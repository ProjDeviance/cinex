@extends('layouts.index')

@section('title')

@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-6">
				<div class='panel panel-default'>
					<div class='panel-body'>
						<h2 class="page-header"><i class='fa fa-rocket'></i> Reserve </h2>
						<i class='fa fa-exclamation-circle'></i> You may reserve shows.
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
				                            <center>
				                            	<img class="img-thumbnail" src="{{ $displayShow->poster }}" style="width:50%"/>
				                            </center>
				                            <br>
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
			                                		{{ $displayEntry->title }} - {{ $displayEntry->price }} - [{{ date('m/d g:ia', strtotime($displayEntry->start_timeslot))}} to {{ date('m/d g:ia', strtotime($displayEntry->end_timeslot)) }}]
			                                		
												{{ Form::open(['type' => 'POST', 'url' => '/manager/reserve']) }}
													<input type="hidden" name="entry_id" value="{{$displayEntry->id}}">
						                			{{ Form::number('amount', 1, ['class' => '', 'placeholder' => 'amount', 'required' => '', 'style' => 'width: 30px']) }}
						                			<button class="btn btn-xs btn-default" type="submit">
                                    				Reserve
                                					</button>
						        				{{ Form::close() }}
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
		</div>
	</div>
@stop

@section('javascripts')

@stop
