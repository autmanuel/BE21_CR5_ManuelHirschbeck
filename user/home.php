<?php
session_start(); 

if (!isset($_SESSION["admin"]) && !isset($_SESSION["user"])) {
    header("Location: register.php");
}

if (isset($_SESSION["admin"])) {
    header("Location: ../products/dashboard.php");
}
require_once "../components/db_connect.php";

$sql = "SELECT * from users WHERE user_id = {$_SESSION["user"]}";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

require_once "../components/navbar.php";


$layout = "";




$filter = isset($_GET['filter']) ? $_GET['filter'] : '';

if ($filter === 'senior') {
    $readQuery = "SELECT * FROM animal WHERE age > 8";
} else {
    $readQuery = "SELECT * from animal";
}

$readResult = mysqli_query($connect, $readQuery);

if (mysqli_num_rows($readResult) == 0) {
    $layout = "No products found!";
} else {
    $rows = mysqli_fetch_all($readResult, MYSQLI_ASSOC);
    foreach ($rows as $value) {
        $availability = "btn-success 'style='pointer-events: none;'";
        $adoptBtn = "<button onclick='adopt(" . $value['animal_id'] . ")' class='btn btn-info'>Take me home</button>";
        $opacity = "opacity-100";
        $detailsBtn = "<a href='details.php?animal_id={$value["animal_id"]}' class='btn btn-warning'>Show Details</a>";
        if($value["availability"] === "Adopted"){
            $opacity= "opacity-50";
            $availability = "btn-danger mx-auto btn-lg 'style='pointer-events: none;'";
            $detailsBtn = "";
            $adoptBtn = "";
        }
        $layout .= "<div>
        <div class='card m-4' style='width: 18rem;'>
        <img src='{$value["photo"]}' class='card-img-top $opacity' alt='animal' style='height: 300px; object-fit: cover;'>
        <div class='card-body'>
          <h5 class='card-title text-center'> {$value["name"]}</h5>
          <p class='card-text $opacity'><b>Breed:</b> {$value["breed"]}</p>
          <p class='card-text $opacity'><b>Size:</b> {$value["size"]}</p>
          <p class='card-text $opacity'><b>Age:</b> {$value["age"]}</p>
          <p class='card-text $opacity'><b>Vaccine:</b> {$value["vaccinated"]}</p>
          <div class='d-flex justify-content-between'>
          $detailsBtn
          $adoptBtn
          <btn class='btn $availability'>{$value["availability"]}</span>
          </div>
        </div>
      </div>
        </div>";
    }
}

if (isset($_GET['animal_id'])) {
    $animal_id = $_GET["animal_id"];

    // Adoption des Tieres versuchen
    $addAdoptionSql = "INSERT INTO `pet_adoption` (`user_id`, `animal_id`, `adoption_date`) VALUES ('{$_SESSION["user"]}', '$animal_id', NOW())";
    $addAdoptionResult = mysqli_query($connect, $addAdoptionSql);

    // Update der Verfügbarkeit im animal-Tabelle
    $updateAvailabilitySql = "UPDATE `animal` SET `availability` = 'Adopted' WHERE `animal_id` = '$animal_id'";
    $updateAvailabilityResult = mysqli_query($connect, $updateAvailabilitySql);

    // Überprüfen, ob die Adoption erfolgreich war
    if ($addAdoptionResult && $updateAvailabilityResult) {
        echo "<div class='alert alert-success' role='alert'>
            You have successfully adopted your pet!
        </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>
            Something went wrong, please try again later!
        </div>";
    }

    header("Refresh: 3; url=home.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome <?= $row["first_name"] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>
    <?= $navbar ?>
    <div class="container">
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4">
            <?= $layout ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <script>
        function adopt(animal_id) {
            window.location.href = "home.php?animal_id=" + animal_id;
        }
    </script>
</body>

</html>