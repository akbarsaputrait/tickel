@extends('master_home') @section('content')
<header class="text-dark pb-4" id="home">
  <div class="container mt-5">
    <form action="{{ route('penumpang.register.post') }}" method="post">
      @csrf
      <div class="row justify-content-center align-items-center">
        <div class="col-md-6">
          @if(session()->has('message'))
          <div class="alert alert-{{ session()->get('status') }} alert-dissmissible fade show mb-4">
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
            <i class="ti-{{ session()->get('status') == 'success' ? 'check' : 'close' }}">
                  </i> {{ session()->get('message') }}
          </div>
          @endif
          <div class="card features p-4 text-left text-dark">
            <div class="form-group">
              <label class="label">Nama</label>
              <input type="text" class="form-control {{ ($errors->has('nama_penumpang')) ? 'is-invalid' : '' }}" value="{{ old('nama_penumpang') }}" placeholder="Nama lengkap" name="nama_penumpang" autofocus>
              <div class="invalid-feedback">
                {{ $errors->first('nama_penumpang') }}
              </div>
            </div>
            <div class="form-group">
              <label class="label">Nama Pengguna</label>
              <input type="text" class="form-control {{ ($errors->has('username')) ? 'is-invalid' : '' }}" value="{{ old('username') }}" placeholder="Nama pengguna" name="username">
              <div class="invalid-feedback">
                {{ $errors->first('username') }}
              </div>
            </div>
            <div class="form-group">
              <label class="label">Email</label>
              <input type="email" class="form-control {{ ($errors->has('email')) ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="Alamat email" name="email">
              <div class="invalid-feedback">
                {{ $errors->first('email') }}
              </div>
            </div>
            <div class="form-group">
              <label class="label">Kata Sandi</label>
              <input type="password" class="form-control {{ ($errors->has('password')) ? 'is-invalid' : '' }}" placeholder="*********" name="password">
              <div class="invalid-feedback">
                {{ $errors->first('password') }}
              </div>
            </div>
            <div class="form-group">
              <label class="label">Konfirmasi Kata Sandi</label>
              <input type="password" class="form-control {{ ($errors->has('confirm_password')) ? 'is-invalid' : '' }}" placeholder="*********" name="confirm_password">
              <div class="invalid-feedback">
                {{ $errors->first('confirm_password') }}
              </div>
            </div>
            <div class="form-group">
              <button class="btn btn-primary submit-btn btn-block" type="submit">Daftar</button>
            </div>
            <div class="text-block text-center my-3">
              <span class="text-small font-weight-semibold">Sudah memiliki akun ?</span>
              <a href="{{ route('penumpang.login') }}" class="text-black text-small">Masuk di sini</a>
            </div>
          </div>
        </div>
      </div>
    </form>
  </div>
</header>
@endsection
