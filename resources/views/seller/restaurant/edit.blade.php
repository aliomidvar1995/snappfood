@extends('layouts.seller')

@section('title')
    <title>پنل فروشنده | ویرایش اطلاعات رستوران</title>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card w-50 m-auto shadow">
                <div class="card-header text-center fw-bold fs-4">{{ __('ویرایش مشخصات رستوران') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('seller.restaurants.update', ['restaurant' => $restaurant]) }}">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <label class="mb-2" for="name">{{ __('نام رستوران') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $restaurant->name }}" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="phone_number">{{ __('شماره تماس') }}</label>
                            <input id="phone_number" type="number" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ $restaurant->phone_number }}">
                            @error('phone_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="account_number">{{ __('شماره حساب') }}</label>
                            <input id="account_number" type="number" class="form-control @error('account_number') is-invalid @enderror" name="account_number" value="{{ $restaurant->account_number }}">
                            @error('account_number')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="address">{{ __('آدرس') }}</label>
                            <textarea id="address" class="form-control @error('address') is-invalid @enderror" name="address">{{ $restaurant->address }}</textarea>
                            @error('address')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="restaurant_categories_id">{{ __('دسته بندی های رستوران ها') }}</label>
                            <select id="restaurant_categories_id" type="text" class="form-control @error('restaurant_categories_id') is-invalid @enderror" name="restaurant_categories_id" value="{{ $restaurant->restaurant_categories_id }}">
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
                                {{ __('ویرایش') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection