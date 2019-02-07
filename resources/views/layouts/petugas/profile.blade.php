@extends('master_petugas') @section('title', auth()->guard('petugas')->user()->nama_petugas) @section('content')
@if($errors->has('new_password') || $errors->has('confirm_password') || $errors->has('current_pasword'))
  <div class="alert alert-danger">
    <i class="fa fa-close"></i> Gagal memperbarui kata sandi.
  </div>
@endif
<div class="row">
  <div class="col-md-4">
    <div class="card h-100">
      <div class="card-body text-center">
				@if(is_null(auth()->guard('petugas')->user()->image))
        <img class="img-lg rounded-circle card-img-top" width="300" src="{{ asset('admin/images/faces/face1.jpg') }}" alt="Profile image">
				@else
				<img class="img-lg rounded-circle card-img-top" width="300" src="{{ asset('uploads/images/avatars/'.auth()->guard('petugas')->user()->image ) }}" alt="Profile image">
				@endif
        <div class="description my-3">
          <h3>{{ auth()->guard('petugas')->user()->name }}</h3>
          <small>{{ auth()->guard('petugas')->user()->email }}</small>
        </div>
        <button type="button" data-toggle="modal" data-target="#resetPassword" class="btn btn-outline-dark" name="button">Ganti kata sandi</button>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card h-100">
      <div class="card-body">
        <form class="form-horizontal" action="{{ route('petugas.profile.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control {{ $errors->has('nama_petugas') ? 'is-invalid' : '' }}" placeholder="Name" name="nama_petugas" value="{{ auth()->guard('petugas')->user()->nama_petugas }}">
								<div class="invalid-feedback">
									{{ $errors->first('nama_petugas') }}
								</div>
              </div>
              <div class="form-group">
                <label for="">Nama Pengguna</label>
                <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" placeholder="Username" name="username" value="{{ auth()->guard('petugas')->user()->username }}">
								<div class="invalid-feedback">
									{{ $errors->first('username') }}
								</div>
              </div>
              <div class="form-group">
                <label for="">Alamat</label>
                <textarea name="alamat_petugas" class="form-control" rows="8" cols="80" placeholder="Alamat lengkap">{{ auth()->guard('petugas')->user()->alamat_petugas }}</textarea>
                <div class="invalid-feedback">
									{{ $errors->first('alamat_petugas') }}
								</div>
              </div>
              <div class="form-group">
                <label for="">Foto profil</label>
                <input type="file" class="form-control" name="file" value="" accept="image/*">
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Alamat email</label>
                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ auth()->guard('petugas')->user()->email }}">
								<div class="invalid-feedback">
									{{ $errors->first('email') }}
								</div>
              </div>
              <div class="form-group">
                <label for="">Jenis kelamin</label>
                <select class="form-control {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}" name="jenis_kelamin">
                  <option value="">-- Pilih jenis kelamin</option>
                  <option value="L" {{ auth()->guard('petugas')->user()->jenis_kelamin == "L" ? 'selected' : '' }}>Laki-laki</option>
                  <option value="P" {{ auth()->guard('petugas')->user()->jenis_kelamin == "P" ? 'selected' : '' }}>Perempuan</option>
                </select>
                <div class="invalid-feedback">
									{{ $errors->first('jenis_kelamin') }}
								</div>
              </div>
              <div class="form-group">
                <div class="form-row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Tanggal lahir</label>
                      <input type="date" class="form-control" name="tanggal_lahir" value="{{ auth()->guard('petugas')->user()->tanggal_lahir }}">
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">Telefon</label>
                      <input type="tel" class="form-control {{ $errors->has('telefone') ? 'is-invalid' : '' }}" name="telefone" value="{{ auth()->guard('petugas')->user()->telefone }}">
                      <div class="invalid-feedback">
      									{{ $errors->first('telefone') }}
      								</div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="form-row justify-content-end">
            <div class="col-md-2">
              <button type="submit" class="btn btn-primary" name="button">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="resetPassword" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <form class="form-vertical" action="{{ route('petugas.profile.reset') }}" method="post">
							@csrf
              <div class="form-group">
								<label for="">Kata sandi sekarang</label>
								<input type="password" class="form-control {{ $errors->has('current_pasword') ? 'is-invalid' : '' }}" name="current_pasword" value="" autofocus>
								<div class="invalid-feedback">
									{{ $errors->first('current_pasword') }}
								</div>
							</div>
							<div class="form-group">
								<label for="">Kata sandi baru</label>
								<input type="password" class="form-control {{ $errors->has('new_password') ? 'is-invalid' : '' }}" name="new_password" value="" autofocus>
								<div class="invalid-feedback">
									{{ $errors->first('new_password') }}
								</div>
							</div>
							<div class="form-group">
								<label for="">Ulangi kata sandi baru</label>
								<input type="password" class="form-control {{ $errors->has('confirm_password') ? 'is-invalid' : '' }}" name="confirm_password" value="">
								<div class="invalid-feedback">
									{{ $errors->first('confirm_password') }}
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary" name="button">Simpan</button>
							</div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
