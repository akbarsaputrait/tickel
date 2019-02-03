@extends('master_home') @section('content')
<header class="text-dark pb-4" id="home">
  <div class="container mt-5">
    <div class="my-5">
      <h3>{{ auth()->guard('penumpang')->user()->nama_penumpang }}</h3>
    </div>
    <ul class="nav nav-tabs nav-justified" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#profile">Profil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#history">Riwayat Pemesanan</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#testimoni">Testimoni</a>
      </li>
    </ul>
    <div class="tab-content">
      <div class="tab-pane fade active show" id="profile">
        <div class="row">
          <div class="col-md-12">
            @if(session()->has('message'))
            <div class="alert alert-{{ session()->get('status') }} alert-dissmissible fade show mb-4">
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
              <i class="ti-{{ session()->get('status') == 'success' ? 'check' : 'close' }}">
                    </i> {{ session()->get('message') }}
            </div>
            @endif
            <form class="form-horizontal text-left text-dark" action="{{ route('profile.update', ['username' => auth()->guard('penumpang')->user()->username]) }}" method="post" enctype="multipart/form-data">
              @csrf
              <div class="row">
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Nama</label>
                    <input type="text" class="form-control {{ $errors->has('nama_penumpang') ? 'is-invalid' : '' }}" placeholder="Nama lengkap" name="nama_penumpang" value="{{ auth()->guard('penumpang')->user()->nama_penumpang }}">
                    <div class="invalid-feedback">
                      {{ $errors->first('nama_penumpang') }}
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Email</label>
                    <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="Alamat email" name="email" value="{{ auth()->guard('penumpang')->user()->email }}">
                    <div class="invalid-feedback">
                      {{ $errors->first('email') }}
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Nama Pengguna</label>
                    <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" placeholder="Nama pengguna" name="username" value="{{ auth()->guard('penumpang')->user()->username }}">
                    <div class="invalid-feedback">
                      {{ $errors->first('username') }}
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Nomor Identitas</label>
                    <input type="number" class="form-control" placeholder="Nomor SIM/KTP" name="no_identitas" value="{{ auth()->guard('penumpang')->user()->no_identitas }}">
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Jenis Kelamin</label>
                        <select class="form-control" name="jenis_kelamin">
                          <option value="">Jenis kelamin</option>
                          <option value="L" {{ (auth()->guard('penumpang')->user()->jenis_kelamin == "L") ? 'selected' : '' }}>Laki-laki</option>
                          <option value="P" {{ (auth()->guard('penumpang')->user()->jenis_kelamin == "P") ? 'selected' : '' }}>Perempuan</option>
                        </select>
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">Nomor Telepon</label>
                        <input type="tel" class="form-control" placeholder="08*******" name="telefone" value="{{ auth()->guard('penumpang')->user()->telefone }}">
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="">Tangga Lahir</label>
                    <input type="date" class="form-control" name="tanggal_lahir" value="{{ is_null(auth()->guard('penumpang')->user()->tanggal_lahir) ? '' : auth()->guard('penumpang')->user()->tanggal_lahir }}">
                  </div>
                  <div class="form-group">
                    <label for="">Alamat lengkap</label>
                    <textarea name="alamat_penumpang" class="form-control" rows="5">{{ auth()->guard('penumpang')->user()->alamat_penumpang }}</textarea>
                  </div>
                </div>
                <div class="col-md-4">
                  <div class="form-group">
                    <label for="">Foto Profil</label>
                    <input type="file" class="form-control" name="file" value="">
                  </div>
                  <div class="form-group d-flex justify-content-center align-items-center">
                    <div class="">
                      @if(is_null(auth()->guard('penumpang')->user()->image))
                      <img src="{{ asset('home/images/client.png') }}" class="img-fluid" style="border-radius: 50%;" alt=""> @else
                      <img src="{{ asset('uploads/images/avatars/' . auth()->guard('penumpang')->user()->image) }}" class="img-fluid" style="border-radius: 50%;" alt="" width="100"> @endif
                    </div>
                  </div>
                  <div class="form-group text-center">
                    <button type="submit" class="btn btn-primary custom w-50" name="button">Simpan</button>
                  </div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="tab-pane fade text-dark" id="history">
        <h1>Hallo</h1>
      </div>
        <div class="tab-pane fade text-dark" id="testimoni">
          <h1>Testimoni</h1>
        </div>
    </div>
  </div>
</header>
@endsection
