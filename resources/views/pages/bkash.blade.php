@extends('welcome')

@section('content')

<section id="form"><!--form-->
	<div class="container">
		<div class="row">
			<div class="col-sm-8 col-sm-offset-1">
				<h1>bKash Payment</h1>
				<h2>Thanks for Shopping with US</h2>
				
				
			</div>
			<div class="review">
				<h1>Put The Reviews Here</h1>
				<?php 
				$message = Session::get('message'); 
				if ($message) { ?>
					<strong><p class="alert alert-success"> 
				<?php
					echo $message;
					Session::put('message', NULL); ?>
					</p></strong>
				<?php } ?>

				<?php 
				$cmessage = Session::get('cmessage'); 
				if ($cmessage) { ?>
					<strong><p class="alert alert-success"> 
				<?php
					echo $cmessage;
					Session::put('cmessage', NULL); ?>
					</p></strong>
				<?php } ?>
			</div>

			<!-- Write Your Review Here -->

			<!-- <div class="tab-pane fade active in" id="reviews" >
				<h2>Please Write a Review Here</h2>
				<div class="col-sm-12">
					<ul>
						<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
						<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
						<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
					</ul>
					
					<p><b>Write Your Review</b></p>
					
					<form action="#">
						<span>
							<input type="text" placeholder="Your Name"/>
							<input type="email" placeholder="Email Address"/>
						</span>
						<textarea name="" ></textarea>
						<b>Rating: </b> <img src="{{URL::to('assets/images/product-details/rating.png')}}" alt="" />
						<button type="button" class="btn btn-default pull-right">
							Submit
						</button>
					</form>
				</div>
			</div> -->
		</div>
	</div>
</section><!--/form-->

<!-- @yield('pages/review') -->
@include('pages/review')

@endsection