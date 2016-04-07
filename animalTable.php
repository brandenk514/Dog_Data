<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="dogData.css">
    <title>All Four Paws Database</title>
</head>
<body>

<div class="navBar">
    <ul>
        <li><a href="clientTable.php">Clients</a></li>
        <li><a href="animalTable.php">Dogs</a></li>
        <li><a href="empTable.php">Employees</a></li>
        <li><a href="payTable.php">Payments</a></li>
    </ul>
</div>
<?php

$connection = mysqli_connect("localhost", "root", "root", "4pawsData");

session_start();
$username = $_SESSION["username"];
$password = $_SESSION["password"];

if (mysqli_connect_errno()) {
    var_dump($username);
    var_dump($password);
    die("Connection failed." . mysqli_connect_error());
} else {
    ?>
    <form action="newAnimal.php" method="post">
        <input type="submit" name="submit" value="Add a dog">
    </form>
    </br>
    <table>
        <thead>
        <tr>
            <td>Owner's Name</td>
            <td>Animal's Name</td>
            <td>Species</td>
            <td>Breed</td>
            <td>Sex</td>
            <td>Size</td>
            <td>Neutered</td>
            <td>Friendly</td>
            <td>Rate</td>
            <td>Checked in</td>
            <td>Notes</td>
        </tr>
        </thead>
        <tbody>
        <?php
        $animals = mysqli_query($connection, "SELECT * FROM animal");
        if (empty($animals)) {
            echo "Table is empty. Please add an animal.";
        } else {
            while ($row = mysqli_fetch_assoc($animals)) {
                ?>
                <tr>
                    <td><?php echo $row['ownerLastname'] ?></td>
                    <td><?php echo $row['animalName'] ?></td>
                    <td><?php echo $row['species'] ?></td>
                    <td><?php echo $row['breed'] ?></td>
                    <td><?php if ($row['sex'] == true) {
                            echo "Female";
                        } else {
                            echo "Male";
                        } ?></td>
                    <td><?php echo $row['size'] ?></td>
                    <td><?php if ($row['neutered'] == true) {
                            echo "Yes";
                        } else {
                            echo "No";
                        } ?></td>
                    <td><?php if ($row['friendly'] == true) {
                            echo "Yes";
                        } else {
                            echo "No";
                        } ?></td>
                    <td><?php echo $row['rate'] ?></td>
                    <td><?php if ($row['checkedIn'] == true) {
                            echo "Yes";
                        } else {
                            echo "No";
                        } ?></td>
                    <td><?php echo $row['notes'] ?></td>
                    <td>
                        <form action='animalMed.php' name="<?php echo $row['animalID']; ?>" method="post">
                            <input type="hidden" name="getMed" value="<?php echo $row['animalID']; ?>">
                            <input type="submit" name="submit" value="Show Medical Records">
                        </form>
                    </td>
                    <td>
                        <form action='animalEdit.php' name="<?php echo $row['animalID']; ?>" method="post">
                            <input type="hidden" name="getID" value="<?php echo $row['animalID']; ?>">
                            <input type="submit" name="submit" value="Edit">
                        </form>
                    </td>
                </tr>

                <?php
            }

        }
        ?>

    </table>
    <?php
}
mysqli_close($connection);

?>

</body>
</html>