<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
	use AuthenticatesUsers;

	protected $redirectTo = '/admin/dashboard';

	public function __construct()
  {
    $this->middleware('guest')->except('logout');
  }

	public function guard()
	{
	    return auth()->guard('admin');
	}

  public function showLoginForm()
  {
      return view('layouts.login_admin');
  }
}
