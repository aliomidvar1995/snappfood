@extends('layouts.seller')

@section('title')
    <title>پنل فروشنده | لیست غذا ها</title>
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
                <th scope="col">نام غذا</th>
                <th scope="col">قیمت غذا</th>
                <th scope="col">قیمت غذا (تخفیف)</th>
                <th scope="col">دسته بندی غذا</th>
                <th scope="col">نام رستوران</th>
                <th scope="col">اقدامات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($foods as $food)
                <tr>
                    <th scope="row">{{ $food->id }}</th>
                    <td>{{ $food->name }}</td>
                    <td>{{ $food->price }}</td>
                    <td>{{ $food->discounted_price }}</td>
                    <td>{{ $food->foodCategory->name }}</td>
                    <td>{{ $food->restaurant->name }}</td>
                    <td>
                        <a class="btn btn-outline-warning" href="{{ route('seller.foods.edit', ['food' => $food, 'restaurant' => $food->restaurant]) }}">ویرایش غذا</a>
                        <form class="d-inline" action="{{ route('seller.foods.destroy', ['food' => $food]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger" type="submit">حذف غذا</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection