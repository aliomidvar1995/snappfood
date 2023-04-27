@extends('layouts.admin')

@section('title')
    <title>پنل ادمین | ویرایش تخفیف</title>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card w-50 m-auto shadow">
                <div class="card-header text-center fw-bold fs-4">{{ __('ویرایش تخفیف') }}</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.offs.update', ['off' => $off]) }}">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <label class="mb-2" for="off">{{ __('درصد تخفیف') }}</label>
                            <input id="off" type="number" class="form-control @error('off') is-invalid @enderror" name="off" value="{{ $off->off }}" autofocus>
                            @error('off')
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