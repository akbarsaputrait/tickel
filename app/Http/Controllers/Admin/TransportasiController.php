<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;
use App\TypeTransportasi;
use App\Transportasi;
use App\Kursi;

class TransportasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['transportasi'] = Transportasi::with(['jenis'])->get();
      return view('layouts.admin.transportasi.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data['type'] = TypeTransportasi::all();
      return view('layouts.admin.transportasi.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      // CEK JIKA ADA KODE YANG SAMA
      if(Transportasi::where('kode', '=', $request->kode)->exists()) {
        session()->flash('status', 'danger');
        session()->flash('message', 'Kode transportasi sudah digunakan');
        return redirect()->back()->withInput();
      }

      $request->validate([
        'kode' => 'required|unique:transportasis,kode',
        'nama_transportasi' => 'required',
        'jumlah_kursi' => 'required|numeric',
        'id_type_transportasi' => 'required'
      ], [
        'kode.required' => 'Kode harus diisi',
        'nama_transportasi.required' => 'Nama transportasi harus diisi',
        'jumlah_kursi.required' => 'Jumlah kursi harus diisi',
        'id_type_transportasi.required' => 'Tipe transportasi harus diisi',
        'kode.unique' => 'Kode sudah digunakan',
        'jumlah.numeric' => 'Jumlah kursi harus berupa angka',
      ]);

      $trans = new Transportasi;
      $trans->kode = $request->kode;
      $trans->nama_transportasi = $request->nama_transportasi;
      $trans->jumlah_kursi = $request->jumlah_kursi;
      $trans->keterangan = $request->keterangan;
      $trans->id_type_transportasi = $request->id_type_transportasi;
      $trans->save();

      session()->flash('status', 'success');
      session()->flash('message', 'Transportasi berhasil ditambahkan.');
      return redirect()->route('admin.transportasi.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['trans'] = Transportasi::find($id);
        $data['type'] = TypeTransportasi::all();
        return view('layouts.admin.transportasi.show')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

      $request->validate([
        'kode' => 'required|unique:transportasis,kode,'. $id .', id_transportasi',
        'nama_transportasi' => 'required',
        'jumlah_kursi' => 'required|numeric',
        'id_type_transportasi' => 'required'
      ], [
        'kode.required' => 'Kode harus diisi',
        'nama_transportasi.required' => 'Nama transportasi harus diisi',
        'jumlah_kursi.required' => 'Jumlah kursi harus diisi',
        'id_type_transportasi.required' => 'Tipe transportasi harus diisi',
        'kode.unique' => 'Kode sudah digunakan',
        'jumlah.numeric' => 'Jumlah kursi harus berupa angka',
      ]);

      $trans = Transportasi::find($id);
      $trans->kode = $request->kode;
      $trans->nama_transportasi = $request->nama_transportasi;
      $trans->jumlah_kursi = $request->jumlah_kursi;
      $trans->keterangan = $request->keterangan;
      $trans->id_type_transportasi = $request->id_type_transportasi;
      $trans->save();

      session()->flash('status', 'success');
      session()->flash('message', 'Transportasi berhasil diperbarui.');
      return redirect()->route('admin.transportasi.edit', ['transportasi'=> $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Transportasi::destroy($id);
        return response()->json(['success' => true]);
    }
}
