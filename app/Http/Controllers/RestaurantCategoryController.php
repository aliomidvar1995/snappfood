<?php

namespace App\Http\Controllers;

use App\Models\RestaurantCategory;
use App\Http\Requests\StoreRestaurantCategoryRequest;
use App\Http\Requests\UpdateRestaurantCategoryRequest;
use Illuminate\Http\Request;

class RestaurantCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->search) {
            $restaurantCategories = RestaurantCategory::query()
                        ->where('name', 'like', "%$request->search%")
                        ->paginate(5);
            return view('admin.RestaurantCategory.index', compact('restaurantCategories'));
        }
        $restaurantCategories = RestaurantCategory::query()->paginate(5);
        return view('admin.RestaurantCategory.index', compact('restaurantCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.RestaurantCategory.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRestaurantCategoryRequest $request)
    {
        RestaurantCategory::query()->create([
            'name' => $request->name
        ]);

        return to_route('admin.restaurantCategories.index')->with('store', 'اطلاعات با موفقیت ذخیره شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(RestaurantCategory $restaurantCategory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RestaurantCategory $restaurantCategory)
    {
        return view('admin.RestaurantCategory.edit', compact('restaurantCategory'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRestaurantCategoryRequest $request, RestaurantCategory $restaurantCategory)
    {
        $restaurantCategory->update([
            'name' => $request->name
        ]);
        return to_route('admin.restaurantCategories.index')->with('update', 'اطلاعات با موفقیت بروزرسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RestaurantCategory $restaurantCategory)
    {
        $restaurantCategory->delete();

        return to_route('admin.restaurantCategories.index')->with('delete', 'اطلاعات با موفقیت حذف شد');
    }
}
