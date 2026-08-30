<?php

use App\Http\Controllers\MenuController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('menu');
});

Route::get('/menu', [MenuController::class, 'index'])
->name('menu');

Route::get('/cart', [MenuController::class, 'cart'])
->name('cart');

Route::post('/cart/add', [MenuController::class, 'AddToCart'])
->name('add.to.cart');

Route::get('/cart/remove/{id}', [MenuController::class, 'removeFromCart'])
->name('cart.remove');

Route::get('/checkout', function () {
    return view('customer.layouts.checkout');
})->name('checkout');
