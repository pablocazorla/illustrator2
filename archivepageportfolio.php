<?php get_header(); ?>
<?php $cat_name = single_cat_title('',false);?>
<article id="portfolio" class="main">
	<div class="wrap">
		<section class="summary clearfix">
			<h1><?php echo $cat_name; ?></h1>
		</section>		
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