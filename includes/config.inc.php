<?php 

/* - definicija konstant in nastavitev
 * - obravnavanje napak 
 * - uporabne funkcije
 */
 
// ************************************ //
// ************ NASTAVITVE ************ //

// spremenljiva za status strani
define('LIVE', FALSE);

// e-mail administratorja
define('EMAIL', 'vrtnarija.praktikum@gmail.com');

/* 	naslednji dve spremenljivki naredita stran bolj fklesibilno 
	pri prenosu na drugo lokacijo, je potrebno samo  ti dve 
	konstatni spremeniti   */


// v realnosti - naslov URL strani (zaradi preusmeritev)
define ('BASE_URL', 'http://localhost/projektris/index.php');

// lokacija konfiguracijske datoteke za PB
define ('MYSQL', '/includes/mysqli_connect.php');

// nastavitev časovnega pasu (PHP 5.1 ali višji)
date_default_timezone_set ('Europe/Ljubljana');




// ****************************************** //
// ************ UPRAVLJANJE NAPAK ************ //

// ustvarjanje "upravljaca napak" - error handler
function my_error_handler ($e_number, $e_message, $e_file, $e_line, $e_vars) {

	// ustvarjanje sporočila o napakah
	$message = "An error occurred in script '$e_file' on line $e_line: $e_message\n";
	
	// dodajenje datuma in časa
	$message .= "Date/Time: " . date('n-j-Y H:i:s') . "\n";
	
	if (!LIVE) { // izpis napak - v postopku razvoja

		// izpis napak - pri razvoju
		echo '<div class="error">' . nl2br($message);
	
		// dodajenje podrobnosti o napakah 
		echo '<pre>' . print_r ($e_vars, 1) . "\n";
		debug_print_backtrace();
		echo '</pre></div>';
		
	} else { // preprečevanje izpisa napak - ko splavimo stran

		// pošiljanje e-mail sporočila adminu
		$body = $message . "\n" . print_r ($e_vars, 1);
		//mail(EMAIL, 'Site Error!', $body, 'From: Posodim ti, posodi mi');
		
		// splošen izpis napake
		if ($e_number != E_NOTICE) {
			echo '<div class="error">A system error occurred. We apologize for the inconvenience.</div><br />';
		}
	}

} 

// uporaba funkcije, ki smo jo definirali zgoraj
set_error_handler ('my_error_handler');
