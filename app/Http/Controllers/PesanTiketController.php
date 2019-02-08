<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PesanTiketRequest;
use App\Penumpang;
use App\Rute;
use App\TypeRute;
use App\Transportasi;
use App\Pemesanan;
use App\BuktiPembayaran;

class PesanTiketController extends Controller
{
	public function cariTransportasi(Request $request) {
		$data['transportasi'] = DB::select('call getDetailsRute(?,?)', [$request->rute_awal, $request->rute_akhir]);
		return response()->json($data);
	}

	public function getRute($id) {
		$data['rute'] = DB::select('call getDetailsRuteById(?)', [$id]);
		return response()->json($data);
	}

	public function formPesanTiket() {
		$data['type_rute'] = TypeRute::orderBy('id_type_rute', 'DESC')->get();
		$data['rute_awal'] = Rute::distinct()->select('rute_awal')->get(['id_rute','rute_awal']);
		$data['rute_akhir'] = Rute::distinct()->select('rute_akhir')->get(['id_rute','rute_akhir']);
		$data['transportasi'] = Transportasi::with(['jenis'])->orderBy('id_transportasi', 'DESC')->get();
		return view('layouts.pesan-tiket')->with($data);
	}

	public function pesanTiket(PesanTiketRequest $request) {
		if($request->has('id_rute')) {
			return redirect()->route('pesan.create')->withInput();
		}

		if (!auth()->guard('penumpang')->user()) {
			session()->flash('status', 'warning');
			session()->flash('message', 'Anda harus login terlebih dahulu. Apabila tidak memiliki akun, silahkan untuk mendaftar');
			return redirect()->back()->withInput();
		}

		$check = DB::select('call checkRute(?,?,?,?,?)', [
			$request->rute_awal,
			$request->rute_akhir,
			$request->transportasi,
			$request->kelas,
			$request->jam_berangkat
		]);

		if(empty($check)) {
			session()->flash('status', 'warning');
			session()->flash('message', 'Tiket dengan rute tersebut tidak ditemukan.');
			return redirect()->back();
		}

		$idrute =  $request->id_rutes;
		$pemesanan = new Pemesanan;
		$rute = Rute::with('transportasi')->where('id_rute', '=', $idrute)->first();
		$transportasi = Transportasi::find($rute->id_transportasi);

		$pemesanan->kode_pemesanan = uniqid();
		$pemesanan->tanggal_pemesanan = date('Y-m-d');
		$pemesanan->tempat_pemesanan = $request->tempat_pemesanan;
		$pemesanan->status = 'pending';
		$pemesanan->id_pelanggan = auth()->guard('penumpang')->user()->id_penumpang;
		$pemesanan->id_rute = $request->id_rutes;
		$pemesanan->tujuan = $request->tujuan;
		$pemesanan->tanggal_berangkat = date('Y-m-d', strtotime($request->tanggal_berangkat));
		$pemesanan->jam_cekin = date('H:i:s', strtotime($request->jam_cekin));
		$pemesanan->jam_berangkat = $rute->jam_berangkat;
		$pemesanan->total_bayar = $rute->harga;

		// KODE KURSI
		$jumlah_kursi = $transportasi->jumlah_kursi;

		if($jumlah_kursi > 0) {
				$kode_transportasi = $rute->transportasi->kode;
				$kode_kursi = $kode_transportasi .'-'.$jumlah_kursi;
				$pemesanan->kode_kursi = $kode_kursi;
				$transportasi->jumlah_kursi = $jumlah_kursi - 1;
				$transportasi->save();
				$pemesanan->save();

				$bukti = new BuktiPembayaran;
				$bukti->id_penumpang = auth()->guard('penumpang')->user()->id_penumpang;
				$bukti->id_pemesanan = $pemesanan->id_pemesanan;
				$bukti->save();

				$penumpang = Penumpang::find($pemesanan->id_pelanggan);
				$penumpang->nama_penumpang = $request->nama_penumpang;
				$penumpang->email = $request->email;
				$penumpang->no_identitas = $request->no_identitas;
				$penumpang->alamat_penumpang = $request->alamat_penumpang;
				$penumpang->tanggal_lahir = $request->tanggal_lahir;
				$penumpang->telefone = $request->telefone;
				$penumpang->save();

				session()->flash('status', 'success');
				session()->flash('message', 'Untuk melanjutkan pemesanan silahkan unggah bukti pembayaran anda.');
				return redirect()->route('pembayaran.show', ['id_pemesanan' => $pemesanan->kode_pemesanan])->withInput();
		} else {
			session()->flash('status', 'danger');
			session()->flash('message', 'Maaf tiket yang anda pesan telah habis.');
			return redirect()->back()->withInput();
		}
	}
}
