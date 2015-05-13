@extends('layouts.index')

@section('title')

@stop

@section('content')
	<div class="container">
	
	<div class="row">
     @if(Session::get('msgsuccess'))
      <div class="alert alert-success fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('msgsuccess') }}</center>
      </div>
      {{ Session::forget('msgsuccess') }}
    @endif
    @if(Session::get('msgfail'))
      <div class="alert alert-danger fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('msgfail') }}</center>
      </div>
      {{ Session::forget('msgfail') }}
    @endif
        <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                    Search Results
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">
<div class="dataTable_wrapper">

        <table   align="center"  class="table table-striped  table-hover" id ="dataTables-example">
       
        <tbody>

     @if(Session::get('noresults'))
    <tr>
        <td colspan='6'>
        <center>{{ Session::get('noresults') }}</center>
        </td>
    </tr>
      {{ Session::forget('noresults') }}
    @endif
  <tr>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
        <td ></td>
    </tr>


            @foreach($displayShows as $displayShow)

            <?php
            $firstDetail = Show::where('title', $displayShow->title)->first();

            ?>

            <!-- Modal-->
             <div class="modal fade" id="viewModal{{ $firstDetail->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				                    <div class="modal-dialog">
				                        <div class="modal-content">
				                            <div class="modal-header">
				                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                                <h4 class="modal-title" id="myModalLabel">{{ $firstDetail->title }}</h4>
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
				                                       <i>{{ $firstDetail->title }}</i>
				                                    </div>
				                                </div> 
				                                <div class='row'>
				                                    <div class='col-lg-3 text-right'>
				                                    {{ Form::label('description_Label', 'Description: ') }}
				                                    </div>
				                                    <div class='col-lg-9'>
				                                       <i>{{ $firstDetail->description }}</i>
				                                    </div>
				                                </div>
				                   
				                                <div class='row'>
				                                    <div class='col-lg-3 text-right'>
				                                        {{ Form::label('videolink_Label', 'Video Link: ') }}
				                                    </div>
				                                    <div class='col-lg-9'>
				                                        <i><a href='{{ $displayShow->video_link }}' target = '_blank'>{{ $firstDetail->video_link }}</a></i>
				                                    </div>
				                                </div>
			                                {{ Form::close() }}
			                                <br>
			                                
			                              
				                            </div>
				                            <div class="modal-footer">
				                                <button type="button" class="deleteAccount btn btn-default" id='{{ $displayShow->id }}' data-dismiss='modal'>Close</button>
				                            </div>
				                        </div>
				                    </div>
				                </div>
				                <!--End Modal-->

                <tr >

                    <td colspan ="5">{{ $firstDetail->title  }}</td>
                    	<td colspan ="2">
                    	{{ Form::button('<i class="fa fa-search"></i>', ['data-toggle' => 'modal', 'data-target' => '#viewModal'.$firstDetail->id, 'type' => 'button', 'class' => 'btn btn-info']) }}
                  		<a href="/lookforcinema/{{$firstDetail->id}}" class="btn btn-primary">
          				
          					Look for Cinema
          				</a>
          				</td>

                </tr>

            @endforeach
        </tbody>
    </table>


    <center>{{ $displayShows->links(); }}</center>
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
