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
		$data['pesanan'] = Pemesanan::where('status', '!=', 'cancel')->get();
		$data['pemasukan'] = Pemesanan::where('status', '=', 'done')->get(['total_bayar']);
		$data['pemesanan'] = Pemesanan::with(['petugas', 'admin'])->orderBy('created_at', 'DESC')->limit(10)->get();
		$data['total_bayar'] = DB::table('pemesanans')
															->where('pemesanans.status', '=', 'done')
															->sum(DB::raw('replace(pemesanans.total_bayar, \'.\', "")'));
		// dd($data);
		return view('layouts.admin.dashboard')->with($data);
	}

	public function chartPesanan() {
		$data = DB::select('call chartRute()');
		return response()->json($data);
	}

	public function chartTrans() {
		$data = DB::select('call chartTrans()');
		return response()->json($data);
	}
}
