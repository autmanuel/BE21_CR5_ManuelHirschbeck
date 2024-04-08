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


$admSql = "SELECT * from users WHERE user_id = {$_SESSION["adm"]}";
$admResult = mysqli_query($connect, $admSql);

$row = mysqli_fetch_assoc($admResult);

require_once "../components/navbar.php";

$Qanimal = "SELECT * FROM `animal`";
$Ranimal = mysqli_query($connect, $Qanimal);

$rows = mysqli_fetch_all($Ranimal, MYSQLI_ASSOC);


if (isset($_POST["create"])) {
    
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

    if (!empty($photo)) {
        $photo = mysqli_real_escape_string($connect, $photo);
        if (!filter_var($photo, FILTER_VALIDATE_URL)) {
            echo "<div class='alert alert-danger' role='alert'>
                Bitte geben Sie einen gültigen URL für das Foto ein.
              </div>";
            exit; // Beenden Sie die Ausführung des Codes, wenn der URL ungültig ist
        }
    }

    // Das SQL-Statement nur ausführen, wenn der URL entweder leer ist oder ein gültiger URL ist
    $sql = "INSERT INTO `animal`(`name`, `gender`, `photo`, `location`, `description`, `size`, `age`, `vaccinated`, `breed`, `availability`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $connect->prepare($sql);
    $stmt->bind_param("ssssssisss", $name, $gender, $photo, $location, $description, $size, $age, $vaccinated, $breed, $availability);
    
    if ($stmt->execute()) {
        echo "<div class='alert alert-success' role='alert'>
            New product has been created!
        </div>";
        header("refresh: 3; url= create.php");
    } else {
        echo "<div class='alert alert-danger' role='alert'>
            Something went wrong, please try again later!
        </div>";
        header("refresh: 3; url= create.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>add pet</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?= $navbar ?>
    <div class="container">
        <h2 class="text-primary">Create new pet entry</h2>
        <form action="" method="post" class="d-flex flex-column">
            <label>
                Pet name:
                <input type="text" class="form-control" name="name">
            </label>
            <label>
                Gender:
                <select class="form-select" name="gender" required>
                    <option value="" selected disabled>select Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </label>
            <label>Photo url:
                <input type="text" class="form-control" name="photo" alt="no photo yet">
            </label>
            <label>
                Location:
                <input type="text" class="form-control" placeholder="number and street..." name="location">
            </label>
            <label>
                Description:
                <input type="text" class="form-control" name="description">
            </label>
            <label>
                Size:
                <select class="form-select" name="size" required>
                    <option value="" selected disabled>choose size...</option>
                    <option value="small">small</option>
                    <option value="medium">medium</option>
                    <option value="large">large</option>
                </select>
            </label>
            <label>
                Age:
                <input type="number" class="form-control" placeholder="type number..." name="age">
            </label>
            <label>
                Vaccine:
                <select class="form-select" name="vaccinated" required>
                    <option value="" selected disabled>Vaccinated? choose...</option>
                    <option value="Yes">Yes</option>
                    <option value="No">No</option>
                </select>
            </label>
            <label>
                Breed:
                <input type="text" class="form-control" placeholder="breed, pet type" name="breed">
            </label>
            <label>
                Availability:
                <select class="form-select" name="availability" required>
                    <option value="" selected disabled>choose availability</option>
                    <option value="Available">Available</option>
                    <option value="Adopted">Adopted</option>
                </select>
            </label>
            <input class="btn btn-primary" type="submit" value="Create product" name="create">
        </form>
    </div>

</body>

</html>