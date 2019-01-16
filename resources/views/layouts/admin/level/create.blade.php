@extends('master_admin') @section('title', 'Level') @section('content')
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tambah Transportasi</h4>
        <form class="form-horizontal" action="{{ url('admin/level') }}" method="post">
          @csrf
          <h3 class="card-description">
            Informasi Level
          </h3>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control" name="nama_level" value="" placeholder="Nama Level">
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success" name="button">
              <i class="fa fa-save"></i> Simpan</button>
            <a href="{{ url('admin/level') }}" class="btn btn-danger">
              <i class="fa fa-close"></i> Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
