<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Middleware
|--------------------------------------------------------------------------
*/
use App\Http\Middleware\IsAdmin;
use App\Http\Middleware\IsVendor;
use App\Http\Middleware\IsDeliver;

/*
|--------------------------------------------------------------------------
| Controllers (shared)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OffersController;
use App\Http\Controllers\ReviewsController;
use App\Http\Controllers\Customer\SearchController;

/*
|--------------------------------------------------------------------------
| Orders/Deliveries controllers (Customer + Vendor + Deliver)
|--------------------------------------------------------------------------
*/
use App\Http\Controllers\Customer\OrderController as CustomerOrderController;
use App\Http\Controllers\Vendor\OrderController as VendorOrderController;
use App\Http\Controllers\Deliver\DeliveryController as DeliverDeliveryController;
use App\Http\Controllers\Vendor\ArrivalsController as VendorArrivalsController;
use App\Http\Controllers\Admin\ArrivalsController as AdminArrivalsController;

// Vendor generic products controller
use App\Http\Controllers\Vendor\ProductsController as VendorProductsController;

/*
|--------------------------------------------------------------------------
| Public Landing Page
|--------------------------------------------------------------------------
*/
Route::get('/', fn () => view('welcome'))->name('home');

/*
|--------------------------------------------------------------------------
| Authenticated Dashboard Redirect
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    $type = strtolower((string) (Auth::user()->usertype ?? 'user'));

    return match ($type) {
        'admin'   => redirect()->route('admin.home'),
        'vendor'  => redirect()->route('vendor.dashboard'),
        'deliver' => redirect()->route('deliver.delivery.dashboard'),
        default   => redirect()->route('customer.dashboard'),
    };
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Authenticated User Routes (Customer features)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth'])->group(function () {
    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Cart
    Route::get('/cart', [CartController::class, 'view'])->name('cart.view');
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::delete('/cart', [CartController::class, 'clear'])->name('cart.clear');

    // Payment
    Route::get('/customer/cart/payment', [CartController::class, 'paymentPage'])->name('customer.cart.payment');
    Route::post('/checkout/pay', [CartController::class, 'pay'])->name('checkout.pay');

    // Customer Orders
    Route::get('/orders', [CustomerOrderController::class, 'index'])->name('customer.orders.index');
    Route::get('/orders/{order}', [CustomerOrderController::class, 'show'])
        ->whereNumber('order')->name('customer.orders.show');

    // Customer Search
    Route::get('/customer/search', [SearchController::class, 'search'])->name('customer.search');
});

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', IsAdmin::class])
    ->prefix('admin')
    ->as('admin.')
    ->group(function () {

        Route::get('/home', fn () => view('admin.main_dashboard'))->name('home');
        Route::get('/dashboard', fn () => view('admin.main_dashboard'))->name('dashboard');

        // Arrivals
        Route::prefix('arrivals')->name('arrivals.')->group(function () {
            Route::get('/create', fn () => redirect()->route('admin.arrivals.index'))->name('create');
            Route::get('/',               [AdminArrivalsController::class, 'index'])->name('index');
            Route::post('/',              [AdminArrivalsController::class, 'store'])->name('store');
            Route::get('/{arrival}/edit', [AdminArrivalsController::class, 'edit'])->name('edit');
            Route::put('/{arrival}',      [AdminArrivalsController::class, 'update'])->name('update');
            Route::delete('/{arrival}',   [AdminArrivalsController::class, 'destroy'])->name('destroy');
            Route::delete('/bulk-destroy',[AdminArrivalsController::class, 'bulkDestroy'])->name('bulk-destroy');
        });

        // Cricket
        Route::prefix('cricket')->name('cricket.')->group(function () {
            Route::get('/dashboard', [\App\Http\Controllers\Admin\CricketEquipmentController::class, 'index'])->name('dashboard');
            Route::post('/store',   [\App\Http\Controllers\Admin\CricketEquipmentController::class, 'store'])->name('store');
            Route::get('/{id}/edit',[\App\Http\Controllers\Admin\CricketEquipmentController::class, 'edit'])->name('edit');
            Route::put('/{id}',     [\App\Http\Controllers\Admin\CricketEquipmentController::class, 'update'])->name('update');
            Route::delete('/{id}',  [\App\Http\Controllers\Admin\CricketEquipmentController::class, 'destroy'])->name('destroy');
        });

        // Football
        Route::prefix('football')->name('football.')->group(function () {
            Route::get('/dashboard', [\App\Http\Controllers\Admin\FootballEquipmentController::class, 'index'])->name('dashboard');
            Route::post('/store',   [\App\Http\Controllers\Admin\FootballEquipmentController::class, 'store'])->name('store');
            Route::get('/{id}/edit',[\App\Http\Controllers\Admin\FootballEquipmentController::class, 'edit'])->name('edit');
            Route::put('/{id}',     [\App\Http\Controllers\Admin\FootballEquipmentController::class, 'update'])->name('update');
            Route::delete('/{id}',  [\App\Http\Controllers\Admin\FootballEquipmentController::class, 'destroy'])->name('destroy');
        });

        // Boxing
        Route::prefix('boxing')->name('boxing.')->group(function () {
            Route::get('/dashboard', [\App\Http\Controllers\Admin\BoxingController::class, 'dashboard'])->name('dashboard');
            Route::post('/',         [\App\Http\Controllers\Admin\BoxingController::class, 'store'])->name('store');
            Route::get('/{boxing}/edit', [\App\Http\Controllers\Admin\BoxingController::class, 'edit'])->name('edit');
            Route::put('/{boxing}',       [\App\Http\Controllers\Admin\BoxingController::class, 'update'])->name('update');
            Route::delete('/{boxing}',    [\App\Http\Controllers\Admin\BoxingController::class, 'destroy'])->name('destroy');
        });

        // Basketball
        Route::prefix('basketball')->name('basketball.')->group(function () {
            Route::get('/dashboard', [\App\Http\Controllers\Admin\BasketballController::class, 'index'])->name('dashboard');
            Route::post('/store',    [\App\Http\Controllers\Admin\BasketballController::class, 'store'])->name('store');
            Route::get('/{id}/edit', [\App\Http\Controllers\Admin\BasketballController::class, 'edit'])->name('edit');
            Route::put('/{id}',      [\App\Http\Controllers\Admin\BasketballController::class, 'update'])->name('update');
            Route::delete('/{id}',   [\App\Http\Controllers\Admin\BasketballController::class, 'destroy'])->name('destroy');
        });

        // Badminton
        Route::prefix('badminton')->name('badminton.')->group(function () {
            Route::get('/dashboard', [\App\Http\Controllers\Admin\BadmintonController::class, 'dashboard'])->name('dashboard');
            Route::post('/store',    [\App\Http\Controllers\Admin\BadmintonController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [\App\Http\Controllers\Admin\BadmintonController::class, 'edit'])->name('edit');
            Route::put('/update/{id}', [\App\Http\Controllers\Admin\BadmintonController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [\App\Http\Controllers\Admin\BadmintonController::class, 'destroy'])->name('destroy');
        });

        // Users
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/',       [UserController::class, 'index'])->name('index');
            Route::post('/store', [UserController::class, 'store'])->name('store');
            Route::delete('/{id}',[UserController::class, 'destroy'])->name('destroy');
        });

        // Keep admin dashboard links alive
        Route::prefix('orders')->name('orders.')->group(function () {
            Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))->name('dashboard');
            Route::get('/', fn () => redirect()->route('admin.dashboard'))->name('index');
        });
        Route::prefix('deliveries')->name('deliveries.')->group(function () {
            Route::get('/dashboard', fn () => redirect()->route('admin.dashboard'))->name('dashboard');
            Route::get('/', fn () => redirect()->route('admin.dashboard'))->name('index');
        });
    });

/*
|--------------------------------------------------------------------------
| Vendor Panel Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', IsVendor::class])
    ->prefix('vendor')
    ->as('vendor.')
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [\App\Http\Controllers\Vendor\DashboardController::class, 'index'])->name('dashboard');

        // Vendor Orders
        Route::get('/orders', [VendorOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [VendorOrderController::class, 'show'])
            ->whereNumber('order')->name('orders.show');
        Route::post('/orders/{order}/confirm', [VendorOrderController::class, 'confirm'])
            ->whereNumber('order')->name('orders.confirm');

        // 🔥 FIX: Add missing vendor report routes
        Route::prefix('orders/report')->name('orders.report.')->group(function () {
            Route::get('/today',   [VendorOrderController::class, 'reportToday'])->name('today');
            Route::get('/weekly',  [VendorOrderController::class, 'reportWeekly'])->name('weekly');
            Route::get('/monthly', [VendorOrderController::class, 'reportMonthly'])->name('monthly');
        });

        // Products hub
        Route::get('/products', [VendorProductsController::class, 'home'])->name('products.home');
        Route::prefix('products/{sport}')->group(function () {
            Route::get('/',          [VendorProductsController::class, 'index'])->name('products.index');
            Route::post('/',         [VendorProductsController::class, 'store'])->name('products.store');
            Route::get('/{id}/edit', [VendorProductsController::class, 'edit'])->name('products.edit');
            Route::put('/{id}',      [VendorProductsController::class, 'update'])->name('products.update');
            Route::delete('/{id}',   [VendorProductsController::class, 'destroy'])->name('products.destroy');
        });

        // Arrivals
        Route::prefix('arrivals')->name('arrivals.')->group(function () {
            Route::get('/',               [VendorArrivalsController::class, 'index'])->name('index');
            Route::post('/',              [VendorArrivalsController::class, 'store'])->name('store');
            Route::get('/{arrival}/edit', [VendorArrivalsController::class, 'edit'])->name('edit');
            Route::put('/{arrival}',      [VendorArrivalsController::class, 'update'])->name('update');
            Route::delete('/{arrival}',   [VendorArrivalsController::class, 'destroy'])->name('destroy');
            Route::delete('/bulk-destroy',[VendorArrivalsController::class, 'bulkDestroy'])->name('bulk-destroy');
        });

        // Reviews
        Route::get('/reviews', [\App\Http\Controllers\Vendor\ReviewsController::class, 'index'])->name('reviews.index');
    });

/*
|--------------------------------------------------------------------------
| Deliver Panel Routes
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', IsDeliver::class])
    ->prefix('deliver')
    ->as('deliver.')
    ->group(function () {
        Route::get('/deliveries', [DeliverDeliveryController::class, 'index'])->name('delivery.dashboard');
        Route::post('/deliveries/{delivery}/done',   [DeliverDeliveryController::class, 'delivered'])
            ->whereNumber('delivery')->name('deliveries.delivered');
        Route::post('/deliveries/{delivery}/cancel', [DeliverDeliveryController::class, 'cancelled'])
            ->whereNumber('delivery')->name('deliveries.cancelled');
    });

/*
|--------------------------------------------------------------------------
| Customer Shop Pages
|--------------------------------------------------------------------------
*/
Route::get('/shop', [UserController::class, 'customerDashboard'])->name('customer.dashboard');
Route::get('/shop/sport/cricket',    [UserController::class, 'cricket'])->name('customer.cricket');
Route::get('/shop/sport/football',   [UserController::class, 'football'])->name('customer.football');
Route::get('/shop/sport/badminton',  [UserController::class, 'badminton'])->name('customer.badminton');
Route::get('/shop/sport/basketball', [UserController::class, 'basketball'])->name('customer.basketball');
Route::get('/shop/sport/boxing',     [UserController::class, 'boxing'])->name('customer.boxing');

Route::get('/shop/arrivals', [\App\Http\Controllers\Customer\ArrivalsController::class, 'index'])->name('customer.arrivals');
Route::get('/shop/cart', fn () => redirect()->route('cart.view'))->name('customer.cart');

/*
|--------------------------------------------------------------------------
| Reviews
|--------------------------------------------------------------------------
*/
Route::get('/reviews', [ReviewsController::class, 'index'])->name('customer.reviews');
Route::middleware(['auth'])->group(function () {
    Route::post('/reviews', [ReviewsController::class, 'store'])->name('customer.reviews.store');
});

/*
|--------------------------------------------------------------------------
| Public Pages
|--------------------------------------------------------------------------
*/
Route::get('/offers',    [OffersController::class, 'index'])->name('customer.offers');
Route::view('/about',     'customer.pages.about')->name('customer.about');
Route::view('/contact',   'customer.pages.contact')->name('customer.contact');
Route::view('/delivery',  'customer.pages.delivery')->name('customer.delivery');
Route::view('/branches',  'customer.pages.branches')->name('customer.branches');

require __DIR__.'/auth.php';
