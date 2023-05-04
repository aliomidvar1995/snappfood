@extends('layouts.seller')

@section('title')
    <title>پنل فروشنده | نمایش اطلاعات غذا</title>
@endsection

@section('content')
    @if (session()->get('food-party'))
    <div class="store hide">
        <span class="fa-exclamation-circle">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                <path
                    d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
            </svg>
        </span>
        <span class="msg">{{ session()->get('food-party') }}</span>
        <span class="close-btn">
            <span class="fa-times">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                </svg>
            </span>
        </span>
    </div>
    @endif
    @if (session()->get('update'))
        <div class="update hide">
            <span class="fa-exclamation-circle">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                    <path
                        d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z" />
                </svg>
            </span>
            <span class="msg">{{ session()->get('update') }}</span>
            <span class="close-btn">
                <span class="fa-times">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                        class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path
                            d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z" />
                    </svg>
                </span>
            </span>
        </div>
    @endif
    <div class="mx-auto my-5" style="width: 30rem;">
        <div class="card shadow-lg">
            <img class="card-img-top" src="{{ '/images/' . $food->image }}" alt="">
            <div class="card-body">
                <p class="fs-4">نام غذا: {{ $food->name }}</p>
                <p class="fs-4">نوع غذا: {{ $food->foodCategory->name }}</p>
                <p class="fs-4">قیمت: {{ $food->price }}</p>
                <p class="fs-4">قیمت با تخفیف: {{ $food->discounted_price }}</p>
                <p class="fs-4">قیمت فود پارتی: {{ $food->food_party_price }}</p>
                <p class="fs-4">نام رستوران: {{ $food->restaurant->name }}</p>
                <p class="fs-4">مواد اولیه: {{ $food->material }}</p>
                <!-- Button trigger modal -->
                @if ($food->discounted_price == $food->food_party_price)
                    <div class="d-flex justify-content-center">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            افزودن غذا به فود پارتی
                        </button>
                    </div>
                @endif

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">افزودن غذا به فود پارتی</h5>
                                <button type="button" class="btn-close me-auto ms-0 float-right" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('seller.foods.foodParty', ['food' => $food]) }}">
                                    @csrf
                                    <p>نام غذا: {{ $food->name }}</p>
                                    @if ($food->foodCategory->off)
                                        <p>درصد تخفیف فود پارتی: {{ $food->foodCategory->off->off }}</p>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary mx-auto">افزودن غذا به فود پارتی</button>
                                        </div>
                                    @else
                                        <p>تخفیف فود پارتی برای این غذا موجود نمی باشد</p>
                                    @endif
                                </form>
                            </div>
                            <div class="modal-footer justify-content-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">بستن</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
