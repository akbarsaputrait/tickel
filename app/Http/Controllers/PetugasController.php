<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class PetugasController extends Controller
{
	use AuthenticatesUsers;

	protected $redirectTo = '/petugas/dasbor';

	public function guard()
  {
   return Auth::guard('petugas');
  }

  public function showLoginForm()
  {
		if(!Auth::guard('petugas')->check()) {
      return view('layouts.login_petugas');
		} else {
			return redirect()->route('petugas.dashboard');
		}
  }

	public function loginPetugas(Request $request)
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
      if (Auth::guard('petugas')->attempt(['email' => $request->email, 'password' => $request->password])) {
        // if successful, then redirect to their intended location
        return redirect()->route('petugas.dashboard');
      }else {
				session()->flash('status', 'danger');
				session()->flash('message', 'Email atau kata sandi anda salah.');
			}
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email'));
    }

    public function logoutPetugas()
    {
        Auth::guard('petugas')->logout();
        return redirect()->route('petugas.login');
    }
}
