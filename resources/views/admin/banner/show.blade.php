@extends('layouts.admin')

@section('title')
    <title>پنل ادمین | نمایش اسلایدی بنر ها</title>
@endsection

@section('content')
<div class="w-50 mx-auto mt-5">
    <div id="carouselExampleDark" class="carousel carousel-dark slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            @if (!$banners)
            @else
                @foreach ($banners as $banner)
                    <div class="carousel-item active" data-bs-interval="3000">
                        <img src="{{ '/images/'.$banner->image }}" class="d-block w-100" alt="...">
                    </div>
                @endforeach
            @endif
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleDark" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>
@endsection