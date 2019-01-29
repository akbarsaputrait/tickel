<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\PesanTiketRequest;
use App\Rute;
use App\TypeRute;
use App\Transportasi;
use App\Pemesanan;

class HomeController extends Controller
{
    public function index() {
			$data['type_rute'] = TypeRute::orderBy('id_type_rute', 'DESC')->get();
			$data['rute_awal'] = Rute::distinct()->select('rute_awal')->get(['id_rute','rute_awal']);
			$data['rute_akhir'] = Rute::distinct()->select('rute_akhir')->get(['id_rute','rute_akhir']);
			$data['transportasi'] = Transportasi::with(['jenis'])->orderBy('id_transportasi', 'DESC')->get();
			return view('layouts.home')->with($data);
		}

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
      // dd($data);
      // ID RUTE TIDAK DIKETAHUI KARENA DATA DIAMBIL SECARA DITINCT
			return view('layouts.pesan-tiket')->with($data);
    }

    public function pesanTiket(PesanTiketRequest $request) {
      if($request->has('id_rute')) {
        return redirect()->route('pesan.create')->withInput();
      } else {
        if (!auth()->guard('penumpang')->user()) {
          session()->flash('status', 'warning');
          session()->flash('message', 'Anda harus login terlebih dahulu. Apabila tidak memiliki akun, silahkan untuk mendaftar');
          return redirect()->back()->withInput();
        } else {
          $pemesanan = new Pemesanan;
          $rute = Rute::with('transportasi')->where('id_rute', '=', $request->id_rute)->first();
          $transportasi = Transportasi::find($rute->id_transportasi);

          $pemesanan->kode_pemesanan = uniqid();
          $pemesanan->tanggal_pemesanan = date('Y-m-d');
          $pemesanan->tempat_pemesanan = $request->tempat_pemesanan;
          $pemesanan->status = 'pending';
          $pemesanan->id_pelanggan = auth()->guard('penumpang')->user()->id;
          $pemesanan->id_rute = $request->id_rute;
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
              // $transportasi->save();
              // $pemesanan->save();
              return response()->json(['status' => 'success', 'data' => $pemesanan]);
          } else {
              return response()->json(['status' => 'fail', 'request' => $transportasi]);
          }
          dd($pemesanan);
        }
      }
    }
}
