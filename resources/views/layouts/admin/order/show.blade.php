@extends('master_admin') @section('title', 'A3313') @section('content')
<div class="row">
  <div class="col-lg-12 grid-margin">
		<div class="d-flex justify-content-between mb-3">
			<div>
					<span class="badge badge-warning" style="font-size: 15px;">Proses</span>
			</div>
			<div>
				<a href="{{ url('admin/order') }}" class="btn btn-danger mr-2">
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
        <form>
          <fieldset disabled>
            <h3 class="card-description">
	            Informasi Pesanan
	          </h3>
            <div class="row">
              <div class="col-sm-6 col-md-2">
                <div class="form-group">
                  <label for="">Kode Pemesanan</label>
                  <input type="text" name="" value="A3313" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="form-group">
                  <label for="">Tanggal Pemesanan</label>
                  <input type="text" name="" value="21 April 2018" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 col-md-3">
                <div class="form-group">
                  <label for="">Tempat Pemesanan</label>
                  <input type="text" name="" value="Bandara" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-group">
                  <label for="">Total Pembayaran</label>
                  <input type="text" name="" value="Rp. 300,000" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-4">
                <div class="form-group">
                  <label for="">Tujuan</label>
                  <input type="text" name="" value="Jakarta" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-group">
                  <label for="">Tanggal Berangkat</label>
                  <input type="text" name="" value="25 April 2018" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 col-md-2">
                <div class="form-group">
                  <label for="">Jam Check In</label>
                  <input type="text" name="" value="21:00 WIB" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 col-md-2">
                <div class="form-group">
                  <label for="">Jam Berangkat</label>
                  <input type="text" name="" value="22:00 WIB" class="form-control">
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
                  <input type="text" name="" value="akbarsaputra" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-group">
                  <label for="">Email</label>
                  <input type="text" name="" value="akbarsaputrait@outlook.com" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-group">
                  <label for="">Nama Lengkap</label>
                  <input type="text" name="" value="Akbar Anung Yudha Saputra" class="form-control">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-sm-6 col-md-4">
                <div class="form-group">
                  <label for="">Alamat</label>
                  <textarea name="" class="form-control" rows="8" cols="80">Malang, Jawa Timur</textarea>
                </div>
              </div>
              <div class="col-sm-6 col-md-2">
                <div class="form-group">
                  <label for="">Tanggal Lahir</label>
                  <input type="text" name="" value="26 Desember 2000" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 col-md-2">
                <div class="form-group">
                  <label for="">Jenis Kelamin</label>
                  <input type="text" name="" value="Laki - laki" class="form-control">
                </div>
              </div>
              <div class="col-sm-6 col-md-4">
                <div class="form-group">
                  <label for="">Nomor Telepon</label>
                  <input type="text" name="" value="081931006841" class="form-control">
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
                  <input type="text" class="form-control" name="" value="Jakarta">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <div class="form-group">
                    <label for="">Rute Awal</label>
                    <input type="text" class="form-control" name="" value="Surabaya">
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Rute Akhir</label>
                  <input type="text" class="form-control" name="" value="Jakarta">
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Harga</label>
                  <input type="text" class="form-control" name="" value="Rp. 300,000">
                </div>
              </div>
              <div class="col-md-4">
                <div class="form-group">
                  <label for="">Jenis Transportasi</label>
                  <input type="text" class="form-control" name="" value="Garuda Indonesia">
                </div>
              </div>
            </div>

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
