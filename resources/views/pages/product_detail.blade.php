@extends('welcome')

@section('content')

<?php 
	$product_id = Session::get('product_id');
	print_r($product_id);
	$reviews = DB::table('tbl_review')
		->join('tbl_customer', 'tbl_review.customer_id','=','tbl_customer.customer_id')
		->select('tbl_review.*','tbl_customer.customer_name')
		->where('product_id', $product_id)
        ->where('publication_status', 1)
        ->get();

    $num_of_rows = $reviews->count();
    $average_rating = DB::table('tbl_review')
    				->where('product_id', $product_id)
    				->avg('rating');
 ?>

<div class="col-sm-9 padding-right">
	<div class="product-details"><!--product-details-->
		<div class="col-sm-5">
			<div class="view-product">
				<img src="{{ URL::to($product_detail->product_image) }}" alt="" />
				<h3>ZOOM</h3>
			</div>
		</div>
		<div class="col-sm-7">
			<div class="product-information"><!--/product-information-->
				<!-- <img src="images/product-details/new.png" class="newarrival" alt="" /> -->
				<h2>{{ $product_detail->product_name }}</h2>
				<p>Color: {{ $product_detail->product_color }}</p>
				<!-- <img src="{{URL::to('assets/images/product-details/rating.png')}}" alt="" />
 -->			
 					
 				<span>
 					<h4><strong>{{ $average_rating }}</strong> Out of 5.0</h4>
					<span>US: ${{ $product_detail->product_price }}</span>
					<form action="{{url('/add-to-cart')}}" method="post">
						{{ csrf_field() }}
						<label>Quantity:</label>
						<input name="qty" type="text" value="1" />
						<input type="hidden" name="product_id" value="{{$product_detail->product_id}}">
						<button type="submit" class="btn btn-fefault cart">
							<i class="fa fa-shopping-cart"></i>
							Add to cart
						</button>
					</form>
				</span>
				<p><b>Availability:</b> In Stock</p>
				<p><b>Condition:</b> New</p>
				<p><b>Brand:</b> {{ $product_detail->manufacture_name }}</p>
				<p><b>Categroy:</b> {{ $product_detail->category_name }}</p>
				<!-- <a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a> -->
			</div><!--/product-information-->
		</div>
	</div><!--/product-details-->

	<div class="category-tab shop-details-tab"><!--category-tab-->
		<div class="col-sm-12">
			<ul class="nav nav-tabs">
				<li><a href="#details" data-toggle="tab">Details</a></li>
				<li><a href="#companyprofile" data-toggle="tab">Company Profile</a></li>
				<li><a href="#tag" data-toggle="tab">Tag</a></li>
				<li class="active"><a href="#reviews" data-toggle="tab">Reviews ({{$reviews->count()}})</a></li>
			</ul>
		</div>
		<div class="tab-content">
			<div class="tab-pane fade" id="details" >
				<p>{{ $product_detail->product_long_description }}</p>
			</div>
			
			<div class="tab-pane fade" id="companyprofile" >
				<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="{{URL::to('assets/images/home/gallery1.jpg')}}" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade" id="tag" >
				<div class="col-sm-3">
					<div class="product-image-wrapper">
						<div class="single-products">
							<div class="productinfo text-center">
								<img src="{{URL::to('assets/images/home/gallery1.jpg')}}" alt="" />
								<h2>$56</h2>
								<p>Easy Polo Black Edition</p>
								<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
							</div>
						</div>
					</div>
				</div>
			</div>
			
			<div class="tab-pane fade active in" id="reviews" >
				<div class="col-sm-12">
					<!-- <ul>
						<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
						<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
						<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
					</ul> -->
					
			
					<table>
						<thead>
							<tr>
								<td class="col-md-4"><h4>Customer Name</h4></td>
								<td class="col-md-4"><h4>Rating (Out of 5)</h4></td>
								<td class="col-md-6"><h4>Review</h4></td>
							</tr>
						</thead>
						<tbody>
							@foreach( $reviews as $v_review)
							<tr style='border-top: 1px yellow solid;'}}>
								<td><h4>{{ $v_review->customer_name }}</h4></td>
								<td class="text-center"><h4><strong>{{ $v_review->rating }}</strong></h4></td>
								<td><h5>{{ $v_review->review }}</h5></td>
							</tr>
							@endforeach
						</tbody>
					</table>


					
					<!-- <form action="#">
						<span>
							<input type="text" placeholder="Your Name"/>
							<input type="email" placeholder="Email Address"/>
						</span>
						<textarea name="" ></textarea>
						<b>Rating: </b> <img src="{{URL::to('assets/images/product-details/rating.png')}}" alt="" />
						<button type="button" class="btn btn-default pull-right">
							Submit
						</button>
					</form> -->
				</div>
			</div>
			
		</div>
	</div><!--/category-tab-->
	
	<div class="recommended_items"><!--recommended_items-->
		<h2 class="title text-center">recommended items</h2>
		
		<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
			<div class="carousel-inner">
				<div class="item active">	
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{URL::to('assets/images/home/recommend1.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{URL::to('assets/images/home/recommend2.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{URL::to('assets/images/home/recommend3.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="item">	
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{URL::to('assets/images/home/recommend1.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{URL::to('assets/images/home/recommend2.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
								</div>
							</div>
						</div>
					</div>
					<div class="col-sm-4">
						<div class="product-image-wrapper">
							<div class="single-products">
								<div class="productinfo text-center">
									<img src="{{URL::to('assets/images/home/recommend3.jpg') }}" alt="" />
									<h2>$56</h2>
									<p>Easy Polo Black Edition</p>
									<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to cart</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
				<i class="fa fa-angle-left"></i>
			  </a>
			  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
				<i class="fa fa-angle-right"></i>
			  </a>			
		</div>
	</div><!--/recommended_items-->
	
</div>

@endsection