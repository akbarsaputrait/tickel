<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\RuteRequest;
use App\Transportasi;
use App\TypeRute;
use App\Rute;

class RuteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function index()
     {
       $data['rute'] = Rute::with(['transportasi', 'type'])->get();
       return view('layouts.admin.rute.index')->with($data);
     }

     /**
      * Show the form for creating a new resource.
      *
      * @return \Illuminate\Http\Response
      */
     public function create()
     {
       $data['transportasi'] = Transportasi::all();
       $data['type'] = TypeRute::all();
         return view('layouts.admin.rute.create')->with($data);
     }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RuteRequest $request)
    {
        $rute = new Rute;
        $rute->tujuan = $request->tujuan;
        $rute->rute_awal = $request->rute_awal;
        $rute->rute_akhir = $request->rute_akhir;
        $rute->harga = $request->harga;
        $rute->id_transportasi = $request->id_transportasi;
        $rute->id_type_rute = $request->id_type_rute;
        $rute->save();

        session()->flash('status', 'success');
        session()->flash('message', 'Rute berhasil ditambahkan.');
        return redirect()->route('rute.index');
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
        $data['transportasi'] = Transportasi::all();
        $data['type'] = TypeRute::all();
        $data['rute'] = Rute::find($id);
        return view('layouts.admin.rute.show')->with($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RuteRequest $request, $id)
    {
      $rute = Rute::find($id);
      $rute->tujuan = $request->tujuan;
      $rute->rute_awal = $request->rute_awal;
      $rute->rute_akhir = $request->rute_akhir;
      $rute->harga = $request->harga;
      $rute->id_transportasi = $request->id_transportasi;
      $rute->id_type_rute = $request->id_type_rute;
      $rute->save();

      session()->flash('status', 'success');
      session()->flash('message', 'Rute berhasil diperbarui.');
      return redirect()->route('rute.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Rute::destroy($id);
        return response()->json(['success' => true]);
    }
}
