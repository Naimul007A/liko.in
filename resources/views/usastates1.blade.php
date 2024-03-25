@section('meta')
<title>{{ $page->full_name }} state, County wise schools list | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content') 
	<h1>{{ $page->name }} state Counties list</h1>
@include('includes.topad')	
	<p>Select a County in the state of {{ $page->full_name }} to view all the schools.</p>
@include('includes.centerad')
		<ul class="double li"> 
		@forelse($items as $item)	
			<li><a href="/usa-counties/{{ $item->slug }}">Schools in {{ $item->name }}</a></li> 
		@empty	<h3>No Results</h3> 
		@endforelse 
		</ul>
	{{ $items->links() }}
@stop				
@section('breadcrumb')	
		<ul class="breadcrumb">
		  <li><a href="{{url('/')}}">Home</a></li>
		  <li><a href="/usa-states">School in U.S.A</a></li>
		  <li>{{ $page->full_name }}</li>
		</ul>
@stop