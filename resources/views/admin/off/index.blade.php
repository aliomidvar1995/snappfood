@extends('layouts.admin')

@section('title')
    <title>پنل ادمین | لیست تخفیف ها</title>
@endsection

@section('content')
<div class="w-50 mx-auto mt-5">
    <form class="mb-2" action="{{ route('admin.offs.index') }}">
        <div class="d-flex gap-2">
            <input class="form-control d-inline" type="text" name="search">
            <button class="btn btn-outline-secondary" type="submit">جستجو</button>
        </div>
    </form>
    <table class="table table-hover table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">تخفیف</th>
                <th scope="col">دسته بندی غذا</th>
                <th scope="col">دسته بندی رستوران</th>
                <th scope="col">اقدامات</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($offs as $off)
                <tr>
                    <th scope="row">{{ $off->id }}</th>
                    <td>{{ $off->off }}</td>
                    <td>{{ $off->foodCategory->name }}</td>
                    <td>{{ $off->foodCategory->restaurantCategory->name }}</td>
                    <td>
                        <a class="btn btn-outline-warning" href="{{ route('admin.offs.edit', ['off' => $off]) }}">ویرایش تخفیف</a>
                        <form class="d-inline" action="{{ route('admin.offs.destroy', ['off' => $off]) }}" method="post">
                            @csrf
                            @method('delete')
                            <button class="btn btn-outline-danger" type="submit">حذف تخفیف</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection