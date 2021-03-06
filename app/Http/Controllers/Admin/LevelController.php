<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Level;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $data['level'] = Level::all();
      return view('layouts.admin.level.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('layouts.admin.level.create');
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
        'nama_level' => 'alpha_spaces|required|unique:levels,nama_level'
      ], [
        'nama_level.required' => 'Nama level harus diisi',
        'nama_level.unique' => 'Nama level sudah digunakan',
        'nama_level.alpha_spaces' => 'Nama level harus berupa huruf dan tanpa tanda baca'
      ]);
        $level = new Level;
        $level->nama_level = $request->nama_level;
        $level->save();

        session()->flash('status', 'success');
        session()->flash('message', 'Level berhasil ditambahkan.');
        return redirect()->route('admin.level.index');
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
      $data['level'] = Level::find($id);
      return view('layouts.admin.level.edit')->with($data);
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
        'nama_level' => 'alpha_spaces|required|unique:levels,nama_level,'.$id.',id_level'
      ], [
        'nama_level.required' => 'Nama level harus diisi',
        'nama_level.unique' => 'Nama level sudah digunakan',
        'nama_level.alpha_spaces' => 'Nama level harus berupa huruf tanpa tanda baca'
      ]);

      $level = Level::find($id);
      $level->nama_level = $request->nama_level;
      $level->save();

      session()->flash('status', 'success');
      session()->flash('message', 'Level berhasil diperbarui.');
      return redirect()->route('admin.level.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Level::destroy($id);
        return response()->json(['success' => true]);
    }
}
