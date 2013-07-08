<div class="ecardContainer">
	<div id="ecardOptions" class="flexslider left">
		<ul class="slides">
		@foreach ( Config::get('application.ecards') as $ecard )
			<li>{{ HTML::image( URL::to_asset( $ecard['thumb'] ) ) }}</li>
		@endforeach
		</ul>
	</div>
	<div id="ecardSlider" class="flexslider cardPreview">
		<ul class="slides">
		@foreach ( Config::get('application.ecards') as $ecard )
			<li>{{ HTML::image( URL::to_asset( $ecard['image'] ), '', $ecard['placeholder'] ) }}</li>
		@endforeach
		</ul>
	</div>
	<a href="#/{{ $step['next'] }}" class="btn">Next</a>
</div>
