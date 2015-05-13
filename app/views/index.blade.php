
@extends('layouts.index')


@section('title')
 Login
@stop


@section('content')



<div class="container">
    
        <div class="container">
            <div class="menu row">
                <div class="product col-sm-6">
                  <img class="img-responsive" src="/logo.png"> ---CiNex Logo--- 
					         <hr>

                    <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#aboutus">About Us</a></li>
                        <li><a data-toggle="tab" href="#mp">Mobile Payment</a></li>
                        <li><a data-toggle="tab" href="#geosearch">GeoSearch</a></li>
                    </ul>
                    <br>

                  	<div class="tab-content">
                      <div class="tab-pane active" id="aboutus">
                      <h4>CinEx</h4>
                        <p>Want to watch a movie? Don't want to fall in a long line to get your ticket? Don't want to risk using you credit card to buy your ticket online? Then use your cellphone load. That's right, use your Globe network regular load to make your purchase and watch you movie carefree. CinEx - Cinema Express via Text</p>
                    
                      </div>
                      <div class="tab-pane" id="mp"><h4>How to Pay through Mobile?</h4></div>
                      <div class="tab-pane" id="geosearch"><h4>What is GeoSearch?</h4></div>
                     </div>
                  <hr>
                    
                </div>
                <div class="col-sm-6">
                    <div class="productsrow">
                        
                      <?php
                      $shows = Show::groupBy("title")->get();

                      ?>
                      @foreach($shows as $show)
                      <?php
                      $entryCheck  = Entry::where("show_id", $show->id)->count();
                      if($entryCheck==0)
                        continue;

                      $showdetail = Show::where("title", $show->title)->first();
                      ?>
                        <div class="product menu-category">
                            <div class="menu-category-name list-group-item active">{{$showdetail->title}}</div>
                            <div class="product-image">
                                <img class="product-image menu-item list-group-item" src="/posters/{{$showdetail->poster}}">
                            </div> <a href="/lookforcinema/{{$showdetail->id}}" class="menu-item list-group-item"><span class="badge">View Details</span></a>

                        </div>
                        @endforeach
                      


                    </div>
                </div>
            </div>
            <!--/row-->
        </div>
        <!--/container-->

</div>





@stop

@section('modals')


@stop

