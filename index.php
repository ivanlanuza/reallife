<?php

	include 'secure/include_fb.php';

	// Get User ID
	$user = $facebook->getUser();
	if ($user) 
		{
			try 
				{
					$user_profile = $facebook->api('/me');
					$wronguser = $user_profile;
					// Proceed knowing you have a logged in user who's authenticated.
				} 
				
				catch (FacebookApiException $e) 
					{
						error_log($e);
						$user = null;
					}
		}
	
	
	// Login or logout url will be needed depending on current user state.
	if ($user) 
		{
			header( 'Location: secure/logincheck.php' );
		} 
	else 
		{
			$loginUrl = $facebook->getLoginUrl(array('scope' => 'email'));
		}
		
?>

<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->

    <HEAD>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>RLCP: Real Life Collaboration Portal</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale = 1.0, user-scalable = no">

        <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
		<link rel="icon" href="favicon.ico" type="image/x-icon">

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/bootstrap-theme.css">
		<link rel="stylesheet" href="css/font-awesome.css">
		<link rel="stylesheet" href="css/personalize.css">
		
        <script src="js/modernizr-2.6.2.min.js"></script>

		<script src="js/jquery-1.10.2.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.10.2.min.js"><\/script>')</script>
		<script type="text/javascript">	
			$(document).ready(function(){				//jquery
				$('#button_fb_login').click(function(){		//jquery
						$('#button_fb_login').prop('disabled', true);
						$('#loginwaiting').removeClass('hide');
						$('#loginwaiting').addClass('show');
						document.location.href='<?php echo $loginUrl; ?>';

					});
					
				var msg = getUrlVars()["error"];
				
				if (msg == "noaccess#" ||  msg == "noaccess")
					{
						$('#errorback').addClass('show');
					}		
	
			});
		</script>

		<script type="text/javascript"> //removes extra URL characters appended by facebook
			if (window.location.hash && window.location.hash == '#_=_') {
				window.location.hash = '';
			}
		</script>		
		
	</HEAD>
	
    <BODY id="login">
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <!-- Add your site or application content here -->
		<div class="container">

			<div id="indexheading">
				<img src="img/real_life_logo.png" >
				REAL LIFE Collaboration Portal (R.L.C.P.)
			</div>

			<button type="button" class="btn btn-primary" id="button_fb_login"><i class="fa fa-facebook"></i> | Login with Facebook</button>

			<div id="loginwaiting" class="hide">
				<p>...please wait while Facebook authentication loads...</p>
			</div>
			
			<div id="errorback" class="hide">
				<BR>
				<p>Sorry, the facebook account you used does not seem to have access to Real Life Site.</p>
				<p><a href="">click here</a> for possible solutions</p>
				<BR>
			</div>
	
		</div>

	
		<!-- Load Java scripts and plug-ins -->
		<script src="js/bootstrap.min.js"></script>
		<script src="js/main.js"></script>
		<script src="js/plugins.js"></script>
		
		<script type="text/javascript">	
			function getUrlVars()
				{
					var vars = [], hash;
					var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
					for(var i = 0; i < hashes.length; i++)
					{
						hash = hashes[i].split('=');
						vars.push(hash[0]);
						vars[hash[0]] = hash[1];
					}
					return vars;
				}
		</script>		
				
        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. 
        <SCRIPT>
            (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
            function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
            e=o.createElement(i);r=o.getElementsByTagName(i)[0];
            e.src='//www.google-analytics.com/analytics.js';
            r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
            ga('create','UA-XXXXX-X');ga('send','pageview');
        </SCRIPT>
		-->
		
	</BODY>
</html>
