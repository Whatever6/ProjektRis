<?php 

// resetiranje gesla - če ga je uporabnik pozabil
// resetiranje gesla
// obrazec za resetiranje gesla

require ('includes/config.inc.php'); 
$page_title = 'Forgot Your Password';
include ('includes/header.html');
require ('includes/mail.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	require (MYSQL);

	// predpostavljamo, da ni takšnega uporabnika
	$uid = FALSE;

	// preverjanje emaila
	if (!empty($_POST['email'])) {

		// v PB preverimo ali tak email obstaja oz. pripada registriranemu uporabniku
		$q = 'SELECT user_id FROM users WHERE email="'.  mysqli_real_escape_string ($dbc, $_POST['email']) . '"';
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
		
		if (mysqli_num_rows($r) == 1) { //pridobivanje ID-ja uporabnika, ki ustreza emailu
			list($uid) = mysqli_fetch_array ($r, MYSQLI_NUM); 
		} else { // uporabnik ni bil najden
			echo '<p class="error">The submitted email address does not match those on file!</p>';
		}
		
	} else { // ni bil vnešen e-mail
		echo '<p class="error">You forgot to enter your email address!</p>';
	} 
	
	if ($uid) { // če je vse OK - smo torej pridobili user ID

		// ustvarjanje novega naključnega gesla - deset znakov od tretjega znaka v nizu
		$p = substr ( md5(uniqid(rand(), true)), 3, 10);

		// posodobimo PB z vrednostjo novega, ravno ustvarjenega, gesla
		$q = "UPDATE users SET pass=SHA1('$p') WHERE user_id=$uid LIMIT 1";
		$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));

		if (mysqli_affected_rows($dbc) == 1) { // če je vse OK
		
			// pošljemo email, ki pozove uporabnika naj si novo geslo ponastavi
			$body = "Your password has been temporarily changed to '$p'. 
			Please log in using this password and this email address. 
			Then you may change your password to something more familiar.";
			
			///*****************PHPMailer************
			$mail->addAddress($_POST['email']);     				
			$mail->Subject = 'Your temporary password.';
			$mail->MsgHTML($body);
			
			if(!$mail->send()) {
				echo 'Message could not be sent.';
				echo 'Mailer Error: ' . $mail->ErrorInfo;
			} else {
				echo 'Message has been sent';
			}
			///*****************************
				
			//mail ($_POST['email'], 'Your temporary password.', $body, 'From: marko.holbl@um.si');
			
			echo '<h3>Your password has been changed. You will receive the new, temporary password at the 
			email address with which you registered. Once you have logged in with this password, you may 
			change it by clicking on the "Change Password" link.</h3>';
			mysqli_close($dbc);
			include ('includes/footer.html');
			exit(); 
			
		} else { // če je šlo kaj narobe
			echo '<p class="error">Your password could not be changed due to a system error. We apologize for any inconvenience.</p>'; 
		}

	} else {
		echo '<p class="error">Please try again.</p>';
	}

	mysqli_close($dbc);

}
?>

<h1>Reset Your Password</h1>
<p>Enter your email address below and your password will be reset.</p> 
<form action="forgot_password.php" method="post">
	<fieldset>
	<p><b>Email Address:</b> <input type="text" name="email" size="20" maxlength="60" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" /></p>
	</fieldset>
	<div align="center"><input type="submit" name="submit" value="Reset My Password" /></div>
</form>

<?php include ('includes/footer.html'); ?>