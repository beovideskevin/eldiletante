<?php 

if (isset($_POST['uploadName']) && ! empty($_POST['uploadName']) && isset($_POST['uploadData']) && ! empty($_POST['uploadData'])) {
	error_log("uploadName : " . $_POST['uploadName']);
	error_log("uploadData : " . $_POST['uploadData']);
}

echo "Thank you for your contribution! Your image has been published and is now visible at http://livegallery.eldiletante.com";