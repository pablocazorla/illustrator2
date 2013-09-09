<?php
/*
Template Name: Portfolio
*/
?>

<?php get_header(); ?>
<script type="text/javascript">pageid = 'portfolio';</script>
<article id="portfolio" class="main">
	<div class="wrap">
		<section class="summary clearfix">
			<h1>Portfolio</h1>
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<?php the_content(); ?>
			<?php endwhile; endif; ?>
		</section>		
		<section class="gallery clearfix" id="gallery">
			<?php query_posts('category_name=Portfolio'); while ( have_posts() ) : the_post(); ?>	    
			<figure class="box">			
				<a href="<?php the_permalink(); ?>" class="explain-work open-work" rel="<?php the_ID();?>">
					<span class="hover"></span>
					<?php if(has_post_thumbnail()): the_post_thumbnail('thumbnail'); endif; ?>	
				</a>									
				<figcaption>
					<h2><a href="<?php the_permalink(); ?>" class="open-work" rel="<?php the_ID();?>"><?php the_title(); ?></a></h2>
					<div class="categories"><?php the_category(', '); ?></div>
				</figcaption>						
			</figure>	   
			<?php endwhile; wp_reset_query(); ?>
		</section>
	</div>
</article>
<div class="item-back item-show" style="display:none">
	<div class="item-header">
		<div class="item-header-content wrap">
			<span class="close-work x box">X</span>
		</div>
	</div>
	<div class="item wrap box">	
		<div id="item-content">
			<div class="loading">Loading...</div>
		</div>
	</div>
</div>
<?php get_footer(); ?>