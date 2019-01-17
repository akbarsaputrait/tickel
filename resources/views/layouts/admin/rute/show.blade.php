@extends('master_admin') @section('title', $rute->tujuan) @section('content')
<div class="row">
  <div class="col-12 grid-margin">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Edit Rute</h4>
        <form class="form-horizontal" action="{{ route('rute.update', ['rute' => $rute->id_rute]) }}" method="post">
          @csrf
          @method('PUT')
          <h3 class="card-description">
            Informasi Rute
          </h3>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Tujuan</label>
                <input type="text" class="form-control {{ ($errors->has('tujuan')) ? 'is-invalid' : '' }}" name="tujuan" value="{{ $rute->tujuan }}" placeholder="Tujuan">
                <div class="invalid-feedback">
                  {{ $errors->first('tujuan') }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <div class="form-group">
                  <label for="">Rute Awal</label>
                  <input type="text" class="form-control {{ ($errors->has('rute_awal')) ? 'is-invalid' : '' }}" name="rute_awal" value="{{ $rute->rute_awal }}" placeholder="Rute Awal">
                  <div class="invalid-feedback">
                    {{ $errors->first('rute_awal') }}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Rute Akhir</label>
                <input type="text" class="form-control {{ ($errors->has('rute_akhir')) ? 'is-invalid' : '' }}" name="rute_akhir" value="{{ $rute->rute_akhir }}" placeholder="Rute Akhir">
                <div class="invalid-feedback">
                  {{ $errors->first('rute_akhir') }}
                </div>
              </div>
            </div>
          </div>
          <div class="form-row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Harga</label>
                <div class="input-group mb-3">
                  <div class="input-group-prepend">
                    <span class="input-group-text">Rp.</span>
                  </div>
                  <input type="text" class="form-control {{ ($errors->has('harga')) ? 'is-invalid' : '' }}" name="harga" value="{{ $rute->harga }}" id="hargaRute" placeholder="Harga">
                </div>
                <div class="invalid-feedback">
                  {{ $errors->first('harga') }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Jenis Transportasi</label>
                <select class="form-control {{ ($errors->has('id_transportasi')) ? 'is-invalid' : '' }}" name="id_transportasi">
                  <option value="">-- Jenis Transportasi</option>
                  @foreach($transportasi as $item)
                  <option value="{{ $item->id_transportasi }}" {{ ($rute->id_transportasi == $item->id_transportasi) ? 'selected' : '' }}>{{ $item->nama_transportasi }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback">
                  {{ $errors->first('id_transportasi') }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Tipe Rute</label>
                <select class="form-control {{ ($errors->has('id_type_rute')) ? 'is-invalid' : '' }}" name="id_type_rute">
                  <option value="">-- Tipe Rute</option>
                  @foreach($type as $item)
                  <option value="{{ $item->id_type_rute }}" {{ ($rute->id_type_rute == $item->id_type_rute) ? 'selected' : '' }}>{{ $item->nama_type }}</option>
                  @endforeach
                </select>
                <div class="invalid-feedback">
                  {{ $errors->first('id_type_rute') }}
                </div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-success" name="button">
              <i class="fa fa-save"></i> Simpan</button>
            <a href="{{ route('rute.index') }}" class="btn btn-danger">
              <i class="fa fa-close"></i> Batal</a>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
