@extends('layouts.admin')

@section('title')
    <title>پنل ادمین | مشاهده لیست بنر ها</title>
@endsection

@section('content')
    @if (session()->get('store'))
        <div class="store hide">
            <span class="fa-exclamation-circle">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg>
            </span>
            <span class="msg">{{ session()->get('store') }}</span>
            <span class="close-btn">
                <span class="fa-times">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                </span>
            </span>
        </div>
    @endif
    @if (session()->get('delete'))
        <div class="delete hide">
            <span class="fa-exclamation-circle">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-exclamation-circle-fill" viewBox="0 0 16 16">
                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                </svg>
            </span>
            <span class="msg">{{ session()->get('delete') }}</span>
            <span class="close-btn">
                <span class="fa-times">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-circle-fill" viewBox="0 0 16 16">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM5.354 4.646a.5.5 0 1 0-.708.708L7.293 8l-2.647 2.646a.5.5 0 0 0 .708.708L8 8.707l2.646 2.647a.5.5 0 0 0 .708-.708L8.707 8l2.647-2.646a.5.5 0 0 0-.708-.708L8 7.293 5.354 4.646z"/>
                    </svg>
                </span>
            </span>
        </div>
    @endif
    <div class="w-50 mx-auto mt-5">
        <table class="table table-hover table-dark table-striped">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">عکس بنر</th>
                    <th scope="col">اقدامات</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($banners as $banner)
                    <tr>
                        <th class="align-middle" scope="row">{{ $banner->id }}</th>
                        <td><img src="{{ url('images/'.$banner->image) }}" alt="" width="200"></td>
                        <td class="align-middle">
                            <form
                                action="{{ route('admin.banners.destroy', ['banner' => $banner]) }}"
                                method="post">
                                @csrf
                                @method('delete')
                                <button class="btn btn-outline-danger" type="submit">حذف بنر</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div dir="ltr">
            {{ $banners->links() }}
        </div>
    </div>
@endsection
