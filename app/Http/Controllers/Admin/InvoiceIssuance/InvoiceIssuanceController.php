<?php

namespace App\Http\Controllers\Admin\InvoiceIssuance;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\InvoiceIssuance\FinalInvoiceIssuanceRequest;
use App\Http\Requests\Admin\InvoiceIssuance\InvoiceIssuanceRequest;
use App\Http\Traits\HasDiscount;
use App\Models\Category;
use App\Models\Product;
use App\Models\Reside;
use App\Models\ResideItem;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class
InvoiceIssuanceController extends Controller
{
    use HasDiscount;

    public function index(Reside $reside)
    {
        Gate::authorize('admin.invoice.issuance.index');
        $breadcrumbs = Breadcrumbs::render('admin.invoice.issuance.index', $reside)->getData()['breadcrumbs'];
        return view('Admin.InvoiceIssuance.index', compact('reside', 'breadcrumbs'));
    }

    public function operation(Reside $reside, ResideItem $resideItem)
    {
        Gate::authorize('admin.invoice.issuance.operation');
        $breadcrumbs = Breadcrumbs::render('admin.invoice.issuance.operation', $reside, $resideItem)->getData()['breadcrumbs'];

        $categories = Category::class;
        return view('Admin.SelectCapsule.index', compact('reside', 'resideItem', 'categories', 'breadcrumbs'));
    }

    public function store(Reside $reside, FinalInvoiceIssuanceRequest $request)
    {

        try {
            $inputs = $request->all();
            $this->compilationResideFactor($reside);
            if (isset($inputs['sodurFactor']) && $inputs['sodurFactor'] == 'yes') {
                return redirect()->route('admin.invoice.issuance.printFactor', $reside)->with(['success' => 'عملیات با موفقیت انجام شد']);
            } else {
                return redirect()->route('admin.resideCapsule.index', $reside)->with(['success' => 'عملیات با موفقیت انجام شد']);
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
            $productItems=[];
            foreach ($inputs['product_id'] as $key => $product)
            {
                $productItems[$product]=['price'=>Product::find($product)->price];
            }
            $resideItem->productResidItem()->sync($productItems);
            $resideItem->update([
                'balloons' => $inputs['balloons'],

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
