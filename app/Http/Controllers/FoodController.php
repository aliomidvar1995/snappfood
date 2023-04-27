<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\FoodCategory;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->search) {
            Food::query()
                ->where('name', 'like', "%$request->search%")
                ->get();
            return view('seller.food.index', compact('foods'));
        }
        $foods = Food::all();
        return view('seller.food.index', compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Restaurant $restaurant)
    {
        
        $foodCategories = $restaurant->restaurantCategory->foodCategories;
        return view('seller.food.create', compact('restaurant', 'foodCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodRequest $request)
    {
        // dd($request->all());
        Food::query()->create([
            'name' => $request->name,
            'price' => $request->price,
            'discounted_price' => $request->price,
            'food_categories_id' => $request->food_categories_id,
            'restaurant_id' => $request->restaurant_id
        ]);
        return to_route('seller.foods.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Food $food, Restaurant $restaurant)
    {
        $foodCategories = $restaurant->restaurantCategory->foodCategories;
        return view('seller.food.edit', compact('food', 'restaurant', 'foodCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodRequest $request, Food $food)
    {
        $food->update([
            'name' => $request->name,
            'price' => $request->price,
            'discounted_price' => $request->price,
            'food_categories_id' => $request->food_categories_id,
            'restaurant_id' => $request->restaurant_id
        ]);
        return to_route('seller.foods.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        $food->delete();
        return to_route('seller.foods.index');
    }
}
