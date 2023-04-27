@extends('layouts.admin')

@section('title')
    <title>اسنپ فود | پنل ادمین</title>
@endsection

@section('content')
    <div class="mx-auto mt-5">
        <div class="card shadow-lg">
            <div class="card-header text-center fs-3">{{ Auth::user()->name }}</div>
            <div class="card-body fs-5">
                ایمیل: {{ Auth::user()->email }}
            </div>
        </div>
    </div>
@endsection