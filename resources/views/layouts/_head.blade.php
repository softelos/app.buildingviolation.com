
	<div class="navigation">
		<div class="container">
		    <header class="navbar" id="top" role="banner">
		        <div class="navbar-header">
					<button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
		            <div class="navbar-brand nav expanded" id="brand"></div>
		        </div>
		        <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
					<ul class="nav navbar-nav">
						@if(Auth::check())
							<li><a href="{{action('UserController@show',[Auth::user()->id])}}">{{Auth::user()->username}}</a></li>
							<li><a href="{{url('sign-out')}}">Sign Out</a></li>
						@else
							<li><a href="{{url('sign-in')}}">Sign In</a></li>
						@endif
					</ul>
		        </nav>
		    </header>
		</div>
	</div>


	<section id="banner">
		<div class="block has-dark-background background-color-default-darker center text-banner">
			<div class="container">
					<h1 class="no-bottom-margin no-border">@yield('pageTitle','Hundreds of building violation professionals ready to help!')</h1>
	        </div>
	    </div>
	</section>

