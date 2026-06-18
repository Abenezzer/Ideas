<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionController extends Controller
{
    public function create()
    {
        return view('auth.login');
    }

    public function store(Request $request)
    {
        $cred = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (! Auth::attempt($cred)) {
            $request->session()->regenerateToken();

            return back()
            ->withErrors(['password' => 'We Can not login you with this credencial '])
            ->withInput();
        }

        $request->session()->regenerate();
        return redirect()->intended('/')->with(['success' => 'Logged In Successfuly']);
    }

    public function destroy()
    {
        Auth::logout();

        return redirect('/');
    }
}
