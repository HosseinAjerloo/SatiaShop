<?php

namespace App\Http\Controllers\Admin\InvoiceList;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResidChargeCapsule\ResidChargeCapsuleSearchRequest;
use App\Models\Bank;
use App\Models\Cart;
use App\Models\FinanceTransaction;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Reside;
use App\Services\SmsService\SatiaService;
use Carbon\Carbon;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class InvoiceListController extends Controller
{
    public function index()
    {
        $breadcrumbs = Breadcrumbs::render('admin.invoice-list.index')->getData()['breadcrumbs'];
        $resides = Reside::whereHas('resideItem', function ($query) {
            $query->whereHas('productResidItem');
        })
            ->whereDoesntHave('resideItem', function ($query) {
                $query->doesntHave('productResidItem');
            })->orWhere('reside_type', 'sell')->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('Admin.InvoiceList.index', compact('resides', 'breadcrumbs'));
    }

    public function search(ResidChargeCapsuleSearchRequest $request)
    {
        $resides = Reside::whereHas('resideItem', function ($query) {
            $query->whereHas('productResidItem');
        })
            ->whereDoesntHave('resideItem', function ($query) {
                $query->doesntHave('productResidItem');
            })->orWhere('reside_type', 'sell')->orderBy('created_at', 'desc')->search()->get();
        foreach ($resides as $key => $reside) {
            $reside->jalalidate = \Morilog\Jalali\Jalalian::forge($reside->created_at)->format('Y/m/d');
            $reside->custumerName = ($reside->user->customer_type == 'natural_person' or empty($reside->user->customer_type)) ? $reside->user->fullName ?? '' : $reside->user->organizationORcompanyName ?? '';
            $reside->capsuleCount = $reside->reside_type == 'sell' ? $reside->resideItem->sum('amount') : $reside->resideItem->count();
            $reside->final_pricePersian = $reside->final_price != 0 ? numberFormat($reside->final_price) : numberFormat($reside->totalPrice());
            $reside->invoiceRoute = $reside->reside_type == 'sell' ? route('admin.sale.show', $reside) : route('admin.invoice.issuance.index', $reside);
            if ($reside->status_bank == 'requested') {
                $reside->image_payment = asset('capsule/images/payment-waiting.svg');
            } elseif ($reside->status_bank == 'failed') {
                $reside->image_payment = asset('capsule/images/close.svg');
            } else {
                $reside->image_payment = asset('capsule/images/success.svg');
            }
            $reside->type_change = $reside->reside_type == 'recharge' ? 'شارژ و تمدید کپسول' : 'فروش';
            $reside->paymentRoute = route('admin.invoice-list.payment', $reside);
        }
        return response()->json(['success' => true, 'data' => $resides]);
    }

    public function payment(Reside $reside)
    {

        try {
            $user = Auth::user();
            $balance = $reside->user->getCreaditBalance();

            $bank = Bank::where('is_active', 1)->first();

            $payment = Payment::create(
                [
                    'bank_id' => $bank->id,
                    'reside_id' => $reside->id,
                    'amount' => $reside->final_price,
                    'state' => 'requested',
                ]
            );
            $payment->update(['order_id' => $payment->id + Payment::transactionNumber]);
            $objBank = new $bank->class;
            $objBank->setOrderID($payment->id + Payment::transactionNumber);
            $objBank->setTotalPrice((float)$reside->final_price);
            $objBank->setBankUrl($bank->url);
            $objBank->setTerminalId($bank->terminal_id);
            $objBank->setUrlBack(route('admin.invoice-list.back'));
            $objBank->setBankModel($bank);


            $status = $objBank->payment();
            $financeTransaction = FinanceTransaction::create([
                'user_id' => $reside->user->id,
                'operator_id' => $user->id,
                'amount' => $payment->amount,
                'type' => "bank",
                "creadit_balance" => $balance,
                'description' => " ارتباط با بانک $bank->name",
                'payment_id' => $payment->id,
            ]);
            if (!$status) {
                $reside->update(['status_bank' => 'failed']);
                $payment->update(['description' => "به دلیل عدم ارتباط با بانک $bank->name سفارش شما لغو شد ", 'state' => 'failed']);
                $financeTransaction->update(['description' => "به دلیل عدم ارتباط با بانک $bank->name سفارش شما لغو شد ", 'status' => 'fail']);
                return redirect()->route('admin.invoice-list.index')->withErrors(['error' => 'ارتباط با بانک فراهم نشد لطفا چند دقیقه بعد تلاش فرماید.']);
            }
            $token = $status;
            session()->put('payment', $payment->id);
            session()->put('reside', $reside->id);
            session()->put('financeTransaction', $financeTransaction->id);
            Log::channel('bankLog')->emergency(PHP_EOL . 'Connection with the bank payment gateway '
                . PHP_EOL .
                'Name of the bank: ' . $bank->name
                . PHP_EOL .
                'payment price: ' . $reside->final_price
                . PHP_EOL .
                'payment date: ' . Carbon::now()->toDateTimeString()
                . PHP_EOL .
                'user ID: ' . $user->id
                . PHP_EOL
            );
            return $objBank->connectionToBank($token);
        } catch (\Exception $e) {
            Log::emergency(PHP_EOL . $e->getMessage() . PHP_EOL);
            return redirect()->route('admin.invoice-list.index')->withErrors(['error' => 'ارتباط با بانک فراهم نشد لطفا چند دقیقه بعد تلاش فرماید.']);
        }
    }

    public function paymentBack(Request $request)
    {
        try {
            $satiaService = new SatiaService();

            $user = Auth::user();
            $balance = Auth::user()->getCreaditBalance();
            $payment = Payment::find(session()->get('payment'));
            $reside = Reside::find(session()->get('reside'));
            $financeTransaction = FinanceTransaction::find(session()->get('financeTransaction'));
            $bank = $payment->bank;
            $objBank = new $bank->class;
            $objBank->setBankModel($bank);
            Log::channel('bankLog')->emergency(PHP_EOL . "Return from the bank and the bank's response to the purchase order " . PHP_EOL . json_encode($request->all()) . PHP_EOL .
                'Bank message: ' . PHP_EOL . $objBank->transactionStatus() . PHP_EOL .
                'user ID :' . $user->id
                . PHP_EOL
            );
            $inputs = array_merge(request()->all(), request()->request->all());

            if (!$objBank->backBank()) {
                $payment->update(
                    [
                        'RefNum' => $inputs['RefNum'] ?? null,
                        'ResNum' => $payment->order_id,
                        'state' => 'failed',
                        'description' => ' پرداخت موفقیت آمیز نبود ' . $objBank->transactionStatus()

                    ]);
                $reside->update(['status_bank' => 'failed']);
                $financeTransaction->update(['description' => ' پرداخت موفقیت آمیز نبود ' . $objBank->transactionStatus(), 'status' => 'fail']);
                $bankErrorMessage = " درگاه بانک $bank->name  تراکنش شمارا به دلیل " . $objBank->transactionStatus() . " ناموفق اعلام کرد باتشکر " . PHP_EOL;
                $satiaService->send($bankErrorMessage, $user->mobile, env('SMS_Number'), env('SMS_Username'), env('SMS_Password'));

                return redirect()->route('admin.invoice-list.index')->withErrors(['error' => ' پرداخت موفقیت آمیز نبود ' . $objBank->transactionStatus()]);
            }

            $back_price = $objBank->verify($payment->amount);
            if ($back_price !== true or Payment::where("order_id", $payment->order_id)->count() > 1) {

                $payment->update(
                    [
                        'RefNum' => $inputs['RefNum'] ?? null,
                        'ResNum' => $payment->order_id,
                        'state' => 'failed',
                        'description' => ' پرداخت موفقیت آمیز نبود ' . $objBank->verifyTransaction($back_price)


                    ]);
                $reside->update(['status_bank' => 'failed']);
                $financeTransaction->update(['description' => ' پرداخت موفقیت آمیز نبود ' . $objBank->verifyTransaction($back_price), 'status' => 'fail']);

                $bankErrorMessage = " درگاه بانک $bank->name تراکنش شمارا به دلیل " . $objBank->verifyTransaction($back_price) . " ناموفق اعلام کرد باتشکر " . PHP_EOL;

                $satiaService->send($bankErrorMessage, $user->mobile, env('SMS_Number'), env('SMS_Username'), env('SMS_Password'));
                Log::channel('bankLog')->emergency(PHP_EOL . "Bank Credit VerifyTransaction Purchase Voucher : " . json_encode($request->all()) . PHP_EOL .
                    'Bank message: ' . $objBank->verifyTransaction($back_price) .
                    PHP_EOL .
                    'user Id: ' . $user->id
                    . PHP_EOL
                );
                return redirect()->route('admin.invoice-list.index')->withErrors(['error-SweetAlert' => $objBank->verifyTransaction($back_price)]);
            }

            $payment->update(
                [
                    'RefNum' => $inputs['RefNum'],
                    'ResNum' => $payment->order_id,
                    'state' => 'finished',
                    'description' => 'پرداخت با موفقیت انجام شد'
                ]);
            $reside->update(['status' => 'paid', 'status_bank' => 'finished']);
            $financeTransaction->update([
                'user_id' => $reside->user->id,
                'amount' => $payment->amount,
                'type' => "deposit",
                "creadit_balance" => $balance + $payment->amount,
                'description' => ' افزایش کیف پول جهت پرداخت سفارش',
                'payment_id' => $payment->id,
            ]);

            FinanceTransaction::create([
                'user_id' => $reside->user->id,
                'operator_id' => $user->id,
                'amount' => $payment->amount,
                'type' => "withdrawal",
                "creadit_balance" => $financeTransaction->creadit_balance - $payment->amount,
                'description' => 'برداشت از کیف پول چهت پرداخت سفارش',
                'payment_id' => $payment->id,
            ]);

            $resideItem = $reside->resideItem;
            if ($reside->reside_type == 'recharge') {
                foreach ($resideItem as $item){
                    foreach ($item->productResidItem as $product) {
                        $productTransaction = $product->productTransaction()->latest()->first();

                        \App\Models\ProductTransaction::create([
                            'user_id' => $user->id,
                            'product_id' => $product->id,
                            'reside_id' => $reside->id,
                            'amount' => $product->pivot->amount,
                            'remain' => $productTransaction->remain - $product->pivot->amount,
                            'type' => 'minus'
                        ]);
                    }

                }

            } else {
                foreach ($resideItem as $item) {
                    $productTransaction = $item->product->productTransaction()->latest()->first();

                    \App\Models\ProductTransaction::create([
                        'user_id' => $user->id,
                        'product_id' => $item->product->id,
                        'reside_id' => $reside->id,
                        'amount' => $item->amount,
                        'remain' => $productTransaction->remain - $item->amount,
                        'type' => 'minus'
                    ]);
                }

            }


            return redirect()->route('admin.invoice-list.index')->with(['success' => 'پرداخت باموفقیت انجام شد']);
        } catch (\Exception $e) {

            Log::channel('bankLog')->emergency(PHP_EOL . "Purchase validation from the payment gateway : " . $e->getMessage() . PHP_EOL);

            return redirect()->route('admin.invoice-list.index')->withErrors(['error-SweetAlert' => "خطایی رخ داد لطفا جهت پیگیری پرداخت با پشتیبانی تماس حاصل فرمایید باتشکر"]);

        }
    }

}
