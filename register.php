<?php 

// registracijska stran
// napake se ne izpišejo zaradi "output buffering (output control)"

require ('includes/config.inc.php');
$page_title = 'Register';
require ('includes/mail.php');


// procesiranje podatkov registracijskega obrazca
if ($_SERVER['REQUEST_METHOD'] == 'POST') { 

	// potrebna je povezava na PB
	require (MYSQL);
	
	// "trimamo" vse podatke
	$trimmed = array_map('trim', $_POST);

	// predvidevamo neveljavne podatke
	$fn = $ln = $e = $p = FALSE;
	
	// preverjanje imena in po potrebi izpis napake
	if (preg_match ('/^[A-Z \'.-]{2,20}$/i', $trimmed['first_name'])) {
		$fn = mysqli_real_escape_string ($dbc, $trimmed['first_name']);
	} else {
		echo '<p class="error">Please enter your first name!</p>';
	}

	// preverjanje priimka in po potrebi izpis napake
	if (preg_match ('/^[A-Z \'.-]{2,40}$/i', $trimmed['last_name'])) {
		$ln = mysqli_real_escape_string ($dbc, $trimmed['last_name']);
	} else {
		echo '<p class="error">Please enter your last name!</p>';
	}
	
	// preverjanje e-maila in po potrebi izpis napake
	if (filter_var($trimmed['email'], FILTER_VALIDATE_EMAIL)) {
		$e = mysqli_real_escape_string ($dbc, $trimmed['email']);
	} else {
		echo '<p class="error">Please enter a valid email address!</p>';
	}

	// prevejanje gesla in primerjava z drugin vnosom gesla ter po potrebi izpis napake
	if (preg_match ('/^\w{4,20}$/', $trimmed['password1']) ) {
		if ($trimmed['password1'] == $trimmed['password2']) {
			$p = mysqli_real_escape_string ($dbc, $trimmed['password1']);
		} else {
			echo '<p class="error">Your password did not match the confirmed password!</p>';
		}
	} else {
		echo '<p class="error">Please enter a valid password!</p>';
	}
	
	if ($fn && $ln && $e && $p) { // če je vse OK

		// preverjanje ali je email še na voljo (ne sme biti že zaseden)
		$q = "SELECT user_id FROM users WHERE email='$e'";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 0) { // e-mail je na voljo

			// ustvarjanje aktivacijske kode
			$a = md5(uniqid(rand(), true));

			// vstavljanje novega uporabnika v PB
			$q = "INSERT INTO users (email, pass, first_name, last_name, active, registration_date) 
			VALUES ('$e', SHA1('$p'), '$fn', '$ln', '$a', NOW() )";
			$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

			if (mysqli_affected_rows($dbc) == 1) { // če je bilo vse OK

				// pošiljanje e-maila (potrditveni e-mail)
				$body = "Hvala za registracijo. Svoj račun potrdite s klikom na naslednjo povezavo:\n\n";
				$body .= BASE_URL . 'activate.php?x=' . urlencode($e) . "&y=$a";
				
				///*****************PHPMailer************
				$mail->addAddress($trimmed['email'], 'none');    
				$mail->Subject = 'Registration Confirmation';
				$mail->MsgHTML($body);
				
				if(!$mail->send()) {
					echo 'Message could not be sent.';
					echo 'Mailer Error: ' . $mail->ErrorInfo;
				} else {
					echo 'Message has been sent';
				}
				///*****************************
				
				
				//$mail($trimmed['email'], 'Registration Confirmation', $body, 'From: vrtnarija.praktikum@gmail.com');
				
				echo '<h3>Hvala za registreacijo! Na vaš email naslov smo poslali verifikacijsko kodo. Prosimo, da kliknete na tisto povezavo, da potrdite registracijo.</h3>';
				exit(); // izvajanje se konča
				
			} else { // če je šlo kaj narobe
				echo '<p class="error">You could not be registered due to a system error. We apologize for any inconvenience.</p>';
			}
			
		} else { // če e-mail ni na voljo
			echo '<p class="error">That email address has already been registered. If you have forgotten your password, use the link at right to have your password sent to you.</p>';
		}
		
	} else { // če je prišlo do napake pri preverjanju registracijskih podatkov
		echo '<p class="error">Please try again.</p>';
	}

	mysqli_close($dbc);

}
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
                <li><a href="index.php">Domov</a></li>
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
        <h1>Registracija</h1>
      </div>
 <div class="col-md-15">
     <div class="container">
      <form action="register.php" method="post" class="form-signin">
			<input type="text" name="first_name" size="20" maxlength="20" value="<?php if (isset($trimmed['first_name'])) echo $trimmed['first_name']; ?>"  class="form-control" placeholder="Ime" aria-describedby="basic-addon1" required>
		    <input type="text" name="last_name" size="20" maxlength="40" value="<?php if (isset($trimmed['last_name'])) echo $trimmed['last_name']; ?>" class="form-control" placeholder="Priimek" aria-describedby="basic-addon1" required>
		    <label for="inputEmail" class="sr-only"type="text" name="email" size="30" maxlength="60" value="<?php if (isset($trimmed['email'])) echo $trimmed['email']; ?>" >Email address</label>
		    <input name="email" type="email" id="inputEmail" class="form-control" placeholder="E-naslov" required autofocus>
		    <br>
		    <input name="naslov" type="text" class="form-control" placeholder="Naslov" aria-describedby="basic-addon1" required>
		    <input name="tel_st" type="text" class="form-control" placeholder="Telefonska stevilka" aria-describedby="basic-addon1" required>
		    <hr>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" name="password1" size="20" maxlength="20" value="<?php if (isset($trimmed['password1'])) echo $trimmed['password1']; ?>" id="inputPassword" class="form-control" placeholder="Geslo" required>
			<label for="inputPassword" class="sr-only">Password</label>
			<input type="password" name="password2" size="20" maxlength="20" value="<?php if (isset($trimmed['password2'])) echo $trimmed['password2']; ?>" id="inputPassword" class="form-control" placeholder="Potrditev Gesla" required>
			<hr>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Registracija	</button>
      </form>

    </div> 
 </div>
</div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
  </body>
</html>