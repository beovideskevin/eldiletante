<?php
/**
 * @package WordPress
 * @subpackage EDD
 */

$page_object = get_queried_object();

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

global $wp_query;

$pages = $wp_query->max_num_pages;

if (!$pages) $pages = 1;

$pagination = '';

if ($pages > 1) 
{
	$pagination .= '<ul>';

	if ($paged > 1) $pagination .= '<li><a href="/blog/tag/' . $page_object->slug . '/page/' . ($paged - 1) . '" class="btn">Prev</a></li>';

	for ($i = 1; $i <= $pages ; $i++) 
	{
		if ($i == $paged) $pagination .= '<li class="active"><a href="#" class="btn"><span>' . $i . '</span></a></li>';	
		else $pagination .= '<li><a href="/blog/tag/' . $page_object->slug . '/page/' . $i . '" class="btn">' . $i . '</a></li>';
	}

	if ($paged < $pages) $pagination .= '<li><a href="/blog/tag/' . $page_object->slug . '/page/' . ($paged+1) . '" class="btn">Next</a></li>';

	$pagination .= '</ul>';
}

get_header();

?>
    <div class="blog list-view row">
      <div class="col-md-8 col-sm-12 content">
        <div class="blog-posts">
			<div class="post box" > <!-- id="post-<?php the_ID(); ?>"  -->
			
			<?php get_template_part('loop_cuentos'); ?>
			
			</div>
			<!-- /.post -->

        </div>
        <!-- /.blog-posts -->
        
		<?php if (! empty($pagination)): ?>

			<div class="pagination box">

			<?php echo $pagination; ?>

			</div>
			<!-- /.pagination --> 

		<?php endif; ?>
 <?php get_footer(); ?>
