@extends('layouts.app')

@section('content')
<div id="reset" class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card w-50 m-auto">
                <div class="card-header text-center">{{ __('بازیابی رمز عبور') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group mb-2">
                            <label class="mb-2" for="email">{{ __('ایمیل') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" autofocus>

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-center">
                            <button type="submit" class="btn btn-primary">
                                {{ __('ارسال لینک بازیابی رمز عبور') }}
                            </button>
                        </div>
                        <div class="d-flex justify-content-center">
                            <a class="btn btn-link text-decoration-none" href="{{ route('login') }}">بازگشت به صفحه ورود</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
