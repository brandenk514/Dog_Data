<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" http-equiv="refresh" content="3;url=animalTable.php">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="dogData.css">
    <title>All Four Paws Database</title>
</head>
<body>
<?php
/**
 * Created by PhpStorm.
 * User: brandenkaestner
 * Date: 12/22/15
 * Time: 9:46 PM
 */

$connection = mysqli_connect("localhost", "root", "root", "4pawsData");

$username = $_POST["username"];
$password = $_POST["password"];

session_start();
$_SESSION["username"] = $username;
$_SESSION["password"] = $password;

if (mysqli_connect_errno()) {
    var_dump($username);
    var_dump($password);
    die("Connection failed." . mysqli_connect_error());
} // Below is the form to add a new animal to the database
else {


    $animal = $_POST['animalsName'];
    $species = $_POST['species'];
    $breed = $_POST['breed'];
    $sex = $_POST['sex'];
    $size = $_POST['size'];
    $friend = $_POST[''];
    var_dump($species);
    var_dump($breed);
    var_dump($sex);
    var_dump($size);
    var_dump($animal);

    if (empty($animal) || empty($species) || empty($breed) || empty($sex) || empty($size)) {
        echo "Please insert missing values";
    } else {
        $medQ = "UPDATE animal SET medication='$species', vacDate1='$breed', vacDate2='$sex', vacDate3='$size' WHERE animalID='$animal'";
        var_dump($medQ);
        $newMed = mysqli_query($connection, $medQ);
        if (!$newMed) { // if empty result
            $errorMessage = mysqli_error($connection);
            echo "Error with query: " . $errorMessage;
        } else {
            echo "Information has successfully been updated. Please click anywhere to continue.";
        }
    }
}
mysqli_close($connection);
?>
</body>
</html>
