<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

		<!-- <div class="box" style="margin: 20px 0px 50px 0px">
			<p class="pull-left" style="margin: 0px">El Diletante Digital en las redes sociales...</p>
			<ul class="social pull-right">
			  <li><a href="https://www.facebook.com/diletantedigital" target="_blank"><i class="icon-s-facebook"></i></a></li>
			  <li><a href="https://www.twitter.com/diletantedig" target="_blank"><i class="icon-s-twitter"></i></a></li>
			  <li><a href="https://instagram.com/eldiletantedigital/" target="_blank"><i class="icon-s-instagram"></i></a></li>
			  <li><a href="https://www.vimeo.com/user34254647" target="_blank"><i class="icon-s-vimeo"></i></a></li>
			</ul>
			<div class="clearfix"></div>
        </div> -->
		
      </div>
      <!-- /.content -->
    
	   <?php  get_sidebar(); ?>
	  
    </div>
    <!-- /.blog --> 
	
  </div>
  <!-- /.container --> 
</div>
<!-- /.body-wrapper --> 
<script src="/style/js/jquery.min.js"></script> 
<script src="/style/js/bootstrap.min.js"></script> 
<script src="/style/js/jquery.themepunch.tools.min.js"></script> 
<script src="/style/js/classie.js"></script> 
<script src="/style/js/plugins.js"></script> 
<script src="/style/js/scripts.js"></script>
<script src="/style/js/jquery.ripples.js"></script>
<script>
	var is_focussed = true;
	
	$(document).ready(function () {
		// we have a customer!!! :)
		$.ajax({
			type: "POST",
			url: "/ajax/counter.php"
		});


		var backfilename = "/style/images/backgrounds/bg" + Math.floor((Math.random() * 5) + 1) + ".jpg";
		$.backstretch([backfilename]);	
	
		$(".backstretch").css("background-image", "url("+backfilename+")");
		$('.backstretch').ripples({
			resolution: 512,
			dropRadius: 10,
			perturbance: 0.04,
			interactive: false
		});
		$('.backstretch img').remove();
		
		$('.backstretch').ripples("drop",  
					Math.floor((Math.random() * $('.backstretch').css('width').replace('px','')) + 1),  
					Math.floor((Math.random() * $('.backstretch').css('height').replace('px','')) + 1), 
					10, 0.4);
					
		setInterval(function () {
				if (!is_focussed) {
					return false;
				}
				$('.backstretch').ripples("drop",  
					Math.floor((Math.random() * $('.backstretch').css('width').replace('px','')) + 1),  
					Math.floor((Math.random() * $('.backstretch').css('height').replace('px','')) + 1), 
					Math.floor((Math.random() * 10)), 
					Math.random().toFixed(2));
			}, 
			20000);			

	});
	
	if (/*@cc_on!@*/false) { // check for Internet Explorer
		document.onfocusin = onFocus;
		document.onfocusout = onBlur;
	} else {
		window.onfocus = onFocus;
		window.onblur = onBlur;
	}
	
	function onBlur() {
		is_focussed = false;
	};
	
	function onFocus(){
		is_focussed = true;
	};
	
</script>

<?php wp_footer(); ?>

</body>
</html>
