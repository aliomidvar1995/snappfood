<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OffController;
use App\Http\Controllers\RestaurantCategoryController;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\SellerController;
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

Auth::routes();

Route::middleware('auth')->group(function () {
    Route::prefix('/admin')->middleware(['is-admin'])->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        Route::get('/edit', [AdminController::class, 'edit'])->name('edit');
        Route::put('/', [AdminController::class, 'update'])->name('update');
        Route::delete('/', [AdminController::class, 'destroy'])->name('destroy');

        Route::resource('restaurantCategories', RestaurantCategoryController::class)
            ->except(['show']);
        Route::resource('foodCategories', FoodCategoryController::class)
            ->except(['show']);
        Route::resource('offs', OffController::class)
            ->except(['show']);
        Route::resource('banners', BannerController::class)
            ->except(['show']);
        Route::get('/banners/show', [BannerController::class, 'show'])->name('banners.show');
    });
    Route::prefix('/seller')->middleware(['is-seller'])->name('seller.')->group(function () {
        Route::get('/', [SellerController::class, 'index'])->name('index');
        Route::get('/edit', [SellerController::class, 'edit'])->name('edit');
        Route::put('/', [SellerController::class, 'update'])->name('update');
        Route::delete('/', [SellerController::class, 'destroy'])->name('destroy');

        Route::resource('restaurants', RestaurantController::class);
        Route::resource('foods', FoodController::class)->except(['create', 'edit']);
        Route::get('foods/{restaurant}/create', [FoodController::class, 'create'])
            ->name('foods.create');
        Route::get('foods/{food}/edit/{restaurant}', [FoodController::class, 'edit'])
            ->name('foods.edit');
        Route::post('foods/{food}/food-party', [FoodController::class, 'foodParty'])
            ->name('foods.foodParty');
    });
});
