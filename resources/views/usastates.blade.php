@section('meta')
<title>Find a School in U.S.A, Select a State | Liko.In - Schools near you</title>
@extends('layouts.default')
@section('content')
	<h1>Find a School in U.S.A </h1>
@include('includes.topad')	
		<p>Select a State</p>
@include('includes.centerad')		
		<ul class="double li"> 
		@forelse($items as $item)	
			<li><a href="/usa-states/{{ $item->slug }}">Schools in {{ $item->full_name }}</a></li>
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