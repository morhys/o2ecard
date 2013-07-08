@include('layouts.header')
	<header role="banner">
		<h1 class="logo">
			<a href="{{ Config::get('application.o2international_url') }}" title="O2">
				{{ HTML::image( URL::to_asset('img/logo.png'), 'O2') }}
			</a>
		</h1>
		<div id="hero">
			@yield('hero')
		</div>
	</header>

	<div id="main">
		@yield('content')
	</div>

@include('layouts.footer')