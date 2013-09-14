<?php get_header(); ?>
<?php $cat_name = single_cat_title('',false);?>
<article id="portfolio" class="main" currentmenu="portfolio">
	<header class="summary">
		<div class="noise">
			<div class="summary-content wrap">
				<h1><?php echo $cat_name; ?></h1>
			</div>
		</div>			
	</header>
	<div class="wrap">				
		<section class="gallery clearfix" id="gallery">
			<?php if (have_posts()) :?>
			<?php while (have_posts()) : the_post(); ?>	    
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
			<?php endwhile; ?>
			<?php else :?>
			<h2>Sorry, works not found</h2>
			<?php endif; ?>
		</section>
		
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
</article>
<div class="item-back item-show" style="display:none">
	<div id="item-dimmer" class="close-work"></div>
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