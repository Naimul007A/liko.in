@section('meta')
<title>Find a School in India - State wise schools list | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content')
	<h1>Find a School in India- States List</h1>
@include('includes.topad')	
		<p>Select a State</p>
@include('includes.centerad')		
		<ul class="double li"> 
		@forelse($items as $item)	
			<li><a href="/states/{{ $item->slug }}">Schools in {{ $item->name }}</a></li>
		@empty	<h3>No Results</h3> 
		@endforelse 
		</ul>
@stop				
@section('breadcrumb')	
		<ul class="breadcrumb">
		  <li><a href="{{url('/')}}">Home</a></li>
		  <li>India</li>
		</ul>
@stop