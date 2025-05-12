<?php


use App\Http\Requests\Admin\Product\ProductRequest;
use App\Models\Bank;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use App\Services\ImageService\ImageService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Traits\HasCart;
use Illuminate\Contracts\Database\Eloquent\Builder;


Route::middleware('guest')->group(function () {
    Route::name('login.')->prefix('login')->group(function () {
        Route::get('', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('index');
        Route::get('simple-login', [App\Http\Controllers\Auth\LoginController::class, 'simpleLogin'])->name('simple');
        Route::get('sso_link', [App\Http\Controllers\Auth\LoginController::class, 'ssoLink'])->name('ssoLink');
        Route::get('login-sso', [App\Http\Controllers\Auth\LoginController::class, 'loginWithSso'])->name('loginWithSso');
        Route::post('simple-login', [App\Http\Controllers\Auth\LoginController::class, 'simpleLoginPost'])->name('simple-post');
    });
    Route::get('register', [App\Http\Controllers\Auth\LoginController::class, 'register'])->name('register');
    Route::post('register/{otp:token}', [App\Http\Controllers\Auth\LoginController::class, 'registerUser'])->name('register.post');
    Route::get('forgot-password', [App\Http\Controllers\Auth\LoginController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('forgot-password', [App\Http\Controllers\Auth\LoginController::class, 'sendCodeForget'])->name('post.forgotPassword');
    Route::get('forgot-password/{otp:token}', [App\Http\Controllers\Auth\LoginController::class, 'forgotPasswordToken'])->name('forgotPassword.token');
    Route::get('update-password/{otp:token}', [App\Http\Controllers\Auth\LoginController::class, 'updatePassword'])->name('update.Password');
    Route::post('update-password/{otp:token}', [App\Http\Controllers\Auth\LoginController::class, 'updatePasswordPost'])->name('post.update.Password');
    Route::post('create-cod', [App\Http\Controllers\Auth\LoginController::class, 'createCode'])->name('createCode');

});
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


Route::get('', [App\Http\Controllers\Panel\PanelController::class, 'index'])->name('panel.index');
Route::get('under-category/{category:name}', [App\Http\Controllers\Panel\PanelController::class, 'underCategory'])->name('panel.underCategory');
Route::get('products/{category:name}', [App\Http\Controllers\Panel\PanelController::class, 'products'])->name('panel.products');
Route::get('product/{product:title}', [App\Http\Controllers\Panel\PanelController::class, 'product'])->name('panel.product');
Route::post('find-product', [App\Http\Controllers\Panel\PanelController::class, 'findProductWithAjax'])->name('panel.product.find');
Route::prefix('cart')->name('panel.cart.')->group(function () {
    Route::get('', [App\Http\Controllers\Panel\CartController::class, 'index'])->name('index');
    Route::post('addCard', [App\Http\Controllers\Panel\CartController::class, 'addCart'])->name('addCart');
    Route::post('addCard', [App\Http\Controllers\Panel\CartController::class, 'addCart'])->name('addCart');
    Route::post('increase', [App\Http\Controllers\Panel\CartController::class, 'increase'])->name('increase');
    Route::post('decrease', [App\Http\Controllers\Panel\CartController::class, 'decrease'])->name('decrease');
    Route::get('destroy/{cartItem}', [App\Http\Controllers\Panel\CartController::class, 'destroy'])->name('destroy');
});

//PANEL
Route::middleware(['auth'])->name('panel.')->group(function () {
    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('advance', [App\Http\Controllers\Panel\PaymentController::class, 'advance'])->name('advance');
        Route::post('', [App\Http\Controllers\Panel\PaymentController::class, 'payment'])->name('payment');
        Route::get('paymentBack', [App\Http\Controllers\Panel\PaymentController::class, 'paymentBack'])->withoutMiddleware(Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)->name('back');
    });

    Route::prefix('order')->name('order.')->group(function () {
        Route::get('', [App\Http\Controllers\Panel\OrderController::class, 'index'])->name('index');
        Route::get('invoice-detail-report/{invoice}', [App\Http\Controllers\Panel\OrderController::class, 'invoiceDetail'])->name('invoiceDetail');
    });


    Route::prefix('my-profile')->name('my-profile.')->group(function () {
        Route::get('', [App\Http\Controllers\Panel\UserController::class, 'index'])->name("index");
        Route::put('update', [App\Http\Controllers\Panel\UserController::class, 'update'])->name('update');

    });

});


Route::prefix('admin')->middleware(['auth', 'AdminLogin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('panel.admin');
    Route::put('update', [App\Http\Controllers\Admin\AdminController::class, 'updateUser'])->name('admin.updateUser');
    Route::get('login-another-user/{user}', [App\Http\Controllers\Admin\AdminController::class, 'loginAnotherUser'])->name('panel.admin.login-another-user');
    Route::get('tickets', [App\Http\Controllers\Admin\TicketController::class, 'index'])->name('panel.admin.tickets');
    Route::get('ticket/close/{ticket}', [App\Http\Controllers\Admin\TicketController::class, 'closeTicket'])->name('panel.admin.tickets.close');
    Route::get('ticket-page', [App\Http\Controllers\Admin\TicketController::class, 'ticketPage'])->name('panel.admin.ticket-page');
    Route::get('ticket-chat/{ticket_id}', [App\Http\Controllers\Admin\TicketController::class, 'ticketChat'])->name('panel.admin.ticket-chat');
    Route::post('ticket-message', [App\Http\Controllers\Admin\TicketController::class, 'ticketMessage'])->name('panel.admin.ticket-message');
    Route::get('dollar-price', [App\Http\Controllers\Admin\DollarController::class, 'index'])->name('panel.admin.dollar-price');
    Route::get('dollar-price-submit', [App\Http\Controllers\Admin\DollarController::class, 'priceSubmit'])->name('panel.admin.dollar-price-submit');

    Route::prefix('user')->name('admin.user.')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('index');
    });


    //ADMINMENU

    Route::prefix('menu')->name('admin.menu.')->group(function () {
        Route::get('', [\App\Http\Controllers\Admin\Menu\MenuController::class, 'index'])->name('index');
        Route::get('create', [\App\Http\Controllers\Admin\Menu\MenuController::class, 'create'])->name('create');
        Route::post('store', [\App\Http\Controllers\Admin\Menu\MenuController::class, 'store'])->name('store');
        Route::get('edit/{menu}', [\App\Http\Controllers\Admin\Menu\MenuController::class, 'edit'])->name('edit');
        Route::put('update/{menu}', [\App\Http\Controllers\Admin\Menu\MenuController::class, 'update'])->name('update');
        Route::get('destroy/{menu}', [\App\Http\Controllers\Admin\Menu\MenuController::class, 'destroy'])->name('destroy');
    });

    //ADMINSETTING
    Route::prefix('setting')->name('admin.setting.')->group(function () {
        Route::get('', [\App\Http\Controllers\Admin\Setting\SettingController::class, 'index'])->name('index');
        Route::get('edit/{setting}', [\App\Http\Controllers\Admin\Setting\SettingController::class, 'edit'])->name('edit');
        Route::put('update/{setting}', [\App\Http\Controllers\Admin\Setting\SettingController::class, 'update'])->name('update');
    });

    //ADMINCategory
    Route::prefix('category')->name('admin.category.')->group(function () {
        Route::get('', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'index'])->name('index');
        Route::get('create', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'create'])->name('create');
        Route::post('store', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'store'])->name('store');
        Route::get('edit/{category}', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'edit'])->name('edit');
        Route::put('update/{category}', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'update'])->name('update');
        Route::get('destroy/{category}', [\App\Http\Controllers\Admin\Category\CategoryController::class, 'destroy'])->name('destroy');
    });

    //BRAND

    Route::prefix('brand')->name('admin.brand.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\Brand\BrandController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\Admin\Brand\BrandController::class, 'create'])->name('create');
        Route::post('store', [App\Http\Controllers\Admin\Brand\BrandController::class, 'store'])->name('store');
        Route::get('edit/{brand}', [\App\Http\Controllers\Admin\Brand\BrandController::class, 'edit'])->name('edit');
        Route::put('update/{brand}', [\App\Http\Controllers\Admin\Brand\BrandController::class, 'update'])->name('update');
        Route::get('destroy/{brand}', [\App\Http\Controllers\Admin\Brand\BrandController::class, 'destroy'])->name('destroy');
    });
    //ADMIN ADD PRODUCT

    Route::prefix('product')->name('admin.product.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\Product\ProductController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\Admin\Product\ProductController::class, 'create'])->name('create');
        Route::post('store', [App\Http\Controllers\Admin\Product\ProductController::class, 'store'])->name('store');
        Route::get('edit/{product}', [App\Http\Controllers\Admin\Product\ProductController::class, 'edit'])->name('edit');
        Route::put('update/{product}', [App\Http\Controllers\Admin\Product\ProductController::class, 'update'])->name('update');
        Route::get('destroy/{product}', [App\Http\Controllers\Admin\Product\ProductController::class, 'destroy'])->name('destroy');
        Route::post('toggle-favorite/{product}', [App\Http\Controllers\Admin\Product\ProductController::class, 'toggleFavorite'])->name('toggle-favorite');
    });


    //ADMIN SUPPLIER


    Route::prefix('supplier')->name('admin.supplier.')->group(function () {
        Route::get('', [\App\Http\Controllers\Admin\Supplier\SupplierController::class, 'index'])->name('index');
        Route::get('create', [\App\Http\Controllers\Admin\Supplier\SupplierController::class, 'create'])->name('create');
        Route::post('store', [\App\Http\Controllers\Admin\Supplier\SupplierController::class, 'store'])->name('store');
        Route::get('edit/{supplier}', [\App\Http\Controllers\Admin\Supplier\SupplierController::class, 'edit'])->name('edit');
        Route::put('update/{supplier}', [\App\Http\Controllers\Admin\Supplier\SupplierController::class, 'update'])->name('update');
        Route::prefix('category')->name('category.')->group(function () {
            Route::get('', [\App\Http\Controllers\Admin\Supplier\SupplierCategory\SupplierCategoryController::class, 'index'])->name('index');
            Route::get('create', [\App\Http\Controllers\Admin\Supplier\SupplierCategory\SupplierCategoryController::class, 'create'])->name('create');
            Route::post('store', [\App\Http\Controllers\Admin\Supplier\SupplierCategory\SupplierCategoryController::class, 'store'])->name('store');
            Route::get('edit/{category}', [\App\Http\Controllers\Admin\Supplier\SupplierCategory\SupplierCategoryController::class, 'edit'])->name('edit');
            Route::put('update/{category}', [\App\Http\Controllers\Admin\Supplier\SupplierCategory\SupplierCategoryController::class, 'update'])->name('update');
            Route::delete('destroy/{category}', [\App\Http\Controllers\Admin\Supplier\SupplierCategory\SupplierCategoryController::class, 'destroy'])->name('destroy');
        });
    });

    //ADMIN INVOICE

    Route::prefix('invoice')->name('admin.invoice.')->group(function () {

        Route::prefix('product')->name('product.')->group(function () {
            Route::get('show/{invoice}', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'invoiceProduct'])->name('invoiceProduct');
            Route::get('', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'productIndex'])->name('index');
            Route::get('create', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'create'])->name('create');
            Route::post('store', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'store'])->name('store');
            Route::get('edit/{invoice}', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'editProduct'])->name('edit');
            Route::put('update/{invoice}', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'updateProduct'])->name('update');
            Route::post('add-product-ajax', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'addProduct'])->name('addProduct.ajax');

        });
        Route::prefix('service')->name('service.')->group(function () {
            Route::get('show/{invoice}', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'invoiceService'])->name('invoiceService');
            Route::get('', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'serviceIndex'])->name('index');
            Route::get('create', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'serviceCreate'])->name('create');
            Route::post('store', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'serviceStore'])->name('store');
            Route::get('edit/{invoice}', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'serviceEdit'])->name('edit');
            Route::put('update/{invoice}', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'serviceUpdate'])->name('update');
        });


    });

    Route::prefix('product-transaction')->name('admin.product.transaction.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\ProductTransaction\ProductTransactionController::class, 'index'])->name('index');
        Route::get('details/{product}', [App\Http\Controllers\Admin\ProductTransaction\ProductTransactionController::class, 'details'])->name('details');
    });

    Route::prefix('finance-transaction')->name('admin.finance.transaction.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\FinanceTransAction\FinanceTransActionController::class, 'index'])->name('index');
        Route::get('details/{finance}', [App\Http\Controllers\Admin\FinanceTransAction\FinanceTransActionController::class, 'details'])->name('details');
    });

    Route::prefix('order')->name('admin.order.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\Order\OrderController::class, 'invoice'])->name('invoice');
        Route::get('invoice/details/{invoice}', [App\Http\Controllers\Admin\Order\OrderController::class, 'invoiceDetails'])->name('invoiceDetails');
        Route::get('index', [App\Http\Controllers\Admin\Order\OrderController::class, 'index'])->name('index');
    });

    Route::prefix('bank')->name('admin.bank.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\Bank\BankController::class, 'index'])->name('index');
    });

    Route::prefix('charging-the-capsule')->name('admin.chargingTheCapsule.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\ChargingTheCapsule\ChargingTheCapsuleController::class, 'index'])->name('index');
        Route::post('store', [App\Http\Controllers\Admin\ChargingTheCapsule\ChargingTheCapsuleController::class, 'store'])->name('store');
        Route::get('edit/{reside}', [App\Http\Controllers\Admin\ChargingTheCapsule\ChargingTheCapsuleController::class, 'edit'])->name('edit');
        Route::put('update/{reside}', [App\Http\Controllers\Admin\ChargingTheCapsule\ChargingTheCapsuleController::class, 'update'])->name('update');
        Route::get('print-reside/{reside:id}', [App\Http\Controllers\Admin\ChargingTheCapsule\ChargingTheCapsuleController::class, 'printReside'])->name('printReside');
    });
    Route::prefix('reside-capsule')->name('admin.resideCapsule.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\ResideCapsule\ResideCapsuleController::class, 'index'])->name('index');
        Route::post('/search', [App\Http\Controllers\Admin\ResideCapsule\ResideCapsuleController::class, 'search'])->name('search');
    });
    Route::prefix('invoice-issuance')->name('admin.invoice.issuance.')->group(function () {
        Route::get('{reside}', [App\Http\Controllers\Admin\InvoiceIssuance\InvoiceIssuanceController::class, 'index'])->name('index');
        Route::get('{reside}/{resideItem}/operation', [App\Http\Controllers\Admin\InvoiceIssuance\InvoiceIssuanceController::class, 'operation'])->name('operation');
        Route::post('store/{reside}/{resideItem}', [App\Http\Controllers\Admin\InvoiceIssuance\InvoiceIssuanceController::class, 'storeProductItem'])->name('storeProductItem');
        Route::post('store/{reside}', [App\Http\Controllers\Admin\InvoiceIssuance\InvoiceIssuanceController::class, 'store'])->name('store');
        Route::get('print-factor/{reside}', [App\Http\Controllers\Admin\InvoiceIssuance\InvoiceIssuanceController::class, 'printFactor'])->name('printFactor');

    });

    Route::prefix('sale')->name('admin.sale.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\Sale\SaleController::class, 'index'])->name('index');
        Route::post('', [App\Http\Controllers\Admin\Sale\SaleController::class, 'store'])->name('store');
        Route::get('show/{reside}', [App\Http\Controllers\Admin\Sale\SaleController::class, 'show'])->name('show');
        Route::post('generate-factor/{reside}', [App\Http\Controllers\Admin\Sale\SaleController::class, 'generateFactor'])->name('generate.factor');
        Route::get('print-factor/{reside}', [App\Http\Controllers\Admin\Sale\SaleController::class, 'printFactor'])->name('printFactor');

    });

    Route::prefix('role')->name('admin.role.')->group(function (){
       Route::get('',[App\Http\Controllers\Admin\Role\RoleController::class,'index'])->name('index');
       Route::get('create',[App\Http\Controllers\Admin\Role\RoleController::class,'create'])->name('create');
       Route::get('edit/{role}',[App\Http\Controllers\Admin\Role\RoleController::class,'edit'])->name('edit');
       Route::post('store',[App\Http\Controllers\Admin\Role\RoleController::class,'store'])->name('store');
       Route::get('delete/{role}',[App\Http\Controllers\Admin\Role\RoleController::class,'destroy'])->name('destroy');
    });
    Route::get('print-capsule/{resideItem}',[App\Http\Controllers\Admin\InvoiceIssuance\InvoiceIssuanceController::class, 'printCapsule'])->name('admin.print.capsule');

    Route::view('my-menu','Admin.adminMenu')->name('admin.my-menu');
});


Route::fallback(function () {
    abort(404);
});

Route::get('test2', function () {
    return redirect()->route('test', ['parametr' => 1]);
});

Route::get('test', function () {
})->name('test');

Route::post('create-product', function () {
    dd(request()->all());
})->name('hossein.back');
