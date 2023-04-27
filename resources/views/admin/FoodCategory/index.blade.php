@extends('layouts.admin')

@section('title')
    <title>پنل ادمین | لیست دسته بندی غذا</title>
@endsection

@section('content')
    <div class="w-50 mx-auto mt-5">
        <form class="mb-2" action="{{ route('admin.foodCategories.index') }}">
            <div class="d-flex gap-2">
                <input class="form-control d-inline" type="text" name="search">
                <button class="btn btn-outline-secondary" type="submit">جستجو</button>
            </div>
        </form>
        <table class="table table-hover table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">نام دسته بندی غذا</th>
                    <th scope="col">نام دسته بندی رستوران</th>
                    <th scope="col">اقدامات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($foodCategories as $foodCategory)
                    <tr>
                        <th scope="row">{{ $foodCategory->id }}</th>
                        <td>{{ $foodCategory->name }}</td>
                        <td>{{ $foodCategory->restaurantCategory->name }}</td>
                        <td>
                            <a class="btn btn-outline-warning"
                                href="{{ route('admin.foodCategories.edit', ['foodCategory' => $foodCategory]) }}">ویرایش
                                دسته بندی غذا</a>
                            <form class="d-inline"
                                action="{{ route('admin.foodCategories.destroy', ['foodCategory' => $foodCategory]) }}"
                                method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger" type="submit">حذف دسته بندی غذا</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
