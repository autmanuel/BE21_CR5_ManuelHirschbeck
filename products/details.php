<?php
session_start();

require_once "../components/db_connect.php";

// Überprüfen Sie, ob eine Session für den Benutzer oder den Administrator aktiv ist
if (isset($_SESSION["adm"])) {
    $session = $_SESSION["adm"];
} else if (isset($_SESSION["user"])) {
    $session = $_SESSION["user"];
} else {
    // Wenn keine gültige Session vorhanden ist, wird der Wert auf 0 gesetzt
    $session = 0;
}

// Überprüfen Sie, ob ein Tier-ID-Parameter vorhanden ist
if (!isset($_GET["animal_id"]) || empty($_GET["animal_id"])) {
    header("Location: ../index.php");
    exit; // Stop further execution
}

$animal_id = $_GET["animal_id"];

$sql = "SELECT * FROM `animal` WHERE animal_id = {$animal_id}";
$result = mysqli_query($connect, $sql);
$rowAnimal = mysqli_fetch_assoc($result);

// Laden Sie die entsprechende Navbar basierend auf der Benutzerrolle
if (isset($_SESSION["admin"]) && isset($_SESSION["user"])) {
    require_once "../components/navbar.php";

} else {
    require_once "../components/guest_navbar.php";
}

   
$layout = " 
<div class='card' style=' border: 2px solid black; width: 35rem;'>
<img src='{$rowAnimal["photo"]}' class='card-img-top' alt='animal' style='height: 30rem; object-fit: cover;'>
<div class='card-body text-center'>
  <h1 class='card-title text-center mb-2'><b> {$rowAnimal["name"]}</b></h1>
  <h5 class='card-text'><b>Breed:</b> {$rowAnimal["breed"]}</h5>
  <h5 class='card-text'><b>Gender:</b> {$rowAnimal["gender"]}</h5>
  <h5 class='card-text'><b>Age:</b> {$rowAnimal["age"]}</h5>
  <h5 class='card-text'><b>Size:</b> {$rowAnimal["size"]}</h5>
  <h5 class='card-text'><b>Location:</b> {$rowAnimal["location"]}</h5>
  <h5 class='card-text'><b>Vaccine:</b> {$rowAnimal["vaccinated"]}</h5>
  <h5 class='card-text my-4'>{$rowAnimal["description"]}</h5>
  <div class='d-flex justify-content-center m-2'>
  <a class='btn btn-warning col-6 btn-lg' href='../index.php'>Back</a>
  </div>
</div>
</div>
</div>";



mysqli_close($connect);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?= $navbar ?>
    <div class="container d-flex justify-content-center my-5">

        <?= $layout ?>

    </div>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>