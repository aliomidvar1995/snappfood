@extends('layouts.seller')

@section('title')
    <title>پنل فروشنده | لیست رستوران ها</title>
@endsection

@section('content')
@if (session()->get('store'))
<div class="store hide">
    <span class="fa-exclamation-circle">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
        </svg>
    </span>
    <span class="msg">{{ session()->get('store') }}</span>
    <span class="close-btn">
        <span class="fa-times">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
            </svg>
        </span>
    </span>
</div>
@endif
@if (session()->get('delete'))
<div class="delete hide">
    <span class="fa-exclamation-circle">
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
        </svg>
    </span>
    <span class="msg">{{ session()->get('delete') }}</span>
    <span class="close-btn">
        <span class="fa-times">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
            </svg>
        </span>
    </span>
</div>
@endif
<div class="w-50 mx-auto mt-5">
    <form class="mb-2" action="{{ route('seller.restaurants.index') }}">
        <div class="d-flex gap-2">
            <input class="form-control d-inline" type="text" name="search">
            <button class="btn btn-outline-secondary" type="submit">جستجو</button>
        </div>
    </form>
    <table class="table table-hover table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">نام رستوران</th>
                <th scope="col">نوع رستوران</th>
                <th scope="col">اقدامات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($restaurants as $restaurant)
                <tr>
                    <th scope="row">{{ $restaurant->id }}</th>
                    <td>{{ $restaurant->name }}</td>
                    <td>{{ $restaurant->restaurantCategory->name }}</td>
                    <td>
                        <a class="btn btn-outline-success" href="{{ route('seller.restaurants.show', ['restaurant' => $restaurant]) }}">نمایش اطلاعات رستوران</a>
                        <a class="btn btn-outline-warning" href="{{ route('seller.restaurants.edit', ['restaurant' => $restaurant]) }}">ویرایش اطلاعات رستوران</a>
                        <form class="d-inline" action="{{ route('seller.restaurants.destroy', ['restaurant' => $restaurant]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger" type="submit">حذف رستوران</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection