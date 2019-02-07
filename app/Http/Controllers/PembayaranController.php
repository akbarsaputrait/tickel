<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pemesanan;
use App\BuktiPembayaran;

class PembayaranController extends Controller
{
		public function show($kode_pemesanan) {
			$data['pemesanan'] = Pemesanan::where('kode_pemesanan', '=', $kode_pemesanan)->first();
			$data['pembayaran'] = BuktiPembayaran::where('id_pemesanan', '=', $data['pemesanan']->id_pemesanan)->first();
			$data['rute'] = DB::select('call getDetailsRuteById(?)', [$data['pemesanan']->id_rute]);
			// dd($data);
			return view('layouts.pembayaran')->with($data);
		}

    public function update(Request $request, $id) {
			$pemesanan = Pemesanan::where('kode_pemesanan', '=', $id)->first();
				if(!$pemesanan) {
					session()->flash('status', 'warning');
					session()->flash('message', 'Maaf tiket anda tidak ditemukan');
					return redirect()->route('home');
				} else {
					if(!is_null($pemesanan->file)) {
						session()->flash('status', 'warning');
						session()->flash('message', 'Maaf tiket anda tidak ditemukan');
						return redirect()->route('pembayaran.show', ['id_pemesanan' => $id]);
					} else {
						if(!$request->hasFile('file')) {
							session()->flash('status', 'danger');
							session()->flash('message', 'Bukti pembayaran gagal diunggah. Silahkan coba lagi.');
							return redirect()->back();
						}else {
							$file = $request->file('file');
							$filename = time()  .'.'. $file->getClientOriginalExtension();
							$request->file('file')->move(public_path('uploads/images/bukti-pembayaran'), $filename);

							// UPLOAD BUKTI PEMBAYARAN
							$bukti = BuktiPembayaran::where('id_pemesanan', '=', $pemesanan->id_pemesanan)->first();
							$bukti->file = $filename;

							// CHANGE STATUS PEMESANAN
							$pemesanan->status = 'Proccess';

							$bukti->save();
							$pemesanan->save();

							session()->flash('status', 'success');
							session()->flash('message', 'Bukti pembayaran berhasil diunggah. Kami akan segera mem-verifikasinya. Terima kasih');
							return redirect()->back();
						}
					}
				}
		}
}
