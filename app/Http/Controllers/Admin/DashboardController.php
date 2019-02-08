<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Petugas;
use App\Penumpang;
use App\Pemesanan;

class DashboardController extends Controller
{
	public function index() {
		$data['petugas'] = Petugas::all();
		$data['penumpang'] = Penumpang::all();
		$data['pesanan'] = Pemesanan::where('status', '=', 'done')->get();
		$data['pemasukan'] = Pemesanan::where('status', '=', 'done')->get(['total_bayar']);
		$data['pemesanan'] = Pemesanan::limit(10)->get();
		// dd($data);
		return view('layouts.admin.dashboard')->with($data);
	}

	public function chartPesanan() {
		$data['pemesanan'] = DB::table('pemesanans')
														->select(DB::raw('COUNT(pemesanans.id_pemesanan) as jumlah, MONTH(pemesanans.created_at) as bulan'))
														->groupBy(DB::raw('MONTH(pemesanans.created_at)'))
														->get();
		return response()->json($data);
	}
}
