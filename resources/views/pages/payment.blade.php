@extends('welcome')

@section('content')

	<!-- <section id="cart_items">
		<div class="container col-sm-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php
                     $contents = Cart::getContent();

				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="description">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($contents as $v_content) {?>
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to( $v_content->attributes->image)}}" height="80px" width="80px" alt=""></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{$v_content->name}}</a></h4>
								
							</td>
							<td class="cart_price">
								<p>{{$v_content->price}}</p>
							</td>
							<td class="cart_quantity">
							<div class="cart_quantity_button">
								<form action="{{url('/update-cart')}}" method="post">
									{{ csrf_field()}}
									<input class="cart_quantity_input" type="text" name="qty" value="{{$v_content->quantity}}" autocomplete="off" size="2">
									<input  type="hidden" name="id" value="{{$v_content->id}}"  >
									<input type="submit" name="submit" value="update" class="btn btn-sm btn-default">
								</form>
							</div>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">{{$v_content->total}}</p>
							</td>
							<td class="cart_delete">

								<a class="cart_quantity_delete" href="{{URL::to('/delete-to-cart/'.$v_content->id)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
                       <?php }?>
						
					</tbody>
				</table>
			</div>
		</div>
	</section> --> <!--/#cart_items-->

	<section id="cart_items">
		<div class="container col-md-12">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<?php 
					$contents = Cart::getContent();
					// echo "<pre>";
					// print_r($contents);
					// echo "</pre>";
					// echo exit();
				?>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="name">Name</td>
							<td class="price">Price</td>
							<td class="quantity">Quantity</td>
							<td class="total">Total</td>
							<td>Action</td>
						</tr>
					</thead>
					<tbody>
						@foreach( $contents as $v_content)
						<tr>
							<td class="cart_product">
								<a href=""><img src="{{URL::to( $v_content->attributes->image)}}" alt="" width="80px"></a>
							</td>
							<td class="cart_description">
								<h4><a href="">{{ $v_content->name }}</a></h4>
							</td>
							<td class="cart_price">
								<p>{{ $v_content->price }}</p>
							</td>
							<td class="cart_quantity">
								<!-- <div class="cart_quantity_button">
									<a class="cart_quantity_up" href="{{URL::to('/increment-cart/'.$v_content->id)}}"> + </a>
									<input class="cart_quantity_input" type="text" name="quantity" value="{{ $v_content->quantity }}" autocomplete="off" size="2">
									<a class="cart_quantity_down" href="{{URL::to('/dcrement-cart/'.$v_content->id)}}"> - </a>
								</div> -->
								<h4>{{ $v_content->quantity }}</h4>
							</td>
							<td class="cart_total">
								<p class="cart_total_price">${{ $v_content->price *  $v_content->quantity }}</p>
							</td>
							<td class="cart_delete">
								<a class="cart_quantity_delete" 
								href="{{URL::to('/delete-cart/'.$v_content->id)}}"><i class="fa fa-times"></i></a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	

	<section id="do_action">
		<div class="container">
			<div class="breadcrumbs col-sm-4">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Payment method</li>
				</ol>
			</div>
			<div class="paymentCont col-sm-12">
				<div class="headingWrap">
					<h3 class="headingTop text-center">Select Your Payment Method</h3>	
					<p class="text-center">Created with bootsrap button and using radio button</p>
				</div>
				
				<!-- <div class="paymentWrap">
					<div class="btn-group paymentBtnGroup btn-group-justified" data-toggle="buttons">
						<form action="{{URL::to('/place-order')}}" method="post">
							{{ csrf_field() }}
				            <label class="btn paymentMethod active">
				            	<div class="method visa">bKash</div>
				                <input type="radio" name="payment_gateway" value="bkash" checked> 
				            </label>
				            <label class="btn paymentMethod">
				            	<div class="method master-card">Payoneer</div>
				                <input type="radio" name="payment_gateway" value="payoneer"> 
				            </label>
				            <label class="btn paymentMethod">
			            		<div class="method amex">PayPal</div>
				                <input type="radio" name="payment_gateway" value="paypal">
				            </label>
				            <input class="btn btn-warning" type="submit" value="Done">
			            </form>
			        </div>        
				</div> -->

				<form action="{{URL::to('/place-order')}}" method="post">
					{{ csrf_field() }}
		            
		            <input type="radio" name="payment_method" value="bkash" checked> bKash <br> 
		            <input type="radio" name="payment_method" value="payoneer">
		            Payoneer <br>      
		            <input type="radio" name="payment_method" value="paypal">
		            PayPal <br> 
		            <input class="btn btn-warning" type="submit" value="Done">
	            </form>
				
			</div>
		</div>
	</section><!--/#do_action-->

@endsection