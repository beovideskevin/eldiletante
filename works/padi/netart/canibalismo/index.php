<?php

require('../../../../$_.php');

$_("config", "../../../../config");
$_("connect");

$small_array = ["a", "ante", "bajo", "cabe", "con", "contra", "de", "desde", "durante", "en", "entre", "hacia", "hasta", 
		"mediante", "para", "por", "segun", "sin", "so", "sobre", "tras", "versus", "via", "y", "ni", "tanto", "como",
		"cuanto", "igual", "que", "tambien", "ya", "pero", "sino", "porque", "por que", "aunque", "luego", "que", "conque", 
		"de", "el", "ella", "ellos", "ello", "la", "y", "e", "asi", "mas", "empero", "mientras", "o", "u", "ya", "sea", "vos", 
		"nos", "nosotros", "ud", "ustedes", "yo", "tu"];

		
$unwanted_array = array('Š'=>'S', 'š'=>'s', 'Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A', 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E',
						'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I', 'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U',
						'Ú'=>'U', 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss', 'à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a', 'å'=>'a', 'æ'=>'a', 'ç'=>'c',
						'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i', 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o',
						'ö'=>'o', 'ø'=>'o', 'ù'=>'u', 'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y');

						
$args = $_REQUEST;

if ( ! empty($args['topic'])) {
	$allPar = [];

	$str = strtr($args['topic'], $unwanted_array);

	$words = explode(" ", $str);
	$query = "";

	for ($index = 0; $index < count($words); $index++) {
		if (in_array($words[$index], $small_array) || strlen($words[$index]) < 4) {
			array_splice($words, $index, 1);
			continue;
		}
		
		$words[$index] = "%" . strtolower($words[$index]) . "%";

		if (! empty($query)) {
			$query .= " OR ";
		} 

		$query .= " lower(`text`) LIKE ? ";
	}

	if (! empty($words)) {
		// get all the articles that talk about the topic
		$all = $_("assoclist: SELECT  CAST(CONVERT(`text` USING utf8) AS binary) as `text` FROM `aleph` WHERE " . $query . " ORDER BY id ASC", $words);

		if (! empty($all)) {
			$final = '';
			$allPar = [];
			
			// for each article
			foreach ($all as $one) {
				// get all the lines (\n)
				$lines = explode("\n", $one['text']);

				//for each line 
				foreach ($lines as $l) {
					if (empty($l)) {
						continue;
					}

					// get all the sentences
					$paragraph = explode(".", $l);

					// check if each sentence is big enough (we don't want small talk :)
					for ($index = 0; $index < count($paragraph); $index++) {
						if (str_word_count($paragraph[$index]) > 10 && strlen($paragraph[$index]) > 60) {
							$allPar[] = $paragraph[$index];
						}						
					}
				}
			}

			// how many sentences does the article need
			$count = rand (12, 360);

			// generate the article by using random sentences
			for ($index = 0, $cut = 0; $index < $count && count($allPar) > 0; $index++) {
				if ($cut == 0) {
					$cut = rand (4, 20);
				}

				$i = rand (0, count($allPar) - 1);

				$final .= $allPar[$i];

				$final .= ". ";

				if (($index + 1) % $cut == 0) {
					$final .= "<br><br>";
					$cut = 0;
				} 

				array_splice($allPar, $i, 1);
			}
		}
		else {
			$final = '<p class="msg">Por favor, sea un poco más explícito. Inténtelo de nuevo.</p>';
		}
	}
	else {
		$final = '<p class="msg">Por favor, sea un poco más explícito. Inténtelo de nuevo.</p>';
	}
}
else {
	$final = '<p class="msg">Bienvenido a Canibalismo, un generador automático de artículos teóricos. Busque los términos que desee y el artículo aparecerá aquí. Siempre revise un poco el texto y arréglelo antes de darlo por terminado. El título y el uso que le dé al articulo es por completo responsabilidad suya. Esta obra se alimenta de los huesos metafísicos del Aleph.</p>';
}

?>

<html>
	<head>
		<meta charset="UTF-8">
		<link rel="icon" href="../../../../style/images/favicon.ico" type="image/x-icon" >
		<link rel="shortcut icon" href="../../../../style/images/favicon.ico" type="image/x-icon" >
		<title>Canibalismo, generador automático de artículos teóricos.</title>
		<style>
			
			body {
				background-image: url(image/lampe.gif);
				font-size: 10pt; 
				font-family: Tahoma, Verdana, Arial, Helvetica;
				background-color: #999999;
			}
			
			a:link {
				text-decoration: none
			}
			
			a:visited {
				text-decoration: none
			}
			
			a:active {
				text-decoration: none
			}
			
			td {
				font-size: 10pt; 
				font-family: Tahoma, Verdana, Arial, Helvetica
			}
			
			all.titulo {
				font-weight: bold; 
				font-size: 10pt; 
				font-family: Tahoma, Verdana, Arial, Helvetica
			}
			
			all.autor {
				font-size: 10pt; 
				font-style: italic; 
				font-family: Tahoma, Verdana, Arial, Helvetica
			}

			.msg {
				font-size: 14pt; 
				font-style: normal;
				font-family: Tahoma, Verdana, Arial, Helvetica
			}
		</style>
	</head>
	<body>
		<center>
			<table cellSpacing=0 cellPadding=0 width="95%" border=0>
				<tbody>
					<tr>
						<td>&nbsp;</td>
						<td>
							<div style="text-align: center">
								<br>
								<form id="mainForm" name="mainForm" method="POST" action="./index.php">
									<input type="text" size="30" id="topic" name="topic" value="<?php (! empty($args['topic']) ? $args['topic'] : '' ) ?>">
									<input type="submit" name="submit" id="submit" value="<<<">
								</form>
							</div>
						</td>
						<td>
							<div style="text-align: right">
								<img src="image/pens.gif" style="width: 167px">
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</center>
	
		<hr style="text-align: left; width: 100%" noShade SIZE=3>
		
		<center>
			
			<table  cellSpacing=0 cellPadding=0 width="90%" border=0>
				<tbody>
					<tr>
						<td>
							<div>
								<p><br></p>
							</div>
							<?php echo $final; ?>
							<div>
								<p><br></p>
							</div>
						</td>
					</tr>
				</tbody>
			</table>
		</center>
	</body>
</html>