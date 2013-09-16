<?php get_header(); ?>
<?php $cat_name = single_cat_title('',false);?>
<article id="blog" class="main" currentmenu="blog">
	<header class="summary">
		<div class="noise">
			<div class="summary-content wrap">
				<h1><?php echo $cat_name; ?></h1>
			</div>
		</div>			
	</header>
	<div class="wrap clearfix">	
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
			
			<?php if (show_posts_nav()) : ?>
			<nav class="navPages">		
				<?php global $wp_query;
				$big = 999999999; // need an unlikely integer		
				echo paginate_links( array(
					'base' => str_replace( $big, '%#%', get_pagenum_link( $big ) ),
					'format' => '?paged=%#%',
					'current' => max( 1, get_query_var('paged') ),
					'total' => $wp_query->max_num_pages,
					'prev_text' => 'Prev',
					'next_text' => 'Next'
				) );
				?>
			</nav>
			<?php endif; ?>	
		</div>			
		<aside class="column right" id="column-right">			
			<?php get_sidebar(); ?>	
		</aside>
	</div>
</article>
<?php get_footer(); ?>