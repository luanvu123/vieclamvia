<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\SubCategoryController;
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
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth']], function () {
      Route::resource('users', UserController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('subcategories', SubCategoryController::class);

});
