@extends('welcome')

@section('content')

<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-3 col-sm-offset-1">
				<h1>Thanks for Shopping with US</h1>
				<?php 
				$message = Session::get('message'); 
				if ($message) { ?>
					<strong><p class="alert alert-success"> 
				<?php
					echo $message;
					Session::put('message', NULL); ?>
					</p></strong>
				<?php } ?>
				<h2>PayPal Payment</h2>
					
			</div>
		</div>
	</div>
</section><!--/form-->

@endsection