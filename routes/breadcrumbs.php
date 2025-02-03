<?php
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

Breadcrumbs::for('panel.index', function (BreadcrumbTrail $trail) {
    $trail->push('خانه', route('panel.index'));
});
Breadcrumbs::for('panel.products', function (BreadcrumbTrail $trail,$category) {
    $trail->parent('panel.index');
    $trail->push($category->removeUnderLine, route('panel.products',$category->removeUnderLine));
});

Breadcrumbs::for('panel.product', function (BreadcrumbTrail $trail, $product) {
    $trail->parent('panel.products',$product->category);
    $trail->push($product->removeUnderLine, route('panel.product',$product->removeUnderLine));

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
    $trail->push('ادمین پیج', route('panel.admin'));

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




