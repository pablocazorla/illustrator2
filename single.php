<?php get_header(); ?>
<article id="blog-post" class="main">
	<div class="wrap clearfix">		
		<div class="column left">			
			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<section class="post box" id="post-<?php the_ID();?>">
				<header class="clearfix">
					<h1><?php the_title(); ?></h1>
					<?php if( $post->post_excerpt ){ the_excerpt(); } ?>
					<div class="category">
						Category: <?php the_category(', '); ?>					
					</div>
			
					
					<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style addthis_32x32_style">
<a class="addthis_button_facebook"></a>
<a class="addthis_button_twitter"></a>
<a class="addthis_button_pinterest_share"></a>
<a class="addthis_button_google_plusone_share"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript">var addthis_config = {"data_track_addressbar":true};</script>
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4d9270a3495656e9"></script>
<!-- AddThis Button END -->
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

