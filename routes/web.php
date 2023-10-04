<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BrandProduct;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginAndRegisterController;
use App\Http\Controllers\ProductController;
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

// FE
Route::get('/', [HomeController::class,'index']); 
Route::get('/home', [HomeController::class,'index']);   

// Danh mục sản phẩm trang chủ
Route::get('/danh_muc_san_pham/{category_id}', [CategoryProduct::class,'show_category_home']); 
Route::get('/thuong_hieu_san_pham/{brand_id}', [BrandProduct::class,'show_brand_home']); 
Route::get('/detail_product/{product_id}', [ProductController::class,'detail_product']); 

// BE
Route::get('/admin_login', [AdminController::class,'index']); 
Route::get('/dashboard', [AdminController::class,'show_dashboard']); 
Route::get('/logout', [AdminController::class,'logout']); 
Route::post('/admin_dashboard', [AdminController::class,'dashboard']); 

// BE Category Product
Route::get('/add_category_product', [CategoryProduct::class,'add_category_product']); 
Route::get('/edit_category_product/{category_product_id}', [CategoryProduct::class,'edit_category_product']); 
Route::get('/delete_category_product/{category_product_id}', [CategoryProduct::class,'delete_category_product']); 

Route::get('/all_category_product', [CategoryProduct::class,'all_category_product']); 

Route::get('/unactive_category_product/{category_product_id}', [CategoryProduct::class,'unactive_category_product']); 
Route::get('/active_category_product/{category_product_id}', [CategoryProduct::class,'active_category_product']); 

Route::post('/save_category_product', [CategoryProduct::class,'save_category_product']); 
Route::post('/update_category_product/{category_product_id}', [CategoryProduct::class,'update_category_product']); 

// BE Brand Product
Route::get('/add_brand_product', [BrandProduct::class,'add_brand_product']); 
Route::get('/edit_brand_product/{brand_product_id}', [BrandProduct::class,'edit_brand_product']); 
Route::get('/delete_brand_product/{brand_product_id}', [BrandProduct::class,'delete_brand_product']); 

Route::get('/all_brand_product', [BrandProduct::class,'all_brand_product']); 

Route::get('/unactive_brand_product/{brand_product_id}', [BrandProduct::class,'unactive_brand_product']); 
Route::get('/active_brand_product/{brand_product_id}', [BrandProduct::class,'active_brand_product']); 

Route::post('/save_brand_product', [BrandProduct::class,'save_brand_product']); 
Route::post('/update_brand_product/{brand_product_id}', [BrandProduct::class,'update_brand_product']); 


// BE Product
Route::get('/add_product', [ProductController::class,'add_product']); 
Route::get('/edit_product/{product_id}', [ProductController::class,'edit_product']); 
Route::get('/delete_product/{product_id}', [ProductController::class,'delete_product']); 

Route::get('/all_product', [ProductController::class,'all_product']); 

Route::get('/unactive_product/{product_id}', [ProductController::class,'unactive_product']); 
Route::get('/active_product/{product_id}', [ProductController::class,'active_product']); 

Route::post('/save_product', [ProductController::class,'save_product']); 
Route::post('/update_product/{product_id}', [ProductController::class,'update_product']); 


// add to cart
Route::post('/save_cart', [CartController::class,'save_cart']); 
Route::get('/show_cart', [CartController::class,'show_cart']); 
