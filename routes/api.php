<?php

use App\Http\Controllers\Api\AddressController;
use App\Http\Controllers\Api\FoodController;
use App\Http\Controllers\Api\OrderUserController;
use App\Http\Controllers\Api\RestaurantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [CustomerController::class, 'store']);

Route::post('/login', [CustomerController::class, 'login']);


Route::middleware(['auth:sanctum', 'is-customer'])->group(function() {
    // Authentication
    Route::post('/logout', [CustomerController::class, 'logout']);
    Route::put('/register', [CustomerController::class, 'update']);
    Route::delete('/register', [CustomerController::class, 'destroy']);


    
    Route::prefix('/customer')->name('customer.')->group(function() {
        // address
        Route::post('/addresses', [AddressController::class, 'store'])
            ->name('addresses.store');
        Route::get('/addresses', [AddressController::class, 'index'])
            ->name('addresses.index');
        Route::get('/addresses/{address}', [AddressController::class, 'show'])
            ->name('addresses.show');
        Route::put('/addresses/{address}', [AddressController::class, 'update'])
            ->name('addresses.update');
        Route::delete('/addresses/{address}', [AddressController::class, 'destroy'])
            ->name('addresses.destroy');

        // restaurant
        Route::get('/restaurants', [RestaurantController::class, 'index'])
            ->name('restaurants.index');
        Route::get('/restaurants/{restaurant}', [RestaurantController::class, 'show'])
            ->name('restaurants.show');

        // food
        Route::get('/restaurants/{restaurant}/foods', [FoodController::class, 'index'])
            ->name('foods.index');
        Route::get('/restaurants/{restaurant}/foods/{food}', [FoodController::class, 'show'])
            ->name('foods.show');

        // order
        Route::post('foods/{food}/orders', [OrderUserController::class, 'store'])
            ->name('orders.store');
        Route::get('orders', [OrderUserController::class, 'index'])
            ->name('orders.index');
        Route::get('orders/{order}', [OrderUserController::class, 'show'])
            ->name('orders.show');
        Route::put('orders/{order}', [OrderUserController::class, 'update'])
            ->name('orders.update');
        Route::delete('orders/{order}', [OrderUserController::class, 'destroy'])
            ->name('orders.destroy');
    });
});
