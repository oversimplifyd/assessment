<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '123456789';
$databaseName = "leaseweb";

$conn = mysqli_connect($dbhost, $dbuser, $dbpass);
$mysqli= new mysqli($dbhost, $dbuser, $dbpass) or die("unable to connect..");

if( ! $mysqli->query("Create database if not exists $databaseName")){

    die("Failed creating a new DB");
}

echo "Database created successfully";
$mysqli->close();
?>
