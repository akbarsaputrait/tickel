<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
	use AuthenticatesUsers;

	protected $redirectTo = '/admin/dasbor';

	public function guard()
  {
   return Auth::guard('admin');
  }

  public function showLoginForm()
  {
		if(!Auth::guard('admin')->check()) {
      return view('layouts.login_admin');
		} else {
			return redirect()->route('admin.dashboard');
		}
  }

	public function loginAdmin(Request $request)
    {
      // Validate the form data
			$this->validate($request, [
        'email'   => 'required|email',
        'password' => 'required'
      ], [
				'email.required' => 'Alamat email harus diisi!',
				'email.email' => 'Alamat email tidak valid!',
				'password.required' => 'Kata sandi harus diisi!',
			]);
      // Attempt to log the user in
      if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password])) {
        // if successful, then redirect to their intended location
        return redirect()->route('admin.dashboard');
      }
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email'));
    }

    public function logoutAdmin()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
