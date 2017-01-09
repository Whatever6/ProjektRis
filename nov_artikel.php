<?php

ob_start();
session_start();

require ('includes/config.inc.php');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "baza_posoje";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
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
                <li class="active"><a href="moji_artikli.php">Moji artikli</a></li>
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
    <div class="page-header"></div>
    <div class="page-header">
        <h1>Dodajanje novega artikla:</h1>
      </div>
 <div class="col-md-15">
	 <form name="input" action="dodajanje_artikla.php" method="post">
	     <div class="container">
      <!-- Example row of columns -->
      <div class="row">
        <div class="col-md-4">
			<div class="form-group">
			  <h2>Specifikacije:</h2>
			  <p><b>Naziv artikla:</b><input class="form-control" id="naziv_artikla" name="naziv_artikla" type="text" placeholder="Kolo"></p>
			  <div class="form-group">
				  <label>Zvrst:</label>
				  <select class="form-control" id="izbira" name="izbira">
					<option>Sport</option>
					<option>Vrtnarija</option>
					<option>Igrace</option>
					<option>Racunalnistvo</option>
					<option>Oblacila</option>
				  </select>
			  </div></p>
			  <p><b>tel. stevilka:</b><input class="form-control" id="tel_st" name="tel_st" type="text" placeholder="041 221 942"></p>
			  <p><b>Kraj:</b><input class="form-control" id="kraj" name="kraj" type="text" placeholder="Maribor"></p>
			  <p><b>Datum vrnitve:</b><input class="form-control" id="datum_vrnitve" name="datum_vrnitve" type="datetime" placeholder="leto-mesec-dan(2015-05-25)"></p>
			  <p><b>Je na voljo:</b> <input type="checkbox" name="na_voljo" id="na_voljo" checked><br></p> 
			</div>		  
        </div>
        <div class="col-md-8">
		
		
		  <h2>Opis:</h2> (500 znakov)
          <textarea class="form-control" rows="5" id="opis_artikla" name="opis_artikla" style="min-width: 100%" placeholder="Vnesite opis artikla" maxlength="500"></textarea>
	  </div>
      </div>
		<div class="page-header"></div>
	 	<a href="moji_artikli.php" class="btn btn-primary btn-lg" role="button">Nazaj</a>
		<input type="submit" value="Submit" name="sumit" class="btn btn-success btn-lg">
      </form>
  </div>
  <div class="page-header"></div>
  </div>

	<script>
	</script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>
<?php
$conn->close();
?>