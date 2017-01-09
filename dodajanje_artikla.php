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
$opiss=$_POST[opis_artikla];
$sql="INSERT INTO artikel (ime_artikla,namen_uporabe,kraj,datum_vrnitve,status,opis,tel_st)
VALUES
('$_POST[naziv_artikla]','$_POST[izbira]','$_POST[kraj]','$_POST[datum_vrnitve]','$na_voljo','$opiss','$_POST[tel_st]')";
 
if (mysqli_query($conn, $sql)) {
    header('Location: moji_artikli.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>