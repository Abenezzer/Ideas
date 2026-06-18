<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
       public function create()
    {
        return view('auth.register');
    }

    
    public function store(Request $request)
    {
        $validatedUser = $request->validate([
            'name' => ['required', 'min:3', 'max:250'],
            'email' => ['required', 'unique:users', 'max:250'],
            'password' => ['required', 'min:6', 'max:250']
        ]);
        
        $user = User::create([
            'name' => $validatedUser['name'],
            'email' => $validatedUser['email'],
            'password' => $validatedUser['password']

        ]);

        Auth::login($user);

        return redirect('/')->with(['sucess' => 'You are registered Successfully']);
        
    }

   
}
