@extends('admin_layout')

@section('admin_content')

	<div class="row-fluid sortable">		
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon user"></i><span class="break"></span>Members</h2>
				<div class="box-icon">
					<a href="#" class="btn-setting"><i class="halflings-icon wrench"></i></a>
					<a href="#" class="btn-minimize"><i class="halflings-icon chevron-up"></i></a>
					<a href="#" class="btn-close"><i class="halflings-icon remove"></i></a>
				</div>
			</div>
			
			<?php 
			$message = Session::get('message'); 
			if ($message) { ?>
				<strong><p class="alert alert-success"> 
			<?php
				echo $message;
				Session::put('message', NULL); ?>
				</p></strong>
			<?php } ?>

			<div class="box-content">
				<table class="table table-striped table-bordered bootstrap-datatable datatable">
				  <thead>
					  <tr>
						  <th>Slider ID</th>
						  <th>Slider Image</th>
						  <th>Slider Status</th>
						  <th>Action</th>
					  </tr>
				  </thead> 
			  	@foreach($all_slider as $v_slider)  
				  <tbody>
					<tr>
						<td>{{ $v_slider->slider_id }}</td>					
						<td><img src="{{ $v_slider->slider_image }}" alt="" width="200px"> </td>
						<td class="center">
							@if($v_slider->publication_status == 1)
								<span class="label label-success">Active</span>
							@else 
								<span class="label label-danger">Inactive</span>
							@endif
						</td>
						<td class="center">
						@if($v_slider->publication_status == 1)
							<a class="btn btn-danger" href="{{URL::to('/inactive-slider/'.$v_slider->slider_id)}}">
								<i class="halflings-icon white thumbs-down"></i>  
							</a>
							@else
							<a class="btn btn-success" href="{{URL::to('/active-slider/'.$v_slider->slider_id)}}">
								<i class="halflings-icon white thumbs-up"></i>  
							</a>
							@endif


							<a class="btn btn-info" href="{{URL::to('/edit-slider/'.$v_slider->slider_id)}}">
								<i class="halflings-icon white edit"></i>  
							</a>
							<a class="btn btn-danger" id="delete" href="{{URL::to('/delete-slider/'.$v_slider->slider_id)}}">
								<i class="halflings-icon white trash"></i> 
							</a>
						</td>
					</tr>					
				  </tbody>
				@endforeach
			  </table>            
			</div>
		</div><!--/span-->
	
	</div><!--/row-->

@endsection 