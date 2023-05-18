<?php

namespace App\Http\Controllers;

use App\Models\Restaurant;
use Illuminate\Http\Request;
use Morilog\Jalali\Jalalian;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request, Restaurant $restaurant)
    {
        $last_week = Jalalian::forge('last week')->format('Y-m-d');
        $last_month = Jalalian::forge('last month')->format('Y-m-d');
        $last_year = Jalalian::forge('last year')->format('Y-m-d');
        $now = Jalalian::now()->format('Y-m-d');
        // dd($now);
        $total_price = 0;
        $total_count = 0;

        if(!empty($request->search) && $request->search == 'week') {
            foreach($restaurant->carts as $cart) {
                if($cart->date > $last_week) {
                    $total_price += $cart->total_price;
                    $total_count++;
                }
            }
            return view('seller.report.index', 
                compact('restaurant', 'total_price', 'total_count'));
        }
        if(!empty($request->search) && $request->search == 'month') {
            foreach($restaurant->carts as $cart) {
                if($cart->date > $last_month) {
                    $total_price += $cart->total_price;
                    $total_count++;
                }
            }
            return view('seller.report.index', 
                compact('restaurant', 'total_price', 'total_count'));
        }
        if(!empty($request->search) && $request->search == 'year') {
            foreach($restaurant->carts as $cart) {
                if($cart->date > $last_year) {
                    $total_price += $cart->total_price;
                    $total_count++;
                }
            }
            return view('seller.report.index', 
                compact('restaurant', 'total_price', 'total_count'));
        }
        foreach($restaurant->carts as $cart) {
            $total_price += $cart->total_price;
            $total_count++;
        }
        return view('seller.report.index', 
            compact('restaurant', 'total_price', 'total_count'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
