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
    public function store(Request $request)
    {
      $request->validate([
        'username' => 'alpha_spaces|required|min:5|max:20',
        'email' => 'required|email|unique:petugass,email',
        'nama_petugas' => 'alpha_spaces|required|unique:petugass,nama_petugas',
        'jenis_kelamin' => 'alpha_spaces|required',
        'id_level' => 'required',
        'image' => 'file|mimes:jpeg,jpg,png|max:3000|dimensions:min_width=400,min_height=600'
      ], [
        'username.required' => 'Nama pengguna harus diisi',
        'username.min' => 'Nama pengguna harus lebih dari :min karakter',
        'username.max' => 'Nama pengguna harus kurang dari :max karakter',
        'username.alpha_spaces' => 'Nama pengguna harus berupa huruf dan tanpa tanda baca',
        'email.required' => 'Email harus diisi',
        'email.email' => 'Format email salah',
        'email.unique' => 'Email sudah digunakan',
        'nama_petugas.required' => 'Nama petugas harus diisi',
        'nama_petugas.unique' => 'Nama petugas sudah digunakan',
        'nama_petugas.alpha_spaces' => 'Nama petugas harus berupa huruf dan tanpa tanda baca',
        'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
        'jenis_kelamin.alpha_spaces' => 'Jenis kelamin harus berupa huruf dan tanpa tanda baca',
        'id_level.required' => 'Level harus diisi',
        'image.mimes' => 'Gambar harus berupa :mimes',
        'image.max' => 'Gambar harus kurang dari :max kb',
        'image.dimensions' => 'Ukuran gambar harus kurang dari :min_width px dan :min_height px',
        'image.uploaded' => 'Gambar tidak dapat diunggah.',
        'image.file' => 'File tidak berhasil diunggah'
      ]);

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
      return redirect()->route('admin.petugas.index');
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
      $request->validate([
        'username' => 'alpha_spaces|required|min:5|max:20',
        'email' => 'required|email|unique:petugass,email,'.$id.',id_petugas',
        'nama_petugas' => 'alpha_spaces|required|unique:petugass,nama_petugas,'.$id.',id_petugas',
        'jenis_kelamin' => 'alpha_spaces|required',
        'id_level' => 'required',
        'image' => 'file|mimes:jpeg,jpg,png|max:2000|dimensions:min_width=400,min_height=600'
      ], [
        'username.required' => 'Nama pengguna harus diisi',
        'username.min' => 'Nama pengguna harus lebih dari :min karakter',
        'username.max' => 'Nama pengguna harus kurang dari :max karakter',
        'username.alpha_spaces' => 'Nama pengguna harus berupa huruf dan tanpa tanda baca',
        'email.required' => 'Email harus diisi',
        'email.email' => 'Format email salah',
        'email.unique' => 'Email sudah digunakan',
        'email.alpha_spaces' => 'Email harus berupa huruf',
        'nama_petugas.required' => 'Nama petugas harus diisi',
        'nama_petugas.unique' => 'Nama petugas sudah digunakan',
        'nama_petugas.alpha_spaces' => 'Nama petugas harus berupa huruf dan tanpa tanda baca',
        'jenis_kelamin.required' => 'Jenis kelamin harus diisi',
        'jenis_kelamin.alpha_spaces' => 'Jenis kelamin harus berupa huruf dan tanpa tanda baca',
        'id_level.required' => 'Level harus diisi',
        'image.mimes' => 'Gambar harus berupa :mimes',
        'image.max' => 'Gambar harus kurang dari :max kb',
        'image.dimensions' => 'Ukuran gambar harus kurang dari :min_width px dan :min_height px',
        'image.uploaded' => 'Gambar tidak dapat diunggah.',
        'image.file' => 'File tidak berhasil diunggah'
      ]);

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
      return redirect()->route('admin.petugas.index');
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
