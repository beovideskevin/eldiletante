<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

      <aside class="col-md-4 col-sm-12 sidebar">
		  
		<div class="sidebox box widget">
          <form class="searchform" method="get" action="<?php echo home_url(); ?>">
            <input type="text" id="s2" name="s" value="<?php echo isset( $_GET["s"] ) ? esc_attr( $_GET["s"] ) : ''; ?>" placeholder="type and hit enter"/>
          </form>
        </div>
        <!-- /.widget -->
        
		<?php if ( ! empty($pages = get_pages(array('sort_order' => 'asc', 'sort_column' => 'post_title')))) : ?>
		<div class="sidebox box widget">
          <h3 class="widget-title section-title">Paginas</h3>
          <ul class="circled">
			<?php foreach ($pages as $page) :?>
				<li><a href="<?php echo esc_url(get_page_link( $page->ID )); ?>"><?php echo $page->post_title; ?></a></li>
            <?php endforeach; ?>
          </ul>
        </div>
        <!-- /.widget -->
		<?php endif; ?>
		
		<?php if ( ! empty($cats = get_categories(array('orderby' => 'name', 'order'   => 'ASC')))) : ?>
        <div class="sidebox box widget">
          <h3 class="widget-title section-title">Categorias</h3>
          <ul class="circled">
			<?php foreach ($cats as $cat) : ?>
				<li><a href="<?php echo esc_url(get_category_link( $cat->term_id )); ?>"><?php echo $cat->name; ?></a></li>
			<?php endforeach; ?>
          </ul>
        </div>
        <!-- /.widget -->
		<?php endif; ?>
        
		<?php if ( ! empty($tags = get_tags())) : ?>
		
		<div class="sidebox box widget">
          <h3 class="widget-title section-title">Tags</h3>
          <ul class="tag-list">
			  
		<?php foreach ($tags as $tag) : ?>
			<li><a href="<?php echo esc_url(get_tag_link( $tag->term_id )); ?>" class="btn"><?php echo $tag->name; ?></a></li>
		<?php endforeach; ?>
			  
		  </ul>	  
		  <!-- /.tag-list -->  
        </div>
        <!-- /.widget --> 
			  
		<?php endif; ?>
        
		
		
		<?php  dynamic_sidebar('right-sidebar');  ?>
		
		
		
		<div class="sidebox box widget">
          <!--<h3 class="widget-title section-title">Elsewhere</h3> -->
          <p>El Diletante Digital en las redes sociales...</p>
          <ul class="social">
            <li><a href="https://www.facebook.com/diletantedigital" target="_blank"><i class="icon-s-facebook"></i></a></li>
			<li><a href="https://www.twitter.com/diletantedig" target="_blank"><i class="icon-s-twitter"></i></a></li>
			<li><a href="https://instagram.com/eldiletantedigital/" target="_blank"><i class="icon-s-instagram"></i></a></li>
			<li><a href="https://www.vimeo.com/user34254647" target="_blank"><i class="icon-s-vimeo"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <!-- /.widget -->
        
      </aside>
      <!-- /column .sidebar --> 
