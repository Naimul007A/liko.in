@section('meta')
<title>List of Schools {{ $page->name }} County in U.K | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content') 
		<h1>List of Schools {{ $page->name }} County in U.K</h1>
@include('includes.topad')
		<div style="overflow-x:auto;">          
				<table>
				<thead>
				<tr>
				<th>School name</th>
				<th>Address</th>
				<th>Phone</th>
				</tr>
				</thead>
				<tbody>
				@forelse($items as $item)				
					<tr>
					<td><a href="/uk-schools/{{ $item->slug }}">{{ $item->name }}</a></td>
					<td>{{ $item->address }}</td>
					<td>{{ $item->phone }}</td>
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
		  <li><a href="/uk-counties">U.K Schools</a></li>
		  <li>{{ $page->name }}</li>
		</ul>
@stop