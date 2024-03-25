@section('meta')
<title>{{ $page->name  }}, {{ $page->address  }} | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content')
	<h1>{{ $page->name  }}</h1>
@include('includes.topad')	
	<p>{{ $page->name  }}, is located at {{ $page->address  }}</p>
	<p>Name of the School: <b>{{ $page->name }}</b><br>
		Administered by: {{ $page->runby }}<br>
		Post Box: {{ $page->po }}<br>
		Phone Number: <b>{{ $page->phone }}</b><br>
	</p>
@include('includes.centerad')
	<h3>Location</h3>
	<p>Address: <b>{{ $page->address }}</b><br>
		Postal Zip Code: {{ $page->postal }}<br>
		County : {{ $page->county }}<br>
		State: {{ $page->state }}<br>
		Contact Number: {{ $page->phone }}</p>
@include('includes.middlecontent1')			
	<p>{{ $page->name }} is located in {{ $page->county }}, in United Staes of America (U.S.A) and run by <b>{{ $page->runby }}</b></p>
@include('includes.middlecontent1')		
	<p>Please Note: Updated on 05/08/2016. Contact School or visit {{ $page->name }} website for updated information.</p>
	<h3>More Schools</h3>
	<ul class="double li"> 
		@forelse($relateds as $related)	
		<li><a href="/usa-schools/{{ $related->slug }}">{{ $related->name }}, {{ $related->postal }}</a></li>
		@empty	<h3>No Results</h3> 
		@endforelse 
	</ul>
@include('includes.longcontent1')
	<h3>More Counties</h3>
	<p> 
		@forelse($items as $item)	
		<a href="/usa-counties/{{ $item->slug }}">{{ $item->name }}</a>&nbsp;&nbsp;| &nbsp;&nbsp;
		@empty	<h3>No Results</h3> 
		@endforelse 
	</p>
@stop				
@section('breadcrumb')	
		<ul class="breadcrumb">
		  <li><a href="{{url('/')}}">Home</a></li>
		  <li><a href="/usa-states">School in U.S.A</a></li>
		  <li><a href="/usa-states/{{ $b2->state_url }}">{{ $b2->state }}</a></li>
		  <li><a href="/usa-counties/{{ $b2->slug }}">{{ $b2->name }}</a></li>
		  <li>{{ $page->name }}</li>
		</ul>
@stop