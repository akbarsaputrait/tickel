<?php

namespace App\Http\Controllers\Petugas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Pemesanan;
use App\Penumpang;
use App\Rute;
use App\Petugas;

class DashboardController extends Controller
{
    public function index() {
      $data['pemesanan'] = Pemesanan::with('petugas')->orderBy('id_pemesanan', 'DESC')->limit(10)->get();
			return view('layouts.petugas.dashboard')->with($data);
		}
}
