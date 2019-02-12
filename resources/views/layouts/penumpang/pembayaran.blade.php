@extends('master_home') @section('content')
<header class="text-dark pb-4" id="home">
  <div class="container mt-5">
    <div class="my-5">
      <h1>#{{ $pemesanan->kode_pemesanan }}</h1>
      <h4 class="text-white display-5">Kode Kursi : <span class="badge badge-dark">{{ $pemesanan->kode_kursi }}</span></h4>
      <p class="text-white">Tanggal Pemesanan : {{ date('d F Y', strtotime($pemesanan->tanggal_pemesanan)) }}</p>
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
      @if($pemesanan->status == "done")
      <div class="alert alert-success">
        <span class="ti ti-check"></span> Pesanan anda telah diverifikasi! Silahkan cek email anda.
      </div>
      @endif
    </div>
    <form class="form-horizontal" action="{{ route('pembayaran.update',['id_pemesanan' => $pemesanan->kode_pemesanan]) }}" method="post" enctype="multipart/form-data">
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
                    <select class="form-control" name="rute_awal" disabled>
                      <option value="">{{ $rute[0]->rute_awal }}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Rute Akhir</label>
                    <select class="form-control" name="rute_akhir" disabled>
                      <option value="">{{ $rute[0]->rute_akhir }}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="form-group">
                        <label for="">Tujuan</label>
                        <input type="text" class="form-control {{ ($errors->has('tujuan')) ? 'is-invalid' : '' }}" name="tujuan" value="{{ $rute[0]->tujuan }}" placeholder="Tujuan" disabled>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="form-group">
                        <label for="">Tanggal Berangkat</label>
                        <input type="date" class="form-control {{ ($errors->has('tanggal_berangkat')) ? 'is-invalid' : '' }}" name="tanggal_berangkat" value="{{ $pemesanan->tanggal_berangkat }}" disabled>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Transportasi</label>
                    <select class="form-control" name="transportasi" disabled>
                      <option value="">{{ $rute[0]->nama_transportasi }}</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Kelas</label>
                        <select class="form-control" name="kelas" disabled>
                          <option value="">{{ $rute[0]->nama_type }}</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Jam Berangkat</label>
                        <input type="time" class="form-control" name="jam_berangkat" value="{{ $rute[0]->jam_berangkat }}" placeholder="Jam keberangkatan" disabled>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Tempat Pemesanan</label>
                        <input type="text" class="form-control" name="tempat_pemesanan" value="{{ $pemesanan->tempat_pemesanan }}" disabled>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Total Harga</label>
                        <input type="text" class="form-control" name="harga" value="{{ $pemesanan->total_bayar }}" disabled>
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

      @if($pemesanan->status != "done" || $pemesanan->status == "pending")
      <div class="row">
        <div class="col-md-12">
          <div class="card features p-4 text-left text-dark">
            <h5 class="card-description">Konfirmasi Pembayaran</h5>
            <div class="row">
              <div class="col-md-8">
                @if(is_null($pembayaran->file))
                <p class="alert alert-warning">
                  <span class="ti-info"></span> Silahkan transfer sesuai dengan nominal di bawah ini dan pastikan nomor rekening yang dituju tidak salah. Lalu unggah bukti pembayaran.</p>
                @else
                <p class="alert alert-success">
                  <span class="ti-check"></span> Bukti pembayaran telah di unggah. Kami akan segera memverifikasi dan akan segera dikirim ke alamat email anda. Terima kasih.</p>
                @endif
                <div class="row text-center">
                  <div class="col-md-6 d-flex align-items-center justify-content-center">
                    <div class="">
                      <p class="text-muted">Total Pembayaran</p>
                      <h5 class="display-5" id="totalPembayaran">Rp. {{ $pemesanan->total_bayar }}</h5>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <h6 class="text-muted">Nomor Rekening Tujuan</h6>
                    <div class="list-group">
                      @forelse($rekening as $item)
                      <div class="list-group-item">
                        <p class="font-weight-bold">{{ $item->nama_bank }}</p>
                        <h5 class="display-5" id="totalPembayaran">{{ $item->no_rekening }}</h5>
                        <small class="text-small text-muted">A.N. {{ $item->atas_nama }}</small>
                      </div>
                      @empty
                      <div class="alert alert-danger">
                        Alamat rekening belum tersedia.
                      </div>
                      @endforelse
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-md-4">
                @csrf
                @if(is_null($pembayaran->file))
                <div class="form-group">
                  <h6>Unggah bukti pembayaran</h6>
                  <div class="row">
                    <div class="col-md-9">
                      <input type="file" class="form-control {{ $errors->has('file') ? 'is-invalid' : '' }}" name="file" value="">
                      <div class="invalid-feedback">
                        {{ $errors->first('file') }}
                      </div>
                    </div>
                    <div class="col-md-3">
                      <button type="submit" class="btn btn-primary custom" name="button">
                        <span class="ti-upload"></span>
                      </button>
                    </div>
                  </div>
                </div>
                <div class="form-group mt-3">
                  <h6>Batalkan pesanan?</h6>
                  <button type="button" id="cancelOrder" data-link="{{ route('penumpang.tiket.cancel', ['id_pemesanan' => $pemesanan->kode_pemesanan]) }}" class="btn btn-danger" name="button">Batal</button>
                </div>
                @else
                <div class="form-group">
                  <a href="{{ asset('uploads/images/bukti-pembayaran/' . $pembayaran->file) }}" target="_blank">
                    <img src="{{ asset('uploads/images/bukti-pembayaran/' . $pembayaran->file) }}" class="img-fluid">
                  </a>
                </div>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
      @endif
    </form>
  </div>
</header>
@endsection
