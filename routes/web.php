<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Main\CartHomeController;
use App\Http\Controllers\Main\MainHomeController;
use App\Http\Controllers\Main\CategoryHomeController;
use App\Http\Controllers\Main\ProductHomeController;
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
Route::get('admin/login',[LoginController::class, 'index'])->name('login');
Route::post('admin/login/store',[LoginController::class, 'store']);


Route::middleware(['auth'])->group(function (){
    Route::prefix('admin')->group(function (){

        Route::get('main', [MainController::class, 'index']);

        #categories
        Route::prefix('categories')->group(function (){
            Route::get('list', [CategoryController::class, 'index']);
            Route::get('add', [CategoryController::class, 'create']);
            Route::post('add', [CategoryController::class, 'store']);
            Route::get('edit/{category}', [CategoryController::class, 'show']);
            Route::post('edit/{category}', [CategoryController::class, 'update']);
            Route::DELETE('destroy', [CategoryController::class, 'destroy']);
        });
        #product
        Route::prefix('products')->group(function (){
            Route::get('list', [ProductController::class, 'index']);
            Route::get('add', [ProductController::class, 'create']);
            Route::post('add', [ProductController::class, 'store']);
            Route::get('edit/{product}', [ProductController::class, 'show']);
            Route::post('edit/{product}', [ProductController::class, 'update']);
            Route::DELETE('destroy', [ProductController::class, 'destroy']);
        });
        #slider
        Route::prefix('sliders')->group(function (){
            Route::get('list', [SliderController::class, 'index']);
            Route::get('add', [SliderController::class, 'create']);
            Route::post('add', [SliderController::class, 'store']);
            Route::get('edit/{slider}', [SliderController::class, 'show']);
            Route::post('edit/{slider}', [SliderController::class, 'update']);
            Route::DELETE('destroy', [SliderController::class, 'destroy']);
        });

        #contact
        Route::prefix('contacts')->group(function (){
            Route::get('list', [ContactController::class, 'index']);
            Route::get('add', [ContactController::class, 'create']);
            Route::post('add', [ContactController::class, 'store']);
            Route::get('edit/{contact}', [ContactController::class, 'show']);
            Route::post('edit/{contact}', [ContactController::class, 'update']);
            Route::DELETE('destroy', [ContactController::class, 'destroy']);
        });

        #size
        Route::prefix('sizes')->group(function (){
            Route::get('list', [SizeController::class, 'index']);
            Route::get('add', [SizeController::class, 'create']);
            Route::post('add', [SizeController::class, 'store']);
            Route::DELETE('destroy', [SizeController::class, 'destroy']);
        });

        #upload
        Route::post('upload/services', [UploadController::class, 'store']);
    });
});

Route::get('/', [MainHomeController::class, 'index']);

Route::get('/danh-muc/{id}-{slug}.html', [CategoryHomeController::class, 'index']);
Route::get('/san-pham/{id}-{slug}.html',[ProductHomeController::class, 'index']);
Route::post('/services/load-product',[MainHomeController::class, 'loadProduct']);
Route::post('/san-pham/{id}-{slug}.html',[ProductHomeController::class, 'add_review']);

Route::get('search', [MainHomeController::class, 'search'])->name('member.search');

Route::post('add-cart', [CartHomeController::class, 'index']);
Route::get('carts', [CartHomeController::class, 'show']);
Route::post('update-cart', [CartHomeController::class, 'update']);
Route::get('carts/delete/{id}', [CartHomeController::class, 'remove']);
Route::post('carts', [CartHomeController::class, 'addCart']);


Route::get('contacts',[ContactController::class, 'show_contact']);
