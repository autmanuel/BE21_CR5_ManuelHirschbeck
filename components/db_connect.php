<?php

$localhost = "127.0.0.1";
$username = "root";
$password = "";
$dbname = "be21_cr5_animal_adoption_manuelhirschbeck";

// create connection
$connect = mysqli_connect($localhost, $username, $password, $dbname);

// check connection
if (!$connect) {
   die("Connection failed");
}