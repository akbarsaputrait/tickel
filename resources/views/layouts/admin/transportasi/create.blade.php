@extends('master_admin') @section('title', 'Transportasi') @section('content')
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Tambah Transportasi</h4>
        <form class="form-horizontal" action="{{ route('admin.transportasi.store') }}" method="post">
          @csrf
          <h3 class="card-description">
            Informasi Transportasi
          </h3>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Kode</label>
                <input type="text" class="form-control" name="kode" value="{{ old('kode') }}" placeholder="Kode">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <div class="form-group">
                  <label for="">Nama</label>
                  <input type="text" class="form-control" name="nama_transportasi" value="" placeholder="Nama Transportasi">
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Jumlah Kursi</label>
                <input type="number" class="form-control" name="jumlah_kursi" value="" placeholder="Jumlah Kursi">
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="8" cols="80" placeholder="Keterangan Transportasi"></textarea>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Jenis Transportasi</label>
                <select class="form-control" name="id_type_transportasi">
                  <option value="">-- Jenis Transportasi</option>
                  @foreach($type as $item)
                  <option value="{{ $item->id_type_transportasi }}">{{ $item->nama_type }}</option>
                  @endforeach
                </select>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success" name="button">
              <i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route('admin.transportasi.index') }}" class="btn btn-danger">
              <i class="fa fa-close"></i> Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
