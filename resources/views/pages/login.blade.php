@extends('welcome')

@section('content')

<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-3 col-sm-offset-1">
				<div class="login-form"><!--login form-->
					<?php 
					$message = Session::get('message'); 
					if ($message) { ?>
						<strong><p class="alert alert-success"> 
					<?php
						echo $message;
						Session::put('message', NULL); ?>
						</p></strong>
					<?php } ?>
					<h2>Login to your account</h2>
					<form action="{{ URL::to('/customer-login') }}" method="post">
						{{ csrf_field() }}
						<input type="email" required=""
						placeholder="Email" name="customer_email" />
						<input type="password" placeholder="Password" name="password" />
						<span>
							<input type="checkbox" class="checkbox"> 
							Keep me signed in
						</span>
						<button type="submit" class="btn btn-default">Login</button>
					</form>
				</div><!--/login form-->
			</div>
			<div class="col-sm-1">
				<h2 class="or">OR</h2>
			</div>
			<div class="col-sm-5">
				<div class="signup-form"><!--sign up form-->
					<h2>New User Signup!</h2>
					<form action="{{ URL::to('/customer-registration') }}" method="post">
						{{ csrf_field() }}
						<input type="text" required="" placeholder="Full Name" name="customer_name" />
						<input type="email" required="" placeholder="Email Address" name="customer_email"/>
						<input type="password" required="" placeholder="Password" name="password" />
						<input type="text" required="" placeholder="Mobile" name="mobile_number" />
						<button type="submit" class="btn btn-default">Signup</button>
					</form>
				</div><!--/sign up form-->
			</div>
		</div>
	</div>
</section><!--/form-->

@endsection