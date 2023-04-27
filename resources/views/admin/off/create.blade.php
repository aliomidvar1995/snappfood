@extends('layouts.admin')

@section('title')
    <title>پنل ادمین | ایجاد تخفیف</title>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card w-50 m-auto shadow">
                <div class="card-header text-center fw-bold fs-4">{{ __('ایجاد تخفیف') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.offs.store') }}">
                        @csrf
                        <div class="form-group mb-2">
                            <label class="mb-2" for="off">{{ __('درصد تخفیف') }}</label>
                            <input id="off" type="number" class="form-control @error('off') is-invalid @enderror" name="off" value="{{ old('off') }}" autofocus>
                            @error('off')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label class="mb-2" for="food_categories_id">{{ __('دسته بندی های غذا ها') }}</label>
                            <select id="food_categories_id" class="form-control @error('food_categories_id') is-invalid @enderror" name="food_categories_id" value="{{ old('food_categories_id') }}">
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