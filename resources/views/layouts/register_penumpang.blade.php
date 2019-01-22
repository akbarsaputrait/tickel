<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Register | Tickle</title>
	<!-- plugins:css -->
	<link rel="stylesheet" href="{{ asset('admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
  <style media="screen">
    .auth.theme-one .auto-form-wrapper {
      box-shadow: none;
    }
    .auth.register-bg-1 {
      background: url({{ asset('home/images/asset3.png') }}) center  no-repeat;
    }
  </style>
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth register-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
            <h2 class="text-center mb-4">Register</h2>
            <div class="auto-form-wrapper">
              <form action="{{ route('penumpang.register.post') }}" method="post">
                @csrf
                <div class="form-group">
                  <label class="label">Name</label>
                  <input type="text" class="form-control {{ ($errors->has('nama_penumpang')) ? 'is-invalid' : '' }}" value="{{ old('nama_penumpang') }}" placeholder="Name" name="nama_penumpang" autofocus>
                  <div class="invalid-feedback">
                    {{ $errors->first('nama_penumpang') }}
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Username</label>
                  <input type="text" class="form-control {{ ($errors->has('username')) ? 'is-invalid' : '' }}" value="{{ old('username') }}" placeholder="Username" name="username">
                  <div class="invalid-feedback">
                    {{ $errors->first('username') }}
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Email</label>
                  <input type="email" class="form-control {{ ($errors->has('email')) ? 'is-invalid' : '' }}" value="{{ old('email') }}" placeholder="Email Address" name="email">
                  <div class="invalid-feedback">
                    {{ $errors->first('email') }}
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Password</label>
                  <input type="password" class="form-control {{ ($errors->has('password')) ? 'is-invalid' : '' }}" placeholder="*********" name="password">
                  <div class="invalid-feedback">
                    {{ $errors->first('password') }}
                  </div>
                </div>
                <div class="form-group">
                  <label class="label">Confirm Password</label>
                  <input type="password" class="form-control {{ ($errors->has('confirm_password')) ? 'is-invalid' : '' }}" placeholder="*********" name="confirm_password">
                  <div class="invalid-feedback">
                    {{ $errors->first('confirm_password') }}
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn btn-block" type="submit">Register</button>
                </div>
                <div class="text-block text-center my-3">
                  <span class="text-small font-weight-semibold">Already have and account ?</span>
                  <a href="{{ route('login') }}" class="text-black text-small">Login</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
	<!-- plugins:js -->
  <script src="{{ asset('admin/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ asset('admin/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ asset('admin/js/off-canvas.js') }}"></script>
  <script src="{{ asset('admin/js/misc.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
