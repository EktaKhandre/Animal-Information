<?php 

// Create database connections
$dbHost     = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName     = "ani_database";

$con = mysqli_connect($dbHost, $dbUsername, $dbPassword, $dbName);


// Check connection
if(!$con){
  die("Connection failed: " .mysqli_connect_error());
}


?>
