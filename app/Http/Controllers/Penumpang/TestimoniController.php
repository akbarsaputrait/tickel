<?php

namespace App\Http\Controllers\Penumpang;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Testimoni;

class TestimoniController extends Controller
{
    public function store(Request $request) {
				$tes = new Testimoni;
				$tes->id_user = auth()->guard('penumpang')->user()->id_penumpang;
				$tes->content = $request->content;
				$tes->save();

			session()->flash('message', 'Testimoni telah disimpan');
			session()->flash('status', 'success');

			return redirect()->route('profile.show', ['username' => auth()->guard('penumpang')->user()->username]);
		}

		public function update(Request $request, $id) {
			$tes = Testimoni::find($id);
			$tes->id_user = auth()->guard('penumpang')->user()->id_penumpang;
			$tes->content = $request->content;
			$tes->save();

			session()->flash('message', 'Testimoni telah disimpan');
			session()->flash('status', 'success');

			return redirect()->route('profile.show', ['username' => auth()->guard('penumpang')->user()->username]);
		}
}
