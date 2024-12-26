<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expanse Manager | {{$page_title}}</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/pages/auth.css') }}">
</head>

<body>
    <div id="auth">
        
<div class="row h-100">
    <div class="col-lg-5 col-12">
        <div id="auth-left">
            <!--<div class="auth-logo">
                <a href="index.html"><img src="{{ asset('assets/images/logo/logo.png') }}" alt="Logo"></a>
            </div>-->
            <h1 class="auth-title">Expanse Manager</h1>
            <p class="auth-subtitle mb-5">Login Here</p>
			@if (Session::has('errormsg'))
					<div class="alert alert-danger z-depth-1" role="alert" id="alertmsg">
							<strong>{!! Session::get('errormsg') !!}</strong>
					</div>
			@endif
			@if (Session::has('successmsg'))
						<div class="alert alert-success z-depth-1" role="alert" id="alertmsg">
							<strong>{!! Session::get('successmsg') !!}</strong>
					   </div>
			@endif 
			@if(count($errors))
				<div class="alert alert-danger" id="alertmsg">
					<ul>
						@foreach($errors->all() as $error)
							<li>{{ $error }}</li>
						@endforeach
					</ul>   
				</div>
			@endif
            <form action="{{ route('do_login') }}" method="POST">
			 @csrf
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="text" class="form-control form-control-xl" placeholder="Email" name="email" id="email">
                    <div class="form-control-icon">
                        <i class="bi bi-envelope"></i>
                    </div>
                </div>
                <div class="form-group position-relative has-icon-left mb-4">
                    <input type="password" class="form-control form-control-xl" placeholder="Password" name="password" id="password">
                    <div class="form-control-icon">
                        <i class="bi bi-shield-lock"></i>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary btn-block btn-lg shadow-lg mt-5">Sign In</button>
            </form>
            <div class="text-center mt-5 text-lg fs-4">
                <p class='text-gray-600'>Don't have an account? <a href="{{ route('register') }}" class="font-bold">Sign Up</a>.</p>
            </div>
        </div>
    </div>
    <div class="col-lg-7 d-none d-lg-block">
        <div id="auth-right">
			 <a href="index.html"><img style="width: 100%;" src="{{ asset('assets/images/logo/expanse_manager.png') }}" alt="Logo"></a>
        </div>
    </div>
</div>

    </div>
</body>

</html>
