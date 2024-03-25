@section('meta')
<title>Schools in {{ $page->name }} County | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content') 
	<h1>Schools in {{ $page->name }} County</h1>
@include('includes.topad')	
	<p>List of all schools in {{ $page->name }} county, U.S.A. Click the school link to view all details of the schools.</p>
@include('includes.centerad')
	
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
					<td><a href="/usa-schools/{{ $item->slug }}">{{ $item->name }}</a></td>
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
		  <li><a href="/usa-states">School in U.S.A</a></li>
		  <li><a href="/usa-states/{{ $page->state_url }}">{{ $page->state }}</a></li>
		  <li>{{ $page->name }}</li>
		</ul>
@stop