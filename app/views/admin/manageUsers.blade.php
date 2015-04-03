@extends('layouts.index')

@section('content')
	<div class='col-lg-8 col-md-offset-2'>
		<div class='panel panel-default'>
			<div class='panel-body'>
				<h2 class="page-header"><i class='fa fa-users'></i> Manage Users </h2>
				<i class='fa fa-exclamation-circle'></i> You may edit, delete accounts that were already created.
				<br><br>

				@foreach($displayUsers as $displayUser)

	                <!--- Delete User Modals -->
                    <div class='modal fade' id='deleteModal{{ $displayUser->id }}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel"><i class='fa fa-remove'></i> Delete Account</h4>
                                </div>
                                <div class="modal-body">
                                	Do you want to permanently delete this account (<b class='text text-danger'>{{ $displayUser->name }}</b>)?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="deleteUser btn btn-danger" id='{{ $displayUser->id }}' data-dismiss="modal">Delete Account</button>
                                </div>
                            </div>
                        </div>
                    </div>

	                <!--- Update User Modals -->
                    <div class='modal fade' id='updateModal{{ $displayUser->id }}' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden='true'>
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel"><i class='fa fa-wrench'></i> Update Account Status</h4>
                                </div>
                                <div class="modal-body">
                                	@if($displayUser->status==1)
                                		Do you want to <b class='text text-warning'>deactivate</b> this account (<b class='text text-danger'>{{ $displayUser->name }}</b>)?
                                	@else
                                		Do you want to <b class='text text-success'>activate</b> this account (<b class='text text-danger'>{{ $displayUser->name }}</b>)?
                                	@endif
                                </div>
                                <div class="modal-footer">
                                	@if($displayUser->status==1)
                                		<button type="button" class="updateUser btn btn-warning" id='{{ $displayUser->id }}' data-dismiss="modal">Deactivate Account</button>
                                	@else
                                		<button type="button" class="updateUser btn btn-success" id='{{ $displayUser->id }}' data-dismiss="modal">Activate Account</button>
                                	@endif
                                    
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
	                                    {{ Form::label('email_Label', 'Residence Address: ') }}
	                                    </div>
	                                    <div class='col-lg-6'>
	                                       <i>{{ $displayUser->address }}</i>
	                                    </div>
	                                </div> 
	                                <div class='row'>
	                                    <div class='col-lg-3 text-right'>
	                                        {{ Form::label('phonNumber_Label', 'Phone Number: ') }}
	                                    </div>
	                                    <div class='col-lg-6'>
	                                        <i>{{ $displayUser->phoneNumber }}</i>
	                                    </div>
	                                </div>
	                                <div class='row'>
	                                    <div class='col-lg-3 text-right'>
	                                        {{ Form::label('userType_Label', 'Privilege: ') }}
	                                    </div>
	                                    <div class='col-lg-6'>
	                                        <i>{{ $displayUser->user_Type }}</i>
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

				<div class='panel panel-default'>
					<div class='panel-body'>
						<div class="dataTable_wrapper">
							<table class="table table-striped table-hover" id ="dataTables-example">
				                <thead>
					                <tr>
					                    <th>User ID (#)</th>
					                    <th>Name</th>
					                    <th>Email</th>
					                    <th>Phone Number</th>
					                    <th>Status</th>
					                    <th colspan='3' width='20%'>Action</th>
					                </tr>
				                </thead>
				                <tbody>
				                	@foreach ($displayUsers as $displayUser)
				                	<tr id = 'removeRow{{ $displayUser->id }}'>
				                		<td>{{ $displayUser->id }}</td>
				                		<td>{{ $displayUser->name }}</td>
				                		<td>{{ $displayUser->email }}</td>
				                		<td>{{ $displayUser->phoneNumber }}</td>
				                		<input class='getStatus{{ $displayUser->id }}' type="hidden" value = '{{ $displayUser->status }}'>
				                		
				                		@if($displayUser->status==1)
				                			<td><b class='text text-success'>Active <i class='fa fa-check'></i> </b></td>
				                		@else
				                			<td><b class='text text-warning'>Not Active <i class='fa fa-remove'></i> </b> </td>
				                		@endif
				                		<td>
						        			{{ Form::button('View', ['data-toggle' => 'modal', 'data-target' => '#viewModal'.$displayUser->id, 'type' => 'button', 'class' => 'btn btn-xs btn-info']) }}
						        			{{ Form::button('Update', ['data-toggle' => 'modal', 'data-target' => '#updateModal'.$displayUser->id, 'type' => 'button', 'class' => 'btn btn-xs btn-warning']) }}
					        				{{ Form::button('Delete', ['data-toggle' => 'modal', 'data-target' => '#deleteModal'.$displayUser->id, 'type' => 'button', 'class' => 'btn btn-xs btn-danger']) }}
				                		</td>
				                	</tr>
				                	@endforeach
				                </tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('javascripts')
  <script>
      $(document).ready(function() {

      	var root_url = "<?php echo Request::root(); ?>/";

      	$('.deleteUser').click(function(){
      		var get_ID = this.id;

      		$.ajax({
      			type: "POST",
      			url: root_url+"manageUsers",
      			data: 'delete_ID='+get_ID,
      			success: function(data) {
      				if(data.success) {
      					alert('Account has been deleted successfully.');
      				}
      			}
      		});
      	});

      	$('.updateUser').click(function(){
      		var get_ID = this.id;
      		var status = $('.getStatus'+get_ID).val();

      		$.ajax({
      			type: "POST",
      			url: root_url+"manageUsers",
      			data: 'update_ID='+get_ID+'&status='+status,
      			success: function(data) {
      				if(data.success) {
      					alert('Account Status has been updated successfully.');
      					window.location.reload();
      				}
      			}
      		});
      	});

      });
  </script>
@stop