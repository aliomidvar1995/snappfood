<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\RestaurantCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->search) {
            $restaurants = Auth::user()->restaurants()
                    ->where('name', 'like', "%$request->search%")
                    ->get();
        return view('seller.restaurant.index', compact('restaurants'));
        }
        $restaurants = Auth::user()->restaurants;
        return view('seller.restaurant.index', compact('restaurants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurantCategories = RestaurantCategory::all();
        return view('seller.restaurant.create', compact('restaurantCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantRequest $request)
    {
        Restaurant::query()->create([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'account_number' => $request->account_number,
            'address' => $request->address,
            'restaurant_categories_id' => $request->restaurant_categories_id
        ]);
        return to_route('seller.restaurants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        return view('seller.restaurant.show', compact('restaurant'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        $restaurantCategories = RestaurantCategory::all();
        return view('seller.restaurant.edit', compact('restaurant', 'restaurantCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantRequest $request, Restaurant $restaurant)
    {
        $restaurant->update([
            'name' => $request->name,
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'account_number' => $request->account_number,
            'address' => $request->address,
            'restaurant_categories_id' => $request->restaurant_categories_id
        ]);
        return to_route('seller.restaurants.show', ['restaurant' => $restaurant]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        $restaurant->delete();
        return to_route('seller.restaurants.index');
    }
}
