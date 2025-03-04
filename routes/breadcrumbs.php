<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('panel.index', function (BreadcrumbTrail $trail) {
    $trail->push('خانه', route('panel.index'));
});

Breadcrumbs::for('panel.products', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('panel.index');
    $trail->push($category->removeUnderLine, route('panel.products',$category->name));
});
Breadcrumbs::for('panel.underCategory', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('panel.index');
    $trail->push($category->removeUnderLine, route('panel.underCategory',$category->name));
});

Breadcrumbs::for('panel.product', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('panel.products',$product->category);
    $trail->push($product->removeUnderLine, route('panel.product',$product->title));

});
Breadcrumbs::for('panel.cart.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.index');
    $trail->push('سبد خرید', route('panel.cart.index'));

});
Breadcrumbs::for('panel.payment.advance', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.cart.index');
    $trail->push('پرداخت', route('panel.payment.advance'));

});


Breadcrumbs::for('panel.admin', function (BreadcrumbTrail $trail) {
    $trail->push('ادمین  پیج', route('panel.admin'));

});
Breadcrumbs::for('admin.category.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.admin');
    $trail->push('دسته بندی', route('admin.category.index'));
});
Breadcrumbs::for('admin.category.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.category.index');
    $trail->push('ایجاد دسته بندی', route('admin.category.create'));

});
Breadcrumbs::for('admin.category.edit', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('admin.category.index');
    $trail->push('ویرایش دسته', route('admin.category.edit',$category));
});

Breadcrumbs::for('admin.product.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.admin');
    $trail->push('محصولات', route('admin.product.index'));

});
Breadcrumbs::for('admin.product.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.product.index');
    $trail->push('ایجاد محصول جدید', route('admin.product.create'));

});

Breadcrumbs::for('admin.product.edit', function (BreadcrumbTrail $trail,$product) {
    $trail->parent('admin.product.index');
    $trail->push('ویرایش محصول', route('admin.product.edit',$product));

});

Breadcrumbs::for('admin.menu.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.admin');
    $trail->push('منوها', route('admin.menu.index'));
});
Breadcrumbs::for('admin.menu.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.menu.index');
    $trail->push('ایجاد منوی جدید', route('admin.menu.create'));
});

Breadcrumbs::for('admin.menu.edit', function (BreadcrumbTrail $trail,$menu) {
    $trail->parent('admin.menu.index');
    $trail->push('ویرایش منوی ', route('admin.menu.edit',$menu));
});
Breadcrumbs::for('admin.setting.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.admin');
    $trail->push('تنظیمات نرم افزار', route('admin.setting.index'));
});
Breadcrumbs::for('admin.setting.edit', function (BreadcrumbTrail $trail,$setting) {
    $trail->parent('admin.setting.index');
    $trail->push('ویرایش تنظیمات نرم افزار', route('admin.setting.edit',$setting));
});
Breadcrumbs::for('admin.order.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.admin');
    $trail->push('سفارشات نهایی شده', route('admin.order.index'));
});
Breadcrumbs::for('admin.order.invoiceDetails', function (BreadcrumbTrail $trail,$invoice) {
    if (getRoutNameWithUri()!=null)
        session()->put(['referer'=>getRoutNameWithUri()]);
    $trail->parent(session()->get('referer'));
    $trail->push('لیست جزئیات سفارشات کاربر', route('admin.order.invoiceDetails',$invoice));
});

Breadcrumbs::for('admin.order.invoice', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.admin');
    $trail->push('لیست تمامی سفارشات', route('admin.order.invoice'));
});

Breadcrumbs::for('admin.user.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.admin');
    $trail->push('کاربران', route('admin.user.index'));
});
Breadcrumbs::for('admin.product.transaction.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.admin');
    $trail->push('گردش کالا', route('admin.product.transaction.index'));
});
Breadcrumbs::for('admin.product.transaction.details', function (BreadcrumbTrail $trail,$product) {
    $trail->parent('admin.product.transaction.index');
    $trail->push('جزئیات انبار هر محصول', route('admin.product.transaction.details',$product));
});
Breadcrumbs::for('admin.supplier.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.admin');
    $trail->push('تامین کنندگان', route('admin.supplier.index'));
});
Breadcrumbs::for('admin.supplier.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.supplier.index');
    $trail->push('ایجاد تامین کننده جدید', route('admin.supplier.create'));
});
Breadcrumbs::for('admin.supplier.edit', function (BreadcrumbTrail $trail,$supplier) {
    $trail->parent('admin.supplier.index');
    $trail->push('ویرایش تامین کننده ', route('admin.supplier.edit',$supplier));
});
Breadcrumbs::for('admin.brand.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.admin');
    $trail->push('برند ها', route('admin.brand.index'));
});
Breadcrumbs::for('admin.brand.edit', function (BreadcrumbTrail $trail,$brand) {
    $trail->parent('admin.brand.index');
    $trail->push('ویرایش برند', route('admin.brand.edit',$brand));
});

Breadcrumbs::for('admin.brand.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.brand.index');
    $trail->push('ایجاد برند جدید', route('admin.brand.create'));
});
Breadcrumbs::for('admin.finance.transaction.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.admin');
    $trail->push('معین اشخاص', route('admin.finance.transaction.index'));
});
Breadcrumbs::for('admin.finance.transaction.details', function (BreadcrumbTrail $trail,$finance) {
    $trail->parent('admin.finance.transaction.index');
    $trail->push('معین اشخاص کاربر', route('admin.finance.transaction.details',$finance));
});



Breadcrumbs::for('admin.invoice.service.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.admin');
    $trail->push('لیست فاکتور سرویس', route('admin.invoice.service.index'));
});
Breadcrumbs::for('admin.invoice.product.index', function (BreadcrumbTrail $trail) {
    $trail->parent('panel.admin');
    $trail->push('لیست فاکتور کالا', route('admin.invoice.product.index'));
});

Breadcrumbs::for('admin.invoice.product.invoiceProduct', function (BreadcrumbTrail $trail,$invoice) {
    $trail->parent('admin.invoice.product.index');
    $trail->push('نمایش کالاهای فاکتور', route('admin.invoice.product.invoiceProduct',$invoice));
});
Breadcrumbs::for('admin.invoice.product.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.invoice.product.index');
    $trail->push('افزودن کالا به انبار', route('admin.invoice.product.create'));
});

Breadcrumbs::for('admin.invoice.product.edit', function (BreadcrumbTrail $trail,$invoice) {
    $trail->parent('admin.invoice.product.invoiceProduct',$invoice);
    $trail->push('ویرایش فاکتور کالا', route('admin.invoice.product.edit',$invoice));
});
Breadcrumbs::for('admin.invoice.service.invoiceService', function (BreadcrumbTrail $trail,$invoice) {
    $trail->parent('admin.invoice.service.index');
    $trail->push('نمایش سرویس های فاکتور', route('admin.invoice.service.invoiceService',$invoice));
});

Breadcrumbs::for('admin.invoice.service.create', function (BreadcrumbTrail $trail) {
    $trail->parent('admin.invoice.service.index');
    $trail->push('ثبت فاکتور سرویس', route('admin.invoice.service.create'));
});
Breadcrumbs::for('admin.invoice.service.edit', function (BreadcrumbTrail $trail,$invoice) {
    $trail->parent('admin.invoice.service.invoiceService',$invoice);
    $trail->push('ویرایش فاکتور سرویس', route('admin.invoice.service.edit',$invoice));
});



