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

class HomeController extends Controller
{
    public function index() {
			$data['type_rute'] = TypeRute::orderBy('id_type_rute', 'DESC')->get();
			$data['rute_awal'] = Rute::distinct()->select('rute_awal')->get(['id_rute','rute_awal']);
			$data['rute_akhir'] = Rute::distinct()->select('rute_akhir')->get(['id_rute','rute_akhir']);
			$data['transportasi'] = Transportasi::with(['jenis'])->orderBy('id_transportasi', 'DESC')->get();
			return view('layouts.home')->with($data);
		}
}
