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
    $med = $_POST['med'];
    $vac1 = $_POST['newVac1'];
    $vac2 = $_POST['newVac2'];
    $vac3 = $_POST['newVac3'];
    var_dump($med);
    var_dump($vac1);
    var_dump($vac2);
    var_dump($vac3);
    var_dump($animal);

    if (empty($animal) || empty($med) || empty($vac1) || empty($vac2) || empty($vac3)) {
        echo "Please insert missing values";
    } else {
        $medQ = "UPDATE animal SET medication='$med', vacDate1='$vac1', vacDate2='$vac2', vacDate3='$vac3' WHERE animalID='$animal'";
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