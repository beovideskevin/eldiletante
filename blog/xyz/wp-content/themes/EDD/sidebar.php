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
		
		<!-- <?php if ( ! empty($cats = get_categories(array('orderby' => 'name', 'order' => 'ASC')))) : ?>
        <div class="sidebox box widget">
          <h3 class="widget-title section-title">Cuentos</h3>
          <ul class="circled">
			<?php foreach ($cats as $cat) : ?>
				<li><a href="<?php echo esc_url(get_category_link( $cat->term_id )); ?>"><?php echo $cat->name; ?> (<?= $cat->count ?>)</a></li>
			<?php endforeach; ?>
          </ul>
        </div>
		<?php endif; ?> -->

    <div class="sidebox box widget">
      <h3 class="widget-title section-title">Cuentos</h3>
        <ul class="circled">
				  <li><a href="/blog/2018/08/14/papeles-sucios/">Papeles Sucios</a></li>
          <li><a href="/blog/tag/megacity-blues/">Megacity Blues</a></li>
        </ul>
    </div>
    <!-- /.widget -->
    

		<?php if ( ! empty($tags = get_tags())) : ?>
		
		<div class="sidebox box widget">
          <h3 class="widget-title section-title">Tags</h3>
          <ul class="tag-list">
			  
		<?php for ($i = 0; $i < 12 && $i < count($tags); $i++) : ?>
			<li><a href="<?php echo esc_url(get_tag_link( $tags[$i]->term_id )); ?>" class="btn"><?php echo $tags[$i]->name; ?></a></li>
		<?php endfor; ?>
			  
		  </ul>	  
		  <!-- /.tag-list -->  
        </div>
        <!-- /.widget --> 
			  
		<?php endif; ?>
        
		
		
		<?php  dynamic_sidebar('right-sidebar');  ?>
		
		
		
		<div class="sidebox box widget">
          <!--<h3 class="widget-title section-title">Elsewhere</h3> -->
          <p>El Diletante Digital en las redes	...</p>
          <ul class="social">
            <li><a href="https://www.facebook.com/eldiletantedigital" target="_blank"><i class="icon-s-facebook"></i></a></li>
			<li><a href="https://www.instagram.com/eldiletantedigital/" target="_blank"><i class="icon-s-instagram"></i></a></li>
			<li><a href="https://www.vimeo.com/eldiletante" target="_blank"><i class="icon-s-vimeo"></i></a></li>
          </ul>
          <div class="clearfix"></div>
        </div>
        <!-- /.widget -->
        
      </aside>
      <!-- /column .sidebar --> 
