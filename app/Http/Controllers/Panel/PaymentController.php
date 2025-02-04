<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Http\Requests\Panel\PaymentRequest;
use App\Jobs\SendAppAlertsJob;
use App\Models\Bank;
use App\Models\Cart;
use App\Models\Doller;
use App\Models\FinanceTransaction;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Service;
use App\Services\SmsService\SatiaService;
use Carbon\Carbon;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    public function advance(Request $request)
    {
        $user = Auth::user();
        $myCart = Cart::where('status', 'addToCart')->where(function ($query) use ($request, $user) {
            $query->orWhere('user_id', $user ? $user->id : null)->orWhere('user_ip', $request->ip());

        })->first();
        if (!$myCart)
            return redirect()->route('panel.index')->withErrors(['error'=>'سبد خرید شما خالی است لطفا کالایی را انتخاب کنید']);
        $banks=Bank::where("is_active",'1')->get();
        $breadcrumbs=Breadcrumbs::render('panel.payment.advance')->getData()['breadcrumbs'];

        return view('Panel.payment',compact('banks','myCart','breadcrumbs'));
    }
    public function payment(PaymentRequest $request)
    {
        try {
            $user = Auth::user();
            $balance = Auth::user()->getCreaditBalance();

            $inputs = $request->all();
            $bank = Bank::find($inputs['payment_type']);
            $myCart = Cart::where('status', 'addToCart')->where('user_id', $user->id)->first();
            $myCart->finalPrice=round($myCart->finalPrice);
            $myCart->update(['status','applyToTheBank']);
            $invoice = Invoice::create([
                'user_id' => $user->id,
                'bank_id' => $bank->id,
                'status_bank' => 'requested',
                'final_amount' => $myCart->finalPrice,
                'status' => 'not_paid',
                'type_of_business' => 'sales'
            ]);

            $payment = Payment::create(
                [
                    'bank_id' => $bank->id,
                    'invoice_id' => $invoice->id,
                    'amount' => $myCart->finalPrice,
                    'state' => 'requested',

                ]
            );
            $payment->update(['order_id' => $payment->id + Payment::transactionNumber]);
            $objBank = new $bank->class;
            $objBank->setOrderID($payment->id + Payment::transactionNumber);
            $objBank->setTotalPrice($myCart->finalPrice);
            $objBank->setBankUrl($bank->url);
            $objBank->setTerminalId($bank->terminal_id);
            $objBank->setUrlBack(route('panel.payment.back'));
            $objBank->setBankModel($bank);


            $status = $objBank->payment();
            $financeTransaction = FinanceTransaction::create([
                'user_id' => $user->id,
                'amount' => $payment->amount,
                'type' => "bank",
                "creadit_balance" => $balance,
                'description' => " ارتباط با بانک $bank->name",
                'payment_id' => $payment->id,
            ]);
//            dd($status);
            if (!$status) {
                $invoice->update(['description' => "به دلیل عدم ارتباط با بانک $bank->name سفارش شما لغو شد ",'status_bank'=>'fail']);
                $financeTransaction->update(['description' => "به دلیل عدم ارتباط با بانک $bank->name سفارش شما لغو شد ", 'status' => 'fail']);
                return redirect()->route('panel.cart.index')->withErrors(['error' => 'ارتباط با بانک فراهم نشد لطفا چند دقیقه بعد تلاش فرماید.']);
            }
            $token = $status;
            session()->put('payment', $payment->id);
            session()->put('financeTransaction', $financeTransaction->id);
            Log::channel('bankLog')->emergency(PHP_EOL . 'Connection with the bank payment gateway '
                . PHP_EOL .
                'Name of the bank: ' . $bank->name
                . PHP_EOL .
                'payment price: ' . $myCart->finalPrice
                . PHP_EOL .
                'payment date: ' . Carbon::now()->toDateTimeString()
                . PHP_EOL .
                'user ID: ' . $user->id
                . PHP_EOL
            );
            return $objBank->connectionToBank($token);
        } catch (\Exception $e) {
            SendAppAlertsJob::dispatch('در ارتباط با بانک در پروژه کپسول خطایی پیش آمدر لطفا ارتباط خود را برسی کنید')->onQueue('perfectmoney');
            Log::emergency(PHP_EOL . $e->getMessage() . PHP_EOL);
            return redirect()->route('panel.cart.index')->withErrors(['error' => 'ارتباط با بانک فراهم نشد لطفا چند دقیقه بعد تلاش فرماید.']);
        }
    }
    public function paymentBack(Request $request)
    {
        try {
            $satiaService = new SatiaService();

            $user = Auth::user();
            $balance = Auth::user()->getCreaditBalance();
            $inputs = $request->all();
            $payment = Payment::find(session()->get('payment'));
            $financeTransaction = FinanceTransaction::find(session()->get('financeTransaction'));
            $bank = $payment->bank;
            $objBank = new $bank->class;
            $objBank->setBankModel($bank);
            $myCart = Cart::where('status', 'addToCart')->where('user_id', $user->id)->first();
            $invoice = $payment->invoice;
            foreach ($myCart->cartItem as $cartItem) {
                $invoice->invoiceItem()->create([
                    'product_id' => $cartItem->product_id,
                    'price' => $cartItem->price,
                    'amount' => $cartItem->amount,
                    'type' => $cartItem->type
                ]);
            }

            Log::channel('bankLog')->emergency(PHP_EOL . "Return from the bank and the bank's response to the purchase order " . PHP_EOL . json_encode($request->all()) . PHP_EOL .
                'Bank message: ' . PHP_EOL . $objBank->transactionStatus() . PHP_EOL .
                'user ID :' . $user->id
                . PHP_EOL
            );
            if (!$objBank->backBank()) {
                $payment->update(
                    [
                        'RefNum' => null,
                        'ResNum' => $inputs['ResNum'],
                        'state' => 'failed'

                    ]);
                $invoice->update([ 'description' => ' پرداخت موفقیت آمیز نبود ' . $objBank->transactionStatus(),'status_bank'=>'failed']);
                $financeTransaction->update(['description' => ' پرداخت موفقیت آمیز نبود ' . $objBank->transactionStatus(), 'status' => 'fail']);

                $bankErrorMessage = "درگاه بانک سامان تراکنش شمارا به دلیل " . $objBank->transactionStatus() . " ناموفق اعلام کرد باتشکر " . PHP_EOL . 'پشتیبانی بانک سامان' . PHP_EOL . '021-6422';
                $satiaService->send($bankErrorMessage, $user->mobile, env('SMS_Number'), env('SMS_Username'), env('SMS_Password'));

                return redirect()->route('panel.index')->withErrors(['error' => ' پرداخت موفقیت آمیز نبود ' . $objBank->transactionStatus()]);
            }

            $back_price = $objBank->verify($payment->amount);
            if ($back_price !== true or Payment::where("order_id", $inputs['ResNum'])->count() > 1) {
                $payment->update(
                    [
                        'RefNum' => null,
                        'ResNum' => $inputs['ResNum'],
                        'state' => 'failed'

                    ]);
                $invoice->update([ 'description' => ' پرداخت موفقیت آمیز نبود ' . $objBank->verifyTransaction($back_price),'status_bank'=>'failed']);
                $financeTransaction->update(['description' => ' پرداخت موفقیت آمیز نبود ' . $objBank->verifyTransaction($back_price), 'status' => 'fail']);

                $bankErrorMessage = "درگاه بانک سامان تراکنش شمارا به دلیل " . $objBank->verifyTransaction($back_price) . " ناموفق اعلام کرد باتشکر " . PHP_EOL . 'پشتیبانی بانک سامان' . PHP_EOL . '021-6422';

                $satiaService->send($bankErrorMessage, $user->mobile, env('SMS_Number'), env('SMS_Username'), env('SMS_Password'));
                Log::channel('bankLog')->emergency(PHP_EOL . "Bank Credit VerifyTransaction Purchase Voucher : " . json_encode($request->all()) . PHP_EOL .
                    'Bank message: ' . $objBank->verifyTransaction($back_price) .
                    PHP_EOL .
                    'user Id: ' . $user->id
                    . PHP_EOL
                );
                return redirect()->route('panel.index')->withErrors(['not_paid'=>$objBank->verifyTransaction($back_price)]);
            }

            $payment->update(
                [
                    'RefNum' => $inputs['RefNum'],
                    'ResNum' => $inputs['ResNum'],
                    'state' => 'finished'
                ]);

            $financeTransaction->update([
                'user_id' => $user->id,
                'amount' => $payment->amount,
                'type' => "deposit",
                "creadit_balance" => $balance + $payment->amount,
                'description' => ' افزایش کیف پول جهت پرداخت سفارش',
                'payment_id' => $payment->id,
            ]);

            FinanceTransaction::create([
                'user_id' => $user->id,
                'amount' => $payment->amount,
                'type' => "withdrawal",
                "creadit_balance" => $financeTransaction->creadit_balance - $payment->amount,
                'description' => 'برداشت از کیف پول چهت پرداخت سفارش',
                'payment_id' => $payment->id,
            ]);



            foreach ($myCart->cartItem as $cartItem) {

                $productTransaction = $cartItem->product->productTransaction()->latest()->first();
                \App\Models\ProductTransaction::create([
                    'user_id' => $user->id,
                    'product_id' => $cartItem->product_id,
                    'invoice_id' => $invoice->id,
                    'amount' => $cartItem->amount,
                    'remain' => $productTransaction->remain - $cartItem->amount,
                    'type'=>'minus'
                ]);
            }
            Order::create([
                'user_id'=>$user->id,
                'invoice_id'=>$invoice->id,
                'total_price'=>$invoice->final_amount
            ]);


            $invoice->update(['status' => 'paid','description'=>'پرداخت موفقیت آمیز']);
            $myCart->delete();

            return redirect()->route('order.invoiceDetail', $invoice);
        } catch (\Exception $e) {
            Log::channel('bankLog')->emergency(PHP_EOL . "Purchase validation from the payment gateway : " .  $e->getMessage() . PHP_EOL);
            SendAppAlertsJob::dispatch('(هنگام برگشت از بانک جهت اعتبارسنجی پرداخت کاربر خطایی به وجود آمد لطفا برسی کنید)')->onQueue('perfectmoney');

            return redirect()->route('panel.index')->withErrors(['error' => "خطایی رخ داد لطفا جهت پیگیری پرداخت با پشتیبانی تماس حاصل فرمایید باتشکر"]);

        }
    }

}
