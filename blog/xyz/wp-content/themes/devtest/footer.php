				
				</div>
				
				<?php 
					//get_sidebar(); 
				?>
				<div style="clear: both;">&nbsp;</div>
			</div>
		</div>
	</div> --> 





		<section class="contact">
			<div class="contact-div"><img src="images/bottom1.png" alt="LOREM IPSUM DOLOR SIT AMENT"></div>
			<div class="contact-div"><img src="images/bottom2.jpg" class="img-fluid" alt="LOREM IPSUM DOLOR SIT AMENT"></div>
			<div class="contact-div">
				<form>
					<fieldset>
						<div class="row">
							<div class="col-md-6"><input type="text" class="form-control" name="firstName" id="firstName" placeholder="FIRST NAME"></div>
							<div class="col-md-6"><input type="text" class="form-control" name="lastName" id="lastName" placeholder="LAST NAME"></div>
							<div class="col-md-12"><input type="text" class="form-control" name="email" id="email" placeholder="EMAIL"></div>
							<div class="col-md-12"><input type="text" class="form-control" name="reference" id="reference" placeholder="HOW DID YOU HEAR ABOUT US?"></div>
							<div class="col-md-12"><input type="submit" class="form-control" name="submitBtn" id="submitBtn" value="SUBMIT"></div>
						</div>
					</fieldset>
				</form>
			</div>
		</section>

		<section class="footer">
			<div class="copyright">Copyright &copy; 2017 Developer Test</div>
			<div class="powered">Powered by <b>Razz Interactive</b>
				<div class="upArrow"><a href="javascript:;" id="upArrowLink"><img src="images/up.png"></a></div></div>
		</section>
		
	</div>     
		
	<!-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> -->
	<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
	
	<!-- -->
	<script>
		$(document).ready(function () {
			$(".sideMenu").hide();

			$(".menuLink").click(function () {
				$(".sideMenu").show();
			});

			$("#closeMenuLink").click(function () {
				$(".sideMenu").hide();
			});

			$("#downArrowLink").click(function () {
				$('html, body').animate({
					scrollTop: $('#postsCarousel').offset().top - 20 
				}, 'slow');
			});

			$("#upArrowLink").click(function () {
				$('html, body').animate({
					scrollTop: $('#header').offset().top - 20 
				}, 'slow');
			});
		});
	</script>
	
</body>
</html>
