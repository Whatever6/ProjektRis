<?php 
ob_start();
session_start();

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
                <li><a href="index.php">Vsi artikli</a></li>
                <li><a href="moji_artikli.html">Moji artikli</a></li>
                
              </ul>
              <ul class="nav navbar-nav navbar-right">
				<li><a class="active" href="login.php" style="background-color: green; color: white;">Prijava</a></li>
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
				  </ul>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </div>
    </div>
	<br/><br/>
	<br/><br/>
	<div class="container">
		<div class="col-md-6">
			<div class="row" style="text-align: center">
				<?php echo '<h3>Uspešno ste se odjavili.</h3>'; ?>
			</div>
		</div>
	</div>



	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  
</body>
</head>
</html>