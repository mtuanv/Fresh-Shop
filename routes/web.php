<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

//Front-end
Route::get('/', [\App\Http\Controllers\ShopController::class, 'index'])->name('index');
Route::get('/aboutus', [\App\Http\Controllers\ShopController::class, 'about'])->name('aboutus');
Route::get('/blog', [\App\Http\Controllers\ShopController::class, 'blog'])->name('blog');
Route::get('/blogDetail/{id}', [\App\Http\Controllers\ShopController::class, 'blogDetail'])->name('blogDetail');
Route::get('/contactus', [\App\Http\Controllers\ShopController::class, 'contact'])->name('contactus');
Route::get('/cart', [\App\Http\Controllers\ShopController::class, 'cart'])->name('cart');
Route::get('/menu', [\App\Http\Controllers\ShopController::class, 'menu'])->name('menu');
Route::get('/detail/{id}', [\App\Http\Controllers\ShopController::class, 'detail'])->name('detail');
Route::get('/searchHeader', [\App\Http\Controllers\ShopController::class, 'searchHeader'])->name('searchHeader');
Route::get('/slideFilter', [\App\Http\Controllers\ShopController::class, 'slideFilter'])->name('slideFilter');

//Route cua gio hang
Route::get('/Add-Cart/{id}', [\App\Http\Controllers\CartController::class, 'AddCart'])->name('AddnewCart');
Route::get('/Delete-Item-Cart/{id}', [\App\Http\Controllers\CartController::class, 'DeleteItemCart'])->name('DeleteItem');
Route::get('/List-Carts', [\App\Http\Controllers\CartController::class, 'ViewListCart'])->name('ShowCart');
Route::get('/Delete-Item-List-Cart/{id}', [\App\Http\Controllers\CartController::class, 'DeleteItemListCart'])->name('DeleteList');

//back-end
Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::middleware(['auth', 'checkAdmin'])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [\App\Http\Controllers\UserController::class, 'index'])->name('dashboard');
        Route::post('/update', [\App\Http\Controllers\UserController::class, 'update'])->name('updateuser');
        Route::post('/dashboard/user_edit', [App\Http\Controllers\UserController::class, 'edit'])->name('edituser');
        Route::get('/user_delete/{id}', [\App\Http\Controllers\UserController::class, 'destroy'])->name('deleteuser');
        Route::resource('/tags', \App\Http\Controllers\TagController::class);
        Route::resource('/products', \App\Http\Controllers\ProductController::class);
        Route::resource('/promotions', \App\Http\Controllers\PromotionController::class);
        Route::post('/promotion_status/{id}', [App\Http\Controllers\PromotionController::class, 'changeStatus'])->name('changestt');
        Route::resource('/orders', \App\Http\Controllers\OrderController::class);
        Route::post('/order_status/{id}', [App\Http\Controllers\OrderController::class, 'changeStatus'])->name('changesttorder');
        Route::get('/dayreport', [\App\Http\Controllers\ReportController::class, 'day'])->name('dayreport');
        Route::get('/monthreport', [\App\Http\Controllers\ReportController::class, 'month'])->name('monthreport');
    });
});
