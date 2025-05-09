<?php

namespace App\Http\Controllers\Admin\InvoiceIssuance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InvoiceIssuance\FinalInvoiceIssuanceRequest;
use App\Http\Requests\Admin\InvoiceIssuance\InvoiceIssuanceRequest;
use App\Http\Traits\HasDiscount;
use App\Models\Category;
use App\Models\Reside;
use App\Models\ResideItem;
use Illuminate\Http\Request;

class InvoiceIssuanceController extends Controller
{
    use HasDiscount;

    public function index(Reside $reside)
    {
        return view('Admin.InvoiceIssuance.index', compact('reside'));
    }

    public function operation(Reside $reside, ResideItem $resideItem)
    {
        $categories = Category::class;
        return view('Admin.SelectCapsule.index', compact('reside', 'resideItem', 'categories'));
    }

    public function store(Reside $reside, FinalInvoiceIssuanceRequest $request)
    {
        try {
            $inputs = $request->all();
            $this->compilationResideFactor($reside);
            if (isset($inputs['sodurFactor']) && $inputs['sodurFactor'] == 'yes') {
                return redirect()->route('admin.invoice.issuance.printFactor', $reside)->with(['success' => 'عملیات با موفقیت انجام شد']);
            } else {
                return redirect()->route('admin.invoice.issuance.index', $reside)->with(['success' => 'عملیات با موفقیت انجام شد']);
            }

        } catch (\Exception $exception) {
            return redirect()->route('admin.invoice.issuance.index', $reside)->withErrors(['error' => "خطایی رخ داد لطفا چند دقیقه دیگر تلاش کنید و با پشتیانی تماس حاصل فرمایید"]);

        }
    }

    public function printFactor(Reside $reside)
    {
        return view('Admin.PrintFactorChargeCapsule.index', compact('reside'));
    }

    public function storeProductItem(Reside $reside, ResideItem $resideItem, InvoiceIssuanceRequest $request)
    {
        try {

            $inputs = $request->all();
            $resideItem->productResidItem()->sync($inputs['product_id']);
            $resideItem->update([
                'balloons' => $inputs['balloons'],
                'salary' => $inputs['salary']
            ]);
            return redirect()->route('admin.invoice.issuance.index', $reside)->with('success', "تعوضی موارد مورد نیاز برای کالا {$resideItem->product->removeUnderLine} ثبت شد ");
        } catch (\Exception $exception) {
            return redirect()->route('admin.invoice.issuance.index', $reside)->withErrors(['error' => "خطایی رخ داد لطفا چند دقیقه دیگر تلاش کنید و با پشتیانی تماس حاصل فرمایید"]);
        }

    }

    public function printCapsule(ResideItem $resideItem)
    {
        return view('Admin.PrintCapsule.index', compact('resideItem'));
    }
}
