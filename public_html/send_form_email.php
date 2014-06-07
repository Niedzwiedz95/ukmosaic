<?php
 
if(isset($_POST['email']))
{
 
    $email_to = "info@martinmosaic.com";
 
    $email_subject = "martinmosaic";

     
 
    $email_message .= "Name: ".clean_string($name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Telephone: ".clean_string($telephone)."\n";
 
    $email_message .= "Comments: ".clean_string($comments)."\n";
 
	
	// create email headers
	 
	$headers = 'From: '.$email_from."\r\n".
	 
	'Reply-To: '.$email_from."\r\n" .
	 
	'X-Mailer: PHP/' . phpversion();
	 
	mail($email_to, $email_subject, $email_message, $headers);
     
}

?>
