<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showLogin(){
        return view('auth.login');
    }

    public function login(Request $request){
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.products.index');
            }
            return redirect()->route('products.index');
        }

        return back()->withErrors([
            'email' => 'invalid email or password.',
        ])
        ->OnlyInput('email');
    }

    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('products.index');
    }


public function showRegister()
{
    return view('auth.register');
}

public function register(Request $request)
{
    $data = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255|unique:users,email',
        'password' => 'required|string|min:8|confirmed',
    ]);

    $user = new User();
    $user->name = $data['name'];
    $user->email = $data['email'];
    $user->password = Hash::make($data['password']);
    $user->role = 'user';
    $user->save();

    Auth::login($user);
    $request->session()->regenerate();

    return redirect()->route('products.index')
        ->with('success', 'Account created successfully!');
}


}
