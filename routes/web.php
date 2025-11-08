<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SuperadminController;
use App\Http\Controllers\UserController;

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

// Route::get('/', [PageController::class, 'login'])->name('index');
Route::get('/', function () {
    return redirect()->route('login');
});



require __DIR__ . '/auth.php';


// Routes for superadmin users

Route::middleware(['auth', 'role:superadmin'])->group(function () {
    Route::get('/superadmin/dashboard', [SuperadminController::class, 'SuperAdminDashboard'])->name('superadmin.dashboard');


    Route::resource('/superadmin/user', UserController::class)->names([
        'index' => 'superadmin.user.index',
        'create' => 'superadmin.user.create',
        'store' => 'superadmin.user.store',
        'show' => 'superadmin.user.show',
        'edit' => 'superadmin.user.edit',
        'update' => 'superadmin.user.update',
        'destroy' => 'superadmin.user.destroy',
    ]);

    // superadmin products
    Route::resource('/superadmin/products', ProductController::class)->names([
        'index' => 'superadmin.products.index',
        'create' => 'superadmin.products.create',
        'store' => 'superadmin.products.store',
        'show' => 'superadmin.products.show',
        'edit' => 'superadmin.products.edit',
        'update' => 'superadmin.products.update',
        'destroy' => 'superadmin.products.destroy',

    ]);

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/superadmin/profile/edit', 'edit')->name('superadmin.profile.edit');
        Route::patch('/superadmin/profile', 'update')->name('superadmin.profile.update');
    });
});

// Routes for regular user
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');

    Route::controller(ProfileController::class)->group(function () {
        Route::get('/user/profile/edit', 'edit')->name('user.profile.edit');
        Route::patch('/user/profile', 'update')->name('user.profile.update');
    });

    // user products
    Route::get('/user/products/product-list', [ProductController::class, 'product_list'])
        ->name('user.products.product_list');
});
