<?php

namespace App\Http\Traits;

use App\Models\Product;
use App\Models\Reside;
use App\Models\ResideItem;
use App\Models\User;
use App\Services\SmsService\SatiaService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait  HasResideChargeCapsule
{
    protected $resideItems = array();
    protected $redirectUri;

    protected function registerResideCapsule()
    {

        $inputs = request()->all();
        DB::beginTransaction();

        try {
            $operator = Auth::user();
            $user = $this->findUserWidthScanQrCode()?:$this->whoIsUser();
            if ($this->getResideCapsuleItem()) {
                $totalPrice = array_sum(array_column($this->resideItems, 'price'));
                $reside = Reside::create(
                    [
                        'user_id' => $user->id,
                        'operator_id' => $operator->id,
                        'status_bank' => 'requested',
                        'total_price' => $totalPrice,
                        'discount_collection' => 0,
                        'final_price' => $totalPrice,
                        'status' => 'not_paid',
                        'reside_type' => 'recharge',
                        'type' => 'reside'
                    ]
                );

            } else {
                return redirect()->back()->withErrors(['error' => 'پارامتر وارد شده معتبر نمیباشد']);
            }
            $reside->resideItem()->createMany($this->resideItems);
            DB::commit();
            if (isset($inputs['print'])) {
                $this->redirectUri = redirect()->route('admin.chargingTheCapsule.printReside', $reside)->with(['success' => 'رسید شما صادر شد و عملیات با موفقیت انجام شد.']);;
            } else {
                $this->redirectUri = redirect()->route('admin.resideCapsule.index')->with(['success' => 'رسید شما صادر شد و عملیات با موفقیت انجام شد.']);
            }
            return $this->redirectUri;


        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'خطایی در ثبت اطلاعات شما رخ داد لطفا با پشتیبانی تماس حاصل فرمایید']);
        }
    }

    protected function getResideCapsuleItem(): bool
    {
//        $this->generateUniqueCode();
        $inputs = request()->all();
        if (count($inputs['product_description']) != count($inputs['product_status'])) {
            return false;
        }
        foreach ($inputs['product_description'] as $key => $value) {
            if (!isset($inputs['product_status'][$key]))
                return false;
            $productId = str_contains($key, "_") ? explode('_', $key)[0] : $key;

            $product = Product::find($productId);
            $resideItem = [
                'product_id' => $product->id,
                'price' => 0,
                'type' => $product->type,
                'status' => $inputs['product_status'][$key],
                'description' => $value,
                'unique_code' => isset($inputs['unique_code'])? $inputs['unique_code']: $this->generateUniqueCode()
            ];
            array_push($this->resideItems, $resideItem);
        }

        if (empty($this->resideItems))
            return false;
        return true;
    }

    protected function generateUniqueCode()
    {
        $randomPseudo = openssl_random_pseudo_bytes(6);
        $number = null;
        foreach (str_split($randomPseudo) as $char) {
            $number .= ord($char);
        }
        $number = substr($number, 0, 6);
        if (!$this->isUnique($number)) {
            $this->generateUniqueCode();
        }
        return $number;
    }

    protected function isUnique($number)
    {
        $resideItem = ResideItem::where('unique_code', $number)->count();
        if ($resideItem == 0) {
            return true;
        }
        return false;
    }


    protected function updateResideCapsule()
    {
        $inputs = request()->all();
        DB::beginTransaction();

        try {
            $reside = $inputs['reside'];
            $operator = Auth::user();
            $user = $this->whoIsUser();
            if ($this->getResideCapsuleItem()) {
                $totalPrice = array_sum(array_column($this->resideItems, 'price'));
                $reside->update(
                    [
                        'user_id' => $user->id,
                        'operator_id' => $operator->id,
                        'status_bank' => 'requested',
                        'total_price' => $totalPrice,
                        'discount_collection' => 0,
                        'final_price' => $totalPrice,
                        'status' => 'not_paid',
                        'reside_type' => 'recharge',
                        'type' => 'reside'

                    ]
                );

            } else {
                return redirect()->back()->withErrors(['error' => 'پارامتر وارد شده معتبر نمیباشد']);
            }
            $reside->resideItem()->forceDelete();
            $reside->resideItem()->createMany($this->resideItems);
            DB::commit();
            if (isset($inputs['print'])) {
                $this->redirectUri = redirect()->route('admin.chargingTheCapsule.printReside', $reside)->with(['success' => 'رسید شما صادر شد و عملیات با موفقیت انجام شد.']);;
            } else {
                $this->redirectUri = redirect()->route('admin.resideCapsule.index')->with(['success' => 'رسید شما صادر شد و عملیات با موفقیت انجام شد.']);
            }
            return $this->redirectUri;


        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'خطایی در ثبت اطلاعات شما رخ داد لطفا با پشتیبانی تماس حاصل فرمایید']);
        }
    }


    protected function registerSealCapsule()
    {
        $inputs = request()->all();
        DB::beginTransaction();
        $totalPrice = 0;
        try {
            $operator = Auth::user();
            $user = $this->whoIsUser();
            if ($this->getResideSaleCapsuleItem()) {
                foreach ($this->resideItems as $productItem) {
                    $totalPrice += $productItem['price'] * $productItem['amount'];
                }
                $reside = Reside::create(
                    [
                        'user_id' => $user->id,
                        'operator_id' => $operator->id,
                        'status_bank' => 'requested',
                        'total_price' => $totalPrice,
                        'discount_collection' => 0,
                        'final_price' => $totalPrice,
                        'status' => 'not_paid',
                        'reside_type' => 'sell',
                        'type' => 'reside'
                    ]
                );

            } else {
                return redirect()->back()->withErrors(['error' => 'پارامتر وارد شده معتبر نمیباشد']);
            }
            $reside->resideItem()->createMany($this->resideItems);
            DB::commit();

            $this->redirectUri = redirect()->route('admin.sale.show', $reside)->with(['success' => 'رسید شما صادر شد و عملیات با موفقیت انجام شد.']);;

            return $this->redirectUri;


        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'خطایی در ثبت اطلاعات شما رخ داد لطفا با پشتیبانی تماس حاصل فرمایید']);
        }
    }


    protected function updateSealCapsule()
    {
        $reside = request()->reside;
        $inputs = request()->all();
        DB::beginTransaction();
        $totalPrice = 0;
        try {
            $operator = Auth::user();
            $user = $this->whoIsUser();
            if ($this->getResideSaleCapsuleItem()) {
                foreach ($this->resideItems as $productItem) {
                    $totalPrice += $productItem['price'] * $productItem['amount'];
                }
                $reside->update(
                    [
                        'user_id' => $user->id,
                        'operator_id' => $operator->id,
                        'status_bank' => 'requested',
                        'total_price' => $totalPrice,
                        'discount_collection' => 0,
                        'final_price' => $totalPrice,
                        'status' => 'not_paid',
                        'reside_type' => 'sell',
                        'type' => 'reside'
                    ]
                );

            } else {
                return redirect()->back()->withErrors(['error' => 'پارامتر وارد شده معتبر نمیباشد']);
            }
            $reside->resideItem->each->forceDelete();

            $reside->resideItem()->createMany($this->resideItems);
            DB::commit();

            $this->redirectUri = redirect()->route('admin.sale.show', $reside)->with(['success' => 'رسید شما صادر شد و عملیات با موفقیت انجام شد.']);;

            return $this->redirectUri;


        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'خطایی در ثبت اطلاعات شما رخ داد لطفا با پشتیبانی تماس حاصل فرمایید']);
        }
    }

    protected function getResideSaleCapsuleItem(): bool
    {
        $inputs = request()->all();
        foreach ($inputs['product_description'] as $key => $value) {
            if (!isset($inputs['product_amount'][$key]))
                return false;

            $product = Product::find($key);
            $resideItem = [
                'product_id' => $product->id,
                'price' => $product->price,
                'type' => $product->type,
                'status' => 'sell',
                'description' => $value,
                'amount' => $inputs['product_amount'][$key],
                'unique_code' => $this->generateUniqueCode()

            ];
            array_push($this->resideItems, $resideItem);
        }

        if (empty($this->resideItems))
            return false;
        return true;
    }


    protected function whoIsUser()
    {
        $inputs = request()->all();
        $mobile = isset($inputs['mobile']) ? $inputs['mobile'] : $inputs['mobile_'];
        $user = User::where('mobile', $mobile)->first();

        if ($user) {
            $user->update($inputs);
        } else {
            $inputs['mobile'] = $mobile;
            $inputs['password'] = password_hash($mobile, PASSWORD_DEFAULT);
            $user = User::create($inputs);
        }

        $smsService = new SatiaService();
        $smsService->send('کاربرگرامی شماره موبایل شما همان کلمه عبور شما در نظر گرفته شده است . لطفا در اسرع وقت آن را ویرایش کنید', $user->mobile);

        return $user;
    }

    protected function findUserWidthScanQrCode()
    {
        $inputs=request()->all();
        if (!empty($inputs['user']))
            return $inputs['user'];
        else
            return false;
    }

}
