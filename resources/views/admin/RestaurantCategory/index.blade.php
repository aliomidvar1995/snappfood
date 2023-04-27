@extends('layouts.admin')

@section('title')
    <title>پنل ادمین | لیست دسته بندی رستوران</title>
@endsection

@section('content')
    <div class="w-50 mx-auto mt-5">
        <form class="mb-2" action="{{ route('admin.restaurantCategories.index') }}">
            <div class="d-flex gap-2">
                <input class="form-control d-inline" type="text" name="search">
                <button class="btn btn-outline-secondary" type="submit">جستجو</button>
            </div>
        </form>
        <table class="table table-hover table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام دسته بندی رستوران</th>
                    <th scope="col">اقدامات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($restaurantCategories as $restaurantCategory)
                    <tr>
                        <th scope="row">{{ $restaurantCategory->id }}</th>
                        <td>{{ $restaurantCategory->name }}</td>
                        <td>
                            <a class="btn btn-outline-warning" href="{{ route('admin.restaurantCategories.edit', ['restaurantCategory' => $restaurantCategory]) }}">ویرایش دسته بندی رستوران</a>
                            <form class="d-inline" action="{{ route('admin.restaurantCategories.destroy', ['restaurantCategory' => $restaurantCategory]) }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger" type="submit">حذف دسته بندی رستوران</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
