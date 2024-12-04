<?php

$serverName = "localhost";
$dBUsername = "klik";
$dBPassword = "z85!FAkAB0Sbd-jP";
$dBName = "klik_database";

$conn = mysqli_connect($serverName, $dBUsername, $dBPassword, $dBName, 3306);

if (!$conn)
{
    die("Connection failed: ". mysqli_connect_error());
}


