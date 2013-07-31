<?php get_header(); ?>
<script type="text/javascript">pageid = 'work';</script>
<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
	
	<article id="work" class="main">
		<nav class="breadcrumbs">
			<div class="wrap">
				<a rel="category tag" title="View all posts in Portfolio" href="<?php bloginfo('url'); ?>/portfolio">Portfolio</a>
				<span class="separator"></span>
				<?php the_category(', '); ?>
			</div>
		</nav>
		<section class="summary wrap clearfix">			
			<h1><?php the_title(); ?></h1>			
			<?php the_excerpt(); ?>			
			<nav class="share clearfix">				
				<?php comments_popup_link('Comments', '1 Comment','% Comments','comment-link'); ?>				
				<a class="facebook-link" href="http://www.facebook.com/sharer.php?u=<?php the_permalink();?>&t=<?php the_title(); ?>" target="blank">Share on Facebook</a>
				<a class="twitter-link" href="http://twitter.com/home?status=<?php the_permalink();?>" target="blank">Share on Twitter</a>
				<a class="pinterest-link" href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php echo pc_thumb_url("large");?>&description=<?php echo get_the_excerpt(); ?>" target="_blank">Pin It</a>	
				
			</nav>		
		</section>
		<section class="content wrap clearfix">
			<?php the_content(); ?>			
		</section>
		<section class="comments-section">
			<div class="wrap clearfix">
				<?php comments_template(); ?>
			</div>					
		</section>		
	</article>
<?php endwhile; endif; ?>

<?php get_footer(); ?>

