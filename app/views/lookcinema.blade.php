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
                 Establishments
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

    		@if($establishments==NULL)
    		<?php  
    		$show_array = array();
    		$establishment_array = array();
    		?>

            @foreach($displayShows as $displayShow)

            <?php
            $entries = Entry::where("show_id", $displayShow->id)->where('start_timeslot', '>', new DateTime('today'))->orderBy('start_timeslot', 'ASC')->get();
    
            $establishment = Establishment::find($displayShow->establishment_id);
            $establishment_array[] = $establishment->id;
            $show_array[] = $displayShow->id;
            ?>

            <!-- Modal-->
             <div class="modal fade" id="viewModal{{ $establishment->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				                    <div class="modal-dialog">
				                        <div class="modal-content">
				                            <div class="modal-header">
				                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                                <h4 class="modal-title" id="myModalLabel">{{ $establishment->name }}</h4>
				                            </div>
				                            <div class="modal-body">
				                            <center>
				                            	<img class="img-thumbnail" src="{{ $displayShow->poster }}" style="width:50%"/>
				                            </center>
				                            <br>
				                            {{ Form::open(['class' => 'form-horizontal']) }}
				                                <div class='row'>
				                                    <div class='col-lg-3 text-right'>
				                                    {{ Form::label('title_Label', 'Location: ') }}
				                                    </div>
				                                    <div class='col-lg-9'>
				                                       <i>{{ $establishment->address }}</i>
				                                    </div>
				                                </div>
				                                 <br>
				                                  <br>
				                                <?php 
				                                $cinemaCheck = null;
				                                ?>
				                                @foreach($entries as $entry)
				                                @if($cinemaCheck!=$entry->cinema_id)
				                                <?php
				                                $cinemaCheck = $entry->cinema_id;
				                                $cinemaLook = Cinema::find($entry->cinema_id);
				                                ?>
				                                <div class='row'>
				                                    <div class='col-lg-3 text-right'>
				                                    {{ Form::label('title_Label', 'Cinema: ') }}
				                                    </div>
				                                    <div class='col-lg-9'>
				                                       <i>{{ $cinemaLook->name }}</i>
				                                    </div>
				                                </div>
				                                <br>
				                                @endif
				                                <div class='row'>
				                                    <div class='col-lg-4'>
				                                   {{ Form::open(['type' => 'POST', 'url' => '/buy']) }}
									
													<input type="hidden" name="entry_id" value="{{$entry->id}}">
						                			{{ Form::number('amount', 1, ['class' => '', 'placeholder' => 'amount', 'required' => '', 'style' => 'width: 30px']) }}
						                			<select name="mode">
						                				<option value="mobile" selected>Globe Load</option>
						                				<option value="credit">Credit Card</option>
						                			</select>
						                			<button class="btn btn-xs btn-default" type="submit">
                                    				Buy
                                					</button>
						 
						        					{{ Form::close() }}
				                                    </div>
				                                    <div class='col-lg-8'>
				                                       <b><?php
				                                       $reserved = Reservation::where("entry_id", $entry->id)->count();
				                                       $cinemalimit = Cinema::find($entry->cinema_id);

				                                      	echo ($cinemalimit->seat_rows*$cinemalimit->seat_columns) - $reserved;
				                                       ?> seats</b>&nbsp;<i>{{ $entry->start_timeslot }}  -  {{$entry->end_timeslot}}</i>
				                                    </div>
				                                </div>
				                                <br>
				                                @endforeach
				                                <?php
  												$text = strtolower(htmlentities($establishment->address)); 
    											$text = str_replace(get_html_translation_table(), "-", $text);
    											$text = str_replace(" ", "+", $text);
    											$text = preg_replace("/[-]+/i", "+", $text);

				                                ?>

				                                <br><br>
				                                <div class="row">
				                                	<iframe
  													width="500"
  													height="450"
  													frameborder="0" style="border:0"
  													src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCrqM3MFU1zftmI_est6qd4zvakbt8mn-4&q={{$text}}">
													</iframe>
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
                    <td colspan ="5">{{ $establishment->address  }}</td>
                    	<td colspan ="2">
                    	{{ Form::button('<i class="fa fa-search"></i>', ['data-toggle' => 'modal', 'data-target' => '#viewModal'.$establishment->id, 'type' => 'button', 'class' => 'btn btn-info']) }}
          				</td>
                </tr>

            @endforeach

			@else

			<?php  
		
    		$establishment_array= Session::get('establishment_arrays');
    		$show_array = Session::get('show_arrays');

    		?>


            @foreach($establishments as $establishment)

            <?php
            $displayShow = Show::where('establishment_id', $establishment->id)->whereIn('id', $show_array )->first();
            $entries = Entry::where("show_id", $displayShow->id)->where('start_timeslot', '>', new DateTime('today'))->orderBy('start_timeslot', 'ASC')->get();
    
        
            $establishment_array[] = $establishment->id;
            $show_array[] = $displayShow->id;
            ?>

            <!-- Modal-->
             <div class="modal fade" id="viewModal{{ $establishment->id }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
				                    <div class="modal-dialog">
				                        <div class="modal-content">
				                            <div class="modal-header">
				                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				                                <h4 class="modal-title" id="myModalLabel">{{ $establishment->name }}</h4>
				                            </div>
				                            <div class="modal-body">
				                            <center>
				                            	<img class="img-thumbnail" src="{{ $displayShow->poster }}" style="width:50%"/>
				                            </center>
				                            <br>
				                        		<div class='row'>
				                                    <div class='col-lg-3 text-right'>
				                                    {{ Form::label('title_Label', 'Location: ') }}
				                                    </div>
				                                    <div class='col-lg-9'>
				                                       <i>{{ $establishment->address }} {{$establishment->distance}}</i>
				                                    </div>
				                                </div>
				                                 <br>
				                                  <br>
				                                <?php 
				                                $cinemaCheck = null;
				                                ?>
				                                @foreach($entries as $entry)
				                                @if($cinemaCheck!=$entry->cinema_id)
				                                <?php
				                                $cinemaCheck = $entry->cinema_id;
				                                $cinemaLook = Cinema::find($entry->cinema_id);
				                                ?>
				                                <div class='row'>
				                                    <div class='col-lg-3 text-right'>
				                                    {{ Form::label('title_Label', 'Cinema: ') }}
				                                    </div>
				                                    <div class='col-lg-9'>
				                                       <i>{{ $cinemaLook->name }}</i>
				                                    </div>
				                                </div>
				                                <br>
				                                @endif
				                                <div class='row'>
				                                    <div class='col-lg-4 text-right'>
				                                    {{ Form::open(['type' => 'POST', 'url' => '../buy' ]) }}
													<input type="hidden" name="entry_id" value="{{$entry->id}}">
						                			{{ Form::number('amount', 1, ['class' => '', 'placeholder' => 'amount', 'required' => '', 'style' => 'width: 30px']) }}
						                			<select name="mode">
						                				<option value="mobile" selected>Globe Load</option>
						                				<option value="credit">Credit Card</option>
						                			</select>
						 							<button class="btn btn-xs btn-default" type="submit">
                                    				Buy
                                					</button>
						        					{{ Form::close() }}
				                                    </div>
				                                    <div class='col-lg-8'>
				                                       <b><?php
				                                       $reserved = Reservation::where("entry_id", $entry->id)->count();
				                                       $cinemalimit = Cinema::find($entry->cinema_id);

				                                      	echo ($cinemalimit->seat_rows*$cinemalimit->seat_columns) - $reserved;
				                                       ?> seats</b>&nbsp;<i>{{ $entry->start_timeslot }}  -  {{$entry->end_timeslot}}</i>
				                                    </div>
				                                </div>
				                                <br>
				                                @endforeach
				                                <?php
  												$text = strtolower(htmlentities($establishment->address)); 
    											$text = str_replace(get_html_translation_table(), "-", $text);
    											$text = str_replace(" ", "+", $text);
    											$text = preg_replace("/[-]+/i", "+", $text);

				                                ?>

				                                <br><br>
				                                <div class="row">
				                                	<iframe
  													width="500"
  													height="450"
  													frameborder="0" style="border:0"
  													src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCrqM3MFU1zftmI_est6qd4zvakbt8mn-4&q={{$text}}">
													</iframe>
				                                </div>

			                      
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
                    <td colspan ="5">{{ $establishment->address  }}</td>
                    	<td colspan ="2">
                    	{{ Form::button('<i class="fa fa-search"></i>', ['data-toggle' => 'modal', 'data-target' => '#viewModal'.$establishment->id, 'type' => 'button', 'class' => 'btn btn-info']) }}
          				</td>
                </tr>

            @endforeach

            @endif




        </tbody>
    </table>

    @if($establishments==NULL)
    <center>{{ $displayShows->links(); }}</center>
  
    @endif
    </div>
<?php
			Session::put('establishment_arrays', $establishment_array);
    		Session::put('show_arrays', $show_array);
?>
   
</div>
</div>
</div>
</div>
</div>
 <div class="col-lg-6">
            <div class="panel panel-default">
                <div class="panel-heading" align='center'>
                 Search the Nearest Cinema
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12" align="center">
						{{ Form::open(['type' => 'POST', 'url' => '/geosearch', 'class' => 'form-horizontal', 'files' => true]) }}
						        <div class="form-group">
						          	<div class="col-lg-3 col-md-offset-1">
										{{ Form::label('title_Label', 'Your Location: ') }}
									</div>
									<div class="col-lg-6">
						                {{ Form::text('address', null, ['class' => 'form-control  ', 'placeholder' => 'Address', 'required' => '']) }}
						                <p class='text text-danger'>{{ $errors->first('address') }}</p>
						        	</div>
						        </div>
						        
						        <div class="col-lg-12" align="center">
						            <input type="submit" class="btn btn-success left-sbs" name="showSubmit" value="Geosearch">
						        </div>
						        {{ Form::close() }}
                        </div>
                       
                        <br>
                        <br>
                  
                    </div>
                </div>


             </div>
                   @if(Session::get('addresstext'))
                        <div class="row">

                        	<div>
                        	<iframe
  													width="450"
  													height="400"
  													frameborder="0" style="border:0"
  													src="https://www.google.com/maps/embed/v1/place?key=AIzaSyCrqM3MFU1zftmI_est6qd4zvakbt8mn-4&q={{Session::get('addresstext')}}">
													</iframe>
												</div>
                        </div>
                        @endif
</div>
</div>
@stop

@section('javascripts')

	
@stop
