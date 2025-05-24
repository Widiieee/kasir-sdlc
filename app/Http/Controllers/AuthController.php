<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth/register');
    }

    public function registerSave (Request $request)
    {
        Validator::make($request->all(), [
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ])->validate();

        User::create([
            'nama'=> $request->nama,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role'=> 'Admin'
        ]);

        return redirect()->route('login');
    }
}
