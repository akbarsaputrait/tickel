<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class PetugasController extends Controller
{
	use AuthenticatesUsers;

	protected $redirectTo = '/petugas/dashboard';

	public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

	public function guard()
	{
	   return auth()->guard('petugas');
	}

  public function showLoginForm()
  {
      return view('layouts.login_petugas');
  }

	public function dashboard() {
		// return view('layouts.petugas.dashboard');
		dd(auth()->guard('petugas'));
	}
}
