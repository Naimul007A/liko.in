@section('meta')
<title>Schools list in India; Find a School in India | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content')
	<h1>Schools list in India; Find a School in India</h1>
@include('includes.topad')	
		<p>More than 1400000 schools are there all over India. Enter the school name in the search box above or browse through the state list.<br>Indian Schools listed Statewise</p>
@include('includes.centerad')		
		<ul class="double li"> 
		@forelse($items as $item)	
			<li><a href="/states/{{ $item->slug }}">Schools in {{ $item->name }}</a></li>
		@empty	<h3>No Results</h3> 
		@endforelse 
		</ul>
@stop