<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


the_post();

get_header();

?>
	<div class="single blog row">
      <div class="col-md-8 col-sm-12 content">
        <div class="blog-posts">
          <div class="post box">
            <!-- <div class="meta"><?php 
				$post_cats = get_the_category(); 
				if (! empty($post_cats)) {
					echo '<span class="category">' . esc_html( $post_cats[0]->name ) . '</span>'; 
				}
			?><span class="date"><?php the_time(' j F, Y'); ?></span><span class="comments"><a href="#"><?php get_comments_number() ?> <i class="icon-chat-1"></i></a></span></div> -->
            <h2 class="post-title"><?php the_title(); ?></h2>
            
			<?php the_content(); ?>
				
          </div>
          <!-- /.post --> 
        </div>
        <!-- /.blog-posts -->
    
 <?php get_footer(); ?>
