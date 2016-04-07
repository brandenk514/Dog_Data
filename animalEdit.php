<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="dogData.css">
    <title>All Four Paws Database</title>
</head>
<body>

<form name="updateAnimal" action="animalEdit.php" method="post">

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
    $aID = $_POST['getID'];
    var_dump($aID);

    $aQ = mysqli_query($connection, "SELECT * FROM animal WHERE animalID='$aID'");

    while ($row = mysqli_fetch_assoc($aQ)) {
    ?>

    <h3><?php echo $row['animalName']; ?>'s Information:</h3>
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
    <h5>Species: </h5>
    <p><?php echo $row['species']; ?></p>
    <p>Enter new species: </p><input title="species" type="text" name="species"/>

    <h5>Breed: </h5>
    <p><?php echo $row['breed']; ?></p>
    <p>Enter new breed: </p><input title="breed" type="text" name="breed"/>

    <h5>Sex: </h5>
    <p><?php echo $row['sex']; ?></p></br>
    <p>Change sex: Female</p><input title="sex" type="radio" name="female"/> Male <input title="sex" type="radio"
                                                                                         name="male"/>

    <h5>Size: </h5>
    <p><?php echo $row['size']; ?></p>
    <h5>Friendly: </h5>
    <p><?php echo $row['friendly']; ?></p>
    <h5>Neutered: </h5>
    <p><?php echo $row['neutered']; ?></p>
    <h5>Checked In:</h5>
    <p><?php echo $row['checkedIn']; ?></p>
    <h5>Rate: </h5>
    <p><?php echo $row['rate']; ?></p>

    <h5>Notes: </h5>
    <textarea name="notes" rows="5"
              cols="40"/><?php echo $var = isset($_POST['notes']) ? $_POST['notes'] : "" ?></textarea></br>

    <input type="submit" value="Update">
</form>
<?php
}
}
mysqli_close($connection);
?>

</body>
</html>