<?php 

// stran za izpis
require ('includes/config.inc.php'); 
$page_title = 'Logout';

// če v seji ni shranjenega imena, lahko uporabnika samo preuksmerimo 
if (!isset($_SESSION['first_name'])) {

	$url = BASE_URL . 'login.php';
	ob_end_clean(); 
	header("Location: $url");
	exit();
	
} else { // v nasprotnem primeru odjavimo uporabnika

	$_SESSION = array(); // izbris sejnih spremenljivk
	session_destroy(); // uničevanje seje
	setcookie (session_name(), '', time()-3600); // izbris piškotkov

}

// izpis sporočila
echo '<h3>You are now logged out.</h3>';

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="naloga za razvoj informacijskih sistemov">
    <meta name="author" content="Matej Fekonja, Eva Kuster, Katarina Rajh, Barbara Ribaric">


    <title>RIS</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>
    <link href="theme.css" rel="stylesheet">
	
<body>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  
</body>
</head>
</html>