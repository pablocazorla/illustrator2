<?php get_header(); ?>

<script type="text/javascript">pageid = 'home';</script>
<article id="home-article" class="main">	
	<div class="home-presentation">
		<div class="title">
			<h1>I am<br>illustrator<br>and<br>concept artist</h1>
		</div>
		<a class="home-link" title="View my Portfolio" href="<?php bloginfo('url'); ?>/portfolio">Portfolio</a>
		<img class="portrait" src="<?php bloginfo('template_url'); ?>/img/home.jpg"/>
	</div>
	<section class="content wrap">
		<h2 class="last-work">Last work</h2>
		<div class="gallery clearfix">
			<?php query_posts('posts_per_page=3'); while ( have_posts() ) : the_post(); ?>	    
			<figure>			
				<a href="<?php the_permalink(); ?>" class="explain-work" rel="<?php the_ID();?>">
					<?php if(has_post_thumbnail()): the_post_thumbnail('thumbnail'); endif; ?>	
				</a>									
				<figcaption>
					<h2><?php the_title(); ?></h2>
					<div class="categories"><?php the_category(', '); ?></div>
				</figcaption>						
			</figure>	   
			<?php endwhile; wp_reset_query(); ?>
		</div>
		<div class="align-center">
			<a title="More of my Portfolio" href="<?php bloginfo('url'); ?>/portfolio">More...</a>
		</div>		
	</section>
</article>

<?php get_footer(); ?>