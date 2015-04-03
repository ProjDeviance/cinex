@extends('layouts.index')

@section('content')
<div class="container">
	<div class='col-lg-8 col-md-offset-2'>
		<div class='panel panel-default'>
			<div class='panel-body'>
				<h2 class="page-header"><i class='fa fa-users'></i> Manage Users </h2>
				<i class='fa fa-exclamation-circle'></i> You may manage accounts that were already created.
				<br><br>

				<div class='panel panel-default'>
					<div class='panel-body'>
						<div class="dataTable_wrapper">
							<table class="table table-striped table-hover" id ="dataTables-example">
				                <thead>
					                <tr>
					           
					                    <th>Establishment</th>
					                    <th>Email</th>
					                    <th>Contact Number</th>
					                    <th>Status</th>
					                    <th colspan='3' width='20%'>Action</th>
					                </tr>
				                </thead>
				                <tbody>
				                	@foreach ($displayUsers as $displayUser)

				                	<?php $establishment = Establishment::find($displayUser->establishment_id); ?>
				                	<tr id = 'removeRow{{ $displayUser->id }}'>
				                
				                		<td>{{ $establishment->establishment_name }}</td>
				                		<td>{{ $displayUser->email }}</td>
				                		<td>{{ $displayUser->contact_number }}</td>
				                		<input class='getStatus{{ $displayUser->id }}' type="hidden" value = '{{ $displayUser->status }}'>
				                		
				                		@if($displayUser->status==1)
				                			<td><b class='text text-success'>Active <i class='fa fa-check'></i> </b></td>
				                		@else
				                			<td><b class='text text-warning'>Not Active <i class='fa fa-remove'></i> </b> </td>
				                		@endif
				                		<td>
						        			{{ Form::button('View', ['data-toggle' => 'modal', 'data-target' => '#viewModal'.$displayUser->id, 'type' => 'button', 'class' => 'btn btn-xs btn-info']) }}
						        			@if($displayUser->status==1)
						        			{{ Form::button('Deactivate', ['data-toggle' => 'modal', 'data-target' => '#deactivateModal'.$displayUser->id, 'type' => 'button', 'class' => 'btn btn-xs btn-danger']) }}
						        			@else
						        			{{ Form::button('Activate', ['data-toggle' => 'modal', 'data-target' => '#activateModal'.$displayUser->id, 'type' => 'button', 'class' => 'btn btn-xs btn-success']) }}
					        				@endif
				                		</td>
				                	</tr>
				                	@endforeach
				                </tbody>
							</table>
							<center>{{ $displayUsers->links(); }}</center>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@stop
@section('modals')
@foreach($displayUsers as $displayUser)
<?php $establishment = Establishment::find($displayUser->establishment_id); ?>
	                <!--- Delete User Modals -->
                    <div class='modal fade' id='deactivateModal{{ $displayUser->id }}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel"><i class='fa fa-remove'></i> Deactivate Account</h4>
                                </div>
                                <div class="modal-body">
                                	Do you want to  <b class='text text-danger'>deactivated</b> this account (<b class='text text-danger'>{{ $displayUser->name }}</b>)?
                                </div>
                                <div class="modal-footer">
                                	<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <a  href="/admin/deactivate/{{$displayUser->id}}" type="button" class="deleteUser btn btn-danger" id='{{ $displayUser->id }}'>Deactivate</a>
                                </div>
                            </div>
                        </div>
                    </div>

	                <!--- Update User Modals -->
                    <div class='modal fade' id='activateModal{{ $displayUser->id }}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel"><i class='fa fa-wrench'></i> Activate Account</h4>
                                </div>
                                <div class="modal-body">
                                	
                                		Do you want to <b class='text text-success'>activate</b> this account (<b class='text text-danger'>{{ $displayUser->name }}</b>)?
                                
                                </div>
                                <div class="modal-footer">
                                		<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>

                                		<a href="/admin/activate/{{$displayUser->id}}" type="button" class="updateUser btn btn-success" id='{{ $displayUser->id }}' >Activate Account</a> 
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- View User Modals -->
                    <div class='modal fade' id='viewModal{{ $displayUser->id }}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel"><i class='fa fa-users'></i> Account Details</h4>
                                </div>
                                <div class="modal-body">
	                                <div class='row'>
	                                    <div class='col-lg-3 text-right'>
	                                    {{ Form::label('name_Label', 'Full Name: ') }}
	                                    </div>
	                                    <div class='col-lg-9'>
	                                       <i>{{ $displayUser->name }}</i>
	                                    </div>
	                                </div> 
	                                <div class='row'>
	                                    <div class='col-lg-3 text-right'>
	                                    {{ Form::label('email_Label', 'Email Address: ') }}
	                                    </div>
	                                    <div class='col-lg-6'>
	                                       <i>{{ $displayUser->email }}</i>
	                                    </div>
	                                </div>
	                                
	                                <div class='row'>
	                                    <div class='col-lg-3 text-right'>
	                                        {{ Form::label('contact_number_Label', 'Contact Number: ') }}
	                                    </div>
	                                    <div class='col-lg-6'>
	                                        <i>{{ $displayUser->contact_number }}</i>
	                                    </div>
	                                </div>
	                                <div class='row'>
	                                    <div class='col-lg-3 text-right'>
	                                    {{ Form::label('est_name_Label', 'Establishment Name: ') }}
	                                    </div>
	                                    <div class='col-lg-6'>
	                                       <i>{{ $establishment->establishment_name }}</i>
	                                    </div>
	                                </div> 
	                                
	                                <div class='row'>
	                                    <div class='col-lg-3 text-right'>
	                                    {{ Form::label('address_Label', 'Establishment Address: ') }}
	                                    </div>
	                                    <div class='col-lg-6'>
	                                       <i>{{ $establishment->address }}</i>
	                                    </div>
	                                </div> 
	                                
	                                <br>
	                                <h6 class='text text-danger'><b>Created Last: {{ date('F d, Y g:ia', strtotime($displayUser->created_at)) }} </b></h6>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

				@endforeach
@stop
@section('javascripts')
  
@stop