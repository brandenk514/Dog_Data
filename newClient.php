<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="dogData.css">
    <title>All Four Paws Database</title>
</head>
<body>

<form name="insert" action="newClient.php" method="post">

    <?php
    /**
     * Created by PhpStorm.
     * User: brandenkaestner
     * Date: 12/22/15
     * Time: 9:46 PM
     */

    $connection = mysqli_connect("localhost","root","root","Dogdata");

    $username = $_POST["username"];
    $password = $_POST["password"];

    session_start();
    $_SESSION["username"] = $username;
    $_SESSION["password"] = $password;

    if (mysqli_connect_errno()) {
        var_dump($username);
        var_dump($password);
        die("Connection failed." . mysqli_connect_error());
    }
    // Below is the form to add a new dog to the database
    else {
    ?>

    <h3>Add a new client:</h3>

    <p>Client's firstname: <input title="firstname" type="text" name="firstname"/></p>

    <p>Client's lastname: <input title="lastname" type="text" name="lastname"/></p>

    <p>Client's address: <input title="address" type="text" name="address"/></p>

    <p>Client's Email: <input title="email" type="text" name="email"/></p>

    <input type="submit" value="Add"/>

</form>
</br>

<form action='clientTable.php' method="POST">
    <input type="submit" name="backDog" value="Back to client table">
</form>

<?php

//Adding the clients's ID
$clientIDQ = mysqli_query($connection, "SELECT clientID FROM clients ORDER BY clientID DESC LIMIT 1"); // Query for ID of last row in client table
$clientID = mysqli_fetch_assoc($clientIDQ); //fetches row
$clientInt = (int)$clientID['clientID']; // String query -> int
var_dump($clientInt);
if ($clientInt == null) {
    $clientInt = 0; // if data table is empty
} else {
    $clientInt = $clientInt + 1; // new ID for client
}
var_dump($clientInt);

//clients's first name from form
$firstName = $_POST["firstname"];
var_dump($firstName);

//cleint's last name from form
$lastName = $_POST["lastname"];
var_dump($lastName);

//address from form
$address = $_POST["address"];
var_dump($address);

//address from form
$email = $_POST["email"];
var_dump($email);

//test to make sure values that can not be null are filled
if (empty($firstName)) {
    echo "first name needed";
    $clientID = $clientID - 1;
} else if (empty($lastName)) {
    echo "last name needed.";
    $clientID = $clientID - 1;
} else if (empty($address)) {
    echo "Address needed";
    $clientID = $clientID - 1;
} else if (empty($email)) {
    echo "email needed";
    $clientID = $clientID - 1;
} else {
    $newClientQ = "INSERT INTO clients (clientID, firstname, lastname, address, email) VALUES
                  ('" . $clientInt . "', '" . $firstname . "', '" . $lastName . "', '" . $address . "', '" . $email . "')";

    $newClient = mysqli_query($connection, $newClientQ);
    if (!$newClient) { // if empty result
        $errorMessage = mysqli_error($connection);
        echo "Error with query: " . $errorMessage;
    } else {
        echo "Client has been successfully added to the database.";
    }
}
}
mysqli_close($connection);
?>


</body>
</html>
