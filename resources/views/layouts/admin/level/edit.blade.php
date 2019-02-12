@extends('master_admin') @section('title', 'Level') @section('content')
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tambah Transportasi</h4>
        <form class="form-horizontal" action="{{ route('admin.level.update', ['level' => $level->id_level]) }}" method="post">
          @csrf
					@method('PUT')
          <h3 class="card-description">
            Informasi Level
          </h3>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control {{ $errors->has('nama_level') ? 'is-invalid' : '' }}" name="nama_level" value="{{ $level->nama_level }}" placeholder="Nama Level">
                <div class="invalid-feedback">
                  {{ $errors->first('nama_level') }}
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success" name="button">
              <i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route('admin.level.index') }}" class="btn btn-danger">
              <i class="fa fa-close"></i> Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
