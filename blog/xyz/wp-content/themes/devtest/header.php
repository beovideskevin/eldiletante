<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title><?php bloginfo('title'); ?></title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" rel="stylesheet" media="screen,projection"/>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/solid.css" integrity="sha384-v2Tw72dyUXeU3y4aM2Y0tBJQkGfplr39mxZqlTBDUZAb9BGoC40+rdFCG0m10lXk" crossorigin="anonymous">
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/fontawesome.css" integrity="sha384-q3jl8XQu1OpdLgGFvNRnPdj5VIlCvgsDQTQB6owSOHWlAurxul7f+JpUOVdAiJ5P" crossorigin="anonymous">
		<?php wp_head(); ?>
	</head>
    <body>
        <!-- Document Wrapper
        ============================================= -->
        <div id="wrapper" class="clearfix">
		
			<div class="sideMenu">
                <a href="javascript:;" id="closeMenuLink"><img src="images/closemenu.png"></a>
                <ul>
                    <li class="active"><a href="javascript:;">HOME</a></li>
                    <li><a href="javascript:;">FLOOR PLANS</a></li>
                    <li><a href="javascript:;">GALLERY</a></li>
                    <li><a href="javascript:;">AMENITIES</a></li>
                    <li><a href="javascript:;">CONTACT</a></li>
                </ul>
				
				<?php 
					// wp_nav_menu(); 
				?>
            </div>
		
			<div id="header">
                <nav class="navbar navbar-expand-lg navbar-light ">
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link menuLink" href="#"><img src="images/menu.png"> </a>
                        </li>
                    </ul>
                
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link menuLink" href="#"> MENU</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="#">CALL 888.555.5555</a>
                        </li>  
                    </ul>

                    <ul class="nav navbar-nav navbar-logo mx-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="#"><img alt="LOGO" src="images/logo.png"></a>
                        </li>
                    </ul>
                                
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a class="nav-link" href="#">RESIDENTS</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">APPLY NOW</a>
                        </li>  
                    </ul>

                </nav>
            </div>

            <section id="mainImage" class="clearfix">

                <img src="images/main.jpg" class="img-fluid" alt="LOREM IPSUM DOLOR SIT AMENT">
                <span id="downArrow">
                    <!-- <i class="fas fa-angle-double-down"></i> -->
                   <a href="javascript:;" id="downArrowLink"><img src="images/down.png"></a>
                </span>

            </section>
		
			<section id="postsCarousel">

                <div class="row">
                    <div class="col-md-12" id="floor-title">
                        <h1>FLOOR PLANS</h1>
                        <h5>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod. tempor </h5>
                    </div>
                </div>

                <div class="row row-equal">
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">S1</h5>
                                <h6 class="card-subtitle mb-2">Studio / 1 Bathroom</h6>
                                <div class="container"><img src="images/floor1.jpg" ></div>
                            </div>
                            <div class="card-bottom">
                                <span class="card-bottom-first">650 SQ FT</span>
                                <span class="card-bottom-last">$1,500</span>    
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">A1</h5>
                                <h6 class="card-subtitle mb-2">1 Bedroom / 1 Bathroom</h6>
                                <div class="container"><img src="images/floor2.jpg" ></div>
                            </div>
                            <div class="card-bottom">
                                <span class="card-bottom-first">850 SQ FT</span>
                                <span class="card-bottom-last">$1,800</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">B1</h5>
                                <h6 class="card-subtitle mb-2">2 Bedroom / 1 Bathroom</h6>
                                <div class="container"><img src="images/floor3.jpg" ></div>
                            </div>
                            <div class="card-bottom">
                                <span class="card-bottom-first">1,096 SQ FT</span>
                                <span class="card-bottom-last">$2,000</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">C3</h5>
                                <h6 class="card-subtitle mb-2">3 Bedroom / 2 Bathroom</h6>
                                <div class="container"><img src="images/floor4.jpg" ></div>
                            </div>
                            <div class="card-bottom">
                                <span class="card-bottom-first">1,235 SQ FT</span>
                                <span class="card-bottom-last">$2,400</span>
                            </div>
                        </div>
                    </div>

                    <a class="products-prev" href="javascript:;">
                        <i class="fas fa-chevron-left"></i>
                    </a>
                    <a class="products-next" href="javascript:;">
                        <i class="fas fa-chevron-right"></i>
                    </a>
                </div>

                <div class="row row-equal">
                    <div class="col-md-12">
                        <div class="mycarousel-controls">
                            <ol class="mycarousel-indicators">   
                                <li data-target="#slideshow" data-slide-to="0" class="active"></li>
                                <li data-target="#slideshow" data-slide-to="1"></li>
                                <li data-target="#slideshow" data-slide-to="2"></li>
                            </ol>
                        </div>
                    </div>
                </div>
                
            </section>

			
	<!-- end #menu -->
	<!-- <div id="page">
		<div id="page-bgtop">
			<div id="page-bgbtm">
				<div id="content">