<?php

session_start();

require_once "../components/db_connect.php";
require_once "../components/file_upload.php";
require_once "../components/functions.php";
$session = 0;
$goBack = "";

if (isset($_SESSION["adm"])) {
    $session = $_SESSION["adm"];
    $goBack = "../products/dashboard.php";
} else {
    $session = $_SESSION["user"];
    $goBack = "home.php";
}

$sql = "SELECT * FROM users WHERE user_id = {$session}";

$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

require_once "../components/navbar.php";

if (isset($_POST["update"])) {
    $first_name = cleanInputs($_POST["first_name"]);
    $last_name = cleanInputs($_POST["last_name"]);
    $email = cleanInputs($_POST["email"]);
    $date_of_birth = $_POST["date_of_birth"];
    $picture = fileUpload($_FILES["picture"]);

    if ($_FILES["picture"]["error"] == 4) {
        $update = "UPDATE `users` SET `first_name`='{$first_name}',`last_name`='{$last_name}',`date_of_birth`='{$date_of_birth}',`email`='{$email}' WHERE user_id = {$session}";
    } else {
        if ($row["picture"] != "avatar.png") {
            unlink("../pictures/{$row["picture"]}");
        }
        $update = "UPDATE `users` SET `first_name`='{$first_name}',`last_name`='{$last_name}',`date_of_birth`='{$date_of_birth}',`email`='{$email}', `picture`='{$picture[0]}' WHERE user_id = {$session}";
    }

    $result = mysqli_query($connect, $update);

    header("Location: {$goBack}");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Update</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?= $navbar ?>
    <div class="container">
        <h2 class="text-center my-4">Profile Update</h2>
        <div class="">
            <form method="post" enctype="multipart/form-data">
                <label>First name:
                    <input type="text" class="form-control" name="first_name" value="<?= $row["first_name"] ?>">
                </label>
                <label>
                    Last name:
                    <input type="text" class="form-control" name="last_name" value="<?= $row["last_name"] ?>">
                </label>
                <label>
                    Email address:
                    <input type="email" class="form-control" name="email" value="<?= $row["email"] ?>">
                </label>
                <label>
                    Birthdate:
                    <input type="date" class="form-control" name="date_of_birth" value="<?= $row["date_of_birth"] ?>">
                </label>
                <label>
                    Profile picture:
                    <input type="file" class="form-control" name="picture">
                </label>
                <input type="submit" class="btn btn-primary" name="update">

            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>

</html>