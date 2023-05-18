<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Requests\UpdateCommentRequest;
use App\Models\Food;
use App\Models\Order;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Restaurant $restaurant)
    {
        if($request->search) {
            $comments = [];
            $orders = Order::query()->where('food_id', $request->search)->get();
            foreach($orders as $order) {
                $comments[] = $order->cart->comment;
            }
            $comments = collect($comments);
            $comments->sortBy('created_at');
            return view('seller.comment.index', compact('restaurant', 'comments'));
        }
        $comments = $restaurant->comments()->paginate(5);
        return view('seller.comment.index', compact('restaurant', 'comments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCommentRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Comment $comment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCommentRequest $request,Restaurant $restaurant, Comment $comment)
    {
        if(Auth::id() == $restaurant->user_id) {
            $comment->update(['delete_request' => true]);
        }
        return to_route('seller.comments.index', ['restaurant' => $restaurant]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
