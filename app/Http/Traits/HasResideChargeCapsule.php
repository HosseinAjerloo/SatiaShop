<?php

namespace App\Http\Traits;

use App\Models\Product;
use App\Models\Reside;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

trait  HasResideChargeCapsule
{
    protected $resideItems = array();
    protected $redirectUri;

    protected function getResideCapsuleItem(): bool
    {
        $inputs = request()->all();
        if (count($inputs['product_description']) != count($inputs['product_status'])) {
            return false;
        }
        foreach ($inputs['product_description'] as $key => $value) {
            if (!isset($inputs['product_status'][$key]))
                return false;
            $productId=str_contains($key, "_")?explode('_', $key)[0]:$key;

            $product = Product::find($productId);
            $resideItem = [
                'product_id' => $product->id,
                'price' => 0,
                'type' => $product->type,
                'status' => $inputs['product_status'][$key],
                'description' => $value
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
        if ($inputs['customer_type'] == 'natural_person') {
            $user = User::updateOrCreate(
                [ 'national_code' => $inputs['national_code']],
                [
                    'name' => $inputs['name'],
                    'mobile' => $inputs['mobile'],
                    'customer_type' => $inputs['customer_type'],
                    'family' => $inputs['family'],
                    'address' => $inputs['address']
                ]
            );
        } else {
            $user = User::updateOrCreate(
                ['registration_number' => $inputs['registration_number'], 'national_id' => $inputs['national_id']],
                [
                    'organizationORcompanyName' => $inputs['organizationORcompanyName'],
                    'representative_name' => $inputs['representative_name'],
                    'economic_code' => $inputs['economic_code'],
                    'tel' => $inputs['tel']
                ]
            );
        }
        return $user;
    }
    protected function registerResideCapsule()
    {
        $inputs = request()->all();
        DB::beginTransaction();

        try {
            $operator = Auth::user();
            $user=$this->whoIsUser();
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
                        'type'=>'reside'
                    ]
                );

            }
            else{
                return redirect()->back()->withErrors(['error' => 'پارامتر وارد شده معتبر نمیباشد']);
            }
            $reside->resideItem()->createMany($this->resideItems);
            DB::commit();
            if (isset($inputs['print']))
            {
                $this->redirectUri= redirect()->route('admin.chargingTheCapsule.printReside',$reside)->with(['success' => 'رسید شما صادر شد و عملیات با موفقیت انجام شد.']);;
            }else{
                $this->redirectUri=redirect()->route('admin.chargingTheCapsule.index')->with(['success' => 'رسید شما صادر شد و عملیات با موفقیت انجام شد.']);
            }
            return $this->redirectUri;


        } catch (\Exception $exception) {
            dd($exception->getMessage(),$exception->getLine());
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'خطایی در ثبت اطلاعات شما رخ داد لطفا با پشتیبانی تماس حاصل فرمایید']);
        }
    }
    protected function updateResideCapsule()
    {
        $inputs = request()->all();
        DB::beginTransaction();

        try {
            $reside=$inputs['reside'];
            $operator = Auth::user();
            $user=$this->whoIsUser();
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
                        'type' => 'recharge'
                    ]
                );

            }
            else{
                return redirect()->back()->withErrors(['error' => 'پارامتر وارد شده معتبر نمیباشد']);
            }
            $reside->resideItem()->forceDelete();
            $reside->resideItem()->createMany($this->resideItems);
            DB::commit();
            if (isset($inputs['print']))
            {
                $this->redirectUri= redirect()->route('admin.chargingTheCapsule.printReside',$reside)->with(['success' => 'رسید شما صادر شد و عملیات با موفقیت انجام شد.']);;
            }else{
                $this->redirectUri=redirect()->route('admin.chargingTheCapsule.index')->with(['success' => 'رسید شما صادر شد و عملیات با موفقیت انجام شد.']);
            }
            return $this->redirectUri;


        } catch (\Exception $exception) {
            dd($exception->getMessage(),$exception->getLine());
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'خطایی در ثبت اطلاعات شما رخ داد لطفا با پشتیبانی تماس حاصل فرمایید']);
        }
    }



}
