<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainController;
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
Route::get('/',[LoginController::class, 'index']);
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
    });
});

