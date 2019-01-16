<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\TypeTransportasiRequest;
use App\TypeTransportasi;

class TypeTransportasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['type_transportasi'] = TypeTransportasi::all();
      return view('layouts.admin.type_transportasi.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.type_transportasi.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TypeTransportasiRequest $request)
    {
      $type = new TypeTransportasi;
      $type->nama_type = $request->nama_type;
      $type->keterangan = $request->keterangan;
      $type->save();

      session()->flash('status','success');
      session()->flash('message', 'Tipe transportasi berhasil ditambahkan.');
      return redirect()->route('type-transportasi.index');
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
      $data['type'] = TypeTransportasi::find($id);
        return view('layouts.admin.type_transportasi.show')->with($data);
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
      $type = TypeTransportasi::find($id);
      $type->nama_type = $request->nama_type;
      $type->keterangan = $request->keterangan;
      $type->save();

      session()->flash('status','success');
      session()->flash('message', 'Tipe transportasi berhasil diperbarui.');
      return redirect()->route('type-transportasi.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      TypeTransportasi::destroy($id);
      return response()->json(['success' => true]);
    }
}
