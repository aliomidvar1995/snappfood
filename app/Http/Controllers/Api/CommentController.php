<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Cart;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Cart $cart)
    {
        $comment = $cart->comment;
        return CommentResource::make($comment);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request, Cart $cart)
    {

        if(Auth::id() == $cart->user_id && !$cart->comment && $cart->status == 'delivered') {
            $comment = Comment::query()->create([
                'content' => $request->validated('content'),
                'user_id' => Auth::id(),
                'cart_id' => $cart->id
            ]);
            return response(['comment' => CommentResource::make($comment)], 200);
        }
        return response(['msg' => 'unauthorized'], 401);
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart, Comment $comment)
    {
        if(Auth::id() == $cart->user_id && $comment->cart_id == $cart->id) {
            return response(['comment' => CommentResource::make($comment)], 200);
        }
        return response(['msg' => 'unauthorized'], 401);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request, Cart $cart, Comment $comment)
    {
        if(Auth::id() == $cart->user_id && $comment->cart_id == $cart->id) {
            $comment->update(['content' => $request->content]);
            return response(['msg' => 'اطلاعات با موفقیت بروزرسانی شد']);
        }
        return response(['msg' => 'unauthorized'], 401);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart, Comment $comment)
    {
        if(Auth::id() == $cart->user_id && $comment->cart_id == $cart->id) {
            $comment->delete();
            return response(['msg' => 'اطلاعات با موفقیت حذف شد']);
        }
        return response(['msg' => 'unauthorized']);
    }
}
