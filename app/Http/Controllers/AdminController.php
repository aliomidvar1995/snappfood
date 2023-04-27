<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateAdminRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    public function edit()
    {
        return view('admin.edit');
    }

    public function update(UpdateAdminRequest $request)
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
