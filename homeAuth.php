<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="dogData.css">
    <title>All Four Paws Database</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: brandenkaestner
 * Date: 12/21/15
 * Time: 6:26 PM
 */

// Connect to the database

$username = $_POST["username"];
$password = $_POST["password"];

$connection = mysqli_connect("localhost", "root", "root", "4pawsData");


if (mysqli_connect_errno()) {
    var_dump($username);
    var_dump($password);
    die("Connection failed." . mysqli_connect_error());
}
else {

    $result = mysqli_query($connection, "SELECT * FROM employees WHERE un='$username' AND pw='$password'");

// if (!$result)
// Check that we have a valid username/password for access.  If we do,
// we'll establish a session. Otherwise, Failed!

    if (empty($result)) {
        $errorMessage = mysqli_error($connection);
        echo "Error with query: " . $errorMessage;
    } else {
        if (mysqli_num_rows($result) != 1) // if UN and password are not in Database then default to this
        {
            echo "Incorrect login. Please press back and try again.";
        } else {
// Start the session
            session_start();
            $_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
            ?>

<h1>Welcome to the All Four Paws Database</h1>
            <div class="navBar">
                <ul>
                    <li><a href="clientTable.php">Clients</a></li>
                    <li><a href="animalTable.php">Dogs</a></li>
                    <li><a href="empTable.php">Employees</a></li>
                    <li><a href="payTable.php">Payments</a></li>
                </ul>
            </div>
<?php
        }
    }
}
mysqli_close($connection);
?>



</body>
</html>
