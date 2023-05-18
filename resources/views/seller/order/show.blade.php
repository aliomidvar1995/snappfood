@extends('layouts.food')

@section('title')
    <title>پنل فروشنده | نمایش اطلاعات سفارش</title>
@endsection

@section('content')
    @if (session()->get('update'))
    <div class="update hide">
        <span class="fa-exclamation-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
            </svg>
        </span>
        <span class="msg">{{ session()->get('update') }}</span>
        <span class="close-btn">
            <span class="fa-times">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                </svg>
            </span>
        </span>
    </div>
    @endif
    @if ($cart->status != 'selected' && $cart->status != 'delivered')
        <div class="mx-auto my-5" style="width: 30rem;">
            <div class="card shadow-lg">
                <div class="card-header text-center fs-3">{{ $cart->user->name }}</div>
                <div class="card-body">
                    @foreach ($cart->user->addresses as $address)
                        @if ($address->set == true)
                            <p class="fs-4">آدرس سفارش دهنده: {{ $address->address }}</p>
                        @endif
                    @endforeach
                    <hr>
                    @foreach ($cart->orders as $order)
                        <p class="fs-4">نام غذا: {{ $order->food->name }}</p>
                        <p class="fs-4">قیمت نهایی غذا: {{ $order->food->food_party_price }}</p>
                        <p class="fs-4">تعداد سفارش: {{ $order->count }}</p>
                        <p class="fs-4">قیمت کل: {{ $order->total_price }}</p>
                        <hr>
                    @endforeach
                    <p class="fs-4 fw-bold">تاریخ سفارش: {{ $cart->date }}</p>
                    <p class="fs-4">زمان سفارش: {{ $cart->order_time }}</p>
                    @if ($cart->status == 'delivered')
                        <p class="fs-4">زمان تحویل: {{ $cart->delivered_time }}</p>
                    @endif
                    <hr>
                    <p class="fs-4 fw-bold text-secondary">قیمت کل: {{ $cart->total_price }} تومان</p>
                    <div class="d-flex justify-content-center">
                        <a class="btn btn-outline-warning" href="{{ route('seller.carts.edit', ['cart' => $cart, 'restaurant' => $restaurant]) }}">تغییر وضعیت سفارش</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection