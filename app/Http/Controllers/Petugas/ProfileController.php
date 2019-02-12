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
			'nama_petugas' => 'alpha_spaces|required|unique:petugass,nama_petugas,'.$id.',id_petugas',
			'email' => 'required|email|unique:petugass,email,'.$id.',id_petugas',
			'username' => 'alpha_spaces|required|min:5|max:20',
			'jenis_kelamin' => 'alpha_spaces|required',
			'telefone' => 'numeric|required',
			'file' => 'mimes:jpeg,jpg,png|dimensions:max_width=3000,max_height=3000'
		], [
			'nama_petugas.required' => 'Nama harus diisi',
			'email.required' => 'Alamat email harus diisi',
			'email.unique' => 'Alamat email sudah digunakan',
			'username.required' => 'Nama pengguna harus diisi',
			'email.alpha_spaces' => 'Email harus berupa huruf',
			'username.min' => 'Nama pengguna harus lebih dari :min karakter',
			'username.max' => 'Nama pengguna harus kurang dari :max karakter',
			'username.alpha_spaces' => 'Nama pengguna harus berupa huruf',
			'jenis_kelamin.required'  => 'Jenis kelamin harus diisi',
			'jenis_kelamin.alpha_spaces' => 'Jenis kelamin harus berupa huruf',
			'telefone.required' => 'Nomor telepon harus diisi',
			'telefone.numeric' => 'Nomor telepon harus berupa angka',
			'nama_petugas.required' => 'Nama petugas harus diisi',
			'nama_petugas.unique' => 'Nama petugas sudah digunakan',
			'file.mimes' => 'Gambar harus berupa :mimes',
			// 'file.max' => 'Gambar harus kurang dari :max kb',
			'file.dimensions' => 'Ukuran gambar harus kurang dari :max_width px dan :max_height px',
			'file.uploaded' => 'Gambar tidak dapat diunggah.',
			'file.file' => 'File tidak berhasil diunggah'
		]);

		$petugas = Petugas::find($id);
		$petugas->nama_petugas = $request->nama_petugas;
		$petugas->username = $request->username;
		$petugas->email = $request->email;
		$petugas->jenis_kelamin = $request->jenis_kelamin;
		$petugas->telefone = $request->telefone;

		if($request->hasFile('file')) {
			$maxSize = 3000000;
			if($request->file('file')->getSize() > $maxSize) {
				session()->flash('status', 'danger');
				session()->flash('message', 'Ukuran file terlalu besar.');

				return redirect()->back();
			}
			$image = $request->file('file');
			$filename = time() . '.' . $image->getClientOriginalExtension();
			$request->file('file')->move(public_path('uploads/images/avatars'), $filename);
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
