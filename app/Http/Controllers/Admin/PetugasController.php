<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PetugasRequest;
use App\Level;
use App\Petugas;

class PetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['petugas'] = Petugas::all();
      return view('layouts.admin.petugas.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      $data['level'] = Level::all();
      return view('layouts.admin.petugas.create')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PetugasRequest $request)
    {
      $petugas = new Petugas;
      $petugas->username = $request->username;
      $petugas->email = $request->email;
      $petugas->password = bcrypt($request->password);
      $petugas->nama_petugas = $request->nama_petugas;
      $petugas->jenis_kelamin = $request->jenis_kelamin;
      $petugas->alamat_petugas = $request->alamat_petugas;
      $petugas->tanggal_lahir = date('Y-m-d', strtotime($request->tanggal_lahir));
      $petugas->telefone = $request->telefone;
      $petugas->id_level = $request->id_level;
      // UPLOAD PHOTO PROFILE
      if($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $request->file('image')->move(public_path('uploads/images/avatars'), $filename);
        $petugas->image = $filename;
      };
      $petugas->save();

      session()->flash('status', 'success');
      session()->flash('message', 'Petugas berhasil ditambahkan.');
      return redirect()->route('petugas.index');
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
      $data['level'] = Level::all();
      $data['petugas'] = Petugas::find($id);
      return view('layouts.admin.petugas.show')->with($data);
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
      $petugas = Petugas::find($id);
      $petugas->username = $request->username;
      $petugas->email = $request->email;
      $petugas->password = bcrypt($request->password);
      $petugas->nama_petugas = $request->nama_petugas;
      $petugas->jenis_kelamin = $request->jenis_kelamin;
      $petugas->alamat_petugas = $request->alamat_petugas;
      $petugas->tanggal_lahir = date('Y-m-d', strtotime($request->tanggal_lahir));
      $petugas->telefone = $request->telefone;
      $petugas->id_level = $request->id_level;
      // UPLOAD PHOTO PROFILE
      if($request->hasFile('image')) {
        $image = $request->file('image');
        $filename = time() . '.' . $image->getClientOriginalExtension();
        $request->file('image')->move(public_path('uploads/images/avatars'), $filename);
        $petugas->image = $filename;
      };
      $petugas->save();

      session()->flash('status', 'success');
      session()->flash('message', 'Petugas berhasil diperbarui.');
      return redirect()->route('petugas.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      Petugas::destroy($id);
      return response()->json(['success' => true]);
    }
}
