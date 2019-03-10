@extends('admin_layout')

@section('admin_content')

	<ul class="breadcrumb">
		<li>
			<i class="icon-home"></i>
			<a href="index.html">Home</a>
			<i class="icon-angle-right"></i> 
		</li>
		<li>
			<i class="icon-edit"></i>
			<a href="#">Forms</a>
		</li>
	</ul>
			
	<div class="row-fluid sortable">
		<div class="box span12">
			<div class="box-header" data-original-title>
				<h2><i class="halflings-icon edit"></i><span class="break"></span>Add Productproduct</h2>							
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
				<form class="form-horizontal" action="{{url('/save-slider')}}" method="POST" enctype="multipart/form-data">
					{{ csrf_field() }}
				  <fieldset>

					<div class="control-group">
						<label class="control-label">Slider Image</label>
						<div class="controls">
						  <input type="file" name="slider_image" required="">
						</div>
					</div>
					
					<div class="control-group hidden-phone">
					  <label class="control-label" for="textarea2">Publication Status</label>
					  <div class="controls">
						<input type="checkbox" name="publication_status" value="1">
					  </div>
					</div>

					<div class="form-actions">
					  <button type="submit" class="btn btn-primary">Add Product</button>
					  <button type="reset" class="btn">Cancel</button>
					</div>
				  </fieldset>
				</form>   

			</div>
		</div><!--/span-->

	</div><!--/row-->

@endsection