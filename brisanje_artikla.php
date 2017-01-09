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

if (isset($_POST['delete']) && isset($_POST['radio'])) {
    foreach($_POST['radio'] as $del_id){
        $del_id = (int)$del_id;
        $sql = "DELETE FROM artikel WHERE ID_Artikel = $del_id"; 
    }
}

if (mysqli_query($conn, $sql)) {
    header('Location: moji_artikli.php');
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);
?>