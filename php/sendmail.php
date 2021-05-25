<?php
	set_error_handler('minFunksjon');
	function minFunksjon ($errno, $errstr, $errfile, $errline, $errcontext)	{
		echo "Errno: " . $errno . "<br>\r\n";
		echo "Errstr: " . $errstr . "<br>\r\n";
		echo "Errfile: " . $errfile . "<br>\r\n";
		echo "Errline: " . $errline . "<br>\r\n";
		echo "Errcontext: " . $errcontext . "<br>\r\n";
	}

  ini_set("SMTP","s381.usn.no");
  ini_set("smtp_port","25");
	date_default_timezone_set("Europe/Oslo");
	$til = $_POST['email'];
	$fra = "admin@valg2021";
	$subject = "Endret passord";
	$melding = "Don't Forget!";
	$headers = "From: " . $fra . "\r\n" .
				'X-Mailer: PHP/' . phpversion() . "\r\n" .
				"MIME-Version: 1.0\r\n" .
				"Content-Type: text/html; charset=utf-8\r\n" .
				"Content-Transfer-Encoding: 8bit\r\n\r\n";
	$OK = mail($til, $subject, $melding, $headers);
	if ($OK) {
?>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Meldingen er sendt</title>
</head>
<body>Meldingen er sendt!</body>
</html>
 /*<?php
	} else {
?>*/
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<title>Meldingen er ikke sendt</title>
</head>
<body>Meldingen ble ikke sendt til <?php echo $til ?></body>
</html>
<?php
	}
?>