		</div>
	</div>
	<div id="fb-root"></div>
	@section('scripts')
		<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=undefined"></script>
		<script type="text/javascript">
			window.O2 = window.O2 || {};
			O2.config = O2.config || { 
				baseUrl: '{{ URL::base(); }}',
				assetUrl: '{{ URL::to_asset('/'); }}',
				currentUrl: '{{ URL::current() }}',
				uploadUrl: '{{ URL::to_action('ecard@upload') }}',
				FB: {
					id: '{{ Config::get('application.facebook_key') }}', 
					title: '{{ Config::get('application.site_name') }}',
					img: '{{ isset( $thumb ) ? URL::to_asset($thumb) : URL::to_asset('img/thumb.png') }}'
				},
				firstStep: 1,
				imgUploaded : {{ Session::has('uploadedImg') ? json_encode( Session::get('uploadedImg') ) : 'false' }},
				usereCard : {{ Session::has('usereCard') ? json_encode( Session::get('usereCard') ) : 'false' }}
			};
			
			// //Tweet button
			// !function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");
			
			// //Google+
		 //  	(function() {
		 //    	var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
		 //    	po.src = 'https://apis.google.com/js/plusone.js';
		 //    	var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
		 //  	})();

		  	//Facebook
		  	(function(d, s, id) {
			  var js, fjs = d.getElementsByTagName(s)[0];
			  if (d.getElementById(id)) return;
			  js = d.createElement(s); js.id = id;
			  js.src = "//connect.facebook.net/en_GB/all.js#xfbml=1&appId={{ Config::get('application.facebook_key') }}";
			  fjs.parentNode.insertBefore(js, fjs);
			}(document, 'script', 'facebook-jssdk'));

			//Google Analytics
			var _gaq=[["_setAccount","{{ Config::get('application.ga_code') }}"],["_trackPageview"]];
			(function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];g.async=1;
			g.src=("https:"==location.protocol?"//ssl":"//www")+".google-analytics.com/ga.js";
			s.parentNode.insertBefore(g,s)}(document,"script"));
		</script>

		{{ HTML::script('js/plugins.js') }}
		{{ HTML::script('js/main.js') }}
	@yield_section
</body>
</html>