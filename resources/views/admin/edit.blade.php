@extends('layouts.admin')

@section('title')
    <title>اسنپ فود | ویرایش پروفایل</title>
@endsection

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card w-50 m-auto shadow">
                <div class="card-header text-center fw-bold fs-4">{{ __('ویرایش پروفایل') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('admin.update') }}">
                        @csrf
                        @method('put')
                        <div class="form-group mb-2">
                            <label class="mb-2" for="name">{{ __('نام') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label class="mb-2" for="email" class="col-md-4 col-form-label text-md-end">{{ __('ایمیل') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}">
                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label class="mb-2" for="password">{{ __('رمز عبور') }}</label>
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password">
                            @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label class="mb-2" for="password-confirm">{{ __('تایید رمز عبور') }}</label>
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation">
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