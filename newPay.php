<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="dogData.css">
    <title>All Four Paws Database</title>
</head>
<body>

<form name="insert" action="newPay.php" method="post">

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

    <h3>Add a new charge:</h3>

    <p>Client's Name: <input title="clientName" type="text" name="clientName"/></p>

    <p>Amount: <input title="amount" type="number" name="amount"/></p>

    <input type="submit" value="Charge"/>

</form>
</br>

<form action='payTable.php' method="POST">
    <input type="submit" name="backPay" value="Back to payment table">
</form>

<?php

//Adding the clients's ID
$payIDQ = mysqli_query($connection, "SELECT paymentID FROM payments ORDER BY paymentID DESC LIMIT 1"); // Query for ID of last row in client table
$payID = mysqli_fetch_assoc($payIDQ); //fetches row
$payInt = (int)$payID['paymentID']; // String query -> int
var_dump($payInt);
if ($payInt == null) {
    $payInt = 0; // if data table is empty
} else {
    $payInt = $payInt + 1; // new ID for client
}
var_dump($payInt);

//clients's first name from form
$clientName = $_POST["clientName"];
var_dump($clientName);

//cleint's last name from form
$amount = $_POST["lastname"];
var_dump($amount);

//test to make sure values that can not be null are filled
if (empty($animalName)) {
    echo "first name needed";
    $payInt = $payInt - 1;
} else if (empty($amount)) {
    echo "last name needed.";
    $payInt = $payInt - 1;
} else {
    $newPayQ = "INSERT INTO payments (paymentID, ownerID, amount) VALUES ('" . $payInt . "', '" . $ownerID . "', '" . $amount . "')";

    $newPay = mysqli_query($connection, $newPayQ);
    if (!$newPay) { // if empty result
        $errorMessage = mysqli_error($connection);
        echo "Error with query: " . $errorMessage;
    } else {
        echo "The payment has been successfully added to the database.";
    }
}
}
mysqli_close($connection);
?>


</body>
</html>
