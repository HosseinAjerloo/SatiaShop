<?php


use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::name('login.')->prefix('login')->group(function () {
        Route::get('', [App\Http\Controllers\Auth\LoginController::class, 'index'])->name('index');
        Route::get('simple-login', [App\Http\Controllers\Auth\LoginController::class, 'simpleLogin'])->name('simple');
        Route::post('simple-login', [App\Http\Controllers\Auth\LoginController::class, 'simpleLoginPost'])->name('simple-post');
    });
    Route::get('register', [App\Http\Controllers\Auth\LoginController::class, 'register'])->name('register');
    Route::post('register/{otp:token}', [App\Http\Controllers\Auth\LoginController::class, 'registerUser'])->name('register.post');
    Route::get('forgot-password', [App\Http\Controllers\Auth\LoginController::class, 'forgotPassword'])->name('forgotPassword');
    Route::post('forgot-password', [App\Http\Controllers\Auth\LoginController::class, 'sendLinkForget'])->name('post.forgotPassword');
    Route::get('forgot-password/{otp:token}', [App\Http\Controllers\Auth\LoginController::class, 'forgotPasswordToken'])->name('forgotPassword.token');
    Route::get('update-password/{otp:token}', [App\Http\Controllers\Auth\LoginController::class, 'updatePassword'])->name('update.Password');
    Route::post('update-password/{otp:token}', [App\Http\Controllers\Auth\LoginController::class, 'updatePasswordPost'])->name('post.update.Password');
    Route::post('create-cod', [App\Http\Controllers\Auth\LoginController::class, 'createCode'])->name('createCode');

});
Route::get('logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');


Route::get('', [App\Http\Controllers\Panel\PanelController::class, 'index'])->name('panel.index');
Route::get('products/{category:name}', [App\Http\Controllers\Panel\PanelController::class, 'products'])->name('panel.products');
Route::get('product/{product:title}', [App\Http\Controllers\Panel\PanelController::class, 'product'])->name('panel.product');

Route::prefix('cart')->name('panel.cart.')->group(function () {
    Route::get('', [App\Http\Controllers\Panel\CartController::class, 'index'])->name('index');
    Route::post('addCard', [App\Http\Controllers\Panel\CartController::class, 'addCart'])->name('addCart');
    Route::post('increase', [App\Http\Controllers\Panel\CartController::class, 'increase'])->name('increase');
    Route::post('decrease', [App\Http\Controllers\Panel\CartController::class, 'decrease'])->name('decrease');
    Route::get('destroy/{cartItem}', [App\Http\Controllers\Panel\CartController::class, 'destroy'])->name('destroy');
});

//PANEL
Route::middleware(['auth'])->name('panel.')->group(function () {
    Route::prefix('payment')->name('payment.')->group(function () {
        Route::get('advance',[App\Http\Controllers\Panel\PaymentController::class, 'advance'])->name('advance');
        Route::post('', [App\Http\Controllers\Panel\PaymentController::class, 'payment'])->name('payment');
        Route::post('paymentBack', [App\Http\Controllers\Panel\PaymentController::class, 'paymentBack'])->withoutMiddleware(Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class)->name('back');
    });

    Route::prefix('order')->name('order.')->group(function (){
       Route::get('',[App\Http\Controllers\Panel\OrderController::class,'index'])->name('order');
       Route::get('order-item/{invoice}',[App\Http\Controllers\Panel\OrderController::class,'orderItem'])->name('order.item');
    });
});


Route::prefix('admin')->middleware(['auth', 'AdminLogin'])->group(function () {
    Route::get('/', [App\Http\Controllers\Admin\AdminController::class, 'index'])->name('panel.admin');
    Route::get('login-another-user/{user}', [App\Http\Controllers\Admin\AdminController::class, 'loginAnotherUser'])->name('panel.admin.login-another-user');
    Route::get('tickets', [App\Http\Controllers\Admin\TicketController::class, 'index'])->name('panel.admin.tickets');
    Route::get('ticket/close/{ticket}', [App\Http\Controllers\Admin\TicketController::class, 'closeTicket'])->name('panel.admin.tickets.close');
    Route::get('ticket-page', [App\Http\Controllers\Admin\TicketController::class, 'ticketPage'])->name('panel.admin.ticket-page');
    Route::get('ticket-chat/{ticket_id}', [App\Http\Controllers\Admin\TicketController::class, 'ticketChat'])->name('panel.admin.ticket-chat');
    Route::post('ticket-message', [App\Http\Controllers\Admin\TicketController::class, 'ticketMessage'])->name('panel.admin.ticket-message');
    Route::get('dollar-price', [App\Http\Controllers\Admin\DollarController::class, 'index'])->name('panel.admin.dollar-price');
    Route::get('dollar-price-submit', [App\Http\Controllers\Admin\DollarController::class, 'priceSubmit'])->name('panel.admin.dollar-price-submit');

    Route::prefix('user')->group(function () {
        Route::get('/', [App\Http\Controllers\Admin\UserController::class, 'index'])->name('panel.admin.user.index');
        Route::get('inactive/{user}', [App\Http\Controllers\Admin\UserController::class, 'inactive'])->name('panel.admin.user.inactive');
        Route::post('search', [App\Http\Controllers\Admin\UserController::class, 'search'])->name('panel.admin.user.search');
    });


    //ADMINMENU

    Route::prefix('menu')->name('admin.menu.')->group(function () {
        Route::get('', [\App\Http\Controllers\Admin\Menu\MenuController::class, 'index'])->name('index');
        Route::get('create', [\App\Http\Controllers\Admin\Menu\MenuController::class, 'create'])->name('create');
        Route::post('store', [\App\Http\Controllers\Admin\Menu\MenuController::class, 'store'])->name('store');
        Route::get('edit/{menu}', [\App\Http\Controllers\Admin\Menu\MenuController::class, 'edit'])->name('edit');
        Route::put('update/{menu}', [\App\Http\Controllers\Admin\Menu\MenuController::class, 'update'])->name('update');
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
    });

    //BRAND

    Route::prefix('brand')->name('admin.brand.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\Brand\BrandController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\Admin\Brand\BrandController::class, 'create'])->name('create');
        Route::post('store', [App\Http\Controllers\Admin\Brand\BrandController::class, 'store'])->name('store');
        Route::get('edit/{brand}', [\App\Http\Controllers\Admin\Brand\BrandController::class, 'edit'])->name('edit');
        Route::put('update/{brand}', [\App\Http\Controllers\Admin\Brand\BrandController::class, 'update'])->name('update');
    });
    //ADMIN ADD PRODUCT

    Route::prefix('product')->name('admin.product.')->group(function () {
        Route::get('', [App\Http\Controllers\Admin\Product\ProductController::class, 'index'])->name('index');
        Route::get('create', [App\Http\Controllers\Admin\Product\ProductController::class, 'create'])->name('create');
        Route::post('store', [App\Http\Controllers\Admin\Product\ProductController::class, 'store'])->name('store');
        Route::get('edit/{product}', [App\Http\Controllers\Admin\Product\ProductController::class, 'edit'])->name('edit');
        Route::put('update/{product}', [App\Http\Controllers\Admin\Product\ProductController::class, 'update'])->name('update');

    });


    //ADMIN SUPPLIER


    Route::prefix('supplier')->name('admin.supplier.')->group(function () {
        Route::get('', [\App\Http\Controllers\Admin\Supplier\SupplierController::class, 'index'])->name('index');
        Route::get('create', [\App\Http\Controllers\Admin\Supplier\SupplierController::class, 'create'])->name('create');
        Route::post('store', [\App\Http\Controllers\Admin\Supplier\SupplierController::class, 'store'])->name('store');
        Route::get('edit/{supplier}', [\App\Http\Controllers\Admin\Supplier\SupplierController::class, 'edit'])->name('edit');
        Route::put('update/{supplier}', [\App\Http\Controllers\Admin\Supplier\SupplierController::class, 'update'])->name('update');
    });

    //ADMIN INVOICE

    Route::prefix('invoice')->name('admin.invoice.')->group(function () {

        Route::prefix('product')->name('product.')->group(function () {
            Route::get('show/{invoice}', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'invoiceProduct'])->name('invoiceProduct');
            Route::get('', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'productIndex'])->name('index');
            Route::get('create', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'create'])->name('create');
            Route::post('store', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'store'])->name('store');
            Route::get('edit/{product}', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'edit'])->name('edit');
            Route::put('update/{product}', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'update'])->name('update');

        });
        Route::prefix('service')->name('service.')->group(function () {
            Route::get('show/{invoice}', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'invoiceService'])->name('invoiceService');
            Route::get('', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'serviceIndex'])->name('index');
            Route::get('create', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'serviceCreate'])->name('create');
            Route::post('store', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'serviceStore'])->name('store');
            Route::get('edit/{service}', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'serviceEdit'])->name('edit');
            Route::put('update/{service}', [App\Http\Controllers\Admin\Invoice\InvoiceController::class, 'serviceUpdate'])->name('update');

        });


    });
});


Route::fallback(function () {
    abort(404);
});

Route::get('test', function () {
    $orders = \Illuminate\Support\Facades\Auth::user()->orders()->latest()->get();
    return view('Site.Invoice.order', compact('orders'));
})->name('test');




