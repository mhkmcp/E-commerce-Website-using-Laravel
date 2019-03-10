@extends('welcome')

@section('content')

<!-- <?php 
	$product_id = Session::get('product_id');
 ?>
  <h4>{{$product_id}}</h4> -->
  <?php 
	$message = Session::get('message'); 
	if ($message) { ?>
		<strong><p class="alert alert-success"> 
	<?php
		echo $message;
		Session::put('message', NULL); ?>
		</p></strong>
	<?php } ?>
	
<form method="POST" action="{{URL::to('/save-review')}}">
	{{ csrf_field() }}
	
	Rating (Out of 5): <input type="number" name="rating" placeholder="Rating" required="" max="5" min="1" value="5" /> 
	<br>
	<input type="number" hidden="" valu="{{ $product_id }}">
	<textarea name="review" placeholder="Give Your Review" ></textarea>

	<button type="submit" class="btn btn-primary">Done</button>
</form>

@endsection