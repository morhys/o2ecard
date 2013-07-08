@layout('layouts.default')

@section('hero')
	<h1>{{ HTML::image( URL::to_asset('img/headline.png'), Config::get('application.site_name') ) }}</h1>
	{{ HTML::image( URL::to_asset('img/duck.png'), '', array( 'class' => 'duck' ) ) }}
	@render('blocks.rate_box')
@endsection

@section('content')
	@include('blocks.steps_menu')
	{{ Form::open_for_files(action('ecard@send'), 'POST', array('class' => 'stepContainer', 'novalidate')) }}
		@foreach ( Config::get('application.steps') as $key => $step )
		<div id="{{ $key }}" class="step">
			<div class="inner">
				<h2 class="heading">{{ $step['name'] }}: {{ $step['title'] }}</h2>
				@include("blocks.$key")
			</div>
		</div>
		@endforeach
	{{ Form::close() }}
@endsection
