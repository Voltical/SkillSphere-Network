<?php

$sname= "192.168.240.11";
$unmae= "Gino";
$password = "mexicano";

$db_name = "challenge";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

if (!$conn) {
	echo "Connection failed!";
}