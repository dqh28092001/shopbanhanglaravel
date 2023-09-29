<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryProduct;
use App\Http\Controllers\HomeController;
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


// BE
Route::get('/admin_login', [AdminController::class,'index']); 
Route::get('/dashboard', [AdminController::class,'show_dashboard']); 
Route::get('/logout', [AdminController::class,'logout']); 
Route::post('/admin_dashboard', [AdminController::class,'dashboard']); 

// BE Category Product
Route::get('/add_category_product', [CategoryProduct::class,'add_category_product']); 
Route::get('/all_category_product', [CategoryProduct::class,'all_category_product']); 
Route::post('/save_category_product', [CategoryProduct::class,'save_category_product']); 
