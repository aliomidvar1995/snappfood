<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use App\Http\Requests\StoreRestaurantRequest;
use App\Http\Requests\UpdateRestaurantRequest;
use App\Models\RestaurantCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

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
                    ->paginate(5);
        return view('seller.restaurant.index', compact('restaurants'));
        }
        $restaurants = Auth::user()->restaurants()->paginate(5);
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
        $user_id = Auth::id();
        $path = Storage::put("restaurants/$user_id", $request->file('image'));

        $latitude = $request->lat;
        $longitude = $request->lng;

        $response = Http::withHeaders(['Api-Key' => 'service.363f2bf49950435c906c6cbef2cc3d89'])
            ->get("https://api.neshan.org/v5/reverse?lat=$latitude&lng=$longitude");
        
        $address = $response['formatted_address'];

        Restaurant::query()->create([
            'image' => $path,
            'name' => $request->name,
            'days' => $request->days,
            'start' => $request->start,
            'end' => $request->end,
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'account_number' => $request->account_number,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'address' => $address,
            'restaurant_categories_id' => $request->restaurant_categories_id
        ]);
        return to_route('seller.restaurants.index')->with('store', 'اطلاعات با موفقیت ذخیره شد');
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

        if($request->file('image')) {
            $name = Auth::user()->name;
            Storage::delete($restaurant->image);
            $path = Storage::put("restaurants/$name", $request->file('image'));
        }
        else {
            $path = $restaurant->image;
        }

        $latitude = $request->lat;
        $longitude = $request->lng;

        $response = Http::withHeaders(['Api-Key' => 'service.363f2bf49950435c906c6cbef2cc3d89'])
            ->get("https://api.neshan.org/v5/reverse?lat=$latitude&lng=$longitude");
        
        $address = $response['formatted_address'];

        $restaurant->update([
            'image' => $path,
            'name' => $request->name,
            'days' => $request->days,
            'start' => $request->start,
            'end' => $request->end,
            'user_id' => Auth::id(),
            'phone_number' => $request->phone_number,
            'account_number' => $request->account_number,
            'latitude' => $latitude,
            'longitude' => $longitude,
            'address' => $address,
            'restaurant_categories_id' => $request->restaurant_categories_id
        ]);
        return to_route('seller.restaurants.show', ['restaurant' => $restaurant])->with('update', 'اطلاعات با موفقیت بروزرسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        Storage::delete($restaurant->image);
        $restaurant->delete();
        return to_route('seller.restaurants.index')->with('delete', 'اطلاعات با موفقیت حذف شد');
    }
}
