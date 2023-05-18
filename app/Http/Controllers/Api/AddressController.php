<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAddressRequest;
use App\Http\Requests\UpdateAddressRequest;
use App\Http\Resources\AddressResource;
use App\Models\Address;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return AddressResource::collection(Auth::user()->address);
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
    public function store(StoreAddressRequest $request)
    {
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $response = Http::withHeaders(['Api-Key' => 'service.363f2bf49950435c906c6cbef2cc3d89'])
            ->get("https://api.neshan.org/v5/reverse?lat=$latitude&lng=$longitude");
            
        $address = Address::query()->create([
            'title' => $request->validated('title'),
            'latitude' => $request->validated('latitude'),
            'longitude' => $request->validated('longitude'),
            'address' => $response['formatted_address'],
            'user_id' => Auth::id()
        ]);

        return response($address, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Address $address)
    {
        return AddressResource::make(Auth::user()->address()->find($address->id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Address $address)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAddressRequest $request, Address $address)
    {
        if($address->user_id !== Auth::id()) {
            return response(['invalid' => 'njhgyut']);
        }
        $latitude = $request->latitude;
        $longitude = $request->longitude;

        $response = Http::withHeaders(['Api-Key' => 'service.363f2bf49950435c906c6cbef2cc3d89'])
            ->get("https://api.neshan.org/v5/reverse?lat=$latitude&lng=$longitude");
        $address->update([
            'title' => $request->validated('title'),
            'latitude' => $request->validated('latitude'),
            'longitude' => $request->validated('longitude'),
            'address' => $response['formatted_address'],
        ]);

        // Auth::user()->addresses()->find($address->id)->update($request->validated());
        return response(['update' => 'اطلاعات با موفقیت بروزرسانی شد']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Address $address)
    {
        if($address->user_id !== Auth::id()) {
            return response(['invalid' => 'njhgyut']);
        }
        $address->delete();
        // Auth::user()->addresses()->find($address->id)->delete();
        return response(['delete' => 'اطلاعات با موفقیت حذف شد']);
    }

    public function setAddress(Address $address)
    {
        if($address->user_id == Auth::id()) {
            $flag = false;
            foreach(Auth::user()->addresses as $value) {
                if($value->set == true) {
                    $flag = true;
                }
            }
            if($flag == false) {
                $address->update([
                    'set' => true
                ]);
                return response(['msg' => 'آدرس ست شد']);
            }
            else {
                return response(['msg' => 'یک آدرس ست شده است']);
            }

        }
    }
}
