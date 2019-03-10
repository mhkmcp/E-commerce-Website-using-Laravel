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
						  <th>Manufacture ID</th>
						  <th>Manufacture Name</th>
						  <th>Manufacture Description</th>
						  <th>Status</th>
						  <th>Actions</th>
					  </tr>
				  </thead> 

			  	@foreach($all_manufacture as $v_manufacture)  
				  <tbody>
					<tr>
						<td>{{ $v_manufacture->manufacture_id }}</td>
						<td class="center">{{ $v_manufacture->manufacture_name }}</td>
						<td class="center">{{ $v_manufacture->manufacture_description }}</td>
						<td class="center">
							@if($v_manufacture->publication_status == 1)
								<span class="label label-success">Active</span>
							@else 
								<span class="label label-danger">Inactive</span>
							@endif
						</td>
						<td class="center">
							@if($v_manufacture->publication_status == 1)
							<a class="btn btn-danger" href="{{URL::to('/inactive-manufacture/'.$v_manufacture->manufacture_id)}}">
								<i class="halflings-icon white thumbs-down"></i>  
							</a>
							@else
							<a class="btn btn-success" href="{{URL::to('/active-manufacture/'.$v_manufacture->manufacture_id)}}">
								<i class="halflings-icon white thumbs-up"></i>  
							</a>
							@endif


							<a class="btn btn-info" href="{{URL::to('/edit-manufacture/'.$v_manufacture->manufacture_id)}}">
								<i class="halflings-icon white edit"></i>  
							</a>
							<a class="btn btn-danger" id="delete" href="{{URL::to('/delete-manufacture/'.$v_manufacture->manufacture_id)}}">
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