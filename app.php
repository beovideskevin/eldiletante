<?php 

// Route /
function indexPage ($args = [])
{
	global $_;

  	$results = [
		"MENU"        => $_("inject: assets/html/menu_home.html"),
		"CONTENT"     => $_("inject: assets/html/home.html")
	];
	return $results;
}

// Route /laura
function galleryPage ($args = [])
{
	global $_;
	
	if (in_array($args['gallery'], ["itinerant", "nudes", "rolando"])) {
		$gallery = $args['gallery'];
	}
	else {
		// Wrong gallery ???!!
		return indexPage($args);
	}

	$title = [
		"itinerant"  => $_("getlang: ITINERANT"),
		"nudes"  => $_("getlang: NUDES"),
		"rolando"  => $_("getlang: POEMS")
	];

	// Get the base path for the websites and the images
	$basePath = FILES_RELATIVE_PATH . "assets/images/portfolio";

	// Get the images from the database and create the HTML of the gallery page
	$galleryHTML = '';
	$images = $_("assoclist: SELECT * FROM gallery WHERE gallery = '{$gallery}'");
	if (count($images)) {
		foreach ($images as $img) {
			$galleryHTML .= '<figure class="grid-item col-md-4 col-sm-4 col-xs-12">
                        <a href="' . $basePath . "/" . $img['gallery'] . "/" . $img['image'] . '" itemprop="contentUrl" data-size="' . $img['datasize'] . '">
                          <img src="' . $basePath . "/" . $img['gallery'] . '/thumbnails/' . $img['thumbnail'] . '" itemprop="thumbnail" alt="' . $img['title'] . ' <:ALT/>" />
                        </a>
                        <figcaption itemprop="caption description"><!-- <a href="' . $img['url'] . '" target="_blank"> -->' . $img['description'] . '<!-- </a> --></figcaption>
                      </figure>';
		}
	}
	$results = [
		"TITLE_SEO"      => "Artwork gallery",
		"MENU"           => $_("inject: assets/html/menu_page.html"),
    	"ROUTE"          => $args['gallery'],
		"TITLE"          => $title[$gallery],
		"SUBTITLE"       => "", 
		"CONTENT"        => $_("inject: assets/html/gallery.html"),
		"GALLERYCONTENT" => $galleryHTML,
		"STYLES"         => '<link rel="stylesheet" href="/eldiletante.com/assets/css/photoswipe.css">
						    <link rel="stylesheet" href="/eldiletante.com/assets/css/default-skin/default-skin.css">',
		"SCRIPTS"        => '<script type="text/javascript" src="/eldiletante.com/assets/js/masonry.​min.js"></script>
                        	<script type="text/javascript" src="/eldiletante.com/assets/js/photoswipe.min.js"></script>
                        	<script type="text/javascript" src="/eldiletante.com/assets/js/photoswipe-ui-default.min.js"></script>'
	];
	return $results;
}

// Route /show
function showPage ($args = [])
{
	global $_;
	$results = [
		"TITLE_SEO"   => "next show",
		"MENU"        => $_("inject: assets/html/menu_page.html"),
    	"ROUTE"       => 'show',
		"TITLE"       => $_("getlang: THESHOW"),
		"SUBTITLE"    => "",
		"CONTENT"     => $_("inject: assets/html/show.html")
	];
	return $results;
}

// Route /app
function appPage ($args = [])
{
	global $_;
	$results = [
		"TITLE_SEO"   => "the creative application",
		"MENU"        => $_("inject: assets/html/menu_page.html"),
    	"ROUTE"       => 'app',
		"TITLE"       => $_("getlang: THEAPP"),
		"SUBTITLE"    => "",
		"CONTENT"     => $_("inject: assets/html/app.html")
	];
	return $results;
}

// Route /book
function bookPage ($args = [])
{
	global $_;
	$results = [
		"TITLE_SEO"   => "the published book on Digital Art",
		"MENU"        => $_("inject: assets/html/menu_page.html"),
    	"ROUTE"       => 'book',
		"TITLE"       => $_("getlang: THEBOOK"),
		"SUBTITLE"    => "",
		"CONTENT"     => $_("inject: assets/html/book.html")
	];
	return $results;
}

// Route /edd
function eddPage ($args = [])
{
	global $_;
	$results = [
		"TITLE_SEO"   => "the previous projects",
		"MENU"        => $_("inject: assets/html/menu_page.html"),
    	"ROUTE"       => 'edd',
		"TITLE"       => $_("getlang: THEPROJ"),
		"SUBTITLE"    => "",
		"CONTENT"     => $_("inject: assets/html/edd.html")
	];
	return $results;
}


// Route /artist
function artistPage ($args = [])
{
	global $_;
	$results = [
		"TITLE_SEO"   => "about the artist",
		"MENU"        => $_("inject: assets/html/menu_page.html"),
    	"ROUTE"       => 'artist',
		"TITLE"       => $_("getlang: THEART"),
		"SUBTITLE"    => "",
		"CONTENT"     => $_("inject: assets/html/artist.html")
	];
	return $results;
}

// Route /contact
function contactPage ($args = [])
{
	global $_;
	$results = [
		"TITLE_SEO"   => "contact page",
		"MENU"        => $_("inject: assets/html/menu_page.html"),
   		"ROUTE"       => 'contact',
		"TITLE"       => $_("getlang: CONTACT"),
		"SUBTITLE"    => "",
		"CONTENT"     => $_("inject: assets/html/contact.html"),
		"SCRIPTS"     => "<script type='text/javascript' src='/eldiletante.com/assets/js/jquery.validate.min.js'></script>
						 <script src='https://www.google.com/recaptcha/api.js'></script>"
	];
	return $results;
}

// Route /es
function langEs ($args = [])
{
  	global $_;
  
	$_SESSION['LANGUAGE_IN_USE'] = 'es.ini';
	$_("setlang: {$_SESSION['LANGUAGE_IN_USE']}");

	if (!empty($args['url'])) {
		header("location: " . '/' . $args['url']);
	}
	else {
		return indexPage($args);
	}
}

// Route /en
function langEn ($args = [])
{
  	global $_;
	$_SESSION['LANGUAGE_IN_USE'] = 'en.ini';
  	$_("setlang: {$_SESSION['LANGUAGE_IN_USE']}");
	if (!empty($args['url'])) {
    	header("location: " . '/' . $args['url']);
	}
	else {
		return indexPage($args);
	}
}

// Route /ajax
function sendEmail ($args = [])
{
	global $_;

	$_("setlayout: ajax.html");
	$emailMsg = "Email was NOT sent!";
	$recaptcha = $_("getConfig: recaptcha");
	if (!empty($args['g-recaptcha-response']) && !empty($args['email']) && 
      	!empty($args['name']) && !empty($args['message']) && empty($args['hidden'])) 
	{
		$output = json_decode(
			file_get_contents(
				"https://www.google.com/recaptcha/api/siteverify?secret=" . $recaptcha['secretKey'] . "&response=" . $args['g-recaptcha-response']
			), 
			true
		);
		print_r($output);
		if (isset($output['success']) && $output['success'] == 1 && 
			$_(
				"email: contact@eldiletante.com", 
				[
					"subject"   => "Email from eldiletante.com"
				], 
				[
					"OUTPUT" => "name: " . $args['name'] . "<br>" . "email: " . $args['email'] . "<br>" . $args['message'] . "<br>Origin: eldiletante.com" 
				]
				))
			{
				$emailMsg = "Email sent!";
    		}
  	}

	$results = [
		"OUTPUT" => $emailMsg
	];
	return $results;
}

// Route /404
function notFound ($args = []) 
{
	error_log('WOW (404): ' . print_r($args, true));
	error_log('IP: ' . getRealIpAddr());
	return indexPage($args);
}
