<?php

namespace App\Http\Controllers;

use App\Events\DeliveredEvent;
use App\Events\PendingEvent;
use App\Events\PreparingEvent;
use App\Events\SendingEvent;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;

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
    public function show(Restaurant $restaurant, Order $order)
    {
        return view('seller.order.show', compact('restaurant', 'order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Restaurant $restaurant, Order $order)
    {
        return view('seller.order.edit', compact('restaurant', 'order'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request,Restaurant $restaurant, Order $order)
    {
        // dd($request->get('status'));
        if($request->get('status') == 'pending') {
            event(new PendingEvent($order->user->email));
        }
        if($request->get('status') == 'preparing') {
            event(new PreparingEvent($order->user->email));
        }
        if($request->get('status') == 'sending') {
            event(new SendingEvent($order->user->email));
        }
        if($request->get('status') == 'delivered') {
            $order->update([
                'status' => $request->get('status'),
                'end' => now()->format('H:i:s')
            ]);
            event(new DeliveredEvent($order->user->email));
            self::$orders[] = $order;
            cache()->put('orders', self::$orders);
            $order->delete();
            return to_route('seller.orders.index', ['restaurant' => $order->food->restaurant]);
        }
        $order->update(['status' => $request->get('status')]);

        return to_route('seller.orders.show', ['order' => $order, 'restaurant' => $order->food->restaurant]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        //
    }
}
