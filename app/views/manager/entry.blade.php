@extends('layouts.index')

@section('title')

@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-8 col-md-offset-2">
				@if(Session::get('success'))
					<div class='alert alert-success successAlert'>
						<center>{{ Session::get('success') }}</center>
					</div>
				@endif
				{{ Session::forget('success') }}

				<div class='alert alert-success deleteAlert' style='display:none'>
					<center>Entry has been deleted.</center>
				</div>
			</div>
			<div class="col-lg-8 col-md-offset-2">
				<div class='panel panel-default'>
					<div class='panel-body'>
						<h2 class="page-header"><i class='fa fa-film'></i> Manage Entries </h2>
						<i class='fa fa-exclamation-circle'></i> You may manage entries under each shows.
						<br><br>
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class='fa fa-film'></i> Entries Table
							</div>
							<div class="panel-body">
								@foreach($displayEntries as $displayEntry)

								<!--- View Show Modals -->
				                <div class="modal fade" id="viewModal{{ $displayEntry->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				                    <div class="modal-dialog">
				                        <div class="modal-content">
				                            <div class="modal-header">
				                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                                <h4 class="modal-title" id="myModalLabel">Entry for {{ $displayEntry->title }}</h4>
				                            </div>
				                            <div class="modal-body">
					                            {{ Form::open(['class' => 'form-horizontal']) }}
					                                <div class='row'>
					                                    <div class='col-lg-3 text-right'>
					                                    {{ Form::label('title_Label', 'Show Title: ') }}
					                                    </div>
					                                    <div class='col-lg-9'>
					                                       <i>{{ $displayEntry->title }}</i>
					                                    </div>
					                                </div> 
					                                <div class='row'>
					                                    <div class='col-lg-3 text-right'>
					                                    {{ Form::label('description_Label', 'Description: ') }}
					                                    </div>
					                                    <div class='col-lg-9'>
					                                       <i>{{ $displayEntry->description }}</i>
					                                    </div>
					                                </div>
					                                <br>
					                                <div class='row'>
					                                    <div class='col-lg-3 text-right'>
					                                        {{ Form::label('price_Label', 'Price: ') }}
					                                    </div>
					                                    <div class='col-lg-9'>
					                                        <i>{{ $displayEntry->price }}</i>
					                                    </div>
					                                </div>
					                                <div class='row'>
					                                    <div class='col-lg-3 text-right'>
					                                    {{ Form::label('start_Label', 'Start Time Slot: ') }}
					                                    </div>
					                                    <div class='col-lg-9'>
					                                       <i>{{ date('m/d g:ia', strtotime($displayEntry->start_timeslot))}}</i>
					                                    </div>
					                                </div> 
					                                <div class='row'>
					                                    <div class='col-lg-3 text-right'>
					                                    {{ Form::label('end_Label', 'End Time Slot: ') }}
					                                    </div>
					                                    <div class='col-lg-9'>
					                                       <i>{{ date('m/d g:ia', strtotime($displayEntry->end_timeslot)) }}</i>
					                                    </div>
					                                </div> 
				                                {{ Form::close() }}
				                            </div>
				                            <div class="modal-footer">
				                                <button type="button" class="deleteAccount btn btn-default" id='{{ $displayEntry->id }}' data-dismiss='modal'>Close</button>
				                            </div>
				                        </div>
				                    </div>
				                </div>
				                <!--- END - View Show Modals -->

				                <!--- Delete Show Modals -->
				                <div class="modal fade" id="deleteModal{{ $displayEntry->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				                    <div class="modal-dialog">
				                        <div class="modal-content">
				                            <div class="modal-header">
				                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                                <h4 class="modal-title" id="myModalLabel"><i class='fa fa-remove'></i> Delete Entry</h4>
				                            </div>
				                            <div class="modal-body">
				                            	Do you want to <label class='text text-danger'>permanently delete</label> this entry?
				                            </div>
				                            <div class="modal-footer">
				                                <button type="button" class="deleteEntry btn btn-danger" id='{{ $displayEntry->id }}' data-dismiss='modal'>Delete</button>
				                            </div>
				                        </div>
				                    </div>
				                </div>
				                <!--- END - Delete Show Modals -->

				                @endforeach

								<div class="dataTable_wrapper">
									<table class="table table-striped  table-hover" id ="dataTables-example">
						                <thead>
							                <tr>
							                    <th>Entry's Show</th>
							                    <th>Entry Price</th>
							                    <th>Start Time Slot</th>
							                    <th>End Time Slot</th>
							                    <th>Action</th>
							                </tr>
						                </thead>
						                <tbody>
						                	@foreach($displayEntries as $displayEntry)
						                	<tr id = 'removeRow{{ $displayEntry->id }}'>
						                		<td id = 'getShowTitle{{ $displayEntry->id }}'>{{$displayEntry->title }}</td>
						                		<td>{{ $displayEntry->price }}</td>
						                		<td>{{ date('m/d g:ia', strtotime($displayEntry->start_timeslot))}}</td>
						                		<td>{{ date('m/d g:ia', strtotime($displayEntry->end_timeslot)) }}</td>
						                		<td>
					        						{{ Form::button('<i class="fa fa-search"></i>', ['data-toggle' => 'modal', 'data-target' => '#viewModal'.$displayEntry->id, 'type' => 'button', 'class' => 'btn btn-info']) }}
					        						<a href = "entries/edit/{{$displayEntry->id}}">
					        						<button class='btn btn-warning'><i class='fa fa-pencil-square-o'></i> </button>
					        						</a>
					        						{{ Form::button('<i class="fa fa-remove"></i>', ['data-toggle' => 'modal', 'data-target' => '#deleteModal'.$displayEntry->id, 'type' => 'button', 'class' => 'btn btn-danger']) }}
					        						</a>
						                		</td>
						                	</tr>
						                	@endforeach
						                </tbody>
									</table>
								</div>
								<center>{{ $displayEntries->links(); }}</center>
							</div>
							<div class='panel-footer'>
								<div style='overflow:hidden'>
									<div style='float:right'>

									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@stop

@section('javascripts')

	<script>
		$(document).ready(function(){

			var root_url = "<?php echo Request::root(); ?>/";

			$('.deleteEntry').click(function(){
				var get_ID = this.id;
				$.ajax({
					type: "POST",
					url: root_url+'manager/entries',
					data: 'delete_ID='+get_ID,
					success: function(data) {
						if(data.success) {
							$('#removeRow'+get_ID).hide();
							$('.deleteAlert').attr('style', "");
							$('.successAlert').attr('style', "display:none");
						}
					}
				});
			});
		});
	</script>
@stop
