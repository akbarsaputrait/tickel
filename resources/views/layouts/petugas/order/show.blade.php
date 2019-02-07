@extends('master_petugas') @section('title', $pemesanan->kode_pemesanan) @section('content')
<div class="row">
  <div class="col-lg-12 grid-margin">
		<div class="d-flex justify-content-between mb-3">
			<div>
					<span class="badge badge-warning" style="font-size: 15px;">{{ ucfirst($pemesanan->status) }}</span>
			</div>
			<div>
				<a href="{{ route('petugas.order.index') }}" class="btn btn-danger mr-2">
					<i class="fa fa-arrow-left"></i> Kembali
				</a>
				<a href="#" class="btn btn-primary">
					<i class="fa fa-download"></i> Ekspor
				</a>
			</div>
		</div>
    <div class="card">
      <div class="card-body">
        <!-- <h4 class="card-title">A3313</h4> -->
        <form class="form-horizontal" action="{{ route('admin.order.update', ['order' => $pemesanan->kode_pemesanan]) }}">
          <fieldset disabled>
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
            @if(is_null($pembayaran->file))
            <div class="alert alert-warning">
            <span class="fa fa-warning"></span> Bukti Pembayaran tidak ditemukan.
            </div>
            @endif

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
                  <input type="text" class="form-control" name="" value="">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Jenis Kelamin</label>
                  <input type="text" class="form-control" name="" value="Laki-laki">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Nomor Telepon</label>
                  <input type="text" class="form-control" name="" value="085852448548">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Alamat</label>
                  <textarea name="" class="form-control" rows="8" cols="80">Surabaya, Jawa Timur</textarea>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Tanggal Lahir</label>
                  <input type="text" class="form-control" name="" value="26 Desember 1995">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Foto Profil</label>
                  <img src="" alt="">
                </div>
              </div>
            </div>
            @endif
          </fieldset>
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="">Status</label>
								<select class="form-control" name="">
									<option value="">-- Pilih Status</option>
									<option value="">Diterima</option>
									<option value="">Tidak Diterima</option>
								</select>
							</div>
					</div>
				</div>
					<div class="form-group">
						<button type="submit" class="btn btn-success" name="button">
							<i class="fa fa-check"></i> Verifikasi</button>
						</div>
        </form>
      </div>
    </div>
  </div>
</div>
@endsection
