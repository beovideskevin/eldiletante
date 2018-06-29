<?php
/**
 * EDD functions
 *
 * @package WordPress
 * @subpackage EDD
 */

// Add Thumbnail Theme Support
add_theme_support('post-thumbnails');
add_image_size('medium', 440, '', true); // Medium Thumbnail

//Adds Menus
add_theme_support('menus'); 

//Register right sidebar
register_sidebar(array(
  'name' => __( 'Right Hand Sidebar' ),
  'id' => 'right-sidebar',
  'description' => __( 'Widgets in this area will be shown on the right-hand side.' ),
  'before_title' => '<h3 class="widget-title section-title">',
  'after_title' => '</h3>',
  'before_widget' => '<div class="sidebox box widget"> ',
  'after_widget'  => '</div><!-- /.widget -->'
));


function wpb_move_comment_field_to_bottom( $fields ) {
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;
	return $fields;
}
 
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );

function mytheme_comment($parent = 0) 
{
	$args = array(
		'status' => 'approve',
		'order' => 'ASC',
		'parent' => $parent,
		'post_id' => get_the_ID()
	);

	// The comment Query
	$comments_query = new WP_Comment_Query;
	$comments = $comments_query->query( $args );

	$html = "";
	
	if ($comments)
	{
		foreach ($comments as $comment) 
		{
			$html .= '<li><div class="user frame">' . get_avatar($comment->comment_author_email, 70) .'</div>';
			$html .= '<div class="message"><div class="info"><h2><a href="' . (empty($comment->comment_author_url) ? '' : $comment->comment_author_url) .'">'. $comment->comment_author . '</a></h2>';
            $html .= '<div class="meta"><div class="date">' . date("l d, Y", strtotime($comment->comment_date)) . '</div>';
            $html .= '<a class="reply-link" href="' . get_permalink() . '?replytocom=' . $comment->comment_ID . '#respond">Reply</a> </div>';
            $html .= '</div><p>' . $comment->comment_content . '</p></div>';
			$tmp = mytheme_comment($comment->comment_ID);
			if ( ! empty($tmp))
			{
				$html .= '<ul class="children">' . $tmp . '</ul>';
			}
			$html .= '</li>';
		}
	}
	
	return $html;
}

function keep_my_links($text) {
	global $post;
	if ( '' == $text ) {
		$text = get_the_content('');
		$text = apply_filters('the_content', $text);
		$text = str_replace('\]\]\>', ']]&gt;', $text);
		$text = preg_replace('@<script[^>]*?>.*?</script>@si', '', $text);
		$text = strip_tags($text, '<a>');
	}
	return $text;
}
remove_filter('get_the_excerpt', 'wp_trim_excerpt');
add_filter('get_the_excerpt', 'keep_my_links');
