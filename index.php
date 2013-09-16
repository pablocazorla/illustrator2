<?php get_header(); ?>
<article id="home" class="main">	
	<section class="summary">
		<div class="noise">
			<div class="summary-content wrap">
				<div class="text">
					<h1>I am illustrator and<br>concept artist</h1>
					<p>I’m digital artist, fantasy illustrator, concept artist and designer.<br>
In my work you will find a great diversity: concept art for games, storyboards, web illustration, infographics, traditional painting, 3D images, books…</p>
				</div>
				
				<div id="home-slide">
					<div class="noise"></div>
					<div class="slide"></div>
					<div class="slide"></div>
				</div>
			</div>
		</div>			
	</section>
	<?php
	    $catportid = get_cat_ID( 'Portfolio' );
	    $catportlink = get_category_link( $catportid );
		$catblogid = get_cat_ID( 'Blog' );
	    $catbloglink = get_category_link( $catblogid );
	?>
	<div class="wrap">
		<h2>Last <a href="<?php echo $catportlink; ?>">portfolio</a> works</h2>			
		<section class="gallery clearfix" id="gallery">
			<?php query_posts( array( 'category_name' => 'Portfolio', 'posts_per_page' => 4));
			while ( have_posts() ) : the_post();?>
			<figure class="box">			
				<a href="<?php the_permalink(); ?>" class="explain-work open-work" rel="<?php the_ID();?>">
					<span class="hover"></span>
					<?php if(has_post_thumbnail()): the_post_thumbnail('homepage-thumb'); endif; ?>	
				</a>									
				<figcaption>
					<h2><a href="<?php the_permalink(); ?>" class="open-work" rel="<?php the_ID();?>"><?php the_title(); ?></a></h2>
					<div class="categories"><?php the_category(', '); ?></div>
				</figcaption>						
			</figure>	   
			<?php endwhile;
			wp_reset_query();
			?>
		</section>
		<hr/>
		<h2>In the <a href="<?php echo $catbloglink; ?>">blog</a></h2>
		<div class="clearfix">	
			<div class="column left">		
				<?php query_posts( array( 'category_name' => 'Blog', 'posts_per_page' => 2));
				while ( have_posts() ) : the_post();?>
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
				<?php endwhile;
				wp_reset_query();
				?>		
			</div>			
			<aside class="column right" id="column-right">			
				<?php get_sidebar(); ?>
			</aside>
		</div>
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