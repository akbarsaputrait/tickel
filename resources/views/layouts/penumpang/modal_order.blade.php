<div class="modal fade" role="dialog" id="modalOrder" aria-hidden="true">
  <div class="modal-dialog w-1200" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 clas="modal-title">Kode Pemesanan</h5>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" action="#" method="post" enctype="multipart/form-data">
          <fieldset disabled>
            <div class="row">
              <div class="col-md-12">
                @if(session()->has('message'))
                <div class="alert alert-{{ session()->get('status') }} alert-dissmissible fade show mb-4">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
                  <i class="ti-{{ session()->get('status') == 'success' ? 'check' : 'close' }}">
												</i> {{ session()->get('message') }}
                </div>
                @endif
                <div class="card features p-4 text-left text-dark">
                  <h5 class="card-description">
									Informasi Rute
								</h5>
                  <input type="hidden" name="id_rutes" id="id_rute" value="">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Rute Awal</label>
                        <select class="form-control {{ ($errors->has('rute_awal')) ? 'is-invalid' : '' }}" name="rute_awal">
                          <option value="">Pilih kota asal</option>
                        </select>
                        <div class="invalid-feedback">
                          {{ $errors->first('rute_awal') }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Rute Akhir</label>
                        <select class="form-control {{ ($errors->has('rute_akhir')) ? 'is-invalid' : '' }}" name="rute_akhir">
                          <option value="">Pilih kota tujuan</option>
                        </select>
                        <div class="invalid-feedback">
                          {{ $errors->first('rute_akhir') }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-5">
                          <div class="form-group">
                            <label for="">Tujuan</label>
                            <input type="text" class="form-control {{ ($errors->has('tujuan')) ? 'is-invalid' : '' }}" name="tujuan" value="{{ old('tujuan') }}" {{ (old( 'tujuan')) ? '' : '' }} placeholder="Tujuan">
                            <div class="invalid-feedback">
                              {{ $errors->first('tujuan') }}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-7">
                          <div class="form-group">
                            <label for="">Tanggal Berangkat</label>
                            <input type="date" class="form-control {{ ($errors->has('tanggal_berangkat')) ? 'is-invalid' : '' }}" name="tanggal_berangkat" value="{{ old('tanggal_berangkat') }}" {{ (old( 'tanggal_berangkat')) ? '' : '' }}>
                            <div class="invalid-feedback">
                              {{ $errors->first('tanggal_berangkat') }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Transportasi</label>
                        <select class="form-control {{ ($errors->has('transportasi')) ? 'is-invalid' : '' }}" name="transportasi" {{ (old( 'transportasi')) ? '' : 'disabled' }}>
                          <option value="">Jenis Transportasi</option>
                        </select>
                        <div class="invalid-feedback">
                          {{ $errors->first('transportasi') }}
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Kelas</label>
                            <select class="form-control {{ ($errors->has('kelas')) ? 'is-invalid' : '' }}" name="kelas" {{ (old( 'kelas')) ? '' : 'disabled' }}>
                              <option value="">Kelas</option>
                            </select>
                            <div class="invalid-feedback">
                              {{ $errors->first('kelas') }}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Jam Berangkat</label>
                            <input type="time" class="form-control {{ ($errors->has('jam_berangkat')) ? 'is-invalid' : '' }}" name="jam_berangkat" value="{{ old('jam_berangkat') }}" placeholder="Jam keberangkatan" {{ (old( 'jam_berangkat')) ? '' : 'disabled' }}>
                            <div class="invalid-feedback">
                              {{ $errors->first('jam_berangkat') }}
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Tempat Pemesanan</label>
                            <input type="text" class="form-control" name="tempat_pemesanan" value="{{ old('tempat_pemesanan') }}" {{ (old( 'tempat_pemesanan')) ? '' : 'disabled' }}>
                            <div class="invalid-feedback">
                              {{ $errors->first('tempat_pemesanan') }}
                            </div>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="">Total Harga</label>
                            <input type="text" class="form-control" name="harga" value="{{ old('harga') }}" disabled>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="row my-4">
              <div class="col-md-12">
                <div class="card users p-4 text-left text-dark">
                  <h5 class="card-description">
									Informasi Penumpang
								</h5>
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Nama Lengkap</label>
                        <input type="text" class="form-control" name="nama_penumpang" placeholder="Nama lengkap" value="{{ (auth()->guard('penumpang')->check()) ? auth()->guard('penumpang')->user()->nama_penumpang : old('nama_penumpang') }}">
                      </div>
                      <div class="form-group">
                        <label for="">Nomor Identitas (KTP/SIM)</label>
                        <input type="number" class="form-control" name="no_identitas" placeholder="Nomor identitas" value="{{ (auth()->guard('penumpang')->check()) ? auth()->guard('penumpang')->user()->no_identitas : old('no_identitas') }}">
                      </div>
                      <div class="form-group">
                        <label for="">Nomor Telepon</label>
                        <input type="tel" class="form-control" name="telefone" placeholder="Nomor telepon" value="{{ (auth()->guard('penumpang')->check()) ? auth()->guard('penumpang')->user()->telefone : old('telefone') }}">
                      </div>
                    </div>
                    <div class="col-md-4">
                      <div class="form-group">
                        <label for="">Alamat Email</label>
                        <input type="email" class="form-control" name="email" placeholder="Alamaat email" value="{{ (auth()->guard('penumpang')->check()) ? auth()->guard('penumpang')->user()->email : old('email') }}">
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
                </div>
              </div>
            </div>
          </fieldset>

          <div class="row">
            <div class="col-md-12">
              <div class="card features p-4 text-left text-dark">
                <h5 class="card-description">Konfirmasi Pembayaran</h5>
                <div class="row">
                  <div class="col-md-8">
                    <p class="alert alert-warning">Silahkan transfer sesuai dengan nominal di bawah ini dan pastikan nomor rekening yang dituju tidak salah. Lalu unggah bukti pembayaran.</p>
                    <div class="row text-center">
                      <div class="col-md-6 d-flex align-items-center justify-content-center">
                        <div class="">
                          <p class="text-muted">Total Pembayaran</p>
                          <h5 class="display-5" id="totalPembayaran">Rp. 75.000</h5>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <p class="text-muted">Nomor Rekening Tujuan</p>
                        <div class="list-group">
                          <div class="list-group-item">
                            <p class="font-weight-bold">BNI</p>
                            <h5 class="display-5" id="totalPembayaran">07979****</h5>
                            <small class="text-small text-muted">A.N. Akbar Anung Yudha Saputra</small>
                          </div>
                          <div class="list-group-item">
                            <p class="font-weight-bold">BCA</p>
                            <h5 class="display-5" id="totalPembayaran">09494****</h5>
                            <small class="text-small text-muted">A.N. Akbar Anung Yudha Saputra</small>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    @csrf
                    <div class="form-group">
                      <label for="">Unggah file</label>
                      <input type="file" class="form-control" name="" value="">
                    </div>
                    <div class="form-group">
                      <div class="btn-group">
                        <input type="submit" class="btn btn-primary custom wi-25" name="submit" value="Pesan Tiket">
                        <a href="#" class="btn btn-primary-custom">Batal</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</div>
