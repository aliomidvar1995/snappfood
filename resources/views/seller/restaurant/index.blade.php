@extends('layouts.seller')

@section('title')
    <title>پنل فروشنده | لیست رستوران ها</title>
@endsection

@section('content')
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
                        <a class="btn btn-outline-primary" href="{{ route('seller.foods.create', ['restaurant' => $restaurant]) }}">ایجاد غذا</a>
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