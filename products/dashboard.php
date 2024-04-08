<?php

session_start();
if (!isset($_SESSION["adm"]) && !isset($_SESSION["user"])) {
    header("Location: login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: home.php");
}

require_once "../components/db_connect.php";


$sql = "SELECT * from users WHERE user_id = {$_SESSION["adm"]}";
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
        $opacity = "opacity-100";
        if($value["availability"] === "Adopted"){
            $opacity= "opacity-50";
            
            
        }
        $layout .= "<div>
        <div class='card m-4 $opacity' style='width: 19rem;'>
        <img src='{$value["photo"]}' class='card-img-top' alt='animal' style='height: 300px; object-fit: cover;'>
        <div class='card-body'>
          <h5 class='card-title text-center'> {$value["name"]}</h5>
          <p class='card-text'>Breed: {$value["breed"]}</p>
          <p class='card-text'>Size: {$value["size"]}</p>
          <p class='card-text'>Age: {$value["age"]}</p>
          <p class='card-text'>Vaccine: {$value["vaccinated"]}</p>
          <div class='d-flex justify-content-around'>
          <h1>
          <a href='details.php?animal_id={$value["animal_id"]}' class='btn btn-warning'>Show Details</a>
          <a href='update.php?animal_id={$value["animal_id"]}' class='btn btn-success'>Update</a>
          <a href='delete.php?animal_id={$value["animal_id"]}' class='btn btn-danger'>Delete</a>
          </div>
        </div>
      </div>
        </div>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Animal list</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>
    <?= $navbar ?>
    <h2 class='text-center mt-2'>Welcome Admin</h2>
    <div class="container">
        <div class="row row-cols-1 row-cols-xl-4 row-cols-md-2 row-cols-lg-3 row row-cols-s-1">
            <?= $layout ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>