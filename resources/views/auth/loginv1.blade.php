<!DOCTYPE html>
<html lang="es">
<head>
	<title>Entrar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
  <link rel="stylesheet" href="{{ asset('fonts/font-awesome-4.7.0/css/font-awesome.css') }}">
  <link rel="stylesheet" href="{{ asset('css/loginv1.css') }}">
  <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/img-01.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
          @csrf
					<span class="login100-form-title">
						Iniciar sesión
					</span>

					<div class="wrap-input100 validate-input" data-validate = "El correo es requerido">
            <div class="input-group">
              <input class="input100 input-group-input" type="text" name="email" placeholder="Correo" value="{{ old('email') }}">
              <i class="fa fa-envelope input-group-icon" aria-hidden="true"></i>
            </div>
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
            @if ($errors->has('email'))
            <span role="alert">
              <strong> dsadas{{ $errors->first('email') }}</strong>
            </span>
            @endif
					</div>

					<div class="wrap-input100 validate-input" data-validate = "La contraseña es requerida">
						<input class="input100" type="password" name="password" placeholder="Contraseña">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
            @if ($errors->has('password'))
  						<span class="" role="alert">
  							<strong>{{ $errors->first('password') }}</strong>
  						</span>
  					@endif
					</div>

					<div class="container-login100-form-btn">
						<button type="button" id="loginBtn" class="login100-form-btn">
							Entrar
						</button>
					</div>

					<div class="text-center p-t-12">
						<a class="txt2" href="{{ route('password.request') }}">
              Olvidé mi contraseña
						</a>
					</div>

					<div class="text-center p-t-136">
						<a class="txt2" href="#">
							Crear una cuenta
							<i class="fa fa-long-arrow-right m-l-5" aria-hidden="true"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>


	<script src="{{ asset('js/loginv1.js') }}"></script>
  <script >
  $('.js-tilt').tilt({
    scale: 1.1
  })
  $(document).ready(function() {
    $("#loginBtn").click(function(e) {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        e.preventDefault();
        var email = $("input[name='email']").val();
        var password = $("input[name='password']").val();

        $.ajax({
            url: '{{ route('login') }}',
            type: 'POST',
            data: {
                email: email,
                password: password
            },
            success: function(data) {
                if ($.isEmptyObject(data.error)) {
                    window.location.href = '{{ url('/') }}';
                } else {
                    printErrorMsg(data.error);
                }
            }
        });

    });

    function printErrorMsg(msg) {
        $(".print-error-msg-login").find("ul").html('');
        $(".print-error-msg-login").css('display', 'block');
        $.each(msg, function(key, value) {
            $(".print-error-msg-login").find("ul").append('<li>' + value + '</li>');
        });
    }
});
</script>

</body>
</html>
