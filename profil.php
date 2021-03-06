<?php

// skripta, ki omogoča, da si uporabniku spremenijo geslo
// PHP skripta za spreminjanje gesla
// prikaz obrazca za spreminjanje gesla
ob_start();
session_start();

require ('includes/config.inc.php'); 
$page_title = 'Profil';

// če uporabnik  ni prijavljen
if (!isset($_SESSION['id_uporabnik'])) {
	
	$url = BASE_URL . 'vsi_artikli.php'; 
	ob_end_clean(); 
	header("Location: $url");
	exit();
	
}

?>
<!DOCTYPE html>
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
	<script src="sorttable.js"></script>
    <link href="theme.css" rel="stylesheet">


  </head>
<!-- NAVBAR
================================================== -->
  <body>
    <div class="navbar-wrapper">
      <div class="container">
        <nav class="navbar navbar-inverse navbar-fixed-top">
          <div class="container">
            <div class="navbar-header">
              <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
              </button>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
              <ul class="nav navbar-nav">
                <li><a href="vsi_artikli.php">Vsi artikli</a></li>
                <li><a href="moji_artikli.php">Moji artikli</a></li>
                <li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
 					<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
				  <?php if (isset($_SESSION['ime'])) {
							echo "{$_SESSION['ime']} {$_SESSION['priimek']}";
						} 
						?> <span class="caret"></span></a>
                  <ul class="dropdown-menu">
                    <li class="active"><a href="profil.php">Moj profil</a></li>
                    <li><a href="change_password.php">Sprememba gesla</a></li>
                    <li><a href="logout.php">Odjava</a></li>
          		</ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
<br><br>
	<div class="container">
      <div class="page-header">
        <h1>Moji podatki</h1>
      </div>
	  
	  <div class="col-md-6">
       	<div class="row">
			<?php 
				if (isset($_SESSION['ime'])) {
					echo "<h4><b>Ime:</b> {$_SESSION['ime']} </h4>";
					echo "<h4><b>Priimek:</b> {$_SESSION['priimek']} </h4>";
					echo "<h4><b>Email:</b> {$_SESSION['email']} </h4>";					
				} 
			?> 
		</div>
	  </div>
    </div>
      <br>

	<script>
	</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
