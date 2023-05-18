<?php

use App\Http\Controllers\AdminCommentController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\ArchiveController;
use App\Http\Controllers\BannerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FoodCategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\OffController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ReplyController;
use App\Http\Controllers\ReportController;
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

        // delete comment request
        Route::get('/comments', [AdminCommentController::class, 'index'])
            ->name('comments.index');
        Route::delete('/comments/{comment}', [AdminCommentController::class, 'destroy'])
            ->name('comments.destroy');
    });
    Route::prefix('/seller')->middleware(['is-seller'])->name('seller.')->group(function () {
        Route::get('/', [SellerController::class, 'index'])->name('index');
        Route::get('/edit', [SellerController::class, 'edit'])->name('edit');
        Route::put('/', [SellerController::class, 'update'])->name('update');
        Route::delete('/', [SellerController::class, 'destroy'])->name('destroy');

        // restaurant
        Route::resource('restaurants', RestaurantController::class);

        // food
        Route::get('restaurants/{restaurant}/foods', [FoodController::class, 'index'])
            ->name('foods.index');
        Route::post('restaurants/{restaurant}/foods', [FoodController::class, 'store'])
            ->name('foods.store');
        Route::get('restaurants/{restaurant}/foods/create', [FoodController::class, 'create'])
            ->name('foods.create');
        Route::get('restaurants/{restaurant}/foods/{food}/edit', [FoodController::class, 'edit'])
            ->name('foods.edit');
        Route::put('restaurants/{restaurant}/foods/{food}', [FoodController::class, 'update'])
            ->name('foods.update');
        Route::get('restaurants/{restaurant}/foods/{food}', [FoodController::class, 'show'])
            ->name('foods.show');
        Route::delete('restaurants/{restaurant}/foods/{food}', [FoodController::class, 'destroy'])
            ->name('foods.destroy');
        
        // food party
        Route::post('restaurants/{restaurant}/foods/{food}/food-party', [FoodController::class, 'foodParty'])
            ->name('foods.foodParty');

        // cart
        Route::get('restaurants/{restaurant}/carts', [OrderController::class, 'index'])
            ->name('carts.index');
        Route::get('restaurants/{restaurant}/carts/{cart}', [OrderController::class, 'show'])
            ->name('carts.show');
        Route::get('restaurants/{restaurant}/carts/{cart}/edit', [OrderController::class, 'edit'])
            ->name('carts.edit');
        Route::put('restaurants/{restaurant}/carts/{cart}', [OrderController::class, 'update'])
            ->name('carts.update');

        // archive
        Route::get('restaurants/{restaurant}/archives', [ArchiveController::class, 'index'])
            ->name('archives.index');
        Route::get('restaurants/{restaurant}/archives/{cart}', [ArchiveController::class, 'show'])
            ->name('archives.show');

        // report
        Route::get('restaurants/{restaurant}/reports', [ReportController::class, 'index'])
            ->name('reports.index');
        
        // comment
        Route::get('restaurants/{restaurant}/comments', [CommentController::class, 'index'])
            ->name('comments.index');
        Route::put('restaurants/{restaurant}/comments/{comment}', [CommentController::class, 'update'])
            ->name('comments.update');

        // reply
        Route::post('restaurants/{restaurant}/comments/{comment}/replies', [ReplyController::class, 'store'])
            ->name('replies.store');
    });
});
