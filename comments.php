<?php if (have_comments()) : ?>
	<div class="postComment">
		<ol>
			<?php wp_list_comments('callback=custom_comments'); ?>
		</ol>
	</div>
<?php endif; ?>
<?php comment_form();?>