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
        <h1>Moji artikli:</h1>
      </div>

 <div class="col-md-15">
	 <form name="input" action="brisanje_artikla.php" method="post">
          <table class="sortable table table-striped" id="mojaEvidencaa">
            <thead>
              <tr>
                <th>#</th>
                <th>Artikel</th>
				<th>Zvrst</th>
				<th>Kraj</th>
                <th>Datum vrnitve</th>
              </tr>
            </thead>
            <tbody>
			<?php
			$sql = "SELECT ID_Artikel, ime_artikla, namen_uporabe, status, kraj, datum_vrnitve FROM artikel";
			$result = $conn->query($sql);
			$st=1;
			if ($result->num_rows > 0) {
				// output data of each row
				
				while($row = $result->fetch_assoc()) {
					if($row["status"]==0){
						$statuss="ni_na_voljo";
					}else{
						$statuss="";
					}
					echo 
						"<tr id='".$statuss."'>".
						"<td>"."<input type='radio' name='radio[]' value='".$row['ID_Artikel']."'>"."</td>".
						"<td>"."<a href='artikel_urejanje.php?data1=".$row["ID_Artikel"]."&data2=".$row["ime_artikla"]."'>".$row["ime_artikla"]."</a></td>
						<td>" . $row["namen_uporabe"] . "</td>
						<td>" . $row["kraj"] . "</td>
						<td>" . $row["datum_vrnitve"] . "</td>
						</tr>";
						
					
				}
			} else {
				echo "0 results";
			}
			?>
            </tbody>
          </table>
        </div>
        <div class="page-header"></div>
		<a href="nov_artikel.php" class="btn btn-primary btn-lg" role="button">Novi Artikel</a>
		<input type="submit" value="Zbrisi" name="delete" class="btn btn-danger btn-lg">

		</form>
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