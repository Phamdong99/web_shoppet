<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\DiscountController;
use App\Http\Controllers\Admin\LoginController;
use App\Http\Controllers\Admin\MainController;
use App\Http\Controllers\Admin\MemberController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\PaymentMethodController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\SizeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\TransportController;
use App\Http\Controllers\Admin\UploadController;
use App\Http\Controllers\Main\CartHomeController;
use App\Http\Controllers\Main\CategoryHomeController;
use App\Http\Controllers\Main\CheckOutController;
use App\Http\Controllers\Main\HistoryOrderController;
use App\Http\Controllers\Main\LoginHomeController;
use App\Http\Controllers\Main\MainHomeController;
use App\Http\Controllers\Main\ProductHomeController;
use App\Http\Controllers\Main\RegisterController;
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
Route::get('admin/logout',[LoginController::class, 'logout']);

Route::middleware(['auth'])->group(function (){
    Route::name('admin.')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('main', [MainController::class, 'index']);

            #categories
            Route::prefix('categories')->group(function () {
                Route::get('list', [CategoryController::class, 'index']);
                Route::get('add', [CategoryController::class, 'create']);
                Route::post('add', [CategoryController::class, 'store']);
                Route::get('edit/{category}', [CategoryController::class, 'show']);
                Route::post('edit/{category}', [CategoryController::class, 'update']);
                Route::DELETE('destroy', [CategoryController::class, 'destroy']);
            });
            #product
            Route::prefix('products')->group(function () {
                Route::get('list', [ProductController::class, 'index']);
                Route::get('add', [ProductController::class, 'create']);
                Route::post('add', [ProductController::class, 'store']);
                Route::get('edit/{product}', [ProductController::class, 'show']);
                Route::post('edit/{product}', [ProductController::class, 'update']);
                Route::DELETE('destroy', [ProductController::class, 'destroy']);
            });
            #order
            Route::prefix('orders')->group(function () {
                Route::get('list', [OrderController::class, 'index']);
                Route::get('show/{cart}', [OrderController::class, 'show']);
                Route::post('update', [OrderController::class, 'update'])->name('order.update');
            });

            #slider
            Route::prefix('sliders')->group(function () {
                Route::get('list', [SliderController::class, 'index']);
                Route::get('add', [SliderController::class, 'create']);
                Route::post('add', [SliderController::class, 'store']);
                Route::get('edit/{slider}', [SliderController::class, 'show']);
                Route::post('edit/{slider}', [SliderController::class, 'update']);
                Route::DELETE('destroy', [SliderController::class, 'destroy']);
            });

            #contact
            Route::prefix('contacts')->group(function () {
                Route::get('list', [ContactController::class, 'index']);
                Route::get('add', [ContactController::class, 'create']);
                Route::post('add', [ContactController::class, 'store']);
                Route::get('edit/{contact}', [ContactController::class, 'show']);
                Route::post('edit/{contact}', [ContactController::class, 'update']);
                Route::DELETE('destroy', [ContactController::class, 'destroy']);
            });

            #member
            Route::prefix('members')->group(function () {
                Route::get('list', [MemberController::class, 'index']);
                Route::DELETE('destroy', [MemberController::class, 'destroy']);
            });

            #size
            Route::prefix('sizes')->group(function () {
                Route::get('list', [SizeController::class, 'index']);
                Route::get('add', [SizeController::class, 'create']);
                Route::post('add', [SizeController::class, 'store']);
                Route::DELETE('destroy', [SizeController::class, 'destroy']);
            });

            #PaymentMethod
            Route::prefix('payment_methods')->group(function () {
                Route::get('list', [PaymentMethodController::class, 'index']);
                Route::get('add', [PaymentMethodController::class, 'create']);
                Route::post('add', [PaymentMethodController::class, 'store']);
                Route::DELETE('destroy', [PaymentMethodController::class, 'destroy']);
            });

            #Discount
            Route::prefix('discounts')->group(function () {
                Route::get('list', [DiscountController::class, 'index']);
                Route::get('add', [DiscountController::class, 'create']);
                Route::post('add', [DiscountController::class, 'store']);
                Route::DELETE('destroy', [DiscountController::class, 'destroy']);
            });
            #Transport
            Route::prefix('transports')->group(function () {
                Route::get('list', [TransportController::class, 'index']);
                Route::get('add', [TransportController::class, 'create']);
                Route::post('add', [TransportController::class, 'store']);
                Route::DELETE('destroy', [TransportController::class, 'destroy']);
            });


            #review
            Route::prefix('reviews')->group(function () {
                Route::get('list', [ReviewController::class, 'index']);
                Route::get('review_detail/{product}', [ReviewController::class, 'review_detail']);
            });

            #upload
            Route::post('upload/services', [UploadController::class, 'store']);
        });
    });
});

Route::get('member/register',[RegisterController::class, 'register']);
Route::post('member/register/store',[RegisterController::class, 'create_register']);
Route::get('member/login',[LoginHomeController::class, 'index'])->name('member_login');
Route::post('member/login/store',[LoginHomeController::class, 'store']);

Route::get('member/logout',[LoginHomeController::class, 'logout']);


Route::get('/', [MainHomeController::class, 'index'])->name('main');
Route::get('/danh-muc/{id}-{slug}.html', [CategoryHomeController::class, 'index']);
Route::get('/san-pham/{id}-{slug}.html',[ProductHomeController::class, 'index']);
Route::post('update_price_size', [ProductHomeController::class, 'update_price_size']);
Route::post('/services/load-product',[MainHomeController::class, 'loadProduct']);
Route::post('/san-pham/{id}-{slug}.html',[ProductHomeController::class, 'add_review']);
Route::post('/show_pro_detail',[MainHomeController::class, 'show_pro_detail']);




Route::get('contacts',[ContactController::class, 'show_contact']);
Route::get('search', [MainHomeController::class, 'search'])->name('member.search');

Route::middleware(['auth:member'])->group(function () {
    Route::get('member/information',[LoginHomeController::class, 'information']);
    Route::post('add-cart', [CartHomeController::class, 'index']);
    Route::get('carts', [CartHomeController::class, 'show']);
    Route::post('update-cart', [CartHomeController::class, 'update']);
    Route::get('carts/delete/{id}', [CartHomeController::class, 'remove']);
//    Route::get('carts/cart', [CartHomeController::class, 'show_cart']);
    Route::post('check-out', [CheckOutController::class, 'index']);
    Route::post('update_total_checkout', [CheckOutController::class, 'update_total_checkout']);
    Route::post('discount/price', [CheckOutController::class, 'discount_price']);
    Route::post('transport/price', [CheckOutController::class, 'transport_price']);
    Route::get('checkout', [CheckOutController::class, 'checkout']);
    Route::post('checkout', [CheckOutController::class, 'addCart']);
    Route::get('history', [HistoryOrderController::class, 'history_order'])->name('history');
    Route::get('orders/show_detail/{cart}', [HistoryOrderController::class, 'show_detail_order']);
    Route::get('orders/return_goods/{cart}', [HistoryOrderController::class, 'return_goods_order']);
    Route::post('orders/return_goods/{cart}', [HistoryOrderController::class, 'return_goods'])->name('return_goods');
    Route::post('history/update_active', [HistoryOrderController::class, 'update_active']);
});



