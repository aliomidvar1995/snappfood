<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use App\Http\Requests\StoreFoodCategoryRequest;
use App\Http\Requests\UpdateFoodCategoryRequest;
use App\Models\RestaurantCategory;
use Illuminate\Http\Request;

class FoodCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->search) {
            $foodCategories = FoodCategory::query()
                        ->where('name', 'like', "%$request->search%")
                        ->get();
            return view('admin.FoodCategory.index', compact('foodCategories'));
        }
        $foodCategories = FoodCategory::all();
        return view('admin.FoodCategory.index', compact('foodCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $restaurantCategories = RestaurantCategory::all();
        return view('admin.FoodCategory.create', compact('restaurantCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreFoodCategoryRequest $request)
    {
        FoodCategory::query()->create([
            'name' => $request->name,
            'restaurant_categories_id' => $request->restaurant_categories_id
        ]);
        return to_route('admin.foodCategories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(FoodCategory $foodCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FoodCategory $foodCategory)
    {
        return view('admin.FoodCategory.edit', compact('foodCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateFoodCategoryRequest $request, FoodCategory $foodCategory)
    {
        $foodCategory->update([
            'name' => $request->name
        ]);
        return to_route('admin.foodCategories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FoodCategory $foodCategory)
    {
        $foodCategory->delete();
        return to_route('admin.foodCategories.index');
    }
}
