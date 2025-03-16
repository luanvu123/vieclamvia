<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\GenrePostController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\Auth\CustomerAuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerManageController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\TypeCustomerController;
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
Route::get('/nap-tien', [SiteController::class, 'checkout'])->name('checkout');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::post('/customer/register', [CustomerAuthController::class, 'register'])->name('customer.register');
Route::post('/customer/login', [CustomerAuthController::class, 'login'])->name('customer.login');
Route::post('/customer/logout', [CustomerAuthController::class, 'logout'])->name('customer.logout');


Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', UserController::class);
    Route::resource('genre_posts', GenrePostController::class);
    Route::resource('posts', PostController::class);
    Route::resource('type_customers', TypeCustomerController::class);

    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubCategoryController::class);
    Route::resource('customer-manage', CustomerManageController::class);
    Route::post('/customer-manage/deposit', [CustomerManageController::class, 'storeDeposit'])->name('customer-manage.storeDeposit');

    Route::get('/customer-manage/deposits/{customerId}', [CustomerManageController::class, 'indexDeposit'])->name('customer-manage.deposits');
});

Route::middleware(['customer'])->group(function () {
    Route::get('/profile', [CustomerController::class, 'profile'])->name('profile.site');
    Route::post('/profile/update-name', [CustomerController::class, 'updateName'])->name('profile.updateName');
    Route::post('/profile/update-password', [CustomerController::class, 'updatePassword'])->name('profile.updatePassword');
      Route::post('/profile/2fa/generate', [CustomerController::class, 'generate2faSecret'])->name('2fa.generate');
    Route::post('/profile/2fa/enable', [CustomerController::class, 'enable2fa'])->name('2fa.enable');
    Route::post('/profile/2fa/disable', [CustomerController::class, 'disable2fa'])->name('2fa.disable');

});
