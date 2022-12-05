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
    if (isset($output['success']) && $output['success'] == true && 
        $_(
          "email: contact@eldiletante.com", 
          [
            "subject"   => "Email from eldiletante.com", 
            "emailfrom" => $args['email'],
            "namefrom"  => $args['name']
          ], 
          [
            "OUTPUT" => $args['message'] . "<br>Origin: eldiletante.com" 
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

function runMigrations ($args = []) 
{
	global $_;

	if (!$_("migrations")) {
		die("KO");
	}

  // Get the base path for the websites and the images
  $basePath = FILES_BASE_PATH . "assets/images/portfolio";

	// Insert galleries
	$galleries = [
    "itinerant" => [
      ["bitter1.jpg", "It is bitter but I like it because it is bitter and because it is my heart", "It is bitter but I like it because it is bitter and because it is my heart", ""],
      ["bitter2.jpg", "It is bitter but it is my heart", "It is bitter but it is my heart", ""],
      ["griego1.jpg", "Afirmaba, dicen, que por tres cosas daba gracias a la Fortuna. Primero por haber nacido hom­bre y no animal, luego varón y no mujer, y en tercer lugar griego y no bárbaro.", "Afirmaba, dicen, que por tres cosas daba gracias a la Fortuna. Primero por haber nacido hom­bre y no animal, luego varón y no mujer, y en tercer lugar griego y no bárbaro.", ""],
      ["griego2.jpg", "Afirmaba, dicen, que por tres cosas daba gracias a la Fortuna. Primero por haber nacido hom­bre y no animal, luego varón y no mujer, y en tercer lugar griego y no bárbaro.", "Afirmaba, dicen, que por tres cosas daba gracias a la Fortuna. Primero por haber nacido hom­bre y no animal, luego varón y no mujer, y en tercer lugar griego y no bárbaro.", ""],
      ["mechanic1.jpg", "You came and saved me like a mechanic god", "You came and saved me like a mechanic god", ""],
      ["mechanic2.jpg", "You came and saved me like a mechanic god", "You came and saved me like a mechanic god", ""],
      ["michelangelo1.jpg", "Quien es Giuliano? Su inmortalidad burlada. Quien lo recuerda? Es esta tumba monumento para el político o para el escultor? El genio se burla de la mediocridad aún cuando deba servirla.", "Quien es Giuliano? Su inmortalidad burlada. Quien lo recuerda? Es esta tumba monumento para el político o para el escultor? El genio se burla de la mediocridad aún cuando deba servirla.", ""],
      ["michelangelo2.jpg", "Quien es Giuliano? Su inmortalidad burlada. Quien lo recuerda? Es esta tumba monumento para el político o para el escultor? El genio se burla de la mediocridad aún cuando deba servirla.", "Quien es Giuliano? Su inmortalidad burlada. Quien lo recuerda? Es esta tumba monumento para el político o para el escultor? El genio se burla de la mediocridad aún cuando deba servirla.", ""],
      ["dayana1.jpg", "En que piensa una madre cuando acaricia su vientre, en la vida o en la muerte?", "En que piensa una madre cuando acaricia su vientre, en la vida o en la muerte?", ""],
      ["dayana2.jpg", "En que piensa una madre cuando acaricia su vientre, en la vida o en la muerte?", "En que piensa una madre cuando acaricia su vientre, en la vida o en la muerte?", ""],
      ["partenon.jpg", "El búho de Minerva solo levanta el vuelo en el crepúsculo", "El búho de Minerva solo levanta el vuelo en el crepúsculo", ""],
      ["socrates1.jpg", "All humans are mortal Socrates is human therefore Socrates is mortal", "All humans are mortal Socrates is human therefore Socrates is mortal", ""],
      ["socrates2.jpg", "All humans are mortal Socrates is human therefore Socrates is mortal", "All humans are mortal Socrates is human therefore Socrates is mortal", ""],
      ["socrates3.jpg", "All humans are mortal Socrates is human therefore Socrates is mortal", "All humans are mortal Socrates is human therefore Socrates is mortal", ""],
      ["socrates4.jpg", "All humans are mortal Socrates is human therefore Socrates is mortal", "All humans are mortal Socrates is human therefore Socrates is mortal", ""],
      ["socrates5.jpg", "All humans are mortal Socrates is human therefore Socrates is mortal", "All humans are mortal Socrates is human therefore Socrates is mortal", ""],
      ["climax1.jpg", "En el clímax se arquea, se sonroja, y musita una grosería. ", "En el clímax se arquea, se sonroja, y musita una grosería. ", ""],
      ["climax2.jpg", "En el clímax se arquea, se sonroja, y musita una grosería. ", "En el clímax se arquea, se sonroja, y musita una grosería. ", ""],
      ["climax3.jpg", "En el clímax se arquea, se sonroja, y musita una grosería. ", "En el clímax se arquea, se sonroja, y musita una grosería. ", ""],
      ["climax4.jpg", "En el clímax se arquea, se sonroja, y musita una grosería. ", "En el clímax se arquea, se sonroja, y musita una grosería. ", ""],
      ["todust1.jpg", "All go to one place; all come from dust, and all return to dust.", "All go to one place; all come from dust, and all return to dust.", ""],
      ["todust2.jpg", "All go to one place; all come from dust, and all return to dust.", "All go to one place; all come from dust, and all return to dust.", ""],
      ["relampago.jpg", "Somos un relámpago de pasión entre el olvido y la nada.", "Somos un relámpago de pasión entre el olvido y la nada.", ""],
      ["empatia.jpg", "Le dije: Sometimes I feel like a background character in my own life. Ella respondio: Have you been listening to my inner monologue?", "Le dije: Sometimes I feel like a background character in my own life. Ella respondio: Have you been listening to my inner monologue?", ""],
      ["timetedeum.jpg", "Timete Deum", "Timete Deum", ""]
    ],
    "nudes" => [
      ["nikita1.jpg", "Nikita", "Nikita", ""],
      ["nikita2.jpg", "Nikita", "Nikita", ""],
      ["barbie1.jpg", "Barbie", "Barbie", ""],
      ["barbie2.jpg", "Barbie", "Barbie", ""],
      ["geometry1.jpg", "Geometry of the spheres", "Geometry of the spheres", ""],
      ["geometry2.jpg", "Geometry of the spheres", "Geometry of the spheres", ""],
      ["geometry3.jpg", "Geometry of the spheres", "Geometry of the spheres", ""],
      ["geometry4.jpg", "Geometry of the spheres", "Geometry of the spheres", ""],
      ["gisselle1.jpg", "Gisselle", "Gisselle", ""],
      ["gisselle2.jpg", "Gisselle", "Gisselle", ""],
      ["gisselle3.jpg", "Gisselle", "Gisselle", ""],
      ["gisselle4.jpg", "Gisselle", "Gisselle", ""],
      ["lisa1.jpg", "Lisa", "Lisa", ""],
      ["lisa2.jpg", "Lisa", "Lisa", ""],
      ["lisa3.jpg", "Lisa", "Lisa", ""],
      ["laura1.jpg", "Laura", "Laura", ""],
      ["laura2.jpg", "Laura", "Laura", ""],
      ["laura3.jpg", "Laura", "Laura", ""],
      ["personality.jpg", "Personality goes a long way", "Personality goes a long way", ""],
      ["two-guitars.jpg", "Two guitars to play with", "Two guitars to play with", ""],
      ["days1.jpg", "Days of youth (remake 2022)", "Days of youth (remake 2022)", ""],
      ["days2.jpg", "Days of youth (remake 2022)", "Days of youth (remake 2022)", ""],
      ["days3.jpg", "Days of youth (remake 2022)", "Days of youth (remake 2022)", ""],
      ["days4.jpg", "Days of youth (remake 2022)", "Days of youth (remake 2022)", ""]
    ],
		"rolando" => [
			["poems-rolando-CRIM0623.jpg", "Rolando-01", "<:ROLANDO/>", ""],
			["poems-rolando-CRIM0573.jpg", "Rolando-02", "<:ROLANDO/>", ""],
			["poems-rolando-CRIM0511.jpg", "Rolando-03", "<:ROLANDO/>", ""],
			["poems-rolando-CRIM0163.jpg", "Rolando-04", "<:ROLANDO/>", ""],
			["poems-rolando-CRIM0115.jpg", "Rolando-05", "<:ROLANDO/>", ""],
			["poems-rolando-20220521_153114.jpg", "Rolando-06", "<:ROLANDO/>", ""]
		]
	];

	foreach ($galleries as $gallery => $images) {
		foreach ($images as $image) {
			list($width, $height) = getimagesize($basePath . "/" . $gallery . "/" . $image[0]);
			$galleryImage = new Schemas("gallery");
			$galleryImage->gallery = $gallery;
			$galleryImage->thumbnail = $image[0];
			$galleryImage->image = $image[0];
			$galleryImage->title = $image[1];
			$galleryImage->description = $image[2];
			$galleryImage->datasize = $width . 'x' . $height;
			$galleryImage->url = $image[3];
			$galleryImage->save();

			// $query = "INSERT INTO gallery (`gallery`, `thumbnail`, `image`, `title`, `description`, `datasize`, `url`) 
			// 		  VALUES ('{$gallery}', '{$image[0]}.webp', '{$image[0]}.jpg', '{$image[1]}', '{$image[2]}', '{$width}x{$height}', '$image[3]')";
			// $_(": {$query}");
		}
	}

	// All done, go to the index page
	return indexPage($args);
}