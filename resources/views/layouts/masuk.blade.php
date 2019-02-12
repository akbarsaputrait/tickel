
<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login | Tickle</title>
  <!-- plugins:css -->
	<link rel="stylesheet" href="{{ asset('admin/vendors/iconfonts/mdi/css/materialdesignicons.min.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ asset('admin/vendors/css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ asset('admin/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ asset('admin/images/favicon.png') }}" />
  <style media="screen">
    .auth.theme-one .auto-form-wrapper {
      box-shadow: none;
    }
    .auth.auth-bg-1 {
      background: url({{ asset('home/images/asset3.png') }});
      background-position: center center;
      background-repeat: no-repeat;
    }
  </style>

</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper auth-page">
      <div class="content-wrapper d-flex align-items-center auth auth-bg-1 theme-one">
        <div class="row w-100">
          <div class="col-lg-4 mx-auto">
						@if(session()->has('message'))
								<div class="alert alert-{{ session()->get('status') }} alert-dissmissible fade show">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"></button>
										<i class="material-icons">
										session()->get('status') == 'success' ? 'check' : 'close'
										</i>
										{{ session()->get('message') }}
								</div>
						@endif
            <div class="auto-form-wrapper text-center">
              <h3 class="text-center my-3">Siapa anda?</h3>
              <a href="{{ route('admin.login') }}" class="btn btn-outline-primary">
              	Admin
              </a>
							<a href="{{ route('petugas.login') }}" class="btn btn-outline-primary">
              	Petugas
              </a>
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
