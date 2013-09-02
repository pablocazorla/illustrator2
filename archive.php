<?php get_header(); ?>
<?php $cat_name = single_cat_title('',false);?>
<article id="blog" class="main">
	<div class="wrap clearfix">
		<h1><?php echo $cat_name; ?></h1>		
		<div class="column left">			
			<?php if (have_posts()) :?>
			<?php while (have_posts()) : the_post(); ?>
			<section class="post box" id="post-<?php the_ID();?>">
				<header class="clearfix">
					<h2>
						<a href="<?php the_permalink(); ?>">					
							<?php the_title(); ?>
						</a>
					</h2>
					<div class="category">
						Category: <?php the_category(', '); ?>					
					</div>
				</header>
				
				<?php the_content('Read more...',true); ?>	
			</section>
			<?php endwhile; ?>
			<?php else :?>
			<h2><?php _e('Sorry, works not found','pcazorla'); ?>!</h2>
			<?php endif; ?>
		</div>			
		<aside class="column right" id="column-right">			
			<section class="box" id="sidebar">
				<?php get_sidebar(); ?>				
			</section>
		</aside>
	</div>
</article>
<?php get_footer(); ?>