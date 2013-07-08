<header id="stepsNav">
	<nav>
		<ul>
		@foreach ( Config::get('application.steps') as $key => $step )
			<li><a href="#/{{ $key }}">{{ $step['name'] }}</a></li>
		@endforeach
		</ul>
	</nav>
</header>