<?php

session_start();

if (!isset($_SESSION["user"]) && !isset($_SESSION["adm"])) {
    header("Location: ../login.php");
}

if (isset($_SESSION["user"])) {
    header("Location: ../home.php");
}

require_once "../components/db_connect.php";
require_once "../components/functions.php";

$sql = "SELECT * from users WHERE user_id = {$_SESSION["adm"]}";
$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($result);

require_once "../components/navbar.php";

$animal_id = $_GET["animal_id"];

$animalSql = "SELECT * FROM `animal` WHERE animal_id = {$animal_id}";

$animalResult = mysqli_query($connect, $animalSql);

$animalRow = mysqli_fetch_assoc($animalResult);

if (isset($_POST["update"])) {
    $name = cleanInputs($_POST["name"]);
    $gender = $_POST["gender"];
    $photo = $_POST["photo"];
    $location = cleanInputs($_POST["location"]);
    $description = cleanInputs($_POST["description"]);
    $size = cleanInputs($_POST["size"]);
    $age = $_POST["age"];
    $vaccinated = $_POST["vaccinated"];
    $breed = $_POST["breed"];
    $availability = $_POST["availability"];
    
    
        if (!filter_var($photo, FILTER_VALIDATE_URL)) {
            echo "<div class='alert alert-danger' role='alert'>
                Please enter a valid URL!
              </div>";
              header("refresh: 3");
        }else {
    
    if (empty($_POST["photo"])) {
        $sqlUpdate = "UPDATE `animal` SET `name`='{$name}',`gender`='{$gender}',`location`='{$location}',`description` = '{$description}',`size` = '{$size}',`age` = '{$age}',`vaccinated` = '{$vaccinated}',`breed` = '{$breed}',`availability` = '{$availability}' WHERE animal_id = {$animal_id}";
    } else {
        $sqlUpdate = "UPDATE `animal` SET `name`='{$name}',`gender`='{$gender}',`photo` = '{$photo}',`location` = '{$location}',`description` = '{$description}',`size` = '{$size}',`age` = '{$age}',`vaccinated` = '{$vaccinated}',`breed` = '{$breed}',`availability` = '{$availability}' WHERE animal_id = {$animal_id}";
    }

    $sqlResult = mysqli_query($connect, $sqlUpdate);

    if ($sqlResult) {
        echo "<div class='alert alert-success' role='alert'>
        Product has been updated!
      </div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>
        Something went wrong, please try again later!
      </div>";
      header("refresh: 3; url= dashboard.php");
    }
}
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?= $navbar ?>
    <div class="container mb-3">
        <div class="text-center m-3">
            <img src="<?= $animalRow["photo"] ?>" alt="pet" width="250">
        </div>

        <form action="" method="post" class="d-flex flex-column">
            <label>
                Pet name:
                <input type="text" class="form-control" name="name" value="<?= $animalRow["name"] ?>">
            </label>
            <label>
                Gender:
                <select class="form-select" name="gender">
                    <option value="<?= $animalRow["gender"] == "Male" ?>">Male</option>
                    <option value="<?= $animalRow["gender"] == "Female"  ?>">Female</option>
                </select>
            </label>
            <label>Photo url:
                <input type="text" class="form-control" name="photo" alt="no photo yet" value="<?= $animalRow["photo"] ?>">
            </label>
            <label>
                Location:
                <input type="text" class="form-control" placeholder="<?= $animalRow["location"]?>" name="location"value="<?= $animalRow["location"] ?>">
            </label>
            <label for="description" class="form-label">
                Description:
                <textarea class="form-control" row="3" id="description" name="description"><?= $animalRow["description"]?></textarea>
            </label>
            <label>
                Size:
                <select class="form-select" name="size" >
                    <option value="small"<?= $animalRow["size"] == "small" ? "selected" : ""?>">small</option>
                    <option value="medium"<?= $animalRow["size"] == "medium" ? "selected" : ""?>">medium</option>
                    <option value="large"<?= $animalRow["size"] == "large" ? "selected" : ""?>">large</option>
                </select>
            </label>
            <label>
                Age:
                <input type="number" class="form-control" placeholder="type number..." name="age" value="<?= $animalRow["age"] ?>">
            </label>
            <label>
                Vaccine:
                <select class="form-select" name="vaccinated">
                    <option value="Yes" <?= $animalRow["vaccinated"] == "Yes" ? "selected" : ""?>>Yes</option>
                    <option value="No" <?= $animalRow["vaccinated"] == "No" ? "selected" : "" ?>>No</option>
                </select>
            </label>
            <label>
                Breed:
                <input type="text" class="form-control" placeholder="breed, pet type" name="breed" value="<?= $animalRow["breed"] ?>">
            </label>
            <label>
                Availability:
                <select class="form-select" name="availability">
                    <option value="Available" <?= $animalRow["availability"] == "Available" ? "selected" : "" ?>>Available</option>
                    <option value="Adopted" <?= $animalRow["availability"]  == "Adopted" ? "selected" : "" ?>>Adopted</option>
                </select>
            </label>
            <input class="btn btn-primary" type="submit" value="Update Product" name="update">
        </form>
    </div>

</body>

</html>
