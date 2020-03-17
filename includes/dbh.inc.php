<?php

$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbName = "loginsystem";

$mysql = mysqli_connect($host, $dbUsername, $dbPassword, $dbName);

if (!$mysql) {
    die("Connection failed: " . mysqli_connect_error());
}

