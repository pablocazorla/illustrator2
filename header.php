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
	
	<link href='http://fonts.googleapis.com/css?family=Merriweather:400,700' rel='stylesheet' type='text/css'>	
	<link href="<?php bloginfo('template_url'); ?>/style.css" rel="stylesheet" type="text/css" />
	
	<noscript><link href="<?php bloginfo('template_url'); ?>/noscript-style.css" rel="stylesheet" type="text/css" /></noscript>
	
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	
	<!--[if lt IE 9]>
	<script src="<?php bloginfo('template_url'); ?>/js/libs/html5-3.4-respond-1.1.0.min.js"></script>
	<![endif]-->
	
	<?php wp_head(); ?>	
</head>

<?php if(is_home() && is_front_page()){ ?>
	<body class="home">
<?php }else{ ?>
	<body>
<?php }; ?>
<body>
<noscript>
	<div class="noscript-msg">Please, activate Javascript in your browser to enjoy this site</div>
</noscript>
<header class="main visible">
	<div class="wrap clearfix">
		<a href="<?php bloginfo( 'url' ); ?>" class="logo"><?php bloginfo( 'name' ); ?><span><?php $site_description = get_bloginfo( 'description', 'display' );echo $site_description;?></span></a>
		<ul id="skills">
			<li class="sk1">Illustrator</li>
			<li class="sk2">Concept artist</li>
			<li class="sk3">Painter</li>
		</ul>
		<span id="menu-btn">
			<span></span><span></span><span></span>
		</span>		
	</div>
	<menu class="main" id="menu-main">
		<div class="wrap clearfix">
			<span class="arrow"><span></span></span>
			<?php  wp_nav_menu();?>
		</div>
	</menu>	
</header>

