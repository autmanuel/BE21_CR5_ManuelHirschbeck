<?php

session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../index.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../home.php");
}


require_once "../components/db_connect.php";

$animal_id = $_GET["animal_id"];

$sqlread = "SELECT * FROM `animal` WHERE animal_id = {$animal_id}";

$resultRead = mysqli_query($connect, $sqlread);

$row = mysqli_fetch_assoc($resultRead);


$sql = "DELETE FROM `animal` WHERE animal_id = {$animal_id}";

$result = mysqli_query($connect, $sql);

if ($result) {
    
        echo "<div class='alert alert-success' role='alert'>
        Product has been successfully deleted!
      </div>";
 } else {
        echo "<div class='alert alert-danger' role='alert'>
        Something went wrong, please try again later!
      </div>";
    }
    header("Refresh: 3; url= dashboard.php");
  

