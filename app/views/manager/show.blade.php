@extends('layouts.index')

@section('title')

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
				<div class='panel panel-default'>
					<div class='panel-body'>
						<h2 class="page-header"><i class='fa fa-film'></i> Manage Shows </h2>
						<i class='fa fa-exclamation-circle'></i> You may manage shows and its entries.
						<br><br>
						<div class="panel panel-default">
							<div class="panel-heading">
								<i class='fa fa-film'></i> Shows Table
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
				                                    <div class='col-lg-9'>
				                                       <i>{{ $displayShow->description }}</i>
				                                    </div>
				                                </div>
				                                <br>
				                                <div class='row'>
				                                    <div class='col-lg-3 text-right'>
				                                        {{ Form::label('videolink_Label', 'Video Link: ') }}
				                                    </div>
				                                    <div class='col-lg-9'>
				                                        <i><a href='{{ $displayShow->video_link }}' target = '_blank'>{{ $displayShow->video_link }}</a></i>
				                                    </div>
				                                </div>
				                                <div class='row'>
				                                    <div class='col-lg-3 text-right'>
				                                    {{ Form::label('posterlink_Label', 'Poster Link: ') }}
				                                    </div>
				                                    <div class='col-lg-9'>
				                                       <i><a href='{{ $displayShow->poster }}' target = '_blank'>{{ $displayShow->poster }}</a></i>
				                                    </div>
				                                </div> 
			                                {{ Form::close() }}
			                                <br>
			                                <div class='panel panel-default'>
			                                	<div class='panel-heading'>
			                                		<i class='fa fa-level-down'></i> Entries for this Show
			                                	</div>
			                                	<div class='panel-body'>
			                                	<?php $count = 0; ?>
			                                	@foreach($displayEntries as $displayEntry)
			                                		@if($displayShow->id == $displayEntry->show_id)
			                                			<li>{{ $displayEntry->title }} - {{ $displayEntry->price }} - [{{ date('m/d g:ia', strtotime($displayEntry->start_timeslot))}} to {{ date('m/d g:ia', strtotime($displayEntry->end_timeslot)) }}]</li>
			                                			<?php $count++; ?>
			                                		@endif
			                                	@endforeach
			                                	@if($count==0)
			                                		<div class='alert alert-danger'>
			                                			<i class='fa fa-remove'></i> There are no entries for this show yet.
			                                		</div>
			                                	@endif
			                                	</div>
			                                </div>
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
									<table class="table table-striped  table-hover" id ="dataTables-example">
						                <thead>
							                <tr>
							                    <th width='30%'>Title</th>
							                    <th width='40%'>Description</th>
							                    <th colspan='3' width='30%'>Action</th>
							                </tr>
						                </thead>
						                <tbody>
						                	@foreach($displayShows as $displayShow)
						                	<tr id = 'removeRow{{ $displayShow->id }}'>
						                		<td id = 'getShowTitle{{ $displayShow->id }}'>{{$displayShow->title }}</td>
						                		<td>{{$displayShow->description }}</td>
						                		<td>
					        						{{ Form::button('<i class="fa fa-search"></i>', ['data-toggle' => 'modal', 'data-target' => '#viewModal'.$displayShow->id, 'type' => 'button', 'class' => 'btn btn-info']) }}
					        						<a href = "shows/edit/{{$displayShow->id}}">
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
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-body">
						<h2 class="page-header"> <i class='fa fa-plus-square'></i> Add Shows & Entries</h2>
                        <ul class="nav nav-tabs">
                        	@if(Session::get('entryActivePanel'))
	                            <li>
	                            	<a href="#shows" data-toggle="tab"><i class='fa fa-plus'></i> Show</a>
	                            </li>
	                            <li class="active">
	                            	<a href="#entries" data-toggle="tab"><i class='fa fa-plus'></i> Entry</a>
	                            </li>
                        	@else
	                            <li class="active">
	                            	<a href="#shows" data-toggle="tab"><i class='fa fa-plus'></i> Show</a>
	                            </li>
	                            <li>
	                            	<a href="#entries" data-toggle="tab"><i class='fa fa-plus'></i> Entry</a>
	                            </li>
                            @endif
                        </ul>
                        <div class="tab-content">
                        	<!--Shows-->
                        	@if(!Session::get('entryActivePanel'))
                            	<div class="tab-pane fade in active" id="shows">
                            @else
                            	<div class="tab-pane fade" id="shows">
                            @endif
                            	<br>
								<!--Title-->
								{{ Form::open(['type' => 'POST', 'url' => 'manager/shows', 'class' => 'form-horizontal']) }}
						        <div class="form-group">
						          	<div class="col-lg-3 col-md-offset-1">
										{{ Form::label('title_Label', 'Show Title: ') }}
									</div>
									<div class="col-lg-6">
						                {{ Form::text('title', null, ['class' => 'form-control  ', 'placeholder' => 'Show Title (max of 50 char.)', 'required' => '']) }}
						                <p class='text text-danger'>{{ $errors->first('title') }}</p>
						        	</div>
						        </div>
						        <!--Description-->
						        <div class="form-group">
						        	<div class="col-lg-3 col-md-offset-1">
										{{ Form::label('description_Label', 'Description: ') }}
									</div>
									<div class="col-lg-6">
										{{ Form::textarea('description', null, ['class' => 'form-control', 'required' => '', 'size' => '30x6', 'placeholder' => 'Brief Description (minimum of 15 characters, maximum of 1500)', 'autocomplete' => 'off', 'style' => 'resize:none']) }}
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
						            <input type="submit" class="btn btn-success left-sbs" name="showSubmit" value="Add Show">
						        </div>
						        {{ Form::close() }}
                            </div>

                            <!--Entries-->
                        	@if(Session::get('entryActivePanel'))
                            	<div class="tab-pane fade in active" id="entries">
                            @else
                            	<div class="tab-pane fade" id="entries">
                            @endif
                            	<br>
								<!--Cinema-->
								{{ Form::open(['type' => 'POST', 'url' => 'manager/shows', 'class' => 'form-horizontal']) }}
						        <div class="form-group">
						          	<div class="col-lg-3 col-md-offset-1">
										{{ Form::label('cinema_Label', 'Cinema: ') }}
									</div>
									<div class="col-lg-6">
										<select name='cinema' class='form-control'>
											@foreach($displayCinemas as $displayCinema)
												<option value='{{ $displayCinema->name }}'>{{ $displayCinema->name }}</option>
											@endforeach
										</select>
						                <p class='text text-danger'>{{ $errors->first('cinema') }}</p>
						        	</div>
						        </div>
								<!--Show-->
						        <div class="form-group">
						          	<div class="col-lg-3 col-md-offset-1">
										{{ Form::label('show_Label', 'Show: ') }}
									</div>
									<div class="col-lg-6">
										<select name='show' class='form-control' id='showSelect'>
											@foreach($displayShows as $displayShow)
												<option value='{{ $displayShow->title }}'>{{ $displayShow->title }}</option>
											@endforeach
										</select>
						                <p class='text text-danger'>{{ $errors->first('show') }}</p>
						        	</div>
						        </div>
						        <!--Price-->
						        <div class="form-group">
						      		<div class="col-lg-3 col-md-offset-1">
										{{ Form::label('price_Label', 'Price: ') }}
									</div>
									<div class="col-lg-6">
										{{ Form::number('price', null, ['class' => 'form-control', 'placeholder' => "Set a price for this show's entry", 'required' => '']) }}
						                <p class='text text-danger'>{{ $errors->first('price') }}</p>
						        	</div>
						        </div>
						        <!--Start TimeSlot-->
						        <div class="form-group">
						      		<div class="col-lg-3 col-md-offset-1">
										{{ Form::label('start_Label', 'Start Time Slot: ') }}
									</div>
									<div class="col-lg-6">
										<div class="input-group date datetimepicker">
							                {{ Form::text('start_timeslot', null, ['class' => 'form-control', 'readonly' => '', 'data-datepicker' => 'datepicker', 'required' => '']) }}
							                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
						                </div>
						                <p class='text text-danger'>{{ $errors->first('start_timeslot') }}</p>
						        	</div>
						        </div>
						        <!--End TimeSlot-->
						        <div class="form-group">
						      		<div class="col-lg-3 col-md-offset-1">
										{{ Form::label('start_Label', 'End Time Slot: ') }}
									</div>
									<div class="col-lg-6">
										<div class="input-group date datetimepicker">
							                {{ Form::text('end_timeslot', null, ['class' => 'form-control', 'readonly' => '', 'data-datepicker' => 'datepicker', 'required' => '']) }}
							                <span class="input-group-addon"><span class="fa fa-calendar"></span></span>							                
						                </div>
						                <p class='text text-danger'>{{ $errors->first('end_timeslot') }}</p>
						        	</div>
						        </div>
						        <div class="col-lg-12" align="center">
						            <input type="submit" class="btn btn-success left-sbs" name="entrySubmit" value="Add Entry">
						        </div>
						        {{ Form::close() }}
						        {{ Session::forget('entryActivePanel') }}
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

			$('.deleteShow').click(function(){
				var get_ID = this.id;
				var get_Show = $('#getShowTitle'+get_ID).html();
				var get_Current = $('#showSelect :selected');
				$.ajax({
					type: "POST",
					url: root_url+'manager/shows',
					data: 'delete_ID='+get_ID,
					success: function(data) {
						if(data.success) {
							$('#removeRow'+get_ID).hide();
							$('.deleteAlert').attr('style', "");
							$('.successAlert').attr('style', "display:none");
							$('#showSelect option[value="'+get_Show+'"]').hide();
							if(get_Current.val() == get_Show) {
								get_Current.remove();
							}
						}
					}
				});
			});
		});
	</script>
@stop
