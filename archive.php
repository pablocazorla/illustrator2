<?php get_header(); ?>
<article id="blog" class="main">
	<div class="wrap clearfix">
		<h1>Blog</h1>		
		<div class="column left">			
			<?php if (have_posts()) :?>
			<?php while (have_posts()) : the_post(); ?>
			<section class="post box" id="post-<?php the_ID();?>">
				<h2>
				<a href="<?php the_permalink(); ?>">					
				<?php the_title(); ?>
				</a>
				</h2>
				<a href="<?php the_permalink(); ?>">
					<?php if(has_post_thumbnail()): the_post_thumbnail('thumbnail'); endif; ?>
				</a>					
				<?php the_content(); ?>		
			</section>
			<?php endwhile; ?>
			<?php else :?>
			<h2><?php _e('Sorry, works not found','pcazorla'); ?>!</h2>
			<?php endif; ?>
		</div>			
		<aside class="column right">			
			<section class="box">
				<?php get_sidebar(); ?>				
			</section>
		</aside>
	</div>
</article>
<?php get_footer(); ?>