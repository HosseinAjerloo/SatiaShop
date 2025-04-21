<?php

namespace App\Http\Controllers\Admin\ChargingTheCapsule;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ResidChargeCapsule\ResidChargeCapsuleRequest;
use App\Http\Traits\HasResideChargeCapsule;
use App\Models\Category;
use App\Models\Product;
use App\Models\Reside;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ChargingTheCapsuleController extends Controller
{
    use HasResideChargeCapsule;

    public function index()
    {
        $user = Auth::user();
        $allUser = User::all();
        $myFavorites = $user->productFavorite()->where('status', 'active')->where('type', 'service')->get();
        $products = Product::where('status', 'active')->where('type', 'service')->get();
        $filterProducts = Product::whereIn('id', Product::where('status', 'active')->where('type', 'service')->select(DB::raw('max(id) as id'))->groupBy('category_id')->get()->pluck('id')->toArray())->get();

        return view('Admin.ResidSharchCapsule.index', compact('myFavorites', 'products', 'filterProducts', 'allUser'));
    }

    public function store(ResidChargeCapsuleRequest $request)
    {
        $inputs = $request->all();
        DB::beginTransaction();

        try {
            $operator = Auth::user();
            if ($inputs['customer_type'] == 'natural_person') {
                $user = User::updateOrCreate(
                    ['mobile' => $inputs['mobile'], 'national_code' => $inputs['national_code']],
                    [
                        'name' => $inputs['name'],
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
            if ($this->getResideCapsuleItem()) {
                $totalPrice = array_sum(array_column($this->resideItems, 'price'));
                $resied = Reside::create(
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
            DB::commit();
            $resied->resideItem()->createMany($this->resideItems);
            return redirect()->route('admin.chargingTheCapsule.printReside')->withErrors(['error' => 'خطایی در ثبت اطلاعات شما رخ داد لطفا با پشتیبانی تماس حاصل فرمایید']);


        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->withErrors(['error' => 'خطایی در ثبت اطلاعات شما رخ داد لطفا با پشتیبانی تماس حاصل فرمایید']);
        }
    }

    public function printReside()
    {
        dd('hi');
    }
}
