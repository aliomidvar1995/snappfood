@extends('layouts.admin')

@section('title')
    <title>پنل ادمین | ایجاد دسته بندی غذا</title>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card w-50 m-auto shadow">
                <div class="card-header text-center fw-bold fs-4">{{ __('ایجاد دسته بندی غذا') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.foodCategories.store') }}">
                        @csrf
                        <div class="form-group mb-2">
                            <label class="mb-2" for="name">{{ __('نام دسته بندی') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="restaurant_categories_id">{{ __('دسته بندی های رستوران ها') }}</label>
                            <select id="restaurant_categories_id" type="text" class="form-control @error('restaurant_categories_id') is-invalid @enderror" name="restaurant_categories_id" value="{{ old('restaurant_categories_id') }}">
                                @foreach ($restaurantCategories as $restaurantCategory)
                                    <option value="{{ $restaurantCategory->id }}">{{ $restaurantCategory->name }}</option>
                                @endforeach
                            </select>    
                            @error('restaurant_categories_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ایجاد') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection