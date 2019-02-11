<?php

namespace App\Http\Controllers\Penumpang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\PenumpangRequest;
use App\Penumpang;
use App\Pemesanan;
use App\Testimoni;

class ProfilController extends Controller
{
	public function profilShow($username) {
		$username = auth()->guard('penumpang')->user()->username;
		$id_penumpang = auth()->guard('penumpang')->user()->id_penumpang;
		$data['penumpang'] = Penumpang::where('username', '=', $username)->first();
		$data['pemesanan'] = Pemesanan::with('rute')->where('id_pelanggan', '=', $id_penumpang)->orderBy('created_at', 'DESC')->get();
		$data['testimoni'] = Testimoni::where('id_user', '=', $id_penumpang)->first();
		return view('layouts.penumpang.profil')->with($data);
	}

	public function profilUpdate(PenumpangRequest $request, $username) {
		$penum = Penumpang::where('username', '=', $username)->first();
		$penum->username = $request->username;
		$penum->email		 = $request->email;
		$penum->nama_penumpang = $request->nama_penumpang;
		$penum->no_identitas = $request->no_identitas;
		$penum->alamat_penumpang = $request->alamat_penumpang;
		$penum->tanggal_lahir = $request->tanggal_lahir;
		$penum->jenis_kelamin = $request->jenis_kelamin;
		$penum->telefone = $request->telefone;

		if($request->hasFile('file')) {
			$file = $request->file('file');
			$filename = time()  .'.'. $file->getClientOriginalExtension();
			$request->file('file')->move(public_path('uploads/images/avatars'), $filename);
			$penum->image = $filename;
		}

		$penum->save();

		session()->flash('status', 'success');
		session()->flash('message', 'Profil anda berhasil diperbarui');
		return redirect()->back();
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

		$id = auth()->guard('penumpang')->user()->id_penumpang;
		$penumpang = Penumpang::find($id);
		if (Hash::check($request->current_pasword, $penumpang->password)) {
			$penumpang->password = bcrypt($request->confirm_password);
			$penumpang->save();

			session()->flash('status', 'success');
			session()->flash('message', 'Kata sandi berhasil diperbarui');
		} else {
			session()->flash('status', 'danger');
			session()->flash('message', 'Kata sandi anda salah');
		}

		return redirect()->back();
	}
}
