
@extends('layouts.index')


@section('title')
	@if(isset($emailPost))
	{{ $emailPost }}
	@endif
@stop


@section('content')
	
<?php
#	$a = User::where("name", "=", "arben")->orWhere("email","=","hombrebueno")->first();
#	echo $a->name;
#	$as = User::where("name", "=", "arben")->orWhere("email","=","hombrebueno")->get();
#	foreach($as as $a){
#	$a->name
#	}
#	$a = array();
	
#	$a[]= 4;
	

	?>
@stop

