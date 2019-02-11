<div class="modal fade" id="resetPassword" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-body">
        <div class="card">
          <div class="card-body">
            <form class="form-vertical" action="{{ route('admin.password.reset') }}" method="post">
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
