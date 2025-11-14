<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    public function Register()
    {
        return view('auth.register');
    }

    public function storeregis(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'kontak' => 'required|string|max:13',
            'username' => 'required|string|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'nama'=> $request->nama,
            'kontak'=> $request->kontak,
            'username'=> $request->username,
            'password'=> Hash::make($request->password),
            'role'=> 'member',
        ]);

        return redirect()->route('member.dashboard')->with('success', 'Registrasi berhasil. Silakan login.');
    }
}
