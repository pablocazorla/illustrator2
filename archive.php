<?php get_header(); ?>
<script type="text/javascript">pageid = 'portfolio';</script>
<?php $cat_name = single_cat_title('',false);?>

<article id="portfolio" class="main">
	<nav class="breadcrumbs">
		<div class="wrap">
			<a rel="category tag" title="View all posts in Portfolio" href="<?php bloginfo('url'); ?>/portfolio">Portfolio</a>
			<span class="separator"></span>
			<?php echo $cat_name; ?>
		</div>
	</nav>
	<section class="summary wrap clearfix">		
		<h1><?php echo $cat_name; ?></h1>
		<?php echo category_description(); ?> 
	</section>
	<section class="content wrap">
		<div class="gallery clearfix">
			<?php if (have_posts()) :?>
				<?php while (have_posts()) : the_post(); ?>	   
			<figure>			
				<a href="<?php the_permalink(); ?>" class="explain-work" rel="<?php the_ID();?>">
					<?php if(has_post_thumbnail()): the_post_thumbnail('thumbnail'); endif; ?>	
				</a>									
				<figcaption>
					<h2><?php the_title(); ?></h2>
					<div class="categories"><?php the_category(', '); ?></div>
				</figcaption>						
			</figure>
			<?php endwhile; ?>
			<?php else :?>
				<h3><?php _e('Sorry, works not found','pcazorla'); ?>!</h3>
			<?php endif; ?>	
		</div>
		
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
	</section>
</article>
<?php get_footer(); ?>