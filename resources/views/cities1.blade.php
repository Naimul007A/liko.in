@section('meta')
<title>{{ $page->name }} city schools list | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content') 
 
	<h1>School list {{ $page->name }} city</h1>
@include('includes.topad')	
		<p>Select a Pin Code in {{ $page->name }} city in the state of {{ $page->state }} to view all the schools list</p>
@include('includes.centerad')		
		<p> 
		@forelse($items as $item)	
			<a href="/pincodes/{{ $item->slug }}">{{ $item->pin_code }}</a>&nbsp;&nbsp;| &nbsp;&nbsp;
		@empty	<h3>No Results</h3> 
		@endforelse 
		</p>
@stop				
@section('breadcrumb')	
		<ul class="breadcrumb">
		  <li><a href="{{url('/')}}">Home</a></li>
		  <li><a href="/states">India</a></li>
		  <li><a href="/states/{{ $page->state_url }}">{{ $page->state }}</a></li>
		  <li>{{ $page->name }}</li>
		</ul>
@stop