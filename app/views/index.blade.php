
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
                      
                      ?>
                        <div class="product menu-category">
                            <div class="menu-category-name list-group-item active">Accessories</div>
                            <div class="product-image">
                                <img class="product-image menu-item list-group-item" src="/assets/example/ec_belt.jpg">
                            </div> <a href="#" class="menu-item list-group-item">Belt<span class="badge">£28</span></a>

                        </div>
                      


                    </div>
                </div>
            </div>
            <!--/row-->
        </div>
        <!--/container-->

</div>





@stop

@section('modals')

<div class="modal fade" id="myModal">
	<div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
          <h4 class="modal-title">Log In</h4>
        </div>
        <div class="modal-body">
		  <form method = "POST" action="/login">
          <div class="form-group">
    		<label for="exampleInputEmail1">Email address</label>
    		<input name = 'e-add' class="form-control" id="exampleInputEmail1" placeholder="Enter email" type="email">
  		  </div>
		  <div class="form-group">
		  	<label for="exampleInputPassword1">Password</label>
			<input name = 'pass' class="form-control" id="exampleInputPassword1" placeholder="Password" type="password">
		  </div>
          <p class="text-right"><a href="#">Forgot password?</a></p>
        </div>
        <div class="modal-footer">
          <a href="#" data-dismiss="modal" class="btn">Close</a>
          <input type="submit" class="btn btn-primary" value="Login">
        </div>
		</form>
      </div>
    </div>
</div>
</div>
@stop

