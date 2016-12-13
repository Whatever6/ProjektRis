<?php 

// scripta za aktivacijo uporabniškega računa
require ('includes/config.inc.php'); 
$page_title = 'Activate Your Account';

// če $x in $y ne obstajata ali nista v pravem formatu, preusmerimo uporabnika
// namenoma sta uporabljeni takšni imeni - zaradi varnosti
if (isset($_GET['x'], $_GET['y']) 
	&& filter_var($_GET['x'], FILTER_VALIDATE_EMAIL)
	&& (strlen($_GET['y']) == 32 )
	) {

	// posodobitev PB ob uspešni aktivaciji
	require (MYSQL);
	$q = "UPDATE users SET active=NULL WHERE (email='" . mysqli_real_escape_string($dbc, $_GET['x']) . "' AND active='" . mysqli_real_escape_string($dbc, $_GET['y']) . "') LIMIT 1";
	$r = mysqli_query ($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc));
	
	// izpis napake - ki nič ne pove :)
	if (mysqli_affected_rows($dbc) == 1) {
		echo "<h3>Your account is now active. You may now log in.</h3>";
	} else {
		echo '<p class="error">Your accocould not be activated. Please re-check the link or contact the system administrator.</p>'; 
	}

	mysqli_close($dbc);

} else { //  preumeritev

	$url = BASE_URL . 'index.php'; // preusmeritev na osnovno strani (BASE_URL + index.php)
	ob_end_clean(); // brisanje medpomnilnika (buffer)
	header("Location: $url");
	exit();

}

include ('includes/footer.html');
?>