<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rekening;

class RekeningController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['rekening'] = Rekening::all();
        return view('layouts.admin.rekening.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
          'atas_nama' => 'required',
          'nama_bank' => 'required',
          'no_rekening' => 'required'
        ], [
          'atas_nama.required' => 'Nama pemilik rekening harus diisi',
          'nama_bank.required' => 'Nama bank harus diisi',
          'no_rekening' => 'Nomor rekening harus diisi'
        ]);

        $rekening = new Rekening;
        $rekening->atas_nama = $request->atas_nama;
        $rekening->nama_bank = $request->nama_bank;
        $rekening->no_rekening = $request->no_rekening;
        $rekening->save();

        session()->flash('status', 'success');
        session()->flash('message', 'Rekening berhasil ditambahkan.');
        return redirect()->route('admin.rekening.index');
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
        $data['rekening'] = Rekening::find($id);
        return view('layouts.admin.rekening.show')->with($data);
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
        'atas_nama' => 'required',
        'nama_bank' => 'required',
        'no_rekening' => 'required'
      ], [
        'atas_nama.required' => 'Nama pemilik rekening harus diisi',
        'nama_bank.required' => 'Nama bank harus diisi',
        'no_rekening' => 'Nomor rekening harus diisi'
      ]);

      $rekening = Rekening::find($id);
      $rekening->atas_nama = $request->atas_nama;
      $rekening->nama_bank = $request->nama_bank;
      $rekening->no_rekening = $request->no_rekening;
      $rekening->save();

      session()->flash('status', 'success');
      session()->flash('message', 'Rekening berhasil diperbarui.');
      return redirect()->route('admin.rekening.edit',['rekening' => $id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Rekening::destroy($id);
      return response()->json(['success' => true]);
    }
}
