@extends('layouts.index')

@section('title')
    Show & Entries Management
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				@if(Session::get('success'))
					<div class='alert alert-success successAlert'>
						<center>{{ Session::get('success') }}</center>
					</div>
				@endif
				{{ Session::forget('success') }}

				<div class='alert alert-success deleteAlert' style='display:none'>
					<center>Show has been deleted.</center>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Shows & Entries
					</div>
					<div class="panel-body">

						@foreach($displayShows as $displayShow)

						<!--- View Show Modals -->
		                <div class="modal fade" id="viewModal{{ $displayShow->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		                    <div class="modal-dialog">
		                        <div class="modal-content">
		                            <div class="modal-header">
		                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                                <h4 class="modal-title" id="myModalLabel">{{ $displayShow->title }}</h4>
		                            </div>
		                            <div class="modal-body">
		                            {{ Form::open(['class' => 'form-horizontal']) }}
		                                <div class='row'>
		                                    <div class='col-lg-3 text-right'>
		                                    {{ Form::label('title_Label', 'Show Title: ') }}
		                                    </div>
		                                    <div class='col-lg-9'>
		                                       <i>{{ $displayShow->title }}</i>
		                                    </div>
		                                </div> 
		                                <div class='row'>
		                                    <div class='col-lg-3 text-right'>
		                                    {{ Form::label('description_Label', 'Description: ') }}
		                                    </div>
		                                    <div class='col-lg-6'>
		                                       <i>{{ $displayShow->description }}</i>
		                                    </div>
		                                </div>
		                                <br>
		                                <div class='row'>
		                                    <div class='col-lg-3 text-right'>
		                                        {{ Form::label('videolink_Label', 'Video Link: ') }}
		                                    </div>
		                                    <div class='col-lg-6'>
		                                        <i><a href='{{ $displayShow->video_link }}' target = '_blank'>{{ $displayShow->video_link }}</a></i>
		                                    </div>
		                                </div>
		                                <div class='row'>
		                                    <div class='col-lg-3 text-right'>
		                                    {{ Form::label('posterlink_Label', 'Poster Link: ') }}
		                                    </div>
		                                    <div class='col-lg-6'>
		                                       <i><a href='{{ $displayShow->poster }}' target = '_blank'>{{ $displayShow->poster }}</a></i>
		                                    </div>
		                                </div> 
	                                {{ Form::close() }}
	                                <br>
	                                <h6 class='text text-danger'><b>Created Last: {{ date('F d, Y g:ia', strtotime($displayShow->created_at)) }} </b></h6>
		                            </div>
		                            <div class="modal-footer">
		                                <button type="button" class="deleteAccount btn btn-default" id='{{ $displayShow->id }}' data-dismiss='modal'>Close</button>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <!--- END - View Show Modals -->

		                <!--- Delete Show Modals -->
		                <div class="modal fade" id="deleteModal{{ $displayShow->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		                    <div class="modal-dialog">
		                        <div class="modal-content">
		                            <div class="modal-header">
		                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
		                                <h4 class="modal-title" id="myModalLabel"><i class='fa fa-remove'></i> Delete Show</h4>
		                            </div>
		                            <div class="modal-body">
		                            	Do you want to <label class='text text-danger'>permanently delete</label> this show (<label>{{ $displayShow->title }}</label>)?
		                            </div>
		                            <div class="modal-footer">
		                                <button type="button" class="deleteShow btn btn-danger" id='{{ $displayShow->id }}' data-dismiss='modal'>Delete</button>
		                            </div>
		                        </div>
		                    </div>
		                </div>
		                <!--- END - Delete Show Modals -->

		                @endforeach

						<div class="dataTable_wrapper">
							<table class="table table-striped table-hover" id ="dataTables-example">
				                <thead>
					                <tr>
					                    <th>Title</th>
					                    <th>Description</th>
					                    <th colspan='3' width='30%'>Action</th>
					                </tr>
				                </thead>
				                <tbody>
				                	@foreach($displayShows as $displayShow)
				                	<tr id = 'removeRow{{ $displayShow->id }}'>
				                		<td>{{$displayShow->title }}</td>
				                		<td>{{$displayShow->description }}</td>
				                		<td>
			        						{{ Form::button('<i class="fa fa-search"></i>', ['data-toggle' => 'modal', 'data-target' => '#viewModal'.$displayShow->id, 'type' => 'button', 'class' => 'btn btn-info']) }}
			        						<a href = "showsentries/edit/{{$displayShow->id}}">
			        						<button class='btn btn-warning'><i class='fa fa-pencil-square-o'></i> </button>
			        						</a>
			        						{{ Form::button('<i class="fa fa-remove"></i>', ['data-toggle' => 'modal', 'data-target' => '#deleteModal'.$displayShow->id, 'type' => 'button', 'class' => 'btn btn-danger']) }}
			        						</a>
				                		</td>
				                	</tr>
				                	@endforeach
				                </tbody>
							</table>
						</div>
						<center>{{ $displayShows->links(); }}</center>
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Add Shows & Entries
					</div>
					<div class="panel-body">
						<!--Title-->
						{{ Form::open(['type' => 'POST', 'url' => 'manager/showsentries', 'class' => 'form-horizontal']) }}
				        <div class="form-group">
				          	<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('title_Label', 'Show Title: ') }}
							</div>
							<div class="col-lg-6">
				                {{ Form::text('title', null, ['class' => 'form-control  ', 'placeholder' => 'Show Title (maximum of 50 characters)']) }}
				                <p class='text text-danger'>{{ $errors->first('title') }}</p>
				        	</div>
				        </div>
				        <!--Description-->
				        <div class="form-group">
				        	<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('description_Label', 'Description: ') }}
							</div>
							<div class="col-lg-6">
								{{ Form::textarea('description', null, ['class' => 'form-control', 'required' => '', 'size' => '30x6', 'placeholder' => 'Brief Description (minimum of 15 characters, maximum of 250)', 'autocomplete' => 'off', 'style' => 'resize:none']) }}
								<p class='text text-danger'>{{ $errors->first('description') }}</p>
				        	</div>
				        </div>
				        <!--Video Link-->
				        <div class="form-group">
				      		<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('videolink_Label', 'Video Link: ') }}
							</div>
							<div class="col-lg-6">
				                {{ Form::url('video_link', null, ['class' => 'form-control ', 'placeholder' => 'Video Link (valid URL)']) }}
				                <p class='text text-danger'>{{ $errors->first('video_link') }}</p>
				        	</div>
				        </div>
				        <!--Poster Link-->
				        <div class="form-group">
				      		<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('posterlink_Label', 'Poster Link: ') }}
							</div>
							<div class="col-lg-6">
				                {{ Form::url('poster_link', null, ['class' => 'form-control ', 'placeholder' => 'Poster Link (valid URL)']) }}
				                <p class='text text-danger'>{{ $errors->first('poster_link') }}</p>
				        	</div>
				        </div>
				        <div class="col-lg-12" align="center">
				            <input type="submit" class="btn btn-success left-sbs sbmt" value="Add Show">
				        </div>
				        {{ Form::close() }}
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

			$('.deleteShow').click(function(){
				var get_ID = this.id;
				$.ajax({
					type: "POST",
					url: root_url+'manager/showsentries',
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
