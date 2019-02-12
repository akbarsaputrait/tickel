@extends('master_admin') @section('title', 'Petugas') @section('content')
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tambah Petugas</h4>
        <form class="form-horizontal" action="{{ route('admin.petugas.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <h3 class="card-description">
            Informasi Pribadi
          </h3>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Nama Lengkap</label>
                <input type="text" class="form-control {{ ($errors->has('nama_petugas')) ? 'is-invalid' : '' }}" name="nama_petugas" value="" placeholder="Nama Lengkap">
                <div class="invalid-feedback">{{ $errors->first('nama_petugas') }}</div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <select class="form-control {{ ($errors->has('jenis_kelamin')) ? 'is-invalid' : '' }}" name="jenis_kelamin">
                  <option value="">-- Jenis Kelamin</option>
                  <option value="L">Laki-laki</option>
                  <option value="P">Perempuan</option>
                </select>
                <div class="invalid-feedback">
                  {{ $errors->first('jenis_kelamin') }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Nomor Telepon</label>
                <input type="number" class="form-control" name="telefone" value="" placeholder="Nomor Telepon">
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat_petugas" class="form-control" rows="8" cols="80"></textarea>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <!-- <input type="date" class="form-control" name="tanggal_lahir" value=""> -->
                <input type="text" class="form-control datepicker" name="tanggal_lahir" value="" placeholder="Tanggal lahir">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Foto Profil</label>
                <input type="file" class="form-control {{ ($errors->has('image')) ? 'is-invalid' : '' }}" name="image" value="">
                <div class="invalid-feedback">
                  {{ $errors->first('image') }}
                </div>
              </div>
            </div>
          </div>

          <h3 class="card-description">
          Informasi Akun
        </h3>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Nama Pengguna</label>
                <input type="text" class="form-control {{ ($errors->has('username')) ? 'is-invalid' : '' }}" name="username" value="" placeholder="Nama Pengguna">
                <div class="invalid-feedback">
                  {{ $errors->first('username') }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Alamat Email</label>
                <input type="temail" class="form-control {{ ($errors->has('email')) ? 'is-invalid' : '' }}" name="email" value="" placeholder="Alamat Email">
                <div class="invalid-feedback">
                  {{ $errors->first('email') }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Kata Sandi</label>
                <input type="password" class="form-control {{ ($errors->has('password')) ? 'is-invalid' : '' }}" name="password" value="" placeholder="Kata Sandi">
                <div class="invalid-feedback">
                  {{ $errors->first('password') }}
                </div>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Level</label>
                <select class="form-control {{ ($errors->has('id_level')) ? 'is-invalid' : '' }}" name="id_level">
                  <option value="">-- Pilih Level</option>
                  @foreach($level as $item)
                  <option value="{{ $item->id_level }}">{{ $item->nama_level }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback">
                  {{ $errors->first('id_level') }}
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success" name="button">
              <i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route('admin.petugas.index') }}" class="btn btn-danger">
              <i class="fa fa-close"></i> Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
