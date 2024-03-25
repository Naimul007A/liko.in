@section('meta')
<title>Search Results for "{{ $q }}" | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content')
     <h1>Search Results for "{{ $q }}"</h1>
@include('includes.topad')	 
		<ul class="listings">
		@forelse($posts as $post)
		 <li><a href="/{{ $post->url }}{{ $post->slug }}">{{ $post->name }}</a></li>
		@empty
			<h3>No Results</h3>
		@endforelse
		</ul>
@stop
