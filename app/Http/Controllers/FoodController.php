<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Http\Requests\StoreFoodRequest;
use App\Http\Requests\UpdateFoodRequest;
use App\Models\FoodCategory;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
                ->paginate(5);
            return view('seller.food.index', compact('foods'));
        }
        $foods = Food::query()->paginate(5);
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
        $name = Restaurant::query()->find($request->restaurant_id)->name;
        $path = Storage::put("foods/$name", $request->file('image'));
        // discounted price
        $discounted_price = (1-($request->off/100)) * $request->price;
        Food::query()->create([
            'image' => $path,
            'name' => $request->name,
            'price' => $request->price,
            'material' => $request->material,
            'discounted_price' => $discounted_price,
            'food_party_price' => $discounted_price,
            'food_categories_id' => $request->food_categories_id,
            'restaurant_id' => $request->restaurant_id
        ]);
        return to_route('seller.foods.index')->with('store', 'اطلاعات با موفقیت ذخیره شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food)
    {
        return view('seller.food.show', compact('food'));
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
        if($request->file('image')) {
            Storage::delete($food->image);
            $name = Restaurant::query()->find($request->restaurant_id)->name;
            $path = Storage::put("foods/$name", $request->file('image'));
        }
        else {
            $path = $food->image;
        }
        // discounted price
        $discounted_price = (1-($request->off/100)) * $request->price;
        $food->update([
            'image' => $path,
            'name' => $request->name,
            'price' => $request->price,
            'material' => $request->material,
            'discounted_price' => $discounted_price,
            'food_party_price' => $discounted_price,
            'food_categories_id' => $request->food_categories_id,
            'restaurant_id' => $request->restaurant_id
        ]);
        return to_route('seller.foods.show', ['food' => $food])->with('update', 'اطلاعات با موفقیت بروزرسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Food $food)
    {
        Storage::delete($food->image);
        $food->delete();
        return to_route('seller.foods.index')->with('delete', 'اطلاعات با موفقیت حذف شد');
    }

    public function foodParty(Food $food)
    {
        $food_party_price = (1-($food->foodCategory->off->off/100)) * $food->discounted_price;
        $food->update([
            $food->food_party_price = $food_party_price
        ]);
        return to_route('seller.foods.show', ['food' => $food])->with('food-party', 'غذا به فود پارتی اضافه شد');
    }
}
