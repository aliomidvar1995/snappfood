<?php

namespace App\Http\Controllers\Api;

use App\Events\PayEvent;
use App\Events\PendingEvent;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Http\Requests\UpdateOrderRequest;
use App\Http\Resources\CartResource;
use App\Http\Resources\OrderResource;
use App\Models\Cart;
use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use App\Notifications\PayNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Notification;
use Morilog\Jalali\Jalalian;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = Auth::user()->carts()->paginate(2);
        return CartResource::collection($carts);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOrderRequest $request, Restaurant $restaurant)
    {
        // return $request;
        $food = Food::query()->find($request->food_id);

        if($food->restaurant_id === $restaurant->id) {
            $flag = false;
            foreach(Auth::user()->carts as $cart) {
                if($cart->restaurant_id == $restaurant->id && $cart->status == 'selected') {
                    $flag = true;
                    $cart_id = $cart->id;
                    break;
                }
            }
            if($flag == false && $request->count > 0) {
                $cart = Cart::query()->create([
                    'user_id' => Auth::id(),
                    'date' => Jalalian::now()->format('Y/m/d'),
                    'order_time' => Jalalian::now()->format('H:i:s'),
                    'restaurant_id' => $restaurant->id
                ]);
                $cart_id = $cart->id;
            }

            $cart = Cart::query()->find($cart_id);

            
            if($cart->orders()->count() > 0) {
                foreach($cart->orders as $order) {
                    if($order->food_id == $request->food_id) {
                        if($request->count == 0) {
                            $order->delete();

                            $total_price = 0;
                            foreach($cart->orders as $order) {
                                $total_price += $order->total_price;
                            }
                            $cart->update(['total_price' => $total_price]);
    
                            return response([
                                'msg' => 'تعداد غذا بروزرسانی شد', 
                                'order' => OrderResource::make($order)
                            ]);
                        }
                        $order->update([
                            'count' => $request->count,
                            'total_price' => $food->food_party_price * $request->count,
                        ]);

                        $cart->update([
                            'total_price' => $cart->total_price += $order->total_price
                        ]);

                        return response([
                            'msg' => 'تعداد غذا بروزرسانی شد', 
                            'order' => OrderResource::make($order)
                        ]);
                    }
                }
            }
    
            // $food = Food::query()->find($request->food_id);
    
            if($request->count > 0) {
                $order = Order::query()->create([
                    'count' => $request->validated('count'),
                    'food_id' => $request->food_id,
                    'total_price' => $food->food_party_price * $request->count,
                    'cart_id' => $cart_id,
                    'user_id' => Auth::id()
                ]);
            }

            $cart->update([
                'total_price' => $cart->total_price += $order->total_price
            ]);

            if($cart->orders()->count() == 0) {
                $cart->delete();
            }
    
            return response([
                'order' => OrderResource::make($order)
            ]);
            // event(new PendingEvent(Auth::user()->email));
        }
        return response(['msg' => 'unauthorized'], 401);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        if(Auth::check() && $cart->user_id == Auth::id()) {
            // $total_price = 0;
            // foreach($cart->orders as $order) {
            //     $total_price += $order->total_price;
            // }
            // $cart->update(['total_price' => $total_price]);
            return CartResource::make($cart);
        }
        return response(['msg' => 'unauthorized'], 401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOrderRequest $request, Order $order)
    {
        if(Auth::check() && $order->user_id == Auth::id()) {
            $order->update(['count' => $request->validated('count')]);
        }
        return response([
            'msg' => 'اطلاعات با موفقیت بروزرسانی شد',
            'order' => OrderResource::make($order)
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Order $order)
    {
        if(Auth::check() && $order->user_id == Auth::id()) {
            $order->delete();

            return response([
                'msg' => 'سفارش با موفقیت حذف شد'
            ]);
        }
    }

    public function pay(Cart $cart)
    {
        if($cart->user_id == Auth::id() && $cart->status != 'pay') {
            $cart->update([
                'status' => 'pay'
            ]);

            // Auth::user()->notify(new PayNotification());

            Notification::send(Auth::user(), new PayNotification());
    
            // event(new PayEvent(Auth::user()->email));
    
            return response([
                'msg' => 'پرداخت با موفقیت انجام شد'
            ]);
        }
        return response(['msg' => 'unauthorized'], 401);
    }
}
