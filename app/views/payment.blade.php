
@extends('layouts.index')


@section('title')
 Login
@stop


@section('content')



<div class="container">
    
        <div class="container">
         
<?php
$entry = Entry::find(Session::get('saved_entry_id'));
$show = Show::find($entry->show_id);
?>


    @if(Session::get('success'))
      <div class="alert alert-success fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
        <center>{{ Session::get('success') }}</center>
      </div>
      {{ Session::forget('success') }}
    @endif
            
<script src="https://api.paymentwall.com/brick/brick.1.3.js"> </script>
<div id="payment-form-container" align="center"> </div>
<script>
  var brick = new Brick({
    public_key: 't_a5d310fbf88ffd50c2073ebad4faa4',
    amount: <?php echo $entry->price; ?>,
    currency: 'PHP',
    container: 'payment-form-container',
    action: '/billing',
    form: {
      merchant: 'CinEx',
      product: '<?php echo $show->title; ?>'
    }
  });

  brick.showPaymentForm(function(data) {
    // handle success
  }, function(errors) {
    // handle errors
  });
</script>
        </div>
        <!--/container-->

</div>





@stop

@section('modals')


@stop

