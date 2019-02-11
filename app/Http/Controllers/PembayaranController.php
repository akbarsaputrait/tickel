<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Pemesanan;
use App\BuktiPembayaran;
use App\Rute;
use App\Transportasi;
use App\Rekening;

class PembayaranController extends Controller
{
		public function show($kode_pemesanan) {
			$data['rekening'] = Rekening::all();
			$data['pemesanan'] = Pemesanan::where('kode_pemesanan', '=', $kode_pemesanan)->where('status', '!=', 'cancel')->first();
			if(is_null($data['pemesanan'])) {
				session()->flash('status', 'danger');
				session()->flash('message', 'Tiket tidak ditemukan');
				return redirect()->route('profile.show', ['username' => auth()->guard('penumpang')->user()->username]);
			}
			$data['pembayaran'] = BuktiPembayaran::where('id_pemesanan', '=', $data['pemesanan']->id_pemesanan)->first();
			$data['rute'] = DB::select('call getDetailsRuteById(?)', [$data['pemesanan']->id_rute]);
			return view('layouts.penumpang.pembayaran')->with($data);
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
							$pemesanan->status = 'process';

							$bukti->save();
							$pemesanan->save();

							session()->flash('status', 'success');
							session()->flash('message', 'Bukti pembayaran berhasil diunggah. Kami akan segera mem-verifikasinya. Terima kasih');
							return redirect()->back();
						}
					}
				}
		}

		public function cancel($kode_pemesanan) {
			$tiket = Pemesanan::where('kode_pemesanan','=', $kode_pemesanan)->first();
			$tiket->status = 'cancel';
			$tiket->save();

			$rute = Rute::where('id_rute', '=', $tiket->id_rute)->first();
			$transportasi = Transportasi::find($rute->id_transportasi);
			$transportasi->jumlah_kursi = $transportasi->jumlah_kursi + 1;
			$transportasi->save();

			session()->flash('status', 'success');
			session()->flash('message', 'Tiket berhasil dibatalkan');
			return redirect()->route('profile.show', ['username' => auth()->guard('penumpang')->user()->username]);
		}
}
