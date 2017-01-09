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
if(isset($_GET["data1"])){
    $id = $_GET["data1"];
}else{
	header('Location: moji_artikli.php');
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
                <li class="active"><a href="vsi_artikli.php">Vsi artikli</a></li>
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
        <h1>IME ARTIKLA:</h1>
      </div>
 <div class="col-md-15">
	 <form action="">
	     <div class="container">
      <!-- Example row of columns -->
	  
	  
 	<?php
	$izbor="<p><b>Je na voljo:</b> <input type='checkbox' name='na_voljo' id='na_voljo'><br></p>";
	$sql = "SELECT * FROM artikel WHERE ID_Artikel=".$_GET["data1"]."";
	$result = $conn->query($sql);
	if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
		
		
		if ($row["status"]==1){
			$izbor=	"Da";
		}else{
			$izbor=	"Ne";
		}
		echo
		  "<div class='row'>
		  <div class='col-md-4'>
          <h2>Specifikacije</h2>
		  <p><b>Naziv: </b>".$row["ime_artikla"]."</p>
		  <p><b>Izposojevalec: </b>ime in priimek</p>
		  <p><b>Zvrst: </b>".$row["namen_uporabe"]."</p>
		  <p><b>tel. stevilka: </b>".$row["tel_st"]."</p>
		  <p><b>Kraj: </b>".$row["kraj"]."</p>
		  <p><b>Datum vrnitve: </b>".$row["datum_vrnitve"]."</p>
		  <p><b>Je na voljo:  </b>".$izbor."</p>  
        </div>
        <div class='col-md-8'>
          <h2>Opis</h2>
		  <p>".$row["opis"]."</p>
		</div>
      </div>
		<div class='page-header'></div>
	 	<a href='vsi_artikli.php' class='btn btn-primary btn-lg' role='button'>Nazaj</a>
      </form>"
		
		
		
		;}
	} else {
		echo "0 results";
	}
		?>
	  
	  
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