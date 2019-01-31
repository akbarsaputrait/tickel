<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Penumpang;

class PenumpangController extends Controller
{
	use AuthenticatesUsers;

	protected $redirectTo = '/';

	public function guard()
  {
   return Auth::guard('penumpang');
  }

  public function showLoginForm()
  {
		if(!Auth::guard('penumpang')->check()) {
      return view('layouts.login_penumpang');
		} else {
			return redirect()->route('home');
		}
  }

	public function loginPenumpang(Request $request)
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
			if (Auth::guard('penumpang')->attempt(['email' => $request->email, 'password' => $request->password])) {
        // if successful, then redirect to their intended location
        return redirect()->route('home');
      }

      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('email'));
    }

    public function logoutPenumpang()
    {
      Auth::guard('penumpang')->logout();
      return redirect()->route('home');
    }

		public function registerForm() {
			return view('layouts.register_penumpang');
		}

		public function registerPost(RegisterRequest $request) {
			if(Penumpang::where('username', '=', $request->username)->exists()) {
				session()->flash('status', 'danger');
				session()->flash('message', 'Nama pengguna sudah digunakan!');
				return redirect()->back();
			}

			if(Penumpang::where('email', '=', $request->email)->exists()) {
				session()->flash('status', 'danger');
				session()->flash('message', 'Alamat email sudah digunakan!');
				return redirect()->back();
			}

			$penum = new Penumpang;
			$penum->username = $request->username;
			$penum->email = $request->email;
			$penum->password = bcrypt($request->password);
			$penum->nama_penumpang = $request->nama_penumpang;
			$penum->save();

			session()->flash('status', 'success');
			session()->flash('message', 'Berhasil! Silahkan anda login');
			return redirect()->route('penumpang.login');
		}
}
