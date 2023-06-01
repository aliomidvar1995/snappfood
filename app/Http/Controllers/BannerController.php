<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Http\Requests\StoreBannerRequest;
use App\Http\Requests\UpdateBannerRequest;
use Illuminate\Support\Facades\Storage;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $banners = Banner::query()->paginate(3);
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreBannerRequest $request)
    {
        $path = Storage::putFile('banners', $request->file('image'));

        Banner::query()->create([
            'image' => $path
        ]);
        return to_route('admin.banners.index')->with('store', 'اطلاعات با موفقیت ذخیره شد');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
        $banners = Banner::all();
        return view('admin.banner.show', compact('banners'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Banner $banner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateBannerRequest $request, Banner $banner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Banner $banner)
    {
        Storage::delete($banner->image);
        $banner->delete();
        return to_route('admin.banners.index')->with('delete', 'اطلاعات با موفقیت حذف شد');
    }
}
