<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PenumpangController extends Controller
{
	use AuthenticatesUsers;

	protected $redirectTo = '/penumpang/dashboard';

	public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

	protected function guard()
	{
	    return auth()->guard('penumpang');
	}

  public function showLoginForm()
  {
      return view('layouts.login_penumpang');
  }

	public function dashboard() {
		return view('layouts.penumpang.dashboard');
	}
}
