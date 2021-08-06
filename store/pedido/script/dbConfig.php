<?php
require_once "../../model/ConexionBD.class.php";

$con = ConexionBD::CadenaCN();
//DB details
$dbHost = $con["servidor"];
$dbUsername = $con["usuario"];
$dbPassword = $con["password"];
$dbName = $con["basedatos"];

//Create connection and select DB
$db = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

if ($db->connect_error) {
    die("Unable to connect database: " . $db->connect_error);
}
