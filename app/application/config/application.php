<?php

return array(

	/*
	|--------------------------------------------------------------------------
	| Application URL
	|--------------------------------------------------------------------------
	|
	| The URL used to access your application without a trailing slash. The URL
	| does not have to be set. If it isn't, we'll try our best to guess the URL
	| of your application.
	|
	*/

	'url' => '',

	/*
	|--------------------------------------------------------------------------
	| Asset URL
	|--------------------------------------------------------------------------
	|
	| The base URL used for your application's asset files. This is useful if
	| you are serving your assets through a different server or a CDN. If it
	| is not set, we'll default to the application URL above.
	|
	*/

	'asset_url' => '',

	/*
	|--------------------------------------------------------------------------
	| Application Index
	|--------------------------------------------------------------------------
	|
	| If you are including the "index.php" in your URLs, you can ignore this.
	| However, if you are using mod_rewrite to get cleaner URLs, just set
	| this option to an empty string and we'll take care of the rest.
	|
	*/

	'index' => '',

	/*
	|--------------------------------------------------------------------------
	| Application Key
	|--------------------------------------------------------------------------
	|
	| This key is used by the encryption and cookie classes to generate secure
	| encrypted strings and hashes. It is extremely important that this key
	| remains secret and it should not be shared with anyone. Make it about 32
	| characters of random gibberish.
	|
	*/

	'key' => 'rxWymiP8VkVNg4EQRnrNp0vjFbMD9JGE',

	/*
	|--------------------------------------------------------------------------
	| Profiler Toolbar
	|--------------------------------------------------------------------------
	|
	| Laravel includes a beautiful profiler toolbar that gives you a heads
	| up display of the queries and logs performed by your application.
	| This is wonderful for development, but, of course, you should
	| disable the toolbar for production applications.
	|
	*/

	'profiler' => false,

	/*
	|--------------------------------------------------------------------------
	| Application Character Encoding
	|--------------------------------------------------------------------------
	|
	| The default character encoding used by your application. This encoding
	| will be used by the Str, Text, Form, and any other classes that need
	| to know what type of encoding to use for your awesome application.
	|
	*/

	'encoding' => 'UTF-8',

	/*
	|--------------------------------------------------------------------------
	| Default Application Language
	|--------------------------------------------------------------------------
	|
	| The default language of your application. This language will be used by
	| Lang library as the default language when doing string localization.
	|
	*/

	'language' => 'en',

	/*
	|--------------------------------------------------------------------------
	| Supported Languages
	|--------------------------------------------------------------------------
	|
	| These languages may also be supported by your application. If a request
	| enters your application with a URI beginning with one of these values
	| the default language will automatically be set to that language.
	|
	*/

	'languages' => array(),

	/*
	|--------------------------------------------------------------------------
	| SSL Link Generation
	|--------------------------------------------------------------------------
	|
	| Many sites use SSL to protect their users' data. However, you may not be
	| able to use SSL on your development machine, meaning all HTTPS will be
	| broken during development.
	|
	| For this reason, you may wish to disable the generation of HTTPS links
	| throughout your application. This option does just that. All attempts
	| to generate HTTPS links will generate regular HTTP links instead.
	|
	*/

	'ssl' => true,

	/*
	|--------------------------------------------------------------------------
	| Application Timezone
	|--------------------------------------------------------------------------
	|
	| The default timezone of your application. The timezone will be used when
	| Laravel needs a date, such as when writing to a log file or travelling
	| to a distant star at warp speed.
	|
	*/

	'timezone' => 'UTC',

	/*
	|--------------------------------------------------------------------------
	| Class Aliases
	|--------------------------------------------------------------------------
	|
	| Here, you can specify any class aliases that you would like registered
	| when Laravel loads. Aliases are lazy-loaded, so feel free to add!
	|
	| Aliases make it more convenient to use namespaced classes. Instead of
	| referring to the class using its full namespace, you may simply use
	| the alias defined here.
	|
	*/

	'aliases' => array(
		'Auth'       	=> 'Laravel\\Auth',
		'Authenticator' => 'Laravel\\Auth\\Drivers\\Driver',
		'Asset'      	=> 'Laravel\\Asset',
		'Autoloader' 	=> 'Laravel\\Autoloader',
		'Blade'      	=> 'Laravel\\Blade',
		'Bundle'     	=> 'Laravel\\Bundle',
		'Cache'      	=> 'Laravel\\Cache',
		'Command'    	=> 'Laravel\\CLI\\Command',
		'Config'     	=> 'Laravel\\Config',
		'Controller' 	=> 'Laravel\\Routing\\Controller',
		'Cookie'     	=> 'Laravel\\Cookie',
		'Crypter'    	=> 'Laravel\\Crypter',
		'DB'         	=> 'Laravel\\Database',
		'Eloquent'   	=> 'Laravel\\Database\\Eloquent\\Model',
		'Event'      	=> 'Laravel\\Event',
		'File'       	=> 'Laravel\\File',
		'Filter'     	=> 'Laravel\\Routing\\Filter',
		'Form'       	=> 'Laravel\\Form',
		'Hash'       	=> 'Laravel\\Hash',
		'HTML'       	=> 'Laravel\\HTML',
		'Input'      	=> 'Laravel\\Input',
		'IoC'        	=> 'Laravel\\IoC',
		'Lang'       	=> 'Laravel\\Lang',
		'Log'        	=> 'Laravel\\Log',
		'Memcached'  	=> 'Laravel\\Memcached',
		'Paginator'  	=> 'Laravel\\Paginator',
		'Profiler'  	=> 'Laravel\\Profiling\\Profiler',
		'URL'        	=> 'Laravel\\URL',
		'Redirect'   	=> 'Laravel\\Redirect',
		'Redis'      	=> 'Laravel\\Redis',
		'Request'    	=> 'Laravel\\Request',
		'Response'   	=> 'Laravel\\Response',
		'Route'      	=> 'Laravel\\Routing\\Route',
		'Router'     	=> 'Laravel\\Routing\\Router',
		'Schema'     	=> 'Laravel\\Database\\Schema',
		'Section'    	=> 'Laravel\\Section',
		'Session'    	=> 'Laravel\\Session',
		'Str'        	=> 'Laravel\\Str',
		'Task'       	=> 'Laravel\\CLI\\Tasks\\Task',
		'URI'        	=> 'Laravel\\URI',
		'Validator'  	=> 'Laravel\\Validator',
		'View'       	=> 'Laravel\\View',
	),
	'site_title' => "Anneler G&#252;n&#252;n&#252;z Kutlu Olsun",
	'site_name' => "O2 International Events",
	'thankyou_message' => 'Te&#351;ekk&#252;rler!',
	'share_copy' => 'O2 International sim (O2&#8217;nun Uluslararas&#305; sim kart&#305;) ile annem i&#231;in olu&#351;turdu&#287;um ekarta bir bak',
	'facebook_key' => '464406490305938',
	'bitly_login' => 'miyomint',
	'bitly_appkey' => 'R_ab81eddeabc71dadbbcfb24e645d7f02',
	'ga_code' => 'UA-XXXXXXXX-XX',
	'ordernow_url' => 'http://freesim.o2.co.uk/jYCHx76R',
	'o2international_url' => 'http://www.o2internationalevents.co.uk/',
	'return_url' => 'http://o2internationalevents.co.uk/ecard/?key=',
	'no_reply_email' => 'ecard@o2internationalevents.co.uk',
	'steps' => array(
		'step-1' => array(
			'name' => 'Step 1',
			'title' => 'Select an eCard',
			'next' => 'step-2'
		),
		'step-2' => array(
			'name' => 'Step 2',
			'title' => 'Personalise your eCard',
			'next' => 'save'
		),
		'step-3' => array(
			'name' => 'Step 3',
			'title' => 'Send your eCard',
			'next' => 'send'
		)
	),
	'ecards' => array(
		array(
			'thumb' => 'img/ecards_options/ecard-01-thumb.jpg',
			'image' => 'img/ecards_options/ecard-01.jpg',
			'dimensions' => array(
				'height' => 580,
				'width' => 610
			),
			'placeholder' => array(
				'data-ecard' => 'img/ecards_options/ecard-01.jpg',
				'data-placeholder-height' => 189,
				'data-placeholder-width' => 189,
				'data-placeholder-x' => 295,
				'data-placeholder-y' => 361,
			)
		),
		array(
			'thumb' => 'img/ecards_options/ecard-02-thumb.jpg',
			'image' => 'img/ecards_options/ecard-02.jpg',
			'dimensions' => array(
				'height' => 580,
				'width' => 610
			),
			'placeholder' => array(
				'data-ecard' => 'img/ecards_options/ecard-02.jpg',
				'data-placeholder-height' => 204,
				'data-placeholder-width' => 204,
				'data-placeholder-x' => 295,
				'data-placeholder-y' => 341,
			)
		)
	)

);
