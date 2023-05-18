@extends('layouts.food')

@section('title')
    <title>پنل فروشنده | تغییر وضعیت سفارش</title>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card w-50 m-auto shadow">
                <div class="card-header text-center fw-bold fs-4">{{ __('ویرایش وضعیت سفارش') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('seller.carts.update', ['restaurant' => $restaurant, 'cart' => $cart]) }}">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <label class="mb-2" for="status">{{ __('وضعیت سفارش') }}</label>
                            <select id="status" class="form-control @error('status') is-invalid @enderror" name="status">
                                <option value="pending">درحال بررسی</option>
                                <option value="preparing">در حال آماده سازی</option>
                                <option value="sending">ارسال به مقصد</option>
                                <option value="delivered">تحویل گرفته شد</option>
                            </select>
                            @error('status')
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