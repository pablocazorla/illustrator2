<?php get_header(); ?>
<article id="home" class="main">
	<div class="wrap">
		<section id="home-slide" class="cazu-accordion-slide box">			
			<?php query_posts(array( 'category_name' => 'Portfolio', 'posts_per_page' => 5));
			while ( have_posts() ) : the_post();?>
			<div class="slide">
				<?php if(has_post_thumbnail()): the_post_thumbnail('homepage-thumb'); endif; ?>
			</div>
			<?php endwhile;
			wp_reset_query();?>
		</section>
	</div>
</article>

<?php get_footer(); ?>