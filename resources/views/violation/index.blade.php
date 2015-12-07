@extends('layouts/page')

@section('pageName','My Violations')

@section('side-bar')
	@include('site._side-bar',['sidebar_active_menu'=>'violations'])
@endsection

@section('top-css')
	<link rel="stylesheet" href="{{url('js/vendor/jplist/css/jplist.core.min.css')}}">
@endsection

@section('extra-js')
	<script src="{{url('/js/vendor/jplist/js/jplist.core.min.js')}}"></script>
	<script src="{{url('/js/vendor/jplist/js/jplist.sort-bundle.min.js')}}"></script>
	<script src="{{url('/js/vendor/jplist/js/jplist.filter-dropdown-bundle.min.js')}}"></script>
	<script src="{{url('/js/vendor/jplist/js/jplist.bootstrap-pagination-bundle.min.js')}}"></script>

	
	<script>
		$('document').ready(function(){
		   //check all jPList javascript options
		   $('#violation-list').jplist({				
		      itemsBox: '.list' 
		      ,itemPath: '.list-item' 
		      ,panelPath: '.jplist-panel'	
		   });
		   
		});
	</script>
@endsection


@section('content')
	<div class="row">
		<div class="col-md-12">
			<h2>Search Violations</h2>
			<p>Theare are <b>{{ $total }}</b> @if($total>1) violations @else violation @endif reported:</p>			
		</div>
	</div>

	<div id="violation-list">
	
		<div class="row">
			<div class="jplist-panel">
				
				<div class="col-md-3 form-group jplist-panel">
					<select class="jplist-select" data-control-type="sort-select" data-control-name="sort" data-control-action="sort">
						<option data-path="default">Sort By</option>
						<option data-path=".date-filter" data-order="asc" data-type="text">Older to Newer</option>
						<option data-path=".date-filter" data-order="desc" data-type="text">Newer to Older</option>
						<option data-path=".state" data-order="asc" data-type="text">State A-Z</option>
						<option data-path=".state" data-order="desc" data-type="text">State Z-A</option>
					</select>
		   		</div>
				<div class="col-md-3 form-group jplist-panel">
					<select class="jplist-select" data-control-type="filter-select" data-control-name="filter" data-control-action="filter">
						<option data-path="default">Filter By</option>
						<option data-path=".status-Open">Open</option>
						<option data-path=".status-Closed">Closed</option>
						<option data-path=".status-Awarded">Awarded</option>
						<option data-path=".violation-class_1">Hazardous</option>
						<option data-path=".violation-class_2">Non-Hazardous</option>
					</select>
		   		</div>

				<div class="col-md-3 form-group jplist-panel">
					<select class="jplist-select" data-control-type="filter-select" data-control-name="filter-state" data-control-action="filter">
						<option data-path="default">All States</option>
						@foreach($states as $state)
							<option data-path=".state-{{$state}}">{{$state}}</option>
						@endforeach
					</select>
		   		</div>

				<div class="col-md-3 dropdown jplist-items-per-page" data-control-type="boot-items-per-page-dropdown" data-control-name="paging" data-control-action="paging">
			         <select id="dropdown-menu-1" role="menu" aria-expanded="true" class="dropdown">
			         	<option role="presentation"><a role="menuitem" tabindex="-1" href="#" data-number="3">3 per page</option>
			         	<option role="presentation"><a role="menuitem" tabindex="-1" href="#" data-number="5">5 per page</option>
			         	<option role="presentation"><a role="menuitem" tabindex="-1" href="#" data-number="10">10 per page</option>
			         	<option selected="selected" role="presentation"><a role="menuitem" tabindex="-1" href="#" data-number="all">View All</option>
			         </select>
				</div>

		   	</div>
		</div>

		<div class="row">

			@if($total)
				<div class="col-md-12">
					<div class="list">
						@foreach($violations as $violation)
							@include('violation._violation-list')
						@endforeach
					</div>
				</div>
			@else
				<div class="col-md12">
					<p>No violations have been found.</p>
				</div>
			@endif

			<div class="jplist-no-results">
				<p>No violations have been found.</p>
			</div>

		</div>

		<div class="row">

			<div class="row jplist-panel">

				<div class="col-md-6">
			      <div 
			         class="pull-left jplist-pagination-info"
			         data-type="<strong>Page {current} of {pages}</strong><br/> <small>{start} - {end} of {all}</small>" 
			         data-control-type="pagination-info" 
			         data-control-name="paging" 
			         data-control-action="paging">
			        </div>     				
				</div>

				<div class="col-md-6">
					<ul 
					  class="pagination pull-right jplist-pagination"
					  data-control-type="boot-pagination" 
					  data-control-name="paging" 
					  data-control-action="paging"
					  data-range="4"
					  data-mode="google-like">
					</ul>	   				
				</div>

			</div>

		</div>

	</div>	

@endsection





