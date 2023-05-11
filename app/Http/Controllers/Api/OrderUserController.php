<?php

namespace App\Http\Controllers\Api;

use App\Events\PendingEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\OrderResource;
use App\Models\Food;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return OrderResource::collection(Auth::user()->orders);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request, Food $food)
    {
        $order = Order::query()->create([
            'count' => $request->validated('count'),
            'food_id' => $food->id,
            'restaurant_id' => $food->restaurant->id,
            'user_id' => Auth::id()
        ]);
        event(new PendingEvent(Auth::user()->email));

        return OrderResource::make($order);
    }

    /**
     * Display the specified resource.
     */
    public function show(Food $food, Order $order)
    {
        if(Auth::check() && $order->user_id == Auth::id()) {
            return OrderResource::make($order);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        if(Auth::check() && $order->user_id == Auth::id()) {
            $order->update(['count' => $request->validated('count')]);
        }
        return response(['msg' => 'اطلاعات با موفقیت بروزرسانی شد']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        if(Auth::check() && $order->user_id == Auth::id()) {
            $order->delete();
        }

        return response(['msg' => 'اطلاعات با موفقیت حذف شد']);
    }

    public function payment(Order $order)
    {
        if(Auth::check() && $order->user_id == Auth::id()) {
            $order->update(['payment' => true]);
        }
        return response(['msg' => 'پرداخت با موفقیت انجام شد']);
    }
}
