<?php

namespace App\Http\Controllers\Penumpang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PenumpangRequest;
use App\Penumpang;
use App\Pemesanan;

class ProfilController extends Controller
{
	public function profilShow($username) {
		$username = auth()->guard('penumpang')->user()->username;
		$data['penumpang'] = Penumpang::where('username', '=', $username)->first();
		$data['pemesanan'] = Pemesanan::with('rute')->where('id_pelanggan', '=', auth()->guard('penumpang')->user()->id_penumpang)->orderBy('created_at', 'DESC')->get();
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
}
