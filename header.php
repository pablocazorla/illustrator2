<!doctype HTML>
<!--[if IE 7]>    <html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="ie8" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html lang="en"> <!--<![endif]-->
<head>	
	<title><?php
	global $page, $paged;
	wp_title( '|', true, 'right' );
	bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	echo ", $site_description";
	if ( $paged >= 2 || $page >= 2 )
		echo ' - ' . sprintf( 'Page %s', max( $paged, $page ) );
	?></title>
		
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">	
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="resource-type" content="document" />
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta http-equiv="content-language" content="en-us" />
	<meta name="author" content="Pablo Cazorla" />
	<meta name="contact" content="contact@pcazorla.com" />
	<meta name="copyright" content="Designed by Pablo Cazorla under licence Creative Commons - 2013." />
	
	<link href='http://fonts.googleapis.com/css?family=Open+Sans:400' rel='stylesheet' type='text/css'>
	
	<!--temp-->
	<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/reset.css">	
	
	<link href="<?php bloginfo('template_url'); ?>/style.css" rel="stylesheet" type="text/css" />
	
	<!--temp-->	
	<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/mediaqueries.css">
	<link type="text/css" rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/animations.css">
		
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!--[if lt IE 9]>
	<script src="<?php bloginfo('template_url'); ?>/js/html5-3.4-respond-1.1.0.min.js"></script>
	<![endif]-->
	
	<?php wp_head(); ?>	
</head>

<body>
	<header class="main">
		<div class="wrap clearfix">
			<a href="index.html" class="logo"><span>p'</span>caz</a>			
			<div id="side-act">
				<div id="side-act-content">
					<menu class="main">
						<?php  wp_nav_menu();?>
					</menu>
				</div>				
			</div>			
		</div>
		<a id="menu-launcher" href="">
			<span></span><span></span><span></span>
		</a>
	</header>