<?php

	session_start();

    $emailto = 'contact@eldiletante.com';
	$nocomment = isset($_POST["nocomment"]) ? $_POST["nocomment"] : "";
	$subject = 'Email from edd';
	$emailfrom =  "contact@eldiletante.com";
	$message = '';
	$response = '';
	$response_fail = (empty($_SESSION['LANGUAGE_IN_USE']) || $_SESSION['LANGUAGE_IN_USE'] == 'es') ? 'Error. Verifique todos los campos del formulario y vuelva a intentarlo, por favor.' : 'Error. Please verify the form fields and try again.';
	
	if (isset($_POST['g-recaptcha-response'])) {
		$output = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeZ0AYTAAAAAEEf5jI7YkobkyE60xxfv9tT4nNm&response=".$_POST['g-recaptcha-response']), true);
		if (isset($output['success']) && $output['success'] == true) {
			// Honeypot captcha
			if($nocomment == '') {			
				$params = $_POST;
				foreach ( $params as $key=>$value ) {
					if ($key == 'email') {
						$emailfrom = $value;
					}
					elseif ($key == 'subject') {
						$subject = $value;
					}	
					elseif (!($key == 'g-recaptcha-response' || $key == 'ip' || $key == 'emailsubject' || $key == 'url' || $key == 'emailto' || $key == 'nocomment' || $key == 'v_error' || $key == 'v_email')) {
						$key = ucwords(str_replace("-", " ", $key));
						if ( gettype( $value ) == "array" ){
							$message .= "$key: \n";
							foreach ( $value as $two_dim_value ) {
								$message .= "...$two_dim_value<br>";
							}							
						}
						else {
							$message .= $value != '' ? "$key: $value\n" : '';
						}
					}
				}
				$response = sendEmail($subject, $message, $emailto, $emailfrom);
			} 
			else {
				$response = $response_fail; // . " comment is not empty";
				error_log("email error: comment is not empty");
			}
		}
		else {
			$response = $response_fail; // . " captcha didn't authorize";
			error_log("email error: captcha didn't authorize");
		}
	}
	else {
		$response = $response_fail; // . " captcha didn't work";
		error_log("email error: captcha didn't work");
	}
		
	echo $response;

    // Run server-side validation
    function sendEmail($subject, $content, $emailto, $emailfrom) {
    	$from = $emailfrom;
    	$response_sent = (empty($_SESSION['LANGUAGE_IN_USE']) || $_SESSION['LANGUAGE_IN_USE'] == 'es') ? 'Gracias. Su mensaje fue enviado. Le responderé tan pronto como me sea posible.' : 'Thank you. Your message was sent and I\'ll reply ASAP.';
    	$response_error = 'Error. Please try again.';
    	$subject =  filter($subject);
    	$url = "Origin Page: ".$_SERVER['HTTP_REFERER'];
    	$ip = "IP Address: ".$_SERVER["REMOTE_ADDR"];
    	$message = $content."\n$ip\r\n$url";
    	
    	// Validate return email & inform admin
    	$emailto = filter($emailto);
    
    	// Setup final message
    	$body = wordwrap($message);
    	
    	// Create header
    	$headers = "From: $from\n";
    	$headers .= "MIME-Version: 1.0\n";
    	$headers .= "Content-type: text/plain; charset=utf-8\n";
    	// $headers .= "Content-Transfer-Encoding: quoted-printable\r\n";
    	
    	// Send email
    	$mail_sent = @mail($emailto, $subject, $body, $headers);
    	$response = $mail_sent ? $response_sent : $response_error;
    		
    	return $response;
    }
    
    // Remove any un-safe values to prevent email injection
    function filter($value) {
    	$pattern = array("/\n/", "/\r/", "/content-type:/i", "/to:/i", "/from:/i", "/cc:/i");
    	$value = preg_replace($pattern, "", $value);
    	return $value;
    }

    // exit;

?>
