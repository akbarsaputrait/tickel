<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Mail;
use PDF;
use Illuminate\Notifications\Messages\MailMessage;
use Snowfire\Beautymail\Beautymail;
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

			// CHECK IF USER VERIFIED
			if(Penumpang::where('email', '=', $request->email)->exists()) {
				$user = Penumpang::where('email', '=', $request->email)->first();
				if(is_null($user->verified_at)) {
					session()->flash('status', 'danger');
					session()->flash('message', 'Akun anda belum terverifikasi. Silahkan cek email anda untuk memverifikasi akun anda.');
				} else {
					// Attempt to log the user in
					if (Auth::guard('penumpang')->attempt(['email' => $request->email, 'password' => $request->password])) {
		        // if successful, then redirect to their intended location
		        return redirect()->route('home');
		      }else {
						session()->flash('status', 'danger');
						session()->flash('message', 'Email atau kata sandi anda salah.');
					}
				}
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
			$penum->token = sha1(time());
			$penum->save();

			$beautymail = app()->make(Beautymail::class);
				$beautymail->send('email.verify', [
					// DATA
					'token' => $penum->token,
					'username' => $penum->username,
					'nama_penumapang' => $penum->nama_penumpang
				], function($message)
				{
						$message
						 ->from(auth()->guard('admin')->user()->email)
						 ->to('akbarsaputra-548bce@inbox.mailtrap.io')
						 ->subject('Verifikasi Akun | Tickel');
				});

			session()->flash('status', 'success');
			session()->flash('message', 'Berhasil! Silahkan cek email anda untuk memverifikasi akun anda.');
			return redirect()->route('penumpang.login');
		}

		public function verifying_email($token) {
			if(Penumpang::where('token', '=', $token)->exists()) {
				$user = Penumpang::where('token', '=', $token)->first();
				if(!is_null($user->verified_at)) {
					session()->flash('status', 'danger');
					session()->flash('message', 'Akun anda sudah terverifikasi');
				} else {
					$user->verified_at = date('Y-m-d H:i:s');
					$user->save();

					session()->flash('status', 'success');
					session()->flash('message', 'Akun anda berhasil terverifikasi');
				}
			} else {
				session()->flash('status', 'danger');
				session()->flash('message', 'Email tidak terdaftar');
			}

			return redirect()->route('penumpang.login');
		}

		public function resendToken(Request $request) {
			if(Penumpang::where('email','=',$request->email_resend)->exists()) {
				$penum = Penumpang::where('email', '=', $request->email_resend)->first();

				if(!is_null($penum->verified_at)) {
					session()->flash('status', 'danger');
					session()->flash('message', 'Akun anda sudah terverifikasi');
				} else {
					$penum->token = sha1(time());
					$penum->save();

					$beautymail = app()->make(Beautymail::class);
						$beautymail->send('email.verify', [
							// DATA
							'token' => $penum->token,
							'username' => $penum->username,
							'nama_penumpang' => $penum->nama_penumpang
						], function($message)
						{
								$message
								 ->from('admin@tickel.com')
								 ->to('akbarsaputra-548bce@inbox.mailtrap.io')
								 ->subject('Verifikasi Akun | Tickel');
						});
						session()->flash('status', 'success');
						session()->flash('message', 'Kode verifikasi telah dikirim ulang');
				}

			} else {
				session()->flash('status', 'danger');
				session()->flash('message', 'Email tidak ditemukan');
			}

			return redirect()->route('penumpang.login');
		}
}
