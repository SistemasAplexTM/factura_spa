<!DOCTYPE html>
<html lang="en">
<head>
	<title>Entrar</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
	<link rel="stylesheet" href="{{ asset('css/login.css') }}">
<!--===============================================================================================-->
</head>
<body style="background-color: #666666;">
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{ route('login') }}">
					@csrf
					<span class="login100-form-title p-b-43">
						Iniciar sesión
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Valid email is required: ex@abc.xyz">
						<input class="input100" type="email" name="email" value="{{ old('email') }}" >
						<span class="focus-input100"></span>
						<span class="label-input100">Correo</span>
					</div>
					@if ($errors->has('email'))
					<span role="alert">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
					@endif

					<div class="wrap-input100 validate-input" data-validate="Password is required">
						<input class="input100" type="password" name="password" >
						<span class="focus-input100"></span>
						<span class="label-input100">Contraseña</span>
					</div>
					@if ($errors->has('password'))
						<span class="" role="alert">
							<strong>{{ $errors->first('password') }}</strong>
						</span>
					@endif

					<div class="flex-sb-m w-full p-t-3 p-b-32">
						<div>
							<a  href="{{ route('password.request') }}" class="txt1">
								Olvidé mi contraseña
							</a>
						</div>
					</div>

					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Entrar
						</button>
					</div>
				</form>

				<div class="login100-more" style="background-image: url('images/bg-01.jpg');">
				</div>
			</div>
		</div>
	</div>

<!--===============================================================================================-->
	<script src="{{ asset('js/login.js') }}"></script>
</body>
</html>
