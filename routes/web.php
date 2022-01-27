<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\CMSController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReportController;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class,'index'])->name('home');
Route::get('/logout', [HomeController::class,'logout'])->name('logout');
//User Management

//Add User-Edit User-Delete User
Route::get('/usermanage',[AdminController::class,'create'])->name('usermanage');
Route::post('/user/store',[AdminController::class,'store'])->name('UserStore');
Route::get('/userlist',[AdminController::class,'show'])->name('userlist');
Route::get('/EditUser/{id}',[AdminController::class,'edit'])->name('EditUser');
Route::post('/updateuser',[AdminController::class,'update'])->name('UpdateUser');
Route::patch('/deleteuser',[AdminController::class,'destroy'])->name('deleteuser');

//Configration Management

//Add Config-Edit Config-Delete Config
Route::get('/configdata',[ConfigController::class,'create'])->name('configdata');
Route::post('/config/store',[ConfigController::class,'store'])->name('ConfigStore');
Route::get('/configlist',[ConfigController::class,'show'])->name('configlist');
Route::get('/EditConfig/{id}',[ConfigController::class,'edit'])->name('EditConfig');
Route::post('/UpdateConfig',[ConfigController::class,'update'])->name('UpdateConfig');
Route::patch('/DeleteConfig',[ConfigController::class,'destroy'])->name('DeleteConfig');


//Banner Management

//Add Banner-Edit Banner-Delete Banner
Route::get('/bannerdata',[BannerController::class,'create'])->name('bannerdata');
Route::post('/banner/store',[BannerController::class,'store'])->name('BannerStore');
Route::get('/bannerlist',[BannerController::class,'show'])->name('bannerlist');
Route::get('/EditBanner/{id}',[BannerController::class,'edit'])->name('EditBanner');
Route::post('/UpdateBanner',[BannerController::class,'update'])->name('UpdateBanner');
Route::patch('/DeleteBanner',[BannerController::class,'destroy'])->name('DeleteBanner');


//Category Management

//Add Category-Edit Category-Delete Category
Route::get('/categorydata',[CategoryController::class,'create'])->name('categorydata');
Route::post('/category/store',[CategoryController::class,'store'])->name('CategoryStore');
Route::get('/categorylist',[CategoryController::class,'show'])->name('categorylist');
Route::get('/EditCategory/{id}',[CategoryController::class,'edit'])->name('EditCategory');
Route::post('/UpdateCategory',[CategoryController::class,'update'])->name('UpdateCategory');
Route::patch('/DeleteCategory',[CategoryController::class,'destroy'])->name('DeleteCategory');

//Product Management

//Add Product-Edit Product-Delete Product
Route::get('/productdata',[ProductController::class,'create'])->name('productdata');
Route::post('/product/store',[ProductController::class,'store'])->name('ProductStore');
Route::get('/product/list',[ProductController::class,'show'])->name('ProductList');
Route::get('/EditProduct/{id}',[ProductController::class,'edit'])->name('EditProduct');
Route::post('/product/update',[ProductController::class,'update'])->name('ProductUpdate');
Route::get('/deleteproduct/{id}',[ProductController::class,'destroy'])->name('deleteproduct');


//Coupon Management
Route::get('/coupon/create',[CouponController::class,'create'])->name('CouponAdd');
Route::post('/coupon/store',[CouponController::class,'store'])->name('CouponStore');
Route::get('/coupon/list',[CouponController::class,'show'])->name('CouponList');
Route::get('/EditCoupon/{id}',[CouponController::class,'edit'])->name('EditCoupon');
Route::post('/coupon/update',[CouponController::class,'update'])->name('CouponUpdate');
Route::patch('/DeleteCoupon',[CouponController::class,'destroy'])->name('DeleteCoupon');

//contact Us
Route::get('/contact/list',[ContactUsController::class,'list'])->name('ContactUs');


//CMS
Route::get('/cmsdata',[CMSController::class,'create'])->name('cmsdata');
Route::post('/cms/store',[CMSController::class,'store'])->name('CmsStore');
Route::get('/displaycms',[CMSController::class,'show'])->name('DisplayCMS');
Route::patch('/DeleteCMS',[CMSController::class,'destroy'])->name('DeleteCMS');
Route::get('/EditCMS/{id}',[CMSController::class,'edit'])->name('EditCMS');
Route::post('/UpdateCMS',[CMSController::class,'update'])->name('UpdateCMS');

//order

Route::get('/order',[OrderController::class,'Orders'])->name('Orders');
Route::get('/displayorder/{id}',[OrderController::class,'OrdersDetail'])->name('OrdersDetail');

//Reports
Route::get('/export-csv', [ReportController::class,'export'])->name('export-csv');
//Route::get('/usercsv',[ReportController::class,'exportCsv'])->name('usercsv');
Route::get('/ordercsv',[ReportController::class,'exportOrderCsv'])->name('ordercsv');
Route::get('/report',[ReportController::class,'report'])->name('report');
// Route::post('/date',[ReportController::class,'date'])->name('date');












