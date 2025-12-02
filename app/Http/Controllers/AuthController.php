<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Mostrar Login
    public function showLoginForm()
    {
        return view('auth.login');
    }

    // Procesar Login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $credenciales = $request->only('email', 'password');

        if (Auth::attempt($credenciales)) {
            return redirect()->route('home');
        }

        return back()->with('error', 'Credenciales incorrectas');
    }

    // Mostrar Register
    public function showRegisterForm()
    {
        return view('auth.register');
    }

    // Procesar Registro
    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('success', 'Usuario registrado correctamente');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
