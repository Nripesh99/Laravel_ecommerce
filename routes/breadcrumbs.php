<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('admin.index'));
});

// Home > Blog
Breadcrumbs::for('product', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Product', route('products.index'));
});

// Home > Blog > [Category]
// Breadcrumbs::for('category', function (BreadcrumbTrail $trail, $category) {
//     $trail->parent('product');
//     $trail->push($category->title, route('category', $category));
// });

//Home >Product >create
Breadcrumbs::for('product.create', function (BreadcrumbTrail $trail) {
    $trail->parent('product'); // Assuming there's a 'product' breadcrumb defined
    $trail->push('Create', route('products.create'));
});
Breadcrumbs::for('product.index', function (BreadcrumbTrail $trail) {
    $trail->parent('product'); // Assuming there's a 'product' breadcrumb defined
    $trail->push('Create', route('products.index'));
});
//Home> product> user
Breadcrumbs::for('user', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('user', route('users.index'));
});
//home>category
Breadcrumbs::for('category', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('category', route('categories.index'));
});
//home>category>create
Breadcrumbs::for('category.create', function (BreadcrumbTrail $trail) {
    $trail->parent('category');
    $trail->push('Create', route('categories.create'));
});
//home>>stock
Breadcrumbs::for('stock', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('stock', route('stocks.index'));
});
//home>>stock>>create
Breadcrumbs::for('stock.create', function (BreadcrumbTrail $trail) {
    $trail->parent('stock');
    $trail->push('create', route('stocks.create'));
});

//Ecommerce>>shop

Breadcrumbs::for('frontend.shop', function (BreadcrumbTrail $trail) {
    $trail->parent('ecommerce');
    $trail->push('shop', route('frontend.shop'));
});
// Ecommerce
Breadcrumbs::for('ecommerce', function (BreadcrumbTrail $trail) {
    $trail->push('Ecommerce', route('frontend.index'));
});

//Ecommerce>>shop>>details
Breadcrumbs::for('detail.show', function (BreadcrumbTrail $trail) { 
    $trail->parent('frontend.shop');
    $trail->push('Details','frontend.show');
});
//Ecommerce>>cart
Breadcrumbs::for('carts.show', function (BreadcrumbTrail $trail){
    $trail->parent('ecommerce');
    $trail->push('cart', route('carts.show', ['cart' => auth()->id()]));
});
