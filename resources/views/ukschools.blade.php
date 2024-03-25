@section('meta')
<title>Find a School in U.K All Schools list | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content') 
	<h1>Schools in U.K (United Kingdom)</h1>
@include('includes.topad')	
		<p>Browsde by Counties</p>
@include('includes.centerad')	
		<ul class="double li"> 
		@forelse($items as $item)	
			<li><a href="/uk-counties/{{ $item->slug }}">Schools in {{ $item->name }}</a></li>
		@empty	<h3>No Results</h3> 
		@endforelse 
		</ul>
@stop				
@section('breadcrumb')	
		<ul class="breadcrumb">
		  <li><a href="{{url('/')}}">Home</a></li>
		  <li><a href="/uk-counties">U.K Schools</a></li>
		  <li>U.K Schools list</li>
		</ul>
@stop