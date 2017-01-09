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
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

 if(isset($_POST['na_voljo'])){
	 $na_voljo=1;
 }else{
	 $na_voljo=0;
 }
$opiss=$_POST["opis_artikla"];
$sql="UPDATE artikel
SET ime_artikla='$_POST[naziv_artikla]', namen_uporabe='$_POST[izbira]', kraj='$_POST[kraj]',datum_vrnitve='$_POST[datum_vrnitve]', status='$na_voljo', opis='$opiss', tel_st='$_POST[tel_st]'
WHERE ID_Artikel='$_POST[id_art]'
";
 
if (mysqli_query($conn, $sql)) {
    header('Location: moji_artikli.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>