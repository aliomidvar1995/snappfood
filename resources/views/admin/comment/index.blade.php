@extends('layouts.admin')

@section('title')
    <title>پنل ادمین | نظرات</title>
@endsection

@section('content')
    <div class="w-50 mx-auto mt-5">
        @foreach ($comments as $comment)
            <div class="card mt-3">
                <div class="card-header">
                    <p>نظر دهنده: {{ $comment->user->name }}</p>
                    <p>صاحب رستوران: {{ $comment->cart->restaurant->user->name }}</p>
                    غذا ها: 
                    <ul class="me-5">
                        @foreach ($comment->cart->orders as $order)
                            <li>{{ $order->food->name }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="card-body">
                    <p>{{ $comment->content }}</p>
                    <form class="my-3" action="{{ route('admin.comments.destroy', ['comment' => $comment]) }}" method="post">
                        @csrf
                        @method('delete')
                        <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                        <button class="btn btn-outline-danger" type="submit">حذف نظر</button>
                    </form>
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