
<?php 
$iframe = true;
$baseUrl = parse_url($_SERVER["SCRIPT_URI"]);
$urlPaths = split( '/', $baseUrl['path'] );

if ( !$iframe ):
	$ch = curl_init();
	$timeout = 5; // set to zero for no timeout  
	curl_setopt ($ch, CURLOPT_URL, "http://lab.miyomint.com/o2ecards/app/public/" . $_GET['key']);  
	curl_setopt ($ch, CURLOPT_RETURNTRANSFER, 1);  
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );
	curl_setopt( $ch, CURLOPT_ENCODING, "" );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_AUTOREFERER, true );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );    # required for https urls
	curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
	curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout );
	curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 );
	$code = curl_exec($ch);  
	curl_close ( $ch );
	echo $code; 
else:
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Anneler G&#252;n&#252;n&#252;z Kutlu Olsun | O2 International Events</title>
<meta name="description" content="O2 International Events | Anneler G&#252;n&#252;n&#252;z Kutlu Olsun">
<meta property="og:url" content="http://o2internationalevents.co.uk/ecard">
<meta property="og:type" content="website">
<meta property="og:title" content="Anneler G&#252;n&#252;n&#252;z Kutlu Olsun | O2 International Events">
<meta property="og:description" content="O2 International sim (O2&#8217;nun Uluslararas&#305; sim kart&#305;) ile annem i&#231;in olu&#351;turdu&#287;um ekarta bir bak">
<meta property="og:image" content="http://lab.miyomint.com/o2ecards/app/public/img/thumb.png">
<meta property="og:site_name" content="O2 International Events">

<style type="text/css"> 
html {overflow: auto;} 
html, body, div, iframe {margin: 0px; padding: 0px; height: 100%; border: none;} 
iframe {display: block; width: 100%; border: none; overflow-y: auto; overflow-x: hidden;} 
</style> 
</head> 
<body> 
<iframe id="tree" name="tree" src="http://lab.miyomint.com/o2ecards/app/public/<?php echo $_GET['key']; ?>" frameborder="0" marginheight="0" marginwidth="0" width="100%" height="100%" scrolling="auto"></iframe> 
</body>
</html>
<?php endif; ?>