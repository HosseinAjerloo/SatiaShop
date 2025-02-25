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

    public function underCategory(Category $category)
    {
        $brands=Brand::where('status','active')->get();
        $breadcrumbs=Breadcrumbs::render('panel.underCategory',$category)->getData()['breadcrumbs'];
        return view('Panel.underCategory',compact('category','brands','breadcrumbs'));
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


    public function findProductWithAjax(Request  $request)
    {
        $product=Product::where('title','like','%'.$request->input('name').'%')->first();
        if (!$product)
            return \response()->json(['status'=>false,'route'=>'']);
        return \response()->json(['status'=>true,'route'=>route('panel.product',$product->title)]);
    }


}
