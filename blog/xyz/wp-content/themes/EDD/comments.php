<?php

$html =  mytheme_comment();


// Comment Loop
if ( ! empty($html)) : ?>

	<h3><?php echo esc_html(get_comments_number()) ?> Comments</h3>
	
	<ol id="singlecomments" class="commentlist">
	
		<?php echo $html; ?>
		
	</ol>
		
<?php else:  ?>
	
	<h3>No comments yet. Be the first!</h3>

<?php endif; ?>
