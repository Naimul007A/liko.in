@section('meta')
<title>{{ $page->name }} school, {{ $page->village }}, {{ $page->block }} taluk school | Liko.In - Schools near you</title>
@stop
@extends('layouts.default')
@section('content') 


  
	<h1>{{ $page->name  }}- {{ $page->village  }} School</h1>
@include('includes.topad')
	<p>{{ $page->name  }}, is situated in the village of {{ $page->village  }}, {{ $page->block  }} Block, {{ $page->district  }} District, {{ $page->state  }} State, India.<br></p>	
	<p>{{ $page->name  }}, {{ $page->village  }} school information is as below:.<br></p>
@include('includes.centerad')	
		<p>
		School name: {{ $page->name }}, {{ $page->block }}<br>
		Village : {{ $page->village }}<br>
		Block : {{ $page->block }}<br>
		</p>
		<p>	
		Cluster : {{ $page->cluster }}<br>
		District : {{ $page->district }}<br>
		State : {{ $page->state }}<br>
		Pincode Number : {{ $page->pincode }}<br></p>
@include('includes.middlecontent1')			
	<h2>Management of {{ $page->name }}</h2>
		
		<p>School Code : {{ $page->school_code }}<br>
		Head Master : {{ $page->name_of_the_head_master }}<br>
		Management : {{ $page->management }}<br></p>
	
	<h3>Admissions in {{ $page->name }}</h3>
			
		<p>Category : {{ $page->school_category }}<br>
		Type : {{ $page->type_of_school }}<br>
		Lowest Class : {{ $page->lowest_class_in_school }}<br>
		Highest Class : {{ $page->highest_class_in_school }}<br>
		Medium Of Instruction : {{ $page->medium_of_instructions }}<br>
		<b>Note:</b> All the above {{ $page->name }} information were collected in the year 2011 and you may please approach the {{ $page->name }} for current status.<br>
		</p>
@include('includes.longcontent1')		
	<h3>More Schools</h3>	
		<ul class="listings"> 
		@forelse($relateds as $related)	
			<li><a href="/schools-in-india/{{ $related->slug  }}">{{ $related->name   }}, {{ $related->village  }}</a></li>
		@empty	<h3>No Results</h3> 
		@endforelse 
		</ul>
	<h3>More Blocks</h3>	
		<p> 
		@forelse($items as $item)	
			<a href="/blocks/{{ $item->slug  }}">{{ $item->name   }}</a>&nbsp;&nbsp;| &nbsp;&nbsp;
		@empty	<h3>No Results</h3> 
		@endforelse 
		</p>
@stop				
@section('breadcrumb')	
		<ul class="breadcrumb">
		  <li><a href="{{url('/')}}">Home</a></li>
		  <li><a href="/states">India</a></li>
		  <li><a href="/states/{{ $blockid->state_url }}">{{ $blockid->state_name }}</a></li>
		  <li><a href="/districts/{{ $blockid->district_url }}">{{ $blockid->district_name }}</a></li>
		  <li><a href="/blocks/{{ $blockid->slug }}">{{ $blockid->name }}</a></li>
		  <li>{{ $page->name }}</li>
		</ul>
@stop