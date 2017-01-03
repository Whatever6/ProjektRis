<?php
ob_start();

session_start();
require ('includes/config.inc.php');

?>
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
                <li class="active"><a href="index.php">Vsi artikli</a></li>
                <li><a href="moji_artikli.html">Moji artikli</a></li>
                <li>
                  </ul>
                  <ul class="nav navbar-nav navbar-right">
 					<li class="dropdown">
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
					<?php if (isset($_SESSION['first_name'])) {
							echo "{$_SESSION['first_name']} {$_SESSION['last_name']}";
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
        <h1>Vsi artikli na voljo:</h1>
      </div>

 <div class="col-md-15">
	 <form>
          <table class="sortable table table-striped" id="mojaEvidencaa">
            <thead>
              <tr>
                <th>#</th>
                <th>Artikel</th>
				<th>Zvrst</th>
                <th>Ime</th>
                <th>Priimek</th>
				<th>Kraj</th>
                <th>Datum mozne izposoje</th>
                <th>Datum vrnitve</th>

              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1.</td>
                <td><a href="artikel.html">Naziv prvega artikla</a></td>
				<td>Sport</td>
                <td>Matej</td>
                <td>Fekonja</td>
				<td>Maribor</td>
                <td>25.11.2016</td>
                <td>25.12.2016</td>
              </tr>
			  <tr>
                <td>2.</td>
                <td><a href="artikel.html">Naziv drugega artikla</a></td>
				<td>Sport</td>
                <td>Eva</td>
                <td>Kuster</td>
				<td>Maribor</td>
                <td>10.11.2016</td>
                <td>30.11.2016</td>
              </tr>              
			  <tr>
                <td>3.</td>
                <td><a href="artikel.html">Naziv tretjega artikla</a></td>
				<td>Vrtnarija</td>
                <td>Katarina</td>
                <td>Rajh</td>
				<td>Ljubljana</td>
                <td>13.11.2016</td>
                <td>25.11.2016</td>
              </tr>              
			  <tr>
                <td>4.</td>
                <td><a href="artikel.html">Ime cetrtega artikla</a></td>
				<td>Igrace</td>
                <td>Barbara</td>
                <td>Ribaric</td>
				<td>Ljubljana</td>
                <td>16.11.2016</td>
                <td>23.11.2016</td>
              </tr>
			  <tr>
                <td>5.</td>
                <td><a href="artikel.html">Naziv petega artikla</a></td>
				<td>Racunalnistvo</td>
                <td>Matej</td>
                <td>Fekonja</td>
				<td>Maribor</td>
                <td>25.11.2016</td>
                <td>25.12.2016</td>
              </tr>
			  <tr>
                <td>6.</td>
                <td><a href="artikel.html">Naziv sestega artikla</a></td>
				<td>Oblacila</td>
                <td>Eva</td>
                <td>Kuster</td>
				<td>Maribor</td>
                <td>18.11.2016</td>
                <td>19.11.2016</td>
              </tr>              
			  <tr>
                <td>7.</td>
                <td><a href="artikel.html">Naziv sedmega artikla</a></td>
				<td>Sport</td>
                <td>Katarina</td>
                <td>Rajh</td>
				<td>Ljubljana</td>
                <td>15.11.2016</td>
                <td>22.11.2016</td>
              </tr>              
			  <tr>
                <td>8.</td>
                <td><a href="artikel.html">Ime osmega artikla</a></td>
				<td>Oblacila</td>
                <td>Barbara</td>
                <td>Ribaric</td>
				<td>Maribor</td>
                <td>11.11.2016</td>
                <td>24.11.2016</td>
              </tr>
			  
            </tbody>
          </table>
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
