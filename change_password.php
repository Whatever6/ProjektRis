<?php

// skripta, ki omogoča, da si uporabniku spremenijo geslo
// PHP skripta za spreminjanje gesla
// prikaz obrazca za spreminjanje gesla
ob_start();
session_start();

require ('includes/config.inc.php'); 
$page_title = 'Change Your Password';

// če uporabnik  ni prijavljen
if (!isset($_SESSION['id_uporabnik'])) {
	
	$url = BASE_URL . 'vsi_artikli.php'; 
	ob_end_clean(); 
	header("Location: $url");
	exit();
	
}

// če je bila podana zahteva za spremembo gesla
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);
			
	// preverjanje gesla in ali je dvakrat vnešeno isto novo geslo
	$p = FALSE;
	if (preg_match ('/^(\w){4,20}$/', $_POST['geslo1']) ) {
		if ($_POST['geslo1'] == $_POST['geslo2']) {
			$p = mysqli_real_escape_string ($dbc, $_POST['geslo1']);
		} else {
			echo '<p class="error">Gesli se ne ujemata!</p>';
		}
	} else {
		echo '<p class="error">Prosimo vnesite veljavno geslo!</p>';
	}
	
	if ($p) { // če je vse OK

		$q = "UPDATE uporabnik SET pass=SHA1('$p') WHERE id_uporabnik={$_SESSION['id_uporabnik']} LIMIT 1";	
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		if (mysqli_affected_rows($dbc) == 1) { // če je vse OK

			echo '<h3>Uspešno ste spremenili geslo.</h3>';
			
			mysqli_close($dbc);  
			exit();
			
		} else { // če se je kje zalomilo
		
			echo '<p class="error">Vaše geslo se ni spremenilo. Preverite, da je novo geslo drugačno od prejšnega. V primeru, da mislite da je prišlo do napake, kontaktirajte administratorja.</p>'; 

		}

	} else { // če validacija gesla ni uspela
		echo '<p class="error">Prosimo, poskusite ponovno.</p>';		
	}
	
	mysqli_close($dbc); 

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
                    <li><a href="profil.php">Moj profil</a></li>
                    <li class="active"><a href="change_password.php">Sprememba gesla</a></li>
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
        <h1>Spremembe osebnih podatkov</h1>
      </div>
       <div class="col-md-6">
       	<div class="row">
       		<form action="change_password.php" method="post">
	       		<h2><span class="label label-primary">Sprememba Gesla </span></h2>
	       		<div class="row">
		       		<div class="col-xs-8">  
			       		<h4>Vnesite staro geslo:</h4>
			       		<input type="password" id="inputPassword" class="form-control" placeholder="Staro geslo" required>
		       		</div>
	       		</div>
	       		<div class="row">
		       		<div class="col-xs-8">	       		
			       		<h4>Vnesite novo geslo:</h4>
			       		<input type="password" name="geslo1" size="20" maxlength="20" id="inputPassword" class="form-control" placeholder="Novo geslo" required>
		       		</div>
	       		</div>
	       		<div class="row">
		       		<div class="col-xs-8">	       		
			       		<h4>Ponovno novo geslo:</h4>
			       		<input type="password" name="geslo2" size="20" maxlength="20" id="inputPassword" class="form-control" placeholder="Potrdite novo geslo" required>
		       		</div>
	       		</div>
	       		<hr>
	       		<div class="row">
		       		<div class="col-xs-8">
	       				<button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Potrdi spremembo gesla</button>  
	       			</div>
	       		</div>  
       		</form>
       	</div>
      </div>
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
