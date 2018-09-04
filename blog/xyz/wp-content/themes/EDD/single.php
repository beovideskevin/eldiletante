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
            <div class="meta"><span class="category"><?php 
				$post_cats = get_the_category(); 
				if (! empty($post_cats)) {
					echo esc_html( $post_cats[0]->name );  
				}
			?></span><span class="date"><?php the_time(' j F, Y'); ?></span><span class="comments"><a href="#"><?php echo esc_html(get_comments_number()) ?> <i class="icon-chat-1"></i></a></span></div>
           
			<?php if (! empty(get_the_title())) : ?> 
			  <h1 class="post-title"><?php the_title(); ?></h1>
            <?php endif; ?>
			  
			<?php the_content(); ?>
				
          </div>
          <!-- /.post --> 
        </div>
        <!-- /.blog-posts -->
		
        <!-- <div class="divide20"></div>
        
        <div id="comments" class="box">
          
			<?php 
				// comments_template(); 
			?>
		  
        </div> -->
        <!-- /#comments -->
        
        <!-- <div class="divide20"></div>
        
		<div class="comment-form-wrapper box">
		
			<?php 
				/*
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$aria_req = ( $req ? " aria-required='true'" : '' );

				$fields =  array(
					'author' =>
					  '<input id="author" name="author" type="text" title="Name*" value="' . esc_attr( $commenter['comment_author'] ) .
					  '" size="30"' . $aria_req . ' />',

					'email' =>
					  '<input id="email" name="email" type="text" title="Email*" value="' . esc_attr(  $commenter['comment_author_email'] ) .
					  '" size="30"' . $aria_req . ' />',

					'url' =>
					  '<input id="url" name="url" type="text" title="Website" value="' . esc_attr( $commenter['comment_author_url'] ) .
					  '" size="30" />',
				  );
			
				$formArgs = array(
					'title_reply' => 'Would you like to share your thoughts?',
					'class_form' => 'comment-form',
					'label_submit' => 'Submit',
					'class_submit' => 'btn btn-submit',
					'comment_field' =>  '<textarea id="comment" name="comment" cols="45" rows="8" aria-required="true" title="Enter your comment here..."></textarea>',
					'fields' => apply_filters( 'comment_form_default_fields', $fields ),
				);
					
				comment_form($formArgs); 
				*/
			?>
			
		</div> -->
        <!-- /.comment-form-wrapper --> 
		
 <?php get_footer(); ?>
