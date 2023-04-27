@extends('layouts.seller')

@section('title')
    <title>پنل فروشنده | نمایش اطلاعات رستوران</title>
@endsection

@section('content')
    <div class="mx-auto mt-5">
        <div class="card shadow-lg">
            <div class="card-header"><h3 class="fw-bold text-center">اطلاعات رستوران</h3></div>
            <div class="card-body">
                <p class="fs-4">نام رستوران: {{ $restaurant->name }}</p>
                <p class="fs-4">نوع رستوران: {{ $restaurant->restaurantCategory->name }}</p>
                <p class="fs-4">شماره تماس: {{ $restaurant->phone_number }}</p>
                <p class="fs-4">شماره حساب فروشنده: {{ $restaurant->account_number }}</p>
                <p class="fs-4">آدرس رستوران: {{ $restaurant->address }}</p>
            </div>
        </div>
    </div>
@endsection