<?php


$to       = 'info@harriken.com';
$name    = $_POST['name'];
$subject = 'harriken visitors'; 
$email    = $_POST['mail'];

 $radio_value = isset($_POST["radio"]) ? $_POST['radio'] : "";

$message  = $radio_value . " ". $name . " sent :\" ". $_POST['message'] . " \" from " . $email. " ."  ;
$headers  = "From: noreply@harriken.com" . "\r\n" .
			"CC: harriken.chuchu@gmail.com";

 

if(mail($to, $subject, $message, $headers)){
	echo json_encode(array('status' => 'success', 'message' => 'Thanks for your interest in Harriken. We shall be getting back to you soon'));
}
else
{
	echo json_encode(array('status' => 'failed', 'message' => 'Mail not sent'));
}
?>
