<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;

use App\Http\Traits\HasConfig;
use App\Jobs\SendAppAlertsJob;
use App\Models\Bank;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Doller;
use App\Models\FinanceTransaction;
use App\Models\Invoice;
use App\Models\Menu;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Service;
use App\Models\Voucher;
use App\Notifications\IsEmptyUserInformationNotifaction;
use App\Services\BankService\Saman;
use App\Services\SmsService\SatiaService;
use Carbon\Carbon;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use AyubIRZ\PerfectMoneyAPI\PerfectMoneyAPI;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Response;
use function Laravel\Prompts\alert;


class PanelController extends Controller
{
    use HasConfig;

    public function __construct()
    {
        return true;
    }

    public function index()
    {
        $breadcrumbs=Breadcrumbs::render('panel.index')->getData()['breadcrumbs'];

        $menus=Menu::where("status",'active')->orderBy('view_sort','asc')->get();
        $brands=Brand::where('status','active')->get();
        return view('Panel.index',compact('menus','brands','breadcrumbs'));
    }

    public function products(Category $category){

        $breadcrumbs=Breadcrumbs::render('panel.products',$category)->getData()['breadcrumbs'];

        return view('Panel.products',compact('category','breadcrumbs'));
    }
    public function product(Product $product){

        $breadcrumbs=Breadcrumbs::render('panel.product',$product)->getData()['breadcrumbs'];
        $productTransaction=$product->productTransaction()->orderBy('created_at','desc')->first();

        return view('Panel.product',compact('product','productTransaction','breadcrumbs'));
    }


    public function PurchaseThroughTheBank(PurchaseThroughTheBankRequest $request)
    {
        try {
            $dollar = Doller::orderBy('id', 'desc')->first();
            $inputs = $request->all();
            $user = Auth::user();
            $bank = Bank::find($inputs['bank']);
            $inputs['user_id'] = $user->id;
            $inputs['description'] = " خرید مستقیم ووچر از طریق $bank->name";
            $balance = Auth::user()->getCreaditBalance();

            if (isset($inputs['service_id'])) {
                $service = Service::find($inputs['service_id']);
                $voucherPrice = floor($dollar->DollarRateWithAddedValue() * $service->amount);
            } elseif (isset($inputs['custom_payment'])) {
                $inputs['service_id_custom'] = $inputs['custom_payment'];
                $voucherPrice = floor($dollar->DollarRateWithAddedValue() * $inputs['custom_payment']);
            } else {
                return redirect()->route('panel.purchase.view')->withErrors(['SelectInvalid' => "انتخاب شما معتبر نمیباشد"]);
            }
            $inputs['final_amount'] = $voucherPrice;
            $inputs['type'] = 'service';
            $inputs['status'] = 'requested';
            $inputs['bank_id'] = $bank->id;
            $inputs['time_price_of_dollars'] = $dollar->DollarRateWithAddedValue();
            $inputs['description'] = ' خرید کارت هدیه پرفکت مانی از طریق ' . $bank->name;


            $invoice = Invoice::create($inputs);
            $objBank = new $bank->class;
            $objBank->setTotalPrice($voucherPrice);
            $payment = Payment::create(
                [
                    'bank_id' => $bank->id,
                    'invoice_id' => $invoice->id,
                    'amount' => $voucherPrice,
                    'state' => 'requested',

                ]
            );


            $payment->update(['order_id' => $payment->id + Payment::transactionNumber]);
            $objBank->setOrderID($payment->id + Payment::transactionNumber);
            $objBank->setBankUrl($bank->url);
            $objBank->setTerminalId($bank->terminal_id);
            $objBank->setUrlBack(route('panel.Purchase-through-the-bank'));
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
            if (!$status) {
                $invoice->update(['status' => 'failed', 'description' => "به دلیل عدم ارتباط با بانک $bank->name سفارش شما لغو شد "]);
                $financeTransaction->update(['description' => "به دلیل عدم ارتباط با بانک $bank->name سفارش شما لغو شد ", 'status' => 'fail']);
                return redirect()->route('panel.purchase.view')->withErrors(['error' => 'ارتباط با بانک فراهم نشد لطفا چند دقیقه بعد تلاش فرماید.']);
            }
            $token = $status;
            session()->put('payment', $payment->id);
            session()->put('financeTransaction', $financeTransaction->id);
            Log::channel('bankLog')->emergency(PHP_EOL . 'Connection with the bank payment gateway '
                . PHP_EOL .
                'Name of the bank: ' . $bank->name
                . PHP_EOL .
                'payment price: ' . $voucherPrice
                . PHP_EOL .
                'payment date: ' . Carbon::now()->toDateTimeString()
                . PHP_EOL .
                'user ID: ' . $user->id
                . PHP_EOL
            );
            return $objBank->connectionToBank($token);
        } catch (\Exception $e) {
            SendAppAlertsJob::dispatch('در ارتباط بابانک برای خرید پرفکت مانی خطایی به وجود آمد لطفا پیگیری شود')->onQueue('perfectmoney');
            Log::emergency(PHP_EOL . $e->getMessage() . PHP_EOL);
            return redirect()->route('panel.purchase.view')->withErrors(['error' => 'ارتباط با بانک فراهم نشد لطفا چند دقیقه بعد تلاش فرماید.']);
        }
    }

//
    public function backPurchaseThroughTheBank(Request $request)
    {
        try {
            $satiaService = new SatiaService();

            $dollar = Doller::orderBy('id', 'desc')->first();
            $user = Auth::user();
            $balance = Auth::user()->getCreaditBalance();
            $inputs = $request->all();
            $payment = Payment::find(session()->get('payment'));
            $financeTransaction = FinanceTransaction::find(session()->get('financeTransaction'));
            $bank = $payment->bank;
            $objBank = new $bank->class;
            $objBank->setBankModel($bank);
            Log::channel('bankLog')->emergency(PHP_EOL . "Return from the bank and the bank's response to the purchase of the service " . PHP_EOL . json_encode($request->all()) . PHP_EOL .
                'Bank message: ' . PHP_EOL . $objBank->transactionStatus() . PHP_EOL .
                'user ID :' . $user->id
                . PHP_EOL
            );
            $invoice = $payment->invoice;
            if (!$objBank->backBank()) {
                $payment->update(
                    [
                        'RefNum' => null,
                        'ResNum' => $inputs['ResNum'],
                        'state' => 'failed'

                    ]);
                $invoice->update(['status' => 'failed', 'description' => ' پرداخت موفقیت آمیز نبود ' . $objBank->transactionStatus()]);
                $financeTransaction->update(['description' => ' پرداخت موفقیت آمیز نبود ' . $objBank->transactionStatus(), 'status' => 'fail']);

                $bankErrorMessage = "درگاه بانک سامان تراکنش شمارا به دلیل " . $objBank->transactionStatus() . " ناموفق اعلام کرد باتشکر سایناارز" . PHP_EOL . 'پشتیبانی بانک سامان' . PHP_EOL . '021-6422';
                $satiaService->send($bankErrorMessage, $user->mobile, env('SMS_Number'), env('SMS_Username'), env('SMS_Password'));

                return redirect()->route('panel.purchase.view')->withErrors(['error' => ' پرداخت موفقیت آمیز نبود ' . $objBank->transactionStatus()]);
            }

            $back_price = $objBank->verify($payment->amount);

            if ($back_price !== true or Payment::where("order_id", $inputs['ResNum'])->count() > 1) {
                $invoice->update(['status' => 'failed', 'description' => ' پرداخت موفقیت آمیز نبود ' . $objBank->verifyTransaction($back_price)]);
                $financeTransaction->update(['description' => ' پرداخت موفقیت آمیز نبود ' . $objBank->verifyTransaction($back_price), 'status' => 'fail']);

                $bankErrorMessage = "درگاه بانک سامان تراکنش شمارا به دلیل " . $objBank->verifyTransaction($back_price) . " ناموفق اعلام کرد باتشکر سایناارز" . PHP_EOL . 'پشتیبانی بانک سامان' . PHP_EOL . '021-6422';

                $satiaService->send($bankErrorMessage, $user->mobile, env('SMS_Number'), env('SMS_Username'), env('SMS_Password'));
                Log::channel('bankLog')->emergency(PHP_EOL . "Bank Credit VerifyTransaction Purchase Voucher : " . json_encode($request->all()) . PHP_EOL .
                    'Bank message: ' . $objBank->verifyTransaction($back_price) .
                    PHP_EOL .
                    'user Id: ' . $user->id
                    . PHP_EOL
                );
                return redirect()->route('panel.error', $payment->id);
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
                'description' => ' افزایش کیف پول',
                'payment_id' => $payment->id,
                'time_price_of_dollars' => $dollar->DollarRateWithAddedValue()
            ]);

            $invoice->update(['status' => 'finished']);

            return redirect()->route('panel.deliveryVoucherBankView', [$invoice, $payment]);
        } catch (\Exception $e) {
            Log::emergency("panel Controller :" . $e->getMessage());
            SendAppAlertsJob::dispatch('در خرید پرفکت مانی از درگاه بانکی خطایی به وجود آمد لطفا درگاه و پرفکت مانی را چک کنید(توجه این خطا در برگشت از بانک رخ داده است)')->onQueue('perfectmoney');

            return redirect()->route('panel.purchase.view')->withErrors(['error' => "خطایی رخ داد از صبر و شکیبایی شما مچکریم لطفا جهت پیگیری در خواست تیکت ثبت کنید"]);

        }

    }



}
