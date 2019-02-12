@extends('master_petugas') @section('title', '#'.$pemesanan->kode_pemesanan) @section('content')
<div class="row">
  <div class="col-lg-12 grid-margin">
    <div class="d-flex justify-content-end mb-3">
      <div>
        <a href="{{ route('petugas.order.index') }}" class="btn btn-danger mr-2">
          <i class="fa fa-arrow-left"></i> Kembali
        </a>
        <a href="#" class="btn btn-primary" id="printThis">
          <i class="fa fa-print"></i> Print
        </a>
        <a href="{{ route('petugas.export.pdf', ['kode_pemesanan' => $pemesanan->kode_pemesanan]) }}" class="btn btn-success">
          <i class="fa fa-download"></i> Unduh
        </a>
      </div>
    </div>
    <div class="card">
      <div class="card-body">
        <form class="form-horizontal" method="post" action="{{ route('petugas.order.update', ['order' => $pemesanan->kode_pemesanan]) }}">
          @csrf
          @method('PUT')
          <fieldset disabled>
            <div class="printIt">
              <div class="mb-4">
                @switch($pemesanan->status)
                    @case("done")
                        <span class="badge badge-success" style="font-size: 15px;">{{ ucfirst($pemesanan->status) }}</span>
                      @break

                    @case("process")
                        <span class="badge badge-primary" style="font-size: 15px;">{{ ucfirst($pemesanan->status) }}</span>
                      @break

                    @case("pending")
                      <span class="badge badge-warning" style="font-size: 15px;">{{ ucfirst($pemesanan->status) }}</span>
                      @break

                    @case("cancel")
                      <span class="badge badge-danger" style="font-size: 15px;">{{ ucfirst($pemesanan->status) }}</span>
                      @break
                    @default
                    <span class="badge badge-dark" style="font-size: 15px;">{{ ucfirst($pemesanan->status) }}</span>
                @endswitch
              </div>
              <h3 class="card-description">
	            Informasi Pesanan
	          </h3>
              <div class="row">
                <div class="col-sm-6 col-md-2">
                  <div class="form-group">
                    <label for="">Kode Pemesanan</label>
                    <input type="text" name="" value="{{ $pemesanan->kode_pemesanan }}" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                    <label for="">Tanggal Pemesanan</label>
                    <input type="text" name="" value="{{ date('d F Y', strtotime($pemesanan->tanggal_pemesanan)) }}" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 col-md-3">
                  <div class="form-group">
                    <label for="">Tempat Pemesanan</label>
                    <input type="text" name="" value="{{ $pemesanan->tempat_pemesanan }}" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label for="">Total Pembayaran</label>
                    <input type="text" name="" value="Rp. {{ $pemesanan->total_bayar }}" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label for="">Tujuan</label>
                    <input type="text" name="" value="{{ $pemesanan->tujuan }}" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label for="">Tanggal Berangkat</label>
                    <input type="text" name="" value="{{ date('d F Y', strtotime($pemesanan->tanggal_berangkat)) }}" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 col-md-2">
                  <div class="form-group">
                    <label for="">Jam Check In</label>
                    <input type="text" name="" value="{{ date('H:i A', strtotime($pemesanan->jam_cekin)) }}" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 col-md-2">
                  <div class="form-group">
                    <label for="">Jam Berangkat</label>
                    <input type="text" name="" value="{{ date('H:i A', strtotime($pemesanan->jam_berangkat)) }}" class="form-control">
                  </div>
                </div>
              </div>

              <h3 class="card-description">
	            Informasi Pelanggan
	          </h3>
              <div class="row">
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label for="">Username</label>
                    <input type="text" name="" value="{{ $penumpang->username }}" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="text" name="" value="{{ $penumpang->email }}" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label for="">Nama Lengkap</label>
                    <input type="text" name="" value="{{ $penumpang->nama_penumpang }}" class="form-control">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label for="">Alamat</label>
                    <textarea name="" class="form-control" rows="8" cols="80">{{ $penumpang->alamat_penumpang }}</textarea>
                  </div>
                </div>
                <div class="col-sm-6 col-md-2">
                  <div class="form-group">
                    <label for="">Tanggal Lahir</label>
                    <input type="text" name="" value="{{ date('d F Y', strtotime($penumpang->tanggal_lahir)) }}" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 col-md-2">
                  <div class="form-group">
                    <label for="">Jenis Kelamin</label>
                    <input type="text" name="" value="{{ $penumpang->jenis_kelamin == 'L' ? 'Laki - laki' : 'Perempuan' }}" class="form-control">
                  </div>
                </div>
                <div class="col-sm-6 col-md-4">
                  <div class="form-group">
                    <label for="">Nomor Telepon</label>
                    <input type="text" name="" value="{{ $penumpang->telefone }}" class="form-control">
                  </div>
                </div>
              </div>


              <h3 class="card-description">
	            Informasi Rute
	          </h3>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Tujuan</label>
                    <input type="text" class="form-control" name="" value="{{ $rute->tujuan }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <div class="form-group">
                      <label for="">Rute Awal</label>
                      <input type="text" class="form-control" name="" value="{{ $rute->rute_awal }}">
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Rute Akhir</label>
                    <input type="text" class="form-control" name="" value="{{ $rute->rute_akhir }}">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Harga</label>
                    <input type="text" class="form-control" name="" value="Rp. {{ $rute->harga }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Nama Transportasi</label>
                    <input type="text" class="form-control" name="" value="{{ $rute->transportasi->nama_transportasi }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Kelas</label>
                    <input type="text" class="form-control" name="" value="{{ $rute->type->nama_type }}">
                  </div>
                </div>
              </div>
            </div>
          </fieldset>
          @if($pemesanan->status != "cancel") @if(is_null($pembayaran->file))
          <div class="alert alert-warning">
            <span class="fa fa-warning"></span> Bukti Pembayaran tidak ditemukan.
          </div>
          @else
          <div class="d-flex justify-content-center align-items-center my-3">
            <div class="">
              <h5 class="display-5">Bukti Pembayaran</h5>
              <a href="{{ asset('uploads/images/bukti-pembayaran/'.$pembayaran->file) }}" target="_blank">
                <img src="{{ asset('uploads/images/bukti-pembayaran/'.$pembayaran->file) }}" width="300" class="img-fluid" alt="">
              </a>
            </div>
          </div>
          @endif
          @if(is_null($pemesanan->admin))
          <!-- BERARTI PETUGAS YANG VERIFIKASI -->
          @if(is_null($petugas))
          <div class="alert alert-warning">
            <span class="fa fa-warning"></span> Tiket belum diverifikasi oleh Petugas.
          </div>
          @else
          <h3 class="card-description">
            Informasi Petugas
          </h3>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Nama Lengkap</label>
                <input type="text" class="form-control" name="" value="{{ $petugas->nama_petugas }}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Jenis Kelamin</label>
                <input type="text" class="form-control" name="" value="{{ $petugas->jenis_kelamin }}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Nomor Telepon</label>
                <input type="text" class="form-control" name="" value="{{ $petugas->telefone }}">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="" class="form-control" rows="8" cols="80">{{ $petugas->alamat_petugas }}</textarea>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Tanggal Lahir</label>
                <input type="text" class="form-control" name="" value="{{ date('d F Y', strtotime($petugas->tanggal_lahir)) }}">
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Foto Profil</label>
                <br>
                @if(is_null($petugas->image))
                <img class="img-lg rounded-circle" src="{{ asset('admin/images/faces/face1.jpg') }}" alt="Profile image">
        				@else
        				<img class="img-lg rounded-circle" src="{{ asset('uploads/images/avatars/'.$petugas->image ) }}" alt="Profile image">
        				@endif
              </div>
            </div>
          </div>
          @endif
          @else
          <div class="alert alert-success">
            <span class="mdi mdi-check"></span> Pesanan telah diverifikasi oleh {{ $pemesanan->admin->name }}.
          </div>
          @endif
          <h3 class="card-description">
            Verifikasi Pesanan
          </h3>
          <div class="row">
            <div class="col-md-3">
              <div class="form-group">
                <label for="">Status</label>
                <select class="form-control {{ $errors->has('status') ? 'is-invalid' : ''  }}" name="status">
                  <option value="">-- Pilih Status</option>
                  <option value="done" {{ ($pemesanan->status == "done") ? 'selected' : '' }}>Diterima</option>
                  <option value="canceled" {{ ($pemesanan->status == "cancel") ? 'selected' : '' }}>Tidak Diterima</option>
                </select>
                <div class="invalid-feedback">
                  {{ $errors->first('status') }}
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="form-group">
                <label for="">Keterangan</label>
                <textarea name="keterangan" class="form-control" rows="8" cols="80">{{ $pemesanan->keterangan }}</textarea>
              </div>
            </div>
          </div>
          @if($pemesanan->status != "done" || $pemesanan->status == "cancel")
          <div class="form-group">
            <button type="submit" class="btn btn-success" name="button">
              <i class="fa fa-check"></i> Verifikasi</button>
          </div>
          @endif
          @else
          <div class="alert alert-danger">
            <span class="fa fa-close"></span> Pesanan dibatalkan oleh pembeli.
          </div>
          @endif
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
