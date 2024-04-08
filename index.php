<?php
session_start();

if(isset($_SESSION["user"])){ 
    header("Location: ./user/home.php"); 
}

if(isset($_SESSION["adm"])){ 
    header("Location: ./products/dashboard.php");
} 
require_once "./components/db_connect.php";


    $readQuery = "SELECT * from animal";
    $readResult = mysqli_query($connect, $readQuery);

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
        $opacity = "opacity-100";
        $detailsBtn = "<a href='../products/details.php?animal_id={$value["animal_id"]}' class='btn btn-warning'>Show Details</a>";
        if($value["availability"] === "Adopted"){
            $opacity= "opacity-50";
            $availability = "btn-danger mx-auto btn-lg 'style='pointer-events: none;'";
            $detailsBtn = "";
        }
        $layout .= "<div>
        <div class='card m-3' style='width: 18rem;'>
        <img src='{$value["photo"]}' class='card-img-top $opacity' alt='animal' style='height: 300px; object-fit: cover;'>
        <div class='card-body'>
          <h4 class='$opacity card-title text-center mb-2'> {$value["name"]}</h4>
          <p class='$opacity card-text text-start'><b>Breed:</b> {$value["breed"]}</p>
          <p class='$opacity card-text text-start'><b>Size:</b> {$value["size"]}</p>
          <p class='$opacity card-text text-start'><b>Age:</b> {$value["age"]}</p>
          <p class='$opacity card-text text-start'><b>Vaccine:</b> {$value["vaccinated"]}</p>
          <div class='d-flex justify-content-between'>
          $detailsBtn
          <span class='btn $availability'>{$value["availability"]}</span>
          </div>
        </div>
      </div>
      </div>
        ";
    }
}
require_once "./components/guest_navbar.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dog Adoption</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head>

<body>
    <?= $navbar ?>
    <div class="text-center">
        <h2 class="m-5  text-info">Welcome to our Pet Adoption Portal</h2>
        <p class="h4"> Here you can see the list of all pets that are available or adopted, you can register on the top left to adopt a pet.</p>
    </div>

    <div class="container">
        <div class="row row-cols-1 row-cols-s-1 row-cols-md-2 row-cols-lg-3 row-cols-xxl-4">
            <?= $layout ?>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

</html>