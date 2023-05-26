<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\RestaurantResource;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return RestaurantResource::collection(Restaurant::all());
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant)
    {
        return RestaurantResource::make($restaurant);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Restaurant $restaurant)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Restaurant $restaurant)
    {
        //
    }

    public function nearest(Request $request)
    {
        foreach(Auth::user()->addresses as $address) {
            if($address->set) {
                $user_address = $address;
            }
        }
        $lat1 = ($user_address->latitude * pi()) / 180;
        $lon1 = ($user_address->longitude * pi()) / 180;
        $restaurants = Restaurant::all();
        $nearest_restaurants = [];
        $distances = [];
        foreach($restaurants as $restaurant) {
            $lat2 = ($restaurant->latitude * pi()) / 180;
            $lon2 = ($restaurant->longitude * pi()) / 180;
            $distance = acos(sin($lat1)*sin($lat2)+cos($lat1)*cos($lat2)*cos($lon2-$lon1))*6371;
            $distances[] = $distance;
            if($distance < 20) {
                $nearest_restaurants[] = $restaurant;
            }
        }
        if($request->search) {
            $nearest_restaurants = collect($nearest_restaurants)
                            ->where('name', 'like', "%$request->search%")
                            ->all();
            return response(['restaurants' => RestaurantResource::collection($nearest_restaurants)]);
        }
        return response([
            'distances' => $distances,
            'restaurants' => RestaurantResource::collection($nearest_restaurants)
        ]);
    }
}
