@section('meta')
<title>{{ $page->name }}, {{ $page->address }} | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content') 
	<h1>{{ $page->name  }}</h1>
		<p>{{ $page->name  }}, is located at {{ $page->address  }}</p>	
@include('includes.topad')
		<p>Name of the School: <b>{{ $page->name }}</b><br>
			Type: {{ $page->type }}<br>
			Status: {{ $page->status }}<br>
			Head: {{ $page->head }}<br>
			Phone Number: <b>{{ $page->phone }}</b><br>
		</p>		
@include('includes.centerad')
	<p>Address: <b>{{ $page->address }}</b><br>
		Zip Code: <b>{{ $page->postal }}</b><br>
		Contact Number: {{ $page->phone }}</p>	
	
	<p>{{ $page->type }} named as {{ $page->name }} is located in {{ $page->county }}, in United Kingdom and current status is {{ $page->status }}.<br></p>	
 @include('includes.middlecontent1') 	
	<h3>Location</h3>
	<p>Address: {{ $page->address }}<br>
		Postal Zip Code: {{ $page->postal }}<br>
		County : <b>{{ $page->county }}</b><br>
		GOR: {{ $page->gor }}<br>
		Ward: <b>{{ $page->ward }}</b><br>
		Consituency: {{ $page->constituency }}</p>
@include('includes.longcontent1')		
	<h3>{{ $page->name }} School Information</h3>
			
	<p>Phase: {{ $page->phase }}<br>
		Boarders: {{ $page->boarders }}<br>
		Gender: {{ $page->gender }}<br>
		Religious: {{ $page->religion }}<br>
		</p>
	<p>Please Note: Updated on 05/08/2016. Contact School or visit {{ $page->name }} website for updated information.</p>
	<h3>More Schools</h3>
		<ul class="listings"> 
		@forelse($relateds as $related)	
			<li><a href="/uk-schools/{{ $related->slug }}">{{ $related->name }}, {{ $related->postal }}</a></li>
		@empty	<h3>No Results</h3> 
		@endforelse 
		</ul>
	<h3>More Counties</h3>
		<p> 
		@forelse($items as $item)	
			<a href="/uk-counties/{{ $item->slug }}">{{ $item->name }}</a>@include('includes.centerad')
		@empty	<h3>No Results</h3> 
		@endforelse 
		</p>
@stop				
@section('breadcrumb')	
		<ul class="breadcrumb">
		  <li><a href="{{url('/')}}">Home</a></li>
		  <li><a href="/uk-counties">U.K Schools</a></li>
		  <li><a href="/uk-counties/{{ $page->county_url }}">{{ $page->county }}</a></li>
		  <li>{{ $page->name }}</li>
		</ul>
@stop