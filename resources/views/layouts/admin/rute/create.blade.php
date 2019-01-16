@extends('master_admin') @section('title', 'Rute') @section('content')
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tambah Rute</h4>
        <form class="form-horizontal" action="{{ url('admin/rute') }}" method="post">
          @csrf
          <h3 class="card-description">
            Informasi Rute
          </h3>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Tujuan</label>
                <input type="text" class="form-control" name="" value="" placeholder="Tujuan">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <div class="form-group">
                  <label for="">Rute Awal</label>
                  <input type="text" class="form-control" name="" value="" placeholder="Rute Awal">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Rute Akhir</label>
                <input type="text" class="form-control" name="" value="" placeholder="Rute Akhir">
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Harga</label>
                <input type="text" class="form-control" name="" value="" placeholder="Harga">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Jenis Transportasi</label>
                <select class="form-control" name="">
                  <option value="">-- Jenis Transportasi</option>
                  <option value="">Garuda Indonesia A</option>
                  <option value="">Kereta</option>
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success" name="button">
              <i class="fa fa-save"></i> Simpan</button>
            <a href="{{ url('admin/rute') }}" class="btn btn-danger">
              <i class="fa fa-close"></i> Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
