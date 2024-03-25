@section('meta')
<title>Schools in India Block-wise, select a Block to find schools list | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content') 
	<h1>Schools in India Block-wise </h1>
@include('includes.topad')	
		<p>Schools list of all Blocks in India- select a Block to find schools list</p>
			<div style="overflow-x:auto;">          
				<table>
				<thead>
				<tr>
				<th>Block name</th>
				<th>District</th>
				<th>State</th>
				</tr>
				</thead>
				<tbody>
				@forelse($items as $item)				
					<tr>
					<td><a href="/blocks/{{ $item->slug }}">{{ $item->name }}</a></td>
					<td><a href="/districts/{{ $item->district_url }}">{{ $item->district_name }}</a></td>
					<td>{{ $item->state_name }}</td>
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
		  <li>Blocks</li>
		</ul>
@stop