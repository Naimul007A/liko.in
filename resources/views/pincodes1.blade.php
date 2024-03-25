@section('meta')
<title>Schools in {{ $page->name  }}, {{ $page->district }} district | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content')
	<h1>{{ $page->name  }} Schools List</h1>
@include('includes.topad')	
	<p>Schools list located in {{ $page->name  }}, in the {{ $page->district }} district in the state of {{ $page->state }}</p>
@include('includes.centerad')
		<div style="overflow-x:auto;">          
				<table>
				<thead>
				<tr>
				<th>School name</th>
				<th>Village</th>
				<th>Block</th>
				</tr>
				</thead>
				<tbody>
				@forelse($items as $item)				
					<tr>
					<td><a href="/schools-in-india/{{ $item->slug }}">{{ $item->name }}</a></td>
					<td>{{ $item->village }}</td>
					<td>{{ $item->block }}</td>
					</tr>
				@empty	<h3>No Results</h3> @endforelse							
				</tbody>
				</table>
			</div>

  {{ $items->links() }}	
  @stop				
@section('breadcrumb')
		<ul class="breadcrumb">
		  <li><a href="{{url('/')}}">Home</a></li>
		  <li><a href="/states">India</a></li>
		  <li><a href="/states/{{ $page->cities->state_url }}">{{ $page->cities->state }}</a></li>
		  <li><a href="/cities/{{ $page->cities->slug }}">{{ $page->cities->name }}</a></li>
		  <li>{{ $page->pin_code }}</li>
		</ul>
@stop