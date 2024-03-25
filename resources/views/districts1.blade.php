@section('meta')
<title>{{ $page->name }} district schools list | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content') 
	<h1>School list {{ $page->name }} district</h1>
@include('includes.topad')	
		<p>Select a Block in {{ $page->name }} district in the state of {{ $page->state }} to view all the schools list</p>
@include('includes.centerad')		
		<ul class="double li"> 
		@forelse($items as $item)	
			<li><a href="/blocks/{{ $item->slug }}">Schools in {{ $item->name }}</a></li>
		@empty	<h3>No Results</h3> 
		@endforelse 
		</ul>
@stop				
@section('breadcrumb')	
		<ul class="breadcrumb">
		  <li><a href="{{url('/')}}">Home</a></li>
		  <li><a href="/states">India</a></li>
		  <li><a href="/states/{{ $page->state_url }}">{{ $page->state_name }}</a></li>
		  <li>{{ $page->name }}</li>
		</ul>
@stop