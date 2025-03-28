<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GenrePostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerManageController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderManageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();
Route::get('/', [SiteController::class, 'index'])->name('/');
Route::get('/warranty_policy', [SiteController::class, 'warrantyPolicy'])->name('warranty_policy');
Route::get('/contact', [SiteController::class, 'indexSupport'])->name('contact');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register');
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login');
Route::get('/category/{id}', [SiteController::class, 'category'])->name('category');
Route::get('/category/{categoryId}/{subcategoryId}', [SiteController::class, 'category'])->name('category.show');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('logout.customer');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', UserController::class);
    Route::resource('support', SupportController::class);
    Route::resource('order-manage', OrderManageController::class);

    Route::resource('genre_posts', GenrePostController::class);
    Route::resource('posts', PostController::class);

    Route::resource('banks', BankController::class);
    Route::resource('product', ProductController::class);
    Route::post('/stock/store', [StockController::class, 'store'])->name('stock.store');
    Route::get('/product/{product}/sync-quantity', [ProductController::class, 'syncQuantity'])->name('product.sync-quantity');
    Route::get('/product/{product}/stocks', [StockController::class, 'showProductStocks'])->name('product.stocks');
    Route::delete('/stock/{stock}', [StockController::class, 'destroy'])->name('stock.destroy');

    // Route cho xóa nhiều stock cùng lúc
    Route::delete('/stock/destroy-multiple', [StockController::class, 'destroyMultiple'])->name('stock.destroy-multiple');

    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubCategoryController::class);
    Route::resource('customer-manage', CustomerManageController::class);
    Route::post('/customer-manage/deposit', [CustomerManageController::class, 'storeDeposit'])->name('customer-manage.storeDeposit');
    Route::get('/info/edit', [InfoController::class, 'edit'])->name('info.edit');
    Route::put('/info/update', [InfoController::class, 'update'])->name('info.update');
    Route::get('/customer-manage/deposits/{customerId}', [CustomerManageController::class, 'indexDeposit'])->name('customer-manage.deposits');
});

Route::middleware(['customer'])->group(function () {
    Route::get('/profile', [CustomerController::class, 'profile'])->name('profile.site');
    Route::post('/profile/update-name', [CustomerController::class, 'updateName'])->name('profile.updateName');
    Route::post('/profile/update-password', [CustomerController::class, 'updatePassword'])->name('profile.updatePassword');
    Route::post('/profile/2fa/generate', [CustomerController::class, 'generate2faSecret'])->name('2fa.generate');
    Route::post('/profile/2fa/enable', [CustomerController::class, 'enable2fa'])->name('2fa.enable');
    Route::post('/profile/2fa/disable', [CustomerController::class, 'disable2fa'])->name('2fa.disable');
    Route::get('/checkout', [CustomerController::class, 'bank'])->name('checkout');
    Route::get('/bai-viet', [CustomerController::class, 'indexPost'])->name('post.site');
    Route::post('/order/store', [OrderController::class, 'store'])->middleware('auth:customer')->name('order.store');
    Route::get('/blogs/{genreSlug}/{postSlug}', [CustomerController::class, 'postDetail'])->name('post.detail');
    Route::get('/danh-muc/{genre}', [CustomerController::class, 'genreShow']);
    Route::get('/orders', [CustomerController::class, 'indexOrder'])->name('customer.orders');
    Route::get('/orders/{id}', [CustomerController::class, 'indexOrderDetail'])->name('customer.order.detail');
    Route::post('/orders/search', [CustomerController::class, 'searchOrders'])->name('customer.orders.search');
    Route::get('/orders/{id}/download', [CustomerController::class, 'downloadOrder'])->name('customer.order.download');
    Route::get('/customer/deposits', [CustomerController::class, 'indexDeposit'])->name('customer.deposits.index');


});
