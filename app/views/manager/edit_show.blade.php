@extends('layouts.index')

@section('title')
    Show & Entries Management
@stop

@section('content')
	<div class="container">
		<div class="row">
			<div class="col-lg-12">

			</div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Edit Show
					</div>
					<div class="panel-body">
						<!--Title-->
						@foreach($displayEditShows as $displayEditShow)
						{{ Form::open(['type' => 'POST', 'url' => 'manager/shows/edit/'.$displayEditShow->id, 'class' => 'form-horizontal', 'files' => true]) }}
				        <div class="form-group">
				          	<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('title_Label', 'Show Title: ') }}
							</div>
							<div class="col-lg-6">
				                {{ Form::text('title', $displayEditShow->title, ['class' => 'form-control  ', 'placeholder' => 'Show Title (maximum of 50 characters)']) }}
				                <p class='text text-danger'>{{ $errors->first('title') }}</p>
				        	</div>
				        </div>
				        <!--Description-->
				        <div class="form-group">
				        	<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('description_Label', 'Description: ') }}
							</div>
							<div class="col-lg-6">
								{{ Form::textarea('description', $displayEditShow->description, ['class' => 'form-control', 'required' => '', 'size' => '30x6', 'placeholder' => 'Brief Description (minimum of 15 characters, maximum of 250)', 'autocomplete' => 'off', 'style' => 'resize:none']) }}
								<p class='text text-danger'>{{ $errors->first('description') }}</p>
				        	</div>
				        </div>
				        <!--Video Link-->
				        <div class="form-group">
				      		<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('videolink_Label', 'Video Link: ') }}
							</div>
							<div class="col-lg-6">
				                {{ Form::url('video_link', $displayEditShow->video_link, ['class' => 'form-control ', 'placeholder' => 'Video Link (valid URL)']) }}
				                <p class='text text-danger'>{{ $errors->first('video_link') }}</p>
				        	</div>
				        </div>
				        <!--Poster Link-->
				        <div class="form-group">
				      		<div class="col-lg-3 col-md-offset-1">
								{{ Form::label('poster_Label', 'Poster Image: ') }}
							</div>
							<div class="col-lg-6">
								<!--
				                {{ Form::url('poster_link', null, ['class' => 'form-control ', 'placeholder' => 'Poster Link (valid URL)']) }}
				                -->
				                {{ Form::file('poster', ['class' => 'form-control', 'accept' => 'image/*', 'value' => $displayEditShow->poster, 'required']) }}
				                <p class='text text-danger'>{{ $errors->first('poster') }}</p>
				        	</div>
				        </div>
				        <div class="col-lg-12" align="center">
				            <input type="submit" class="btn btn-warning left-sbs sbmt" value="Edit Show">
				        </div>
				        {{ Form::close() }}
				        @endforeach
					</div>
				</div>
			</div>
		</div>
	</div>
@stop