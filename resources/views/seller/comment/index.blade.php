@extends('layouts.food')

@section('title')
    <title>پنل ادمین | نظرات</title>
@endsection

@section('content')
    <div class="w-50 mx-auto mt-5">
        <form class="mb-2" action="{{ route('seller.comments.index', ['restaurant' => $restaurant]) }}">
            <div class="d-flex gap-2">
                <select class="form-control" name="search">
                    @foreach ($restaurant->foods as $food)
                        <option value="{{ $food->id }}">{{ $food->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-outline-secondary" type="submit">جستجو</button>
            </div>
        </form>
        @foreach ($comments as $comment)
            <div class="card mt-3">
                <div class="card-header">
                    غذا ها: 
                    <ul class="me-5">
                        @foreach ($comment->cart->orders as $order)
                            <li>{{ $order->food->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body">
                    <p>{{ $comment->content }}</p>
                    @if (!$comment->delete_request)
                        <form class="my-3" action="{{ route('seller.comments.update', ['restaurant' => $restaurant, 'comment' => $comment]) }}" method="post">
                            @csrf
                            @method('put')
                            <button class="btn btn-outline-danger" type="submit">در خواست حذف نظر</button>
                        </form>
                    @endif
                    @if (!$comment->reply)
                        <form class="mt-3" action="{{ route('seller.replies.store', ['restaurant' => $restaurant, 'comment' => $comment]) }}" method="post">
                            @csrf
                            <div class="form-group">
                                <textarea placeholder="پاسخ شما" class="form-control" name="content" rows="5"></textarea>
                                <button class="btn btn-outline-secondary mt-1" type="submit">ارسال</button>
                            </div>
                        </form>
                    @else
                        <p class="p-1 rounded me-3" style="background-color: #ccc">{{ $comment->reply->content }}</p>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
@endsection