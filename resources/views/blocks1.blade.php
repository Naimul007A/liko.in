@section('meta')
<title>{{ $page->name  }} block, {{ $page->district_name  }} Schools List | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content')
	<h1>{{ $page->name  }} block, {{ $page->district_name  }} Schools List</h1>
@include('includes.topad')	
	<p>Schools list located in {{ $page->name  }}, in the {{ $page->district }} district in the state of {{ $page->state }}</p>
@include('includes.centerad')
		<div style="overflow-x:auto;">          
				<table>
				<thead>
				<tr>
				<th>School name</th>
				<th>Village</th>
				<th>Cluster</th>
				<th>Pin Code</th>
				</tr>
				</thead>
				<tbody>
				@forelse($items as $item)				
					<tr>
					<td><a href="/schools-in-india/{{ $item->slug }}">{{ $item->name }}</a></td>
					<td>{{ $item->village }}</td>
					<td>{{ $item->cluster }}</td>
					<td>{{ $item->pincode }}</td>
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
		  <li><a href="/states/{{ $page->state_url }}">{{ $page->state_name }}</a></li>
		  <li><a href="/districts/{{ $page->district_url }}">{{ $page->district_name }}</a></li>
		  <li>{{ $page->name }}</li>
		</ul>
@stop