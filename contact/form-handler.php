<?php
include('SMTPClass.php');

$use_smtp = '0';
$emailto = 'info@eldiletante.com';

	// retrieve from parameters
	$emailfrom = isset($_POST["email"]) ? $_POST["email"] : "";
	$nocomment = isset($_POST["nocomment"]) ? $_POST["nocomment"] : "";
	$subject = 'Email from edd';
	$message = '';
	$response = '';
	$response_fail = 'Error. Verifique todos los campos del formulario y vuelva a intentarlo, por favor.';
	
	if (isset($_POST['g-recaptcha-response'])) {
		$output = json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LeZ0AYTAAAAAEEf5jI7YkobkyE60xxfv9tT4nNm&response=".$_POST['g-recaptcha-response']), true);
		//print_r($output);
		if (isset($output['success']) && $output['success'] == true) {
			// Honeypot captcha
			if($nocomment == '') {			
				$params = $_POST;
				foreach ( $params as $key=>$value ) {
				
					if(!($key == 'g-recaptcha-response' || $key == 'ip' || $key == 'emailsubject' || $key == 'url' || $key == 'emailto' || $key == 'nocomment' || $key == 'v_error' || $key == 'v_email')){
					
						$key = ucwords(str_replace("-", " ", $key));
						
						if ( gettype( $value ) == "array" ){
							$message .= "$key: \n";
							foreach ( $value as $two_dim_value ) {
								$message .= "...$two_dim_value<br>";
							}							
						}else {
							$message .= $value != '' ? "$key: $value\n" : '';
						}
					}
				}
				
				$response = sendEmail($subject, $message, $emailto, $emailfrom);	
			} 
			else {
				$response = $response_fail; // . " comment is not empty";
			}
		}
		else {
			$response = $response_fail; // . " captcha didn't authorize";
		}
	}
	else {
		$response = $response_fail; // . " captcha didn't work";
	}
		
	echo $response;

// Run server-side validation
function sendEmail($subject, $content, $emailto, $emailfrom) {
	
	$from = $emailfrom;
	$response_sent = 'Gracias. Su mensaje fue enviado. Le responderé tan pronto como me sea posible.';
	$response_error = 'Error. Please try again.';
	$subject =  filter($subject);
	$url = "Origin Page: ".$_SERVER['HTTP_REFERER'];
	$ip = "IP Address: ".$_SERVER["REMOTE_ADDR"];
	$message = $content."\n$ip\r\n$url";
	
	// Validate return email & inform admin
	$emailto = filter($emailto);

	// Setup final message
	$body = wordwrap($message);
	
	if($use_smtp == '1'){
	
		$SmtpServer = 'SMTP SERVER';
		$SmtpPort = 'SMTP PORT';
		$SmtpUser = 'SMTP USER';
		$SmtpPass = 'SMTP PASSWORD';
		
		$to = $emailto;
		$SMTPMail = new SMTPClient ($SmtpServer, $SmtpPort, $SmtpUser, $SmtpPass, $from, $to, $subject, $body);
		$SMTPChat = $SMTPMail->SendMail();
		$response = $SMTPChat ? $response_sent : $response_error;
		
	} else {
		
		// Create header
		$headers = "From: $from\n";
		$headers .= "MIME-Version: 1.0\n";
		$headers .= "Content-type: text/plain; charset=utf-8\n";
		// $headers .= "Content-Transfer-Encoding: quoted-printable\r\n";
		
		// Send email
		$mail_sent = @mail($emailto, $subject, $body, $headers);
		$response = $mail_sent ? $response_sent : $response_error;
		
	}
	return $response;
}

// Remove any un-safe values to prevent email injection
function filter($value) {
	$pattern = array("/\n/", "/\r/", "/content-type:/i", "/to:/i", "/from:/i", "/cc:/i");
	$value = preg_replace($pattern, "", $value);
	return $value;
}

exit;

?>