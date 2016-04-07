<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="dogData.css">
    <title>All Four Paws Database</title>
</head>
<body>

<form name="insert" action="newEmp.php" method="post">

    <?php
    /**
     * Created by PhpStorm.
     * User: brandenkaestner
     * Date: 12/22/15
     * Time: 9:46 PM
     */

    $connection = mysqli_connect("localhost", "root", "root", "Dogdata");

    $username = $_POST["username"];
    $password = $_POST["password"];

    session_start();
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;

    if (mysqli_connect_errno()) {
        var_dump($username);
        var_dump($password);
        die("Connection failed." . mysqli_connect_error());
    } // Below is the form to add a new dog to the database
    else {
    ?>

    <h3>Add a new Employee:</h3>

    <p>Employee's firstname: <input title="firstname" type="text" name="firstname"/></p>

    <p>Employee's lastname: <input title="lastname" type="text" name="lastname"/></p>

    <p>Employee's username: <input title="username" type="text" name="username"/></p>

    <p>Employee's password: <input title="password" type="password" name="password"/></p>

    <input type="submit" value="Add"/>

</form>
</br>

<form action='empTable.php' method="POST">
    <input type="submit" name="backDog" value="Back to client table">
</form>

<?php

//Adding the clients's ID
$empIDQ = mysqli_query($connection, "SELECT workID FROM employees ORDER BY workID DESC LIMIT 1"); // Query for ID of last row in client table
$empID = mysqli_fetch_assoc($empIDQ); //fetches row
$empInt = (int)$empID['workID']; // String query -> int
var_dump($empInt);
if ($empInt == null) {
    $empInt = 0; // if data table is empty
} else {
    $empInt = $empInt + 1; // new ID for client
}
var_dump($empInt);

//clients's first name from form
$firstName = $_POST["firstname"];
var_dump($firstName);

//cleint's last name from form
$lastName = $_POST["lastname"];
var_dump($lastName);

//address from form
$un = $_POST["username"];
var_dump($un);

//address from form
$pw = $_POST["password"];
var_dump($pw);

//test to make sure values that can not be null are filled
if (empty($firstName)) {
    echo "first name needed";
    $empInt = $empInt - 1;
} else if (empty($lastName)) {
    echo "last name needed.";
    $empInt = $empInt - 1;
} else if (empty($un)) {
    echo "Username needed";
    $empInt = $empInt - 1;
} else if (empty($pw)) {
    echo "password needed";
    $empInt = $empInt - 1;
} else {
    $newEmpQ = "INSERT INTO employees (workID, firstname, lastname, un, pw, superVID, onshift) VALUES
                  ('" . $empInt . "', '" . $firstName . "', '" . $lastName . "', '" . $un . "', '" . $pw . "', '" . 1 . "', '" . true . "')";

    $newEmp = mysqli_query($connection, $newEmpQ);
    if (!$newEmp) { // if empty result
        $errorMessage = mysqli_error($connection);
        echo "Error with query: " . $errorMessage;
    } else {
        echo "Employee has been successfully added to the database.";
    }
}
}
mysqli_close($connection);
?>


</body>
</html>
