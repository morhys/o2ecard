@layout('layouts.default')

@section('hero')
	<h1>{{ HTML::image( URL::to_asset('img/headline.png'), Config::get('application.site_name') ) }}</h1>
	{{ HTML::image( URL::to_asset('img/duck.png'), '', array( 'class' => 'duck' ) ) }}
	@render('blocks.rate_box')
@endsection

@section('content')
<div class="stepContainer">
	<div id="ecardView" class="step">
		<div class="inner">
			<h2 class="heading">{{ Session::has('status') ? Session::get('status') . ', ' . Session::get('message') : $title }}</h2>
			<header id="stepsNav">
				<nav>
					<a href="{{ URL::base() }}" class="btn">Create your eCard</a>
				</nav>
			</header>


			<div id="share" class="left">
				<div class="addthis_toolbox addthis_default_style" addthis:url="{{ $ecard['url'] }}" addthis:title="{{ Config::get('application.share_copy') . ' - ' . $ecard['url'] }}" addthis:description="{{ Config::get('application.share_copy') . ' - ' . $ecard['url'] }}">
					<a class="facebook_share">Share</a>
					<a class="addthis_button_tweet"></a>
					<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
					<a class="addthis_button_pinterest_pinit"></a>
				</div>
			</div>

			<div class="cardPreview">
				{{ HTML::image( URL::to_asset( $ecard['img'] ), '', array( 'class' => 'usereCard' ) ) }}
			</div>
		</div>
	</div>
</div>
@endsection
