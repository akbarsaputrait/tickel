@extends('master_home') @section('content')
<header class="text-dark" id="home">
  <div class="container mt-5">
    <div class="my-5">
      <h1>Pesan tiket sekarang!</h1>
      <p>Lengkapi data pribadi anda untuk melanjutkan pemesanan.</p>
    </div>
    <form class="form-horizontal" action="{{ route('pesan.store') }}" method="post" id="pesanTiket">
      <div class="row">
        <div class="col-md-12">
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('status') }} alert-dissmissible fade show mb-4">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <i class="fa fa-{{ session()->get('status') == 'success' ? 'check' : 'close' }}">
                  </i> {{ session()->get('message') }}
          </div>
          @endif
          <div class="card features p-4">
            <h5 class="card-description">
            Informasi Rute
          </h5> @csrf
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Kota Asal</label>
                  <select class="form-control {{ ($errors->has('rute_awal')) ? 'is-invalid' : '' }}" name="rute_awal">
                    <option value="">Pilih kota asal</option>
                    @foreach($rute_awal as $item)
                    <option value="{{ $item->rute_awal }}" {{ ($item->rute_awal == old('rute_awal')) ? 'selected' : '' }}>{{ $item->rute_awal }}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    {{ $errors->first('rute_awal') }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Kota Tujuan</label>
                  <select class="form-control {{ ($errors->has('rute_akhir')) ? 'is-invalid' : '' }}" name="rute_akhir">
                    <option value="">Pilih kota tujuan</option>
                    @foreach($rute_akhir as $item)
                    <option value="{{ $item->rute_akhir }}" {{ ($item->rute_akhir == old('rute_akhir')) ? 'selected' : '' }}>{{ $item->rute_akhir }}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    {{ $errors->first('rute_akhir') }}
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Transportasi</label>
                  <select class="form-control {{ ($errors->has('transportasi')) ? 'is-invalid' : '' }}" name="transportasi" {{ (old('transportasi')) ? '' : 'disabled' }}>
                    <option value="">Jenis Transportasi</option>
                    @foreach($transportasi as $item)
                    <option value="{{ $item->nama_transportasi }}" {{ ($item->nama_transportasi == old('transportasi')) ? 'selected' : '' }}>{{ $item->nama_transportasi }}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    {{ $errors->first('transportasi') }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Kelas</label>
                  <select class="form-control {{ ($errors->has('kelas')) ? 'is-invalid' : '' }}" name="kelas"  {{ (old('kelas')) ? '' : 'disabled' }}>
                    <option value="">Kelas Transportasi</option>
                    @foreach($type_rute as $item)
                    <option value="{{ $item->nama_type }}" {{ ($item->nama_type == old('kelas')) ? 'selected' : '' }}>{{ $item->nama_type }}</option>
                    @endforeach
                  </select>
                  <div class="invalid-feedback">
                    {{ $errors->first('kelas') }}
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Tanggal Berangkat</label>
                  <input type="date" class="form-control {{ ($errors->has('tanggal_berangkat')) ? 'is-invalid' : '' }}" name="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}"  {{ (old('tanggal_berangkat')) ? '' : 'disabled' }}>
                  <div class="invalid-feedback">
                    {{ $errors->first('tanggal_berangkat') }}
                  </div>
                </div>
                <div class="form-group">
                  <label for="">Jam Berangkat</label>
                  <input type="time" class="form-control {{ ($errors->has('jam_berangkat')) ? 'is-invalid' : '' }}" name="jam_berangkat" value="{{ old('jam_berangkat') }}" placeholder="Jam keberangkatan"  {{ (old('jam_berangkat')) ? '' : 'disabled' }}>
                  <div class="invalid-feedback">
                    {{ $errors->first('jam_berangkat') }}
                  </div>
                </div>
              </div>
            </div>
            <div class="row justify-content-end">
              <div class="col-md-2">
                <div class="btn-group w-100">
                  <input type="button" id="cariTiket" class="mt-4 btn btn-primary custom" name="submit" value="Cari Tiket">
                  <button type="button" id="clearButton" class="btn btn-primary custom d-none" name="button">Batal</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row my-4">
        <div class="col-md-12">
          <div class="card users p-4">
            <h5 class="card-description">
            Informasi Penumpang
          </h5>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" class="form-control" name="nama_penumpang" placeholder="Nama lengkap"
                    value="{{ (auth()->guard('penumpang')->check()) ? auth()->guard('penumpang')->user()->nama_penumpang : old('nama_penumpang') }}">
                  </div>
                  <div class="form-group">
                    <label for="">Nomor Identitas (KTP/SIM)</label>
                    <input type="number" class="form-control" name="no_identitas" placeholder="Nomor identitas"
                    value="{{ (auth()->guard('penumpang')->check()) ? auth()->guard('penumpang')->user()->no_identitas : old('no_identitas') }}">
                  </div>
                  <div class="form-group">
                    <label for="">Nomor Telepon</label>
                    <input type="tel" class="form-control" name="telefone" placeholder="Nomor telepon"
                    value="{{ (auth()->guard('penumpang')->check()) ? auth()->guard('penumpang')->user()->telefone : old('telefone') }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Alamat Email</label>
                    <input type="email" class="form-control" name="email" placeholder="Alamaat email"
                    value="{{ (auth()->guard('penumpang')->check()) ? auth()->guard('penumpang')->user()->email : old('email') }}">
                  </div>
                  <div class="form-group">
                    <label for="">Tanggal Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" value="{{ (auth()->guard('penumpang')->check()) ? auth()->guard('penumpang')->user()->tanggal_lahir : old('tanggal_lahir') }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Alamat Lengkap</label>
                    <textarea name="alamat_penumpang" class="form-control" rows="8" cols="80" placeholder="Alamat lengkap">{{ (auth()->guard('penumpang')->check()) ? auth()->guard('penumpang')->user()->alamat_penumpang : old('alamat_penumpang') }}</textarea>
                  </div>
                </div>
              </div>
              <div class="row justify-content-end">
                <div class="col-md-2">
                  <button type="submit" class="btn btn-primary-custom w-100" name="button">Pesan</button>
                </div>
              </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</header>
@include('layouts.modal_tiket')
@endsection
