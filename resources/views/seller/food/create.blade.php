@extends('layouts.food')

@section('title')
    <title>پنل فروشنده | ایجاد غذا</title>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card w-50 m-auto shadow">
                <div class="card-header text-center fw-bold fs-4">{{ __('ایجاد غذا') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('seller.foods.store', ['restaurant' => $restaurant]) }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="restaurant_id" value="{{ $restaurant->id }}">
                        <div class="form-group mb-2">
                            <label class="mb-2" for="image">{{ __('تصویر غذا') }}</label>
                            <input id="image" type="file" class="form-control @error('image') is-invalid @enderror" name="image" value="{{ old('image') }}">
                            @error('image')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="name">{{ __('نام غذا') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="price">{{ __('قیمت غذا') }}</label>
                            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}">
                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="off">{{ __('تخفیف (درصد)') }}</label>
                            <input id="off" type="number" class="form-control @error('off') is-invalid @enderror" name="off" value="{{ old('off') }}">
                            @error('off')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="food_categories_id">{{ __('دسته بندی غذا') }}</label>
                            <select id="food_categories_id" class="form-control @error('food_categories_id') is-invalid @enderror" name="food_categories_id">
                                @foreach ($foodCategories as $foodCategory)
                                    <option value="{{ $foodCategory->id }}">{{ $foodCategory->name }}</option>
                                @endforeach
                            </select>
                            @error('food_categories_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="material">{{ __('مواد اولیه') }}</label>
                            <textarea id="material" class="form-control @error('material') is-invalid @enderror" name="material">{{ old('material') }}</textarea>
                            @error('material')
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