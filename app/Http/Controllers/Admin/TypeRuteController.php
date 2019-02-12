<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TypeRute;

class TypeRuteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['type'] = TypeRute::all();
      return view('layouts.admin.type_rute.index')->with($data);
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
        'nama_type' => 'required|alpha_spaces|unique:type_rute, nama_type'
      ], [
        'nama_type.required' => 'Nama tipe harus diisi',
        'nama_type.alpha_spaces' => 'Nama tipe harus berupa huruf dan tanpa tanda baca'
      ]);

        $type = new TypeRute;
        $type->nama_type = $request->nama_type;
        $type->keterangan = $request->keterangan;
        $type->save();

        session()->flash('status', 'success');
        session()->flash('message', 'Tipe rute berhasil ditambahkan.');
        return redirect()->route('type_rute.index');
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
      $data['type'] = TypeRute::find($id);
      dd($data);
      return view('layouts.admin.type_rute.show')->with($data);
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
        'nama_type' => 'required|alpha_spaces|unique:type_rute, nama_type,' . $id . ', id_type_rute'
      ], [
        'nama_type.required' => 'Nama tipe harus diisi',
        'nama_type.alpha_spaces' => 'Nama tipe harus berupa huruf dan tanpa tanda baca'
      ]);

      $type = TypeRute::find($id);
      $type->nama_type = $request->nama_type;
      $type->keterangan = $request->keterangan;
      $type->save();

      session()->flash('status', 'success');
      session()->flash('message', 'Tipe rute berhasil ditambahkan.');
      return redirect()->route('type_rute.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        TypeRute::destroy($id);
        return response()->json(['success' => true]);
    }
}
