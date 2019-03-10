	
	<section id="cart_items">
		<div class="container col-md-12">
			<div class="table-responsive cart_info">
				<?php 
					$contents = Cart::getContent();
				?>
				<h2 class="table text-center">Please Review Our Products!</h2>
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Image</td>
							<td class="name">Name</td>
							<td>You Liked It?</td>
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
							<!-- <td class="cart_delete">
								<button class="btn btn-primary" type="button"></button>
							</td> -->
							<td>
								<a class="" href="{{ URL::to('/review-product/'.$v_content->id) }}"> Review This Product </a>
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->
