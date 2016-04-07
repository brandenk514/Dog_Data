<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="dogData.css">
    <title>All Four Paws Database</title>
</head>
<body>

<form name="animalMed" action="animalMedUpdate.php" method="post">

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

    $animID = $_POST['getMed']; //returning Null on next page. need to fix

    var_dump($animID);

    $aQ = mysqli_query($connection, "SELECT * FROM animal WHERE animalID='$animID'");
    var_dump($aQ);
    if (empty($aQ)) {
        $errorMessage = mysqli_error($connection);
        echo "Error with query: " . $errorMessage;
    }
    else {
    while ($row = mysqli_fetch_assoc($aQ)) {

    ?>

    <h3><?php echo $row['animalName']; ?>'s Medical information:</h3>

    <p> Select an Animal ID:
        <select name="animalsName" method="post">
            <option value="">Select...</option>
            <?php
            $a = mysqli_query($connection, "SELECT * FROM animal WHERE animalID='$animID'");
            if (empty($a)) {
                echo "No owners saved.";
            } else {
                while ($result = mysqli_fetch_row($a)) {
                    print ("<option>$result[0]</option>");
                }
            }
            ?>
        </select>
    </p>

    <h5>Veterinarian <p><?php echo $row['veterinarian']; ?></p></h5>

    <h5>Medication & Instructions: </h5>
    <h6>Current Instructions</h6>
    <p><?php echo $row['medication']; ?></p>
    <h6>New Instructions:</h6></br>
    <textarea name="med" rows="5"
              cols="40"/><?php echo $var = isset($_POST['med']) ? $_POST['med'] : "" ?></textarea></br>

    <p>Vaccine 1: <?php echo $row['vacDate1']; ?></p>
    <p>Vaccine 2: <?php echo $row['vacDate2']; ?></p>
    <p>Vaccine 3: <?php echo $row['vacDate3']; ?></p>

    <p>Updated Vaccine 1: <input title="vac1" type="date" name="newVac1"
                                 value="<?php echo isset($_POST['vac1Date']) ? $_POST['vac1Date'] : "" ?>"/></p>
    <p>Updated Vaccine 2: <input title="vac2" type="date" name="newVac2"
                                 value="<?php echo isset($_POST['vac2Date']) ? $_POST['vac2Date'] : "" ?>"/></p>
    <p>Updated Vaccine 3: <input title="vac3" type="date" name="newVac3"
                                 value="<?php echo isset($_POST['vac3Date']) ? $_POST['vac3Date'] : "" ?>"/></p>

    <input type="submit" value="Update">
</form>

<form action='animalTable.php' method="POST">
    <input type="submit" name="backDog" value="Back to animal table">
</form>

<?php
}
}
}
mysqli_close($connection);
?>
</body>
</html>
