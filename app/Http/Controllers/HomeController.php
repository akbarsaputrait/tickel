<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Rute;
use App\TypeRute;
use App\Transportasi;

class HomeController extends Controller
{
    public function index() {
			$data['type_rute'] = TypeRute::orderBy('id_type_rute', 'DESC')->get();
			$data['rute_awal'] = Rute::distinct()->select('rute_awal')->get(['id_rute','rute_awal']);
			$data['rute_akhir'] = Rute::distinct()->select('rute_akhir')->get(['id_rute','rute_akhir']);
			$data['transportasi'] = Transportasi::with(['jenis'])->orderBy('id_transportasi', 'DESC')->get();
			return view('welcome')->with($data);
		}

		public function cariTransportasi(Request $request) {
			$data['transportasi'] = DB::select('call getDetailsRute(?,?)', [$request->rute_awal, $request->rute_akhir]);
			return response()->json($data);
		}

    public function getRute($id) {
      $data['rute'] = DB::select('call getDetailsRuteById(?)', [$id]);
      return response()->json($data);
    }
}
