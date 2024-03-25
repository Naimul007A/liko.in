@section('meta')
<title>{{ $page->name }} state- District wise schools list | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content') 
		<h1>{{ $page->name }} state Schools</h1>
@include('includes.topad')		
		<p>Select a district in the state of {{ $page->name }} to view all the schools.</p>
@include('includes.centerad')		
		<ul class="double li"> 
		@forelse($items as $item)	
			<li><a href="/districts/{{ $item->slug }}">Schools in {{ $item->name }}</a></li>
		@empty	<h3>No Results</h3> 
		@endforelse 
		</ul>
		<p>Select a City in the state of {{ $page->name }} to view all the schools.</p>
@include('includes.middlecontent1')		
		<p> 
		@forelse($item1s as $item1)	
			<a href="/cities/{{ $item1->slug }}">{{ $item1->name }}</a>&nbsp;&nbsp;| &nbsp;&nbsp;
		@empty	<h3>No Results</h3> 
		@endforelse 
		</p>
@stop				
@section('breadcrumb')	
  		<ul class="breadcrumb">
		  <li><a href="{{url('/')}}">Home</a></li>
		  <li><a href="/states">India</a></li>
		  <li>{{ $page->name }}</li>
		</ul>
@stop