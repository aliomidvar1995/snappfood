<?php

namespace App\Http\Controllers;

use App\Events\DeliveredEvent;
use App\Events\PendingEvent;
use App\Events\PreparingEvent;
use App\Events\SendingEvent;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class OrderController extends Controller
{
    public static $orders = [];
    /**
     * Display a listing of the resource.
     */
    public function index(Restaurant $restaurant)
    {
        return view('seller.order.index', compact('restaurant'));
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
    public function store(StoreOrderRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Restaurant $restaurant, Cart $cart)
    {
        return view('seller.order.show', compact('restaurant', 'cart'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant, Cart $cart)
    {
        return view('seller.order.edit', compact('restaurant', 'cart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request,Restaurant $restaurant, Cart $cart)
    {
        if($request->get('status') == 'pending') {
            event(new PendingEvent($cart->user->email));
        }
        if($request->get('status') == 'preparing') {
            event(new PreparingEvent($cart->user->email));
        }
        if($request->get('status') == 'sending') {
            event(new SendingEvent($cart->user->email));
        }
        if($request->get('status') == 'delivered') {
            $cart->update([
                'status' => $request->input('status'),
                'delivered_time' => Jalalian::now()->format('H:i:s')
            ]);
            event(new DeliveredEvent($cart->user->email));
            return to_route('seller.archives.index', ['restaurant' => $restaurant]);
        }
        $cart->update(['status' => $request->get('status')]);

        return to_route('seller.carts.show', ['cart' => $cart, 'restaurant' => $restaurant]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        //
    }
}
