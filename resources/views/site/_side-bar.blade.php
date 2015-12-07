<section id="sidebar">
	<header>
		<h2>Menu</h2>
	</header>
	<ul class="sidebar-navigation">

		<li class="@if($sidebar_active_menu=='account') active @endif"><a href="{{ action('UserController@show',[Auth::user()->id]) }}">My Account</a></li>

		@if(Auth::user()->getOriginal('user_type')!='admin')
			
			@can('create-violation')
				<li class="@if($sidebar_active_menu=='my-violations') active @endif"><a href="{{ action('ViolationController@my_violations') }}">My Violations</a></li>
			@endcan

			<li class="@if($sidebar_active_menu=='my-offers') active @endif"><a href="{{ action('OfferController@index') }}">My Offers</a></li>	

			@can('create-violation')
				<li class="@if($sidebar_active_menu=='report-violation') active @endif"><a href="{{ action('ViolationController@create') }}">Report Violation</a></li>
			@endcan

			<li class="@if($sidebar_active_menu=='violations') active @endif"><a href="{{ action('ViolationController@index') }}">Search Violations</a></li>
			
		@else

			<li class="@if($sidebar_active_menu=='payments') active @endif"><a href="{{ url('payment') }}">Payments</a></li>

		@endif
		
		<li class="@if($sidebar_active_menu=='users') active @endif"><a href="{{ action('UserController@index') }}">Users</a></li>
		
	</ul>
</section>
