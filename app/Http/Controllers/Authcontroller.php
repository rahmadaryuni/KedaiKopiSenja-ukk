<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Authcontroller extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }
    public function login (Request $request)
    {
        $credentials = $request -> validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        if (Auth::attempt($credentials)){
            $request->session()->regenerate();
            $user = Auth::user();
            if ($user->role ===' manajer'){
                return redirect()->route('manajer.dashboard');
            }
            if ($user-> role === 'kasir'){
                return redirect()->route('kasir.dashboard');
            }
            Auth::Logout();

            return back()->withErrors([
                'username' => 'Role akun tidak dikenal',
            ]);
        }
        return back() ->withErrors([
            'username'=> 'username atau password salah.',
        ])->onlyInput('username');
    }

    public function logout (Request $request)
    {
        Auth::logout();

        $request->session()->invaliDate();
        $request -> session()-> regenerate();
        return redirect() -> route('login');
    }

}
