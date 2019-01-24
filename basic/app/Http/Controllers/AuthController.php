<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function showLoginForm()
    {
        return view('login.login');
    }

    public function login(LoginRequest $request)
    {
        $login = User::where('email',$request->input('correo'))->first();

        if (!$login) return back()->with('error','correo no encontrado')->withInput();

        if (Hash::check($request->input('password'), $login->password)) {
            return redirect()->route('index');
        }else{
            return back()->with('error','datos incorrectos')->withInput();
        }
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();

        $request->session()->invalidate();

        return redirect('/')->with('info','has cerrado sesión');
    }

    public function showRegisterForm()
    {
        return 'formulario de registro';
    }
}
