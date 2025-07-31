<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\CricketEquipmentController;
use App\Http\Controllers\Admin\FootballEquipmentController;
use App\Http\Controllers\Admin\BoxingController;
use App\Http\Controllers\Admin\BasketballController;
use App\Http\Controllers\Admin\BadmintonController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DeliveryController;
use App\Http\Middleware\IsAdmin;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// 🌐 Public Welcome Page
Route::get('/', function () {
    return view('welcome');
});

// 🔐 Redirect after login based on usertype
Route::get('/dashboard', function () {
    $user = Auth::user();
    if ($user->usertype === 'admin') {
        return redirect()->route('admin.home');
    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// 🔐 Breeze Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 🛡️ Admin Routes
Route::middleware(['auth', IsAdmin::class])->prefix('admin')->name('admin.')->group(function () {

    // 🏠 Admin Main Dashboard
    Route::get('/home', function () {
        return view('admin.main_dashboard');
    })->name('home');

    // 🏏 Cricket Equipment
    Route::prefix('cricket')->name('cricket.')->group(function () {
        Route::get('/dashboard', [CricketEquipmentController::class, 'index'])->name('dashboard');
        Route::post('/store', [CricketEquipmentController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [CricketEquipmentController::class, 'edit'])->name('edit');
        Route::put('/{id}', [CricketEquipmentController::class, 'update'])->name('update');
        Route::delete('/{id}', [CricketEquipmentController::class, 'destroy'])->name('destroy');
    });

    // ⚽ Football Equipment
    Route::prefix('football')->name('football.')->group(function () {
        Route::get('/dashboard', [FootballEquipmentController::class, 'index'])->name('dashboard');
        Route::post('/store', [FootballEquipmentController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [FootballEquipmentController::class, 'edit'])->name('edit');
        Route::put('/{id}', [FootballEquipmentController::class, 'update'])->name('update');
        Route::delete('/{id}', [FootballEquipmentController::class, 'destroy'])->name('destroy');
    });

    // 🥊 Boxing Equipment
    Route::prefix('boxing')->name('boxing.')->group(function () {
        Route::get('/dashboard', [BoxingController::class, 'dashboard'])->name('dashboard');
        Route::post('/', [BoxingController::class, 'store'])->name('store');
        Route::get('/{boxing}/edit', [BoxingController::class, 'edit'])->name('edit');
        Route::put('/{boxing}', [BoxingController::class, 'update'])->name('update');
        Route::delete('/{boxing}', [BoxingController::class, 'destroy'])->name('destroy');
    });

    // 🏀 Basketball Equipment
    Route::prefix('basketball')->name('basketball.')->group(function () {
        Route::get('/dashboard', [BasketballController::class, 'index'])->name('dashboard');
        Route::post('/store', [BasketballController::class, 'store'])->name('store');
        Route::get('/{id}/edit', [BasketballController::class, 'edit'])->name('edit');
        Route::put('/{id}', [BasketballController::class, 'update'])->name('update');
        Route::delete('/{id}', [BasketballController::class, 'destroy'])->name('destroy');
    });

    // 🏸 Badminton Equipment
    Route::prefix('badminton')->name('badminton.')->group(function () {
        Route::get('/dashboard', [BadmintonController::class, 'dashboard'])->name('dashboard');
        Route::post('/store', [BadmintonController::class, 'store'])->name('store');
        Route::get('/edit/{id}', [BadmintonController::class, 'edit'])->name('edit');
        Route::put('/update/{id}', [BadmintonController::class, 'update'])->name('update');
        Route::delete('/delete/{id}', [BadmintonController::class, 'destroy'])->name('destroy');
    });

    // 👥 Users Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
        Route::post('/store', [UserController::class, 'store'])->name('store');
        Route::delete('/{id}', [UserController::class, 'destroy'])->name('destroy');
    });

    // 📦 Orders
    Route::prefix('orders')->name('orders.')->group(function () {
        Route::get('/dashboard', [OrderController::class, 'index'])->name('dashboard');
    });

    // 🚚 Deliveries
    Route::prefix('deliveries')->name('deliveries.')->group(function () {
        Route::get('/dashboard', [DeliveryController::class, 'index'])->name('dashboard');
    });
});

require __DIR__.'/auth.php';
