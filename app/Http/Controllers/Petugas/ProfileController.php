<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Petugas;

class ProfileController extends Controller
{
	public function index() {
		$id = auth()->guard('petugas')->user()->id_petugas;
		$data['petugas'] = Petugas::find($id);
		return view('layouts.petugas.profile');
	}

	public function updateProfile(Request $request) {
		$id = auth()->guard('petugas')->user()->id_petugas;
		$request->validate([
			'nama_petugas' => 'required',
			'email' => 'required|unique:petugass,email,' . $id . ',id_petugas',
			'username' => 'required',
			'jenis_kelamin' => 'required',
			'telefone' => 'required'
		], [
			'nama_petugas.required' => 'Nama harus diisi',
			'email.required' => 'Alamat email harus diisi',
			'email.unique' => 'Alamat email sudah digunakan',
			'username.required' => 'Nama pengguna harus diisi',
			'jenis_kelamin.required'  => 'Jenis kelamin harus diisi',
			'telefone.required' => 'Nomor Telepon harus diisi'
		]);

		$petugas = Petugas::find($id);
		$petugas->nama_petugas = $request->nama_petugas;
		$petugas->username = $request->username;
		$petugas->email = $request->email;
		$petugas->jenis_kelamin = $request->jenis_kelamin;
		$petugas->telefone = $request->telefone;

		if($request->hasFile('file')) {
			$image = $request->file('file');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$request->file('file')->move(public_path('petugas/uploads/images/avatars'), $filename);
			$petugas->image = $filename;
		}
		$petugas->save();

		session()->flash('status', 'success');
		session()->flash('message', 'Profil berhasil diperbarui!');
		return redirect()->route('petugas.profile');
	}

	public function resetPassword(Request $request) {
		$request->validate([
			'current_pasword' => 'required',
			'new_password' => 'required|min:8',
			'confirm_password' => 'required|same:new_password'
		], [
			'current_pasword.required' => 'Kata sandi anda harus diisi',
			'new_password.required' => 'Kata sandi baru diisi!',
			'new_password.min' => 'Kata sandi harus lebih dari 8 karakter',
			'confirm_password.required' => 'Kata sandi konfirmasi harus diisi!',
			'confirm_password.same' => 'Kata sandi harus sama'
		]);

		$id = auth()->guard('petugas')->user()->id_petugas;
		$petugas = Petugas::find($id);
		if (Hash::check($request->current_pasword, $petugas->password)) {
			$petugas->password = bcrypt($request->confirm_password);
			$petugas->save();

			session()->flash('status', 'success');
			session()->flash('message', 'Kata sandi berhasil diperbarui');
		} else {
			session()->flash('status', 'danger');
			session()->flash('message', 'Kata sandi anda salah');
		}

		return redirect()->route('petugas.profile');
	}
}
