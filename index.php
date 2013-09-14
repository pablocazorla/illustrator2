<?php get_header(); ?>
<article id="home" class="main">	
	<section class="summary">
		<div class="noise">
			<div class="summary-content wrap">
				<?php query_posts(array( 'category_name' => 'Portfolio', 'posts_per_page' => 1));
				while ( have_posts() ) : the_post();?>
				<div class="slide">
					<?php if(has_post_thumbnail()): the_post_thumbnail('homepage-thumb'); endif; ?>
				</div>
				<?php endwhile;
				wp_reset_query();?>
			</div>
		</div>			
	</section>	
</article>

<?php get_footer(); ?>