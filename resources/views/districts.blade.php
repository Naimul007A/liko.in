@section('meta')
<title>Find a School in India - select a District to find schools list | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content')  
	<h1>Find a School in India - select a District to find schools list</h1>
@include('includes.topad')	
		<p>Indian Schools listed Districtwise</p>
@include('includes.centerad')
		<ul class="listings"> 
		@forelse($items as $item)	
			<li><a href="/districts/{{ $item->slug }}">{{ $item->name }}, {{ $item->state_name }}</a></li>
		@empty	<h3>No Results</h3> 
		@endforelse 
		</ul>
{{ $items->links() }}
@stop				
@section('breadcrumb')
		<ul class="breadcrumb">
		  <li><a href="{{url('/')}}">Home</a></li>
		  <li>Districts</li>
		</ul>
@stop