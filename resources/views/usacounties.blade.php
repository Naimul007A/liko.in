@section('meta')
<title>Find a School in U.S.A (United States of America), County wise schools list | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content') 
	<h1>Find a School in U.S.A (United States of America)</h1>
@include('includes.topad')
		
	<h2>View Counties by State</h2>
		<p> 
		@forelse($item1s as $item1)	
			<a href="/usa-states/{{ $item1->slug }}">{{ $item1->name }}</a>&nbsp;&nbsp;| &nbsp;&nbsp;
		@empty	<h3>No Results</h3> 
		@endforelse 
		</p>
@include('includes.centerad')	
	<h3>Counties List. Select a County</h3>
		<ol> 
		@forelse($items as $item)	
			<li><a href="/usa-counties/{{ $item->slug }}">Schools in {{ $item->name }}, {{ $item->state }}</a></li>
		@empty	<h3>No Results</h3> 
		@endforelse 
		</ol>	
	{{ $items->links() }}
@stop				
@section('breadcrumb')	
	<ul class="breadcrumb">
		  <li><a href="{{url('/')}}">Home</a></li>
		  <li><a href="/usa-states">School in U.S.A</a></li>
		  <li>Counties in U.S.A</li>
		</ul>
@stop