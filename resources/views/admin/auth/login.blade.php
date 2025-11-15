<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Adroit PMC - Timesheet Application </title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/modules/fontawesome/css/all.min.css') }}">

    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('admin/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/assets/css/components.css') }}">
	<style>
		.btn-primary, .btn-primary:active, .btn-primary:hover, .btn-primary.disabled:active, .btn-primary.disabled:hover{
			background:#034A8F !important;
			border: 1px solid #034A8F !important;
		}
	</style>
</head>
<body >
  <div id="app">
    <section class="section">
      <div class="container">
        <div class="row">
          <div class="col-md-4 offset-md-4 col-12">
		  <br>
            <div class="text-center">
				<a href="#" class="logo logo-normal">					
					<img src="{{ asset('assets/img/logo.webp') }}" alt="Logo"  style="width:200px;">
				</a>
			</div> 
			<br>
			<br>
            <div class="card">
                <div class="card-header">
					<h4>Login</h4>
				</div> 
                  <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" class="needs-validation" novalidate="">
                        @csrf
                      <div class="form-group">
                        <label for="email">Email Address</label>
                        <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" tabindex="1" required autofocus>
                        <div class="invalid-feedback">
                          Please fill in your email
                        </div>
                        @if($errors->first('email'))
                        <code>{{ $errors->first('email') }}</code>
                        @endif
                      </div>
                      <div>
                    </div>

                      <div class="form-group">
                        <div class="d-block">
                          <label for="password" class="control-label">Password</label>
                          <div class="float-right">
                            
                          </div>
                        </div>
                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                        <div class="invalid-feedback">
                          please fill in your password
                        </div>
                        @if ($errors->first('password'))
                            <code>{{ $errors->first('password') }}</code>
                        @endif
                      </div>
                      <div class="form-group">
                        <button type="submit" class="btn btn-primary w-100" tabindex="4">
                          Login
                        </button>
                      </div>
                    </form>
                  </div>
                </div>
            </div>
        </div>
        <div class="simple-footer">
            &copy; Adroit Claims & ADR Consultants {{ date('Y') }}.
          </div>
      </div>
    </section>
  </div>

  <!-- General JS Scripts -->
  <script src="{{ asset('admin/assets/modules/jquery.min.js') }}"></script>
  <script src="{{ asset('admin/assets/modules/popper.js') }}"></script>
  <script src="{{ asset('admin/assets/modules/bootstrap/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('admin/assets/js/stisla.js') }}"></script>
  <!-- Template JS File -->
  <script src="{{ asset('admin/assets/js/scripts.js') }}"></script>
</body>
</html>
