<?php

// JUST FOR DEBUGGING
// error_reporting (E_ALL);

require_once('$_.php');
$_("cli");

/**
 * Run the migrations
 * php cli.php migrations f95db1a57cf1e55f7b5ad11fb19c373b38e0c44a
 */
function runMigrations ($args = []) 
{
	global $_;
  
	if (empty($args['key']) || $args['key'] != $_("getConfig: MIGRATIONKEY") || !$_("migrations")) {
		return "KO" . PHP_EOL;
	} 

  	// Get the base path for the websites and the images
  	$basePath = "." . FILES_ABSOLUTE_PATH . "assets/images/portfolio";

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
			["catacumbas.jpg", "Quocumque te vertas mors’in insidiis est Dequelque coté que tu tournes la mort est aux aguets", "Quocumque te vertas mors’in insidiis est Dequelque coté que tu tournes la mort est aux aguets", ""]
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
			$query = "INSERT INTO gallery (`gallery`, `thumbnail`, `image`, `title`, `description`, `datasize`, `url`) 
			 		  VALUES (?, ?, ?, ?, ?, ?, ?)";
			$_(": {$query}", [
				$gallery,
				$image[0],
				$image[0],
				$image[1],
				$image[2],
				"{$width}x{$height}",
				$image[3]
			]);
		}
	}

	// All done, go to the index page
	return "OK" . PHP_EOL;
}

/**
 * The help
 */
function cliHelp($args = []) {
    return "You need help, kid" . PHP_EOL;
}