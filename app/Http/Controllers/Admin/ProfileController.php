<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Admin;

class ProfileController extends Controller
{
    public function index() {
			$id = auth()->guard('admin')->user()->id;
			$data['admin'] = Admin::find($id);
			return view('layouts.admin.profile');
		}

		public function updateProfile(Request $request) {
			$request->validate([
				'name' => 'required',
				'email' => 'required',
				'username' => 'required'
			], [
				'name.required' => 'Nama harus diisi!',
				'email.required' => 'Alamat email harus diisi!',
				'username.required' => 'Nama pengguna harus diisi!'
			]);

			$id = auth()->guard('admin')->user()->id;
			$admin = Admin::find($id);
			$admin->name = $request->name;
			$admin->username = $request->username;
			$admin->email = $request->email;

			if($request->hasFile('file')) {
				$image = $request->file('file');
				$filename = time() . '.' . $image->getClientOriginalExtension();
				$request->file('file')->move(public_path('admin/uploads/images/avatars'), $filename);
				$admin->image = $filename;
			}
			$admin->save();

			session()->flash('status', 'success');
			session()->flash('message', 'Profil berhasil diperbarui!');
			return redirect()->route('admin.profile');
		}

		public function resetPassword(Request $request) {
			$request->validate([
        'current_pasword' => 'required',
				'new_password' => 'required|min:8',
				'confirm_password' => 'required|same:new_password'
			], [
        'current_pasword.required' => 'Kata sandi anda harus diisi',
				'new_password.required' => 'Kata sandi baru diisi',
				'new_password.min' => 'Kata sandi harus lebih dari 8 karakter',
				'confirm_password.required' => 'Kata sandi konfirmasi harus diisi',
				'confirm_password.same' => 'Kata sandi harus sama'
			]);


			$id = auth()->guard('admin')->user()->id;
			$admin = Admin::find($id);
      if (Hash::check($request->current_pasword, $admin->password)) {
        $admin->password = bcrypt($request->confirm_password);
        $admin->save();

        session()->flash('status', 'success');
        session()->flash('message', 'Kata sandi berhasil diperbarui');
      } else {
        session()->flash('status', 'danger');
        session()->flash('message', 'Kata sandi anda salah');
      }

			return redirect()->route('admin.profile');
		}
}
