<?php get_header(); ?>
<article id="blog-post" class="main">
	<div class="wrap clearfix">		
		<div class="column left">			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section class="post box" id="post-<?php the_ID();?>">
				<header>
					<h1><?php the_title(); ?></h1>
					<div class="category">
						Category: <?php the_category(', '); ?>					
					</div>
				</header>				
				<?php the_content(); ?>
				<?php comments_template(); ?>
			</section>
			<?php endwhile; endif; ?>
		</div>			
		<aside class="column right">			
			<section class="box">
				<?php get_sidebar(); ?>				
			</section>
		</aside>
	</div>
</article>
<?php get_footer(); ?>

