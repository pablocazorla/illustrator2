<?php // Do not delete these lines
if('comments.php' == basename($_SERVER['SCRIPT_FILENAME'])){
	die ('Please do not load this page directly. Thanks!');
	if(!empty($post->post_password)) {
		if($_COOKIE['wp-postpass_' . COOKIEHASH] != $post->post_password) {
?>
			<p class="nocomments">Este post está protegido, ingresa la contraseña para ver el resto.</p>
<?php
			return;
		}
	}
}
?>
<a id="comments" name="comments" class="anchor"></a>
<div id="comments-content">
	<h2><?php comments_number('No comments yet', '1 comment', '% comments');?></h2>
	<?php if($comments){ //INICIA COMENTARIOS?>
	<ul id="commentlist">
		<?php wp_list_comments('avatar_size=48&type=comment&reply_text='); ?>
	</ul>
	<?php };?>
	<a id="respond" name="respond" class="anchor"></a>
	<?php if ('open' == $post->comment_status){ //INICIA FORMULARIO PARA COMENTARIOS - Si estan abiertos ?>
		
		
		<form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
			<h3><?php _e('Share your comment','pcazorla'); ?></h3>
			<p class="req-advice">* Fields required.</p>
			<?php if ( $user_ID ){ //Si SI esta logueado ?>
	
				<p><?php _e('You are logged as','pcazorla'); ?> <a href="<?php echo get_option('siteurl'); ?>/wp-admin/profile.php"><?php echo $user_identity; ?></a> | <a href="<?php echo get_option('siteurl'); ?>/wp-login.php?action=logout" title="Logout">Logout »</a></p>
	
			<?php }else{ //Si NO esta logueado ?>
				
				<fieldset id="authorField" class="validate" min="3">
					<div class="errorMessage" style="display:none;"><?php _e('Please, complete your name','pcazorla'); ?></div>
					<label for="author"><?php _e('Name','pcazorla'); ?><?php if ($req) echo '<span class="req">*</span>'; ?>:</label>					
					<input type="text" name="author" id="author" value="<?php echo $comment_author; ?>" tabindex="1" placeholder="<?php _e('Write your name','pcazorla'); ?>"/>					
				</fieldset>
				
				<fieldset id="emailField" class="validate email" min="3">
					<div class="errorMessage" style="display:none;"><?php _e('Write a right e-mail','pcazorla'); ?></div>
					<label for="email">E-mail<?php if ($req) echo '<span class="req">*</span>'; ?>:</label>					
					<input type="email"" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" placeholder="<?php _e('your_email@mail.com','pcazorla'); ?>"/>					
			<?php } ?>					
				</fieldset>
				
				<fieldset id="commentField" class="validate" min="3">
					<div class="errorMessage" style="display:none;"><?php _e('Please, write some words','pcazorla'); ?></div>
					<label for="comment"><?php _e('Comment','pcazorla'); ?><?php if ($req) echo '<span class="req">*</span>'; ?>:</label>					
					<textarea name="comment" id="comment"  rows="8" tabindex="3" placeholder="<?php _e('Write here','pcazorla'); ?>"></textarea>									
				</fieldset>
							
				<fieldset class="submit-field">
					<input name="submit" type="submit" id="submit" class="button" tabindex="4" title="<?php _e('Send your comment','pcazorla'); ?>" rel="<?php _e('Sending','pcazorla'); ?>..." value="<?php _e('Send','pcazorla'); ?>" />
					<a id="clearFields" href="">Clear fields</a>
					<input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />	
				<?php do_action('comment_form', $post->ID); ?>
				</fieldset>	
		</form>
			
		
	<?php }else{ //Si estan cerrados ?>
		<h4 class="closed-comments"><?php _e('The comments are closed for this work','pcazorla'); ?></h4>
	<?php } ?>
</div>