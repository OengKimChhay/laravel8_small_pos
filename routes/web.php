<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderDetailController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Auth;

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
Route::get('/', [HomeController::class, 'loginPage'])->middleware('auth');
Route::get('/home', [HomeController::class, 'home'])->name('home')->middleware('auth');

Route::middleware(['middleware'=>'PreventBack'])->group(function(){ //to prevent back (login page after login)
    Auth::routes();
});
    
// for admin
Route::group(['prefix'=>'admin','middleware'=>['is_admin','auth','PreventBack']],function(){
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('/ordersDetail',OrderDetailController::class);
    Route::resource('/products',ProductController::class);
    Route::resource('/users',UserController::class);
    Route::resource('/suppliers',SupplierController::class);
    Route::resource('/companies',CompanyController::class);
    Route::resource('/transactions',TransactionController::class);
});
// for user or cashier
Route::group(['prefix'=>'user','middleware'=>['is_user','auth','PreventBack']],function(){
    Route::get('/home', [UserController::class, 'home'])->name('user.home');
});

