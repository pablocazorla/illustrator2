<?php
/*
Template Name: About me
*/
?>

<?php get_header(); ?>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<script type="text/javascript">pageid = 'about me';</script>
<article id="about-me" class="main">
	
	<section class="presentation">
		<div class="wrap clearfix">
			<div class="portrait">
				<img class="photo-pablo-cazorla" src="<?php bloginfo('template_url'); ?>/img/about.png"/>
				<ul class="contact-links">
					<li>Contact me:<br><a href="mailto:contact@pcazorla.com" target="_blank" class="">contact@pcazorla.com</a></li>
				</ul>
			</div>
			<div class="resume">
				<h1><?php the_title(); ?></h1>
				<?php the_content(); ?>
			</div>
		</div>		
	</section>
</article>
<?php endwhile;?>
<?php endif; ?>
<?php get_footer(); ?>