@section('meta')
<title>Find a School in U.S.A (United States of America) Schools list | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content') 
	<h1>Schools in U.S.A (United States of America)</h1>
@include('includes.topad')	
		<ul class="double li"> 
		@forelse($items as $item)	
			<li><a href="/usa-states/{{ $item->slug }}">{{ $item->name }}</a></li>
		@empty	<h3>No Results</h3> 
		@endforelse 
		</ul>
@stop				
@section('breadcrumb')	
		<ul class="breadcrumb">
		  <li><a href="{{url('/')}}">Home</a></li>
		  <li>School in U.S.A</li>
		</ul>	

@stop