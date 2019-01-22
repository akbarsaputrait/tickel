@extends('master_admin') @section('title', auth()->guard('admin')->user()->name) @section('content')
<div class="row">
  <div class="col-md-4">
    <div class="card h-100">
      <div class="card-body text-center">
				@if(is_null(auth()->guard('admin')->user()->image))
        <img class="img-lg rounded-circle card-img-top" width="300" src="{{ asset('admin/images/faces/face1.jpg') }}" alt="Profile image">
				@else
				<img class="img-lg rounded-circle card-img-top" width="300" src="{{ asset('admin/uploads/images/avatars/'.auth()->guard('admin')->user()->image ) }}" alt="Profile image">
				@endif
        <div class="description my-3">
          <h3>{{ auth()->guard('admin')->user()->name }}</h3>
          <small>{{ auth()->guard('admin')->user()->email }}</small>
        </div>
        <button type="button" data-toggle="modal" data-target="#resetPassword" class="btn btn-outline-dark" name="button">Ganti kata sandi</button>
      </div>
    </div>
  </div>
  <div class="col-md-8">
    <div class="card h-100">
      <div class="card-body">
        <form class="form-horizontal" action="{{ route('admin.profile.store') }}" method="post" enctype="multipart/form-data">
          @csrf
          <div class="form-row">
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Nama</label>
                <input type="text" class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" placeholder="Name" name="name" value="{{ auth()->guard('admin')->user()->name }}">
								<div class="invalid-feedback">
									{{ $errors->first('name') }}
								</div>
              </div>
              <div class="form-group">
                <label for="">Nama Pengguna</label>
                <input type="text" class="form-control {{ $errors->has('username') ? 'is-invalid' : '' }}" placeholder="Username" name="username" value="{{ auth()->guard('admin')->user()->username }}">
								<div class="invalid-feedback">
									{{ $errors->first('username') }}
								</div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label for="">Alamat email</label>
                <input type="email" class="form-control {{ $errors->has('email') ? 'is-invalid' : '' }}" name="email" value="{{ auth()->guard('admin')->user()->email }}">
								<div class="invalid-feedback">
									{{ $errors->first('email') }}
								</div>
              </div>
              <div class="form-group">
                <label for="">Foto profil</label>
                <input type="file" name="file" class="form-control">
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
            <form class="form-vertical" action="{{ route('admin.profile.reset') }}" method="post">
							@csrf
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

@if($errors->has('new_password') || $errors->has('confirm_password'))
@section('script')
<script type="text/javascript">
	$(function() {
		$('#resetPassword').modal('show');
	});
</script>
@endsection
@endif
