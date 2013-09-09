<?php
/*
Template Name: SinglePortfolio
*/
?>
<?php
    $post = get_post($_POST['id']);
	$url = $_POST['urlpost'];
?>
<?php if ($post) : ?>
    <?php setup_postdata($post); ?>
    <section class="post" id="post-<?php the_ID();?>">
    	
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
			<script type="text/javascript">var addthis_config = {"data_track_addressbar":true,"url":"<?php echo $url; ?> "};</script>
			<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-4d9270a3495656e9"></script>
			<!-- AddThis Button END -->
		</header>
		<?php if(has_post_thumbnail()): the_post_thumbnail('large'); endif; ?>			
		<?php the_content(); ?>
		<?php comments_template(); ?>
	</section>
<?php endif; ?>