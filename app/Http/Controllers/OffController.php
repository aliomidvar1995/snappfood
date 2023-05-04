<?php

namespace App\Http\Controllers;

use App\Models\FoodCategory;
use App\Models\Off;
use App\Http\Requests\StoreOffRequest;
use App\Http\Requests\UpdateOffRequest;
use Illuminate\Http\Request;

class OffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->search) {
            $offs = Off::query()
                        ->where('off', 'like', "%$request->search%")
                        ->paginate(5);
            return view('admin.off.index', compact('offs'));
        }
        $offs = Off::query()->paginate(5);
        return view('admin.off.index', compact('offs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $foodCategories = FoodCategory::all();
        return view('admin.off.create', compact('foodCategories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreOffRequest $request)
    {
        Off::query()->create([
            'off' => $request->off,
            'food_categories_id' => $request->food_categories_id
        ]);
        return to_route('admin.offs.index')->with('store', 'اطلاعات با موفقیت ذخیره شد');
    }

    /**
     * Display the specified resource.
     */
    public function show(Off $off)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Off $off)
    {
        return view('admin.off.edit', compact('off'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateOffRequest $request, Off $off)
    {
        $off->update([
            'off' => $request->off
        ]);
        return to_route('admin.offs.index')->with('update', 'اطلاعات با موفقیت بروزرسانی شد');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Off $off)
    {
        $off->delete();
        return to_route('admin.offs.index')->with('delete', 'اطلاعات با موفقیت حذف شد');
    }
}
