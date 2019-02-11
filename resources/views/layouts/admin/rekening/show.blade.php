@extends('master_admin') @section('title', $rekening->no_rekening) @section('content')
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Tipe Rute</h4>
        <form class="form-horizontal" action="{{ route('admin.rekening.update', ['rekening' => $rekening->id_rekening]) }}" method="post">
          @csrf
          @method('PUT')
          <h3 class="card-description">
            Informasi Nomor Rekening
          </h3>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Atas Nama</label>
                <input type="text" class="form-control {{ ($errors->has('atas_nama')) ? 'is-invalid' : '' }}" name="atas_nama" value="{{ $rekening->atas_nama }}" placeholder="Atas Nama">
                <div class="invalid-feedback">
                  {{ $errors->first('atas_nama') }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Nama Bank</label>
                <input type="text" class="form-control {{ ($errors->has('nama_bank')) ? 'is-invalid' : '' }}" name="nama_bank" value="{{ $rekening->nama_bank }}" placeholder="Nama Bank">
                <div class="invalid-feedback">
                  {{ $errors->first('nama_bank') }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Nomor Rekening</label>
                <input type="text" class="form-control {{ ($errors->has('no_rekening')) ? 'is-invalid' : '' }}" name="no_rekening" value="{{ $rekening->no_rekening }}" placeholder="Nomor Rekening">
                <div class="invalid-feedback">
                  {{ $errors->first('no_rekening') }}
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success" name="button">
              <i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route('admin.rekening.index') }}" class="btn btn-danger">
              <i class="fa fa-close"></i> Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
