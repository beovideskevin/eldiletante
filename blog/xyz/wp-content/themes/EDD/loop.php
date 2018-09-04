<?php if (have_posts()): while (have_posts()) : the_post(); ?>
	<div class="row" style="margin-bottom: 40px;">
		<?php if ( has_post_thumbnail()) : // Check if thumbnail exists ?>
		<div class="col-sm-5">
			<figure class="frame"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
				<div class="text-overlay">
					<div class="info"><span>Leer</span></div>
				</div>
				<?php the_post_thumbnail('medium'); // Declare pixel size you need inside the array ?></a>
			</figure>
		</div>
		<!-- /column -->
		<div class="col-sm-7 post-content">
		<?php else : ?>
		<div class="col-sm-12 post-content">
		<?php endif; ?>
			<div class="meta"><?php 
				$post_cats = get_the_category(); 
				if (! empty($post_cats)) {
					echo '<span class="category"><a href="'.esc_url(get_category_link( $post_cats[0]->term_id )).'">' . esc_html( $post_cats[0]->name ) . '</a></span>';
				}
			?><span class="date"><?php the_time('F j, Y'); ?> </span><!-- <span class="comments"><a href="#"><?php echo esc_html(get_comments_number()) ?> <i class="icon-chat-1"></i></a></span> --></div>
			<?php if (! empty(get_the_title())) : ?> 
					<h2 class="post-title">
						<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a>
					</h2> 
			<?php endif; ?>
			<?php the_excerpt(); // Build your custom callback length in functions.php ?>
			<!-- <h6 style="text-align:center"> <a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">Leer más</a></h6> -->
		</div>
		<!-- /column -->
	</div>
	<!-- /.row -->
<?php endwhile; else: error_log("OOOOHHH!!");  endif; ?>