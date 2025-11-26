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
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class InvoiceListController extends Controller
{
    public function index()
    {
        $breadcrumbs = Breadcrumbs::render('admin.invoice-list.index')->getData()['breadcrumbs'];
        $resides = Reside::whereDoesntHave('resideItem', function ($query) {
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

            if ($reside->type == 'reside') {
                $reside->image_payment = asset('capsule/images/invoice-wait.svg');
            } elseif ($reside->status_bank == 'requested') {
                $reside->image_payment = asset('capsule/images/payment-waiting.svg');
            } elseif ($reside->status_bank == 'failed') {
                $reside->image_payment = asset('capsule/images/close.svg');
            } else {
                $reside->image_payment = asset('capsule/images/success.svg');
            }
            $reside->type_change = $reside->reside_type == 'recharge' ? 'شارژ و تمدید کپسول' : 'فروش';
            $reside->paymentGatewayRoute = route('admin.invoice-list.payment', $reside);
            $reside->paymentPosRoute = route('admin.invoice-list.pos', $reside);

        }
            if (isset($request->final_price)){
                $record=$resides->filter(function ($res) use ($request){
                   return $res->paymentPrice>=$request->final_price;
                });
                $resides=collect();
                $record->map(function ($res) use ($resides){
                $resides->add($res);

                });

            }
        return response()->json(['success' => true, 'data' => $resides]);
    }

    public function payment(Reside $reside)
    {

        try {
            if ($reside->type == 'reside')
                return redirect()->route('admin.invoice-list.index')->withErrors(['error' => 'لطفاً ابتدا رسید خود را به فاکتور تبدیل نمایید، سپس پرداخت را انجام دهید.']);

            $user = Auth::user();
            $balance = $reside->user->getCreaditBalance();

            $bank = Bank::where('is_active', 1)->first();

            $payment = Payment::create(
                [
                    'bank_id' => $bank->id,
                    'reside_id' => $reside->id,
                    'amount' => $reside->final_price,
                    'state' => 'requested',
                    'payment_type' => 'gateway'
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
                foreach ($resideItem as $item) {
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

    public function paymentPos(Reside $reside)
    {
        try {

            $user = Auth::user();
            $balance = $reside->user->getCreaditBalance();
            Http::fake([
                env('PC_POS') => Http::response([
                    "Envelope" => [
                        "Body" => [
                            "PcPosSaleResponse" => [
                                "PcPosSaleResult" => [
                                    "PacketType" => "",
                                    "ResponseCode" => "00",
                                    "ResponseCodeMessage" => "تراکنش موفق",
                                    "Amount" => "13000",
                                    "CardNo" => "606373******7399",
                                    "ProcessingCode" => "000000",
                                    "TransactionNo" => "001863",
                                    "TransactionTime" => "12:23:38",
                                    "TransactionDate" => "1404/08/21",
                                    "Rrn" => "329515321340",
                                    "ApprovalCode" => "001863",
                                    "TerminalId" => "33765353",
                                    "MerchantId" => "000000131436562",
                                    "OptionalField" => "",
                                    "PcPosStatus" => "ارتباط موفق با دستگاه",
                                    "PcPosStatusCode" => 4,
                                    "OrderId" => "123451",
                                    "SaleId" => "12345"
                                ]
                            ]
                        ]
                    ]
                ], 200)
            ]);
            $payment = Payment::create(
                [
                    'reside_id' => $reside->id,
                    'amount' => $reside->final_price,
                    'state' => 'requested',
                    'payment_type' => 'pos'
                ]
            );

            $payment->update(['order_id' => $payment->id + Payment::transactionNumber]);

            $financeTransaction = FinanceTransaction::create([
                'user_id' => $reside->user->id,
                'operator_id' => $user->id,
                'amount' => $payment->amount,
                'type' => "pos",
                "creadit_balance" => $balance,
                'description' => "ارسال درخواست با دستگاه پوز",
                'payment_id' => $payment->id,
            ]);
            Log::channel('posLog')->emergency(PHP_EOL . 'Connection with pos system the pos payment'
                . PHP_EOL .
                'payment price: ' . $reside->final_price
                . PHP_EOL .
                'payment date: ' . Carbon::now()->toDateTimeString()
                . PHP_EOL .
                'user ID: ' . $user->id
                . PHP_EOL
            );
            $response = Http::post(env('PC_POS_IP'),
                [
                    "token" => env('PC_POS_TOKEN'),
                    "payId" => $payment->order_id,
                    "orderId" => $payment->order_id,
                    "amount" => (float)$reside->final_price
                ]);


            if (!$response->ok() || !$response->successful())
                throw new Exception('filed payment pcPos');

            $body = $response->json('Envelope');
            if (!empty($body) && isset($body['Body'])) {
                $body = $body['Body']['PcPosSaleResponse']['PcPosSaleResult'];
                $payment->update(['pos_info' => $body]);
                if ($body['ResponseCode'] == "00") {

                    $payment->update(
                        [
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
                        foreach ($resideItem as $item) {
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

                } else {
                    $reside->update(['status_bank' => 'failed']);
                    $payment->update(['description' => "پرداخت موفقیت آمیز نبود", 'state' => 'failed']);
                    $financeTransaction->update(['description' => "پرداخت موفقیت آمیز نبود", 'status' => 'fail']);
                    Log::emergency(PHP_EOL . "پرداخت موفقیت آمیز نبود" . PHP_EOL);
                    return redirect()->route('admin.invoice-list.index')->withErrors(['error' => 'پرداخت موفقیت آمیز نبود']);
                }
            }
        } catch (\Exception $error) {
            $reside->update(['status_bank' => 'failed']);
            $payment->update(['description' => "ارتباط با دستگاه پوز فراهم نشد", 'state' => 'failed']);
            $financeTransaction->update(['description' => "ارتباط با دستگاه پوز فراهم نشد", 'status' => 'fail']);
            Log::emergency(PHP_EOL . $error->getMessage() . PHP_EOL);
            return redirect()->route('admin.invoice-list.index')->withErrors(['error' => 'ارتباط با دستگاه پوز فراهم نشد']);
        }
    }

}
