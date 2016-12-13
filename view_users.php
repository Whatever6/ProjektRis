<?php 

// izpis vseh uporabnikov

require ('includes/config.inc.php'); 
include ('includes/header.html');
$page_title = 'View the Current Users';

// Page header:
echo '<h1>Registered Users</h1>';

require (MYSQL);

$q = "SELECT CONCAT(first_name, ' ', last_name) AS name, DATE_FORMAT(registration_date, '%d %M %Y') AS dr, email FROM users ORDER BY registration_date ASC";
$r = mysqli_query($dbc, $q) or trigger_error("Query: $q\n<br />MySQL Error: " . mysqli_error($dbc)); 

$num = mysqli_num_rows($r);

if ($num > 0) { // če je vse OK

	echo "<p>There are currently $num registered users.</p>\n";
	echo '<table align="center" cellspacing="3" cellpadding="3" width="75%">
	<tr><td align="left"><b>Name</b></td><td align="left"><b>E-Mail</b></td><td align="left"><b>Date Registered</b></td></tr>';
	
	while ($results = mysqli_fetch_array ($r, MYSQLI_ASSOC)) {
		echo '<tr><td align="left">' . $results['name'] . '</td><td align="left">' . 
		$results['email'] . '</td><td align="left">' . $results['dr'] . '</td></tr>';
	}

	echo '</table>'; 	

} else { // če je šlo kaj narobe :)

	echo '<p class="error">There are currently no registered users.</p>';

}

mysqli_close($dbc);

include ('includes/footer.html');
?>