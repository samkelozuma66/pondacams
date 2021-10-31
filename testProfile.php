<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
</head>
<body>
	<?php
	$email = "umeshnamdev234@gmail.com";
	$name = "umesh";
	$password = "12345";
	$hash = "dgvivjj";
	//$headers = "drhnfieri";
	$to      = $email; // Send email to our user
	$subject = 'Signup | Verification'; // Give the email a subject 
	$message = '
	  
	Thanks for signing up!
	Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
	  
	------------------------
	Username: '.$name.'
	Password: '.$password.'
	------------------------
	  
	Please click this link to activate your account:
	http://localhost/pondacam/model/profile.php?email='.$email.'&hash='.$hash.'
	  
	'; // Our message above including the link
						  
	//$headers = 'From:noreply@yourwebsite.com' . "\r\n"; // Set from headers
	mail($to, $subject, $message, $headers); // Send our email
	?>
</body>
</html>