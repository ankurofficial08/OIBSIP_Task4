<?php

$hostName = "localhost";
$dbUser = "root";
$dbPassword = "";
$dbName = "rms";
$conn = mysqli_connect($hostName , $dbUser , $dbPassword , $dbName);

if(!$conn) {
    die("Something went Wrong");
}

?>