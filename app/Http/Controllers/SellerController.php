<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateSellerRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SellerController extends Controller
{
    public function index()
    {
        return view('seller.index');
    }

    public function edit()
    {
        return view('seller.edit');
    }

    public function update(UpdateSellerRequest $request)
    {
        Auth::user()->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return to_route('seller.index');
    }

    public function destroy(Request $request)
    {
        Auth::user()->delete();
 
        $request->session()->invalidate();
     
        $request->session()->regenerateToken();
     
        return redirect('/');
    }
}
