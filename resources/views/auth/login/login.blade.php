<!DOCTYPE html>
<html>
<head>
	<title>Pencatatan Transaksi Voucher</title>
	<link rel="stylesheet" type="text/css" href="{{ asset('assets/auth/css/style.css') }}">
	<link href="https://fonts.googleapis.com/css?family=Poppins:600&display=swap" rel="stylesheet">
  <link rel="shortcut icon" sizes="32x32" href="{{ asset('assets/media/photos/square.png') }}">
  
	<script src="https://kit.fontawesome.com/a81368914c.js"></script>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="robots" content="noindex, nofollow">
  <style>
  .alert {
    padding: 9px;
    background-color: #f44336;
    color: white;
    border-radius: 10px;
    box-shadow: 0px 0px 10px #00bfa6;
  }

  .alert-warning {
    padding: 9px;
    background-color: #F9A826;
    color: white;
    border-radius: 10px;
    box-shadow: 0px 0px 10px #00bfa6;
  }

  .closebtn {
    margin-left: 15px;
    color: white;
    font-weight: bold;
    float: right;
    font-size: 22px;
    line-height: 20px;
    cursor: pointer;
    transition: 0.3s;
  }

  .closebtn:hover {
    color: black;
  }
</style>
</head>
<body>
	<img class="wave" src="{{ asset('assets/auth/img/wave_06.svg') }}">
	<div class="container">
		<div class="img">
			<img src="{{ asset('assets/auth/img/bg3.svg') }}">
		</div>
		<div class="login-content">
			<form action="{{route('login')}}" method="post">
      @csrf
				<img src="{{ asset('assets/auth/img/logo_jki_text.png') }}">
				<h2 class="title" style="font-size: 25px;">Pencatatan Transaksi Voucher</h2>
        @if(\Session::has('alert'))
          <div class="alert">
              <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                <p class="mb-0">{{Session::get('alert')}}</p>
          </div>
        @endif
        @if(\Session::has('alertunauth'))
          <div class="alert-warning">
              <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span> 
                <p class="mb-0">{{Session::get('alertunauth')}}</p>
          </div>
        @endif
        <div class="input-div one">
          <div class="i">
            <i class="fas fa-user"></i>
          </div>
          <div class="div">
            <h5>Username</h5>
            <input type="text" class="input" name="username" id="username" value="{{ old('username') }}" required autofocus>
          </div>
        </div>
        <div class="input-div pass">
          <div class="i"> 
            <i class="fas fa-lock"></i>
          </div>
          <div class="div">
            <h5>Password</h5>
            <input type="password" class="input" name="password" id="password" required>
          </div>
        </div>
        <input type="submit" class="btn" value="Login">
        <p>PT JAYA KREASI INDONESIA</p>
      </form>
    </div>
  </div>
  <script type="text/javascript" src="{{ asset('assets/auth/js/main.js') }}"></script>
</body>
</html>
