@extends('layouts.seller')

@section('title')
    <title>پنل فروشنده | نمایش اطلاعات رستوران</title>
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
    <div class="mx-auto my-5" style="width: 30rem;">
        <div class="card shadow-lg">
            <img class="card-img-top" src="{{ $restaurant->image }}" alt="">
            <div class="card-body">
                <p class="fs-4">نام رستوران: {{ $restaurant->name }}</p>
                <p class="fs-4">نوع رستوران: {{ $restaurant->restaurantCategory->name }}</p>
                <p class="fs-4">شماره تماس: {{ $restaurant->phone_number }}</p>
                <p class="fs-4">شماره حساب فروشنده: {{ $restaurant->account_number }}</p>
                <p class="fs-4">روزهای کاری رستوران: {{ $restaurant->days }}</p>
                <p class="fs-4">ساعات کاری رستوران: {{ $restaurant->start }} تا {{ $restaurant->end }}</p>
                <p class="fs-4">آدرس رستوران: {{ $restaurant->address }}</p>
                <div class="d-flex justify-content-center gap-3">
                    <a class="btn btn-outline-secondary" href="{{ route('seller.foods.index', ['restaurant' => $restaurant]) }}">غذا ها</a>
                </div>
            </div>
        </div>
    </div>
@endsection