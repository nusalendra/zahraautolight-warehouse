<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginBasic extends Controller
{
  public function index()
  {
    return view('content.authentications.auth-login-basic');
  }

  public function login()
  {
    $attributes = request()->validate([
      'username' => 'required',
      'password' => 'required'
    ]);

    if (Auth::attempt($attributes)) {
      session()->regenerate();

      return redirect(Auth::user()->redirectPath());
    } else {
      return redirect()->back()->with('error', 'Username atau password anda salah!');
    }
  }

  public function logout()
  {
    Auth::logout();

    return redirect('/');
  }
}
