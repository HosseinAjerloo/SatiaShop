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

