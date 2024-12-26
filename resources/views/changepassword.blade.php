@extends('layouts.mainlayout')
@section('content')  

	
<div id="main">
            <header class="mb-3">
               <a href="#" class="burger-btn d-block d-xl-none">
               <i class="bi bi-justify fs-3"></i>
               </a>
            </header>
			
            <div class="page-heading">
               <h3>{{$page_title}}</h3>
            </div>
            <div class="page-content">
               <section class="section">
					<div class="card">
						<div class="card-header">
							@if(count($errors))
								<div class="alert alert-danger" id="alertmsg">
									<ul>
										@foreach($errors->all() as $error)
											<li>{{ $error }}</li>
										@endforeach
									</ul>   
								</div>
							@endif
							@if (Session::has('successmsg'))
										<div class="alert alert-success z-depth-1" role="alert" id="alertmsg">
											<strong>{!! Session::get('successmsg') !!}</strong>
									   </div>
							@endif
						</div>
						<div class="card-body">
							<div class="row">
								<form method="post" action="{{ route('change-password') }}">
								 @csrf
								<div class="col-md-12">
									<div class="form-group">
										<label for="basicInput">Current Password</label>
										<input type="password" class="form-control" id="current_pass" name="current_pass" placeholder="******">
									</div>
									<div class="form-group">
										<label for="basicInput">New Password</label>
										<input type="password" class="form-control" id="password" name="password" placeholder="******">
									</div>
									<div class="form-group">
										<label for="basicInput">Confirm New Password</label>
										<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="******">
									</div>

									<button type="submit" class="btn btn-primary">SUBMIT</button>
								</div>
								</form>
								
							</div>
						</div>
					</div>
				</section>
            </div>
            
         </div>
@endsection
