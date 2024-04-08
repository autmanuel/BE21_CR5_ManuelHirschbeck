<?php

require_once "../components/db_connect.php";

if(isset($_GET["q"]) && !empty($_GET["q"])){
$q = $_GET["q"];

$query = "SELECT * FROM `user` WHERE `email` = '$q'";
$result = mysqli_query($connect, $query);

if(mysqli_num_rows($result) === 0){
    echo json_encode("");

}else{
    echo json_encode("Email already exists!");
}
}
else{
    echo json_encode("Fehler");
};