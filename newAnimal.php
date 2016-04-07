<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="dogData.css">
    <title>All Four Paws Database</title>
</head>
<body>

<form name="addAnimal" action="newAnimal.php" method="post">

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

    ?>

    <h3>Add a new animal:</h3>

    <p>Animal's Name: <input title="animalName" type="text" name="animalName"
                             value="<?php echo isset($_POST['animalName']) ? $_POST['animalName'] : "" ?>"/></p>

    <p> Select an Owner:
        <select name="owner">
            <option value="">Select...</option>
            <?php
            $owners = mysqli_query($connection, "SELECT lastname, firstname FROM clients"); //Work on getting values to stay on failed submit
            if (empty($owners)) {
                echo "No owners saved.";
            } else {
                while ($row = mysqli_fetch_row($owners)) {
                    ?>
                    <option><?php echo $row[0] . ", " ?><?php echo $row[1] ?></option>
                    <?php
                }
            }
            ?>

        </select>
    </p>

    <p>Species: <input title="species" type="text" name="species"
                       value="<?php echo isset($_POST['species']) ? $_POST['species'] : "" ?>"/></p>

    <p>Breed: <input title="breed" type="text" name="breed"
                     value="<?php echo isset($_POST['breed']) ? $_POST['breed'] : "" ?>"/></p>

    <?php $a = (isset($_POST['size']) ? $_POST['size'] : "");
    $b = (isset($_POST['rate']) ? $_POST['rate'] : ""); ?>

    <p>Size: <select name="size">
            <option value="">Select...</option>
            <option <?php echo ($a == 'Large') ? 'selected="selected"' : '' ?> value="Large">Large</option>
            <option <?php echo ($a == 'Medium') ? 'selected="selected"' : '' ?> value="Medium">Medium</option>
            <option <?php echo ($a == 'Small') ? 'selected="selected"' : '' ?> value="Small">Small</option>
        </select>
    </p>

    <p>Sex: <input type="checkbox" name="female"
                   value="female" <?php if (isset($_POST['female'])) echo "checked='checked'"; ?>/> Female <input
            type="checkbox" name="male" value="male" <?php if (isset($_POST['male'])) echo "checked='checked'"; ?>/>
        Male </p>

    <p>Neutered: <input type="checkbox" name="nYes"
                        value="yes" <?php if (isset($_POST['nYes'])) echo "checked='checked'"; ?>/> Yes <input
            type="checkbox" name="nNo" value="no" <?php if (isset($_POST['nNo'])) echo "checked='checked'"; ?>/> No </p>

    <p>Friendly: <input type="checkbox" name="friendlyYes"
                        value="yes" <?php if (isset($_POST['friendlyYes'])) echo "checked='checked'"; ?>> Yes <input
            type="checkbox" name="friendlyNo"
            value="no" <?php if (isset($_POST['friendlyNo'])) echo "checked='checked'"; ?>> No </p>

    <p>Rate: <select name="rate">
            <option value="">Select...</option>
            <option <?php echo ($b == '1st') ? 'selected="selected"' : '' ?> value="1st">1st</option>
            <option <?php echo ($b == '2nd') ? 'selected="selected"' : '' ?> value="2nd">2nd</option>
            <option <?php echo ($b == '3rd') ? 'selected="selected"' : '' ?> value="3rd">3rd</option>
        </select>
    </p>

    <p>Checked In: <input type="checkbox" name="checkInYes"
                          value="yes" <?php if (isset($_POST['checkInYes'])) echo "checked='checked'"; ?>/> Yes <input
            type="checkbox" name="checkInNo"
            value="no" <?php if (isset($_POST['checkInNo'])) echo "checked='checked'"; ?>/> No </p>

    <p>Notes: </br><textarea name="notes" rows="5"
                             cols="40"/><?php echo $var1 = isset($_POST['notes']) ? $_POST['notes'] : "" ?></textarea></br>
    </p>

    <h4>Medical Information:</h4>

    <p> Select an veterinarian:
        <select name="vets" method="post">
            <option value="">Select...</option>
            <?php
            $vets = mysqli_query($connection, "SELECT lastname FROM vet");
            if (empty($vets)) {
                echo "No owners saved.";
            } else {
                while ($result = mysqli_fetch_row($vets)) {
                    print ("<option>$result[0]</option>");
                }
            }
            ?>
        </select>
    </p>

    <p>Vaccine 1: <input title="vac1" type="date" name="vac1Date"
                         value="<?php echo isset($_POST['vac1Date']) ? $_POST['vac1Date'] : "" ?>"/></p>
    <p>Vaccine 2: <input title="vac2" type="date" name="vac2Date"
                         value="<?php echo isset($_POST['vac2Date']) ? $_POST['vac2Date'] : "" ?>"/></p>
    <p>Vaccine 3: <input title="vac3" type="date" name="vac3Date"
                         value="<?php echo isset($_POST['vac3Date']) ? $_POST['vac3Date'] : "" ?>"/></p>

    <p>Medication & Instructions: <br/><textarea name="med" rows="5"
                                                 cols="40"/><?php echo $var = isset($_POST['med']) ? $_POST['med'] : "" ?></textarea></br>
    </p>

    <h4>Reservation:</h4>

    <p>Date In: <input title="dateIn" type="date" name="dateIn"
                       value="<?php echo isset($_POST['dateIn']) ? $_POST['dateIn'] : "" ?>"/></p>
    <p>Date Out: <input title="dateOut" type="date" name="dateOut"
                        value="<?php echo isset($_POST['dateOut']) ? $_POST['dateOut'] : "" ?>"/></p>
    <p>Room: <input title="room" type="text" name="room"
                    value="<?php echo isset($_POST['room']) ? $_POST['room'] : "" ?>"/></p>

    <input type="submit" value="Add">
</form>

<form action='animalTable.php' method="POST">
    <input type="submit" name="backDog" value="Back to animal table">
</form>

<?php


//Adding the clients's ID
$animalIDQ = mysqli_query($connection, "SELECT animalID FROM animal ORDER BY animalID DESC LIMIT 1"); // Query for ID of last row in client table
$animalID = mysqli_fetch_assoc($animalIDQ); //fetches row
$animalInt = (int)$animalID['animalID']; // String query -> int
var_dump($animalInt);
if ($animalInt == null) {
    $animalInt = 1; // if data table is empty
} else {
    $animalInt = $animalInt + 1; // new ID for animal
}
var_dump($animalInt);

//animal's first name from form
$animalName = $_POST["animalName"];
$_SESSION["animalName"] = $_POST["animalName"];
var_dump($animalName);

//owners's last name from form
$owner = $_POST["owner"];
$strAry = explode(',', $owner); //Explode string to get just last name of client
var_dump($owner);
var_dump($strAry[0]);
$ownerQ = mysqli_query($connection, "SELECT clientID FROM clients WHERE lastname='$strAry[0]'"); // Query for that name and get ID
$ownerID = mysqli_fetch_assoc($ownerQ);
$ownerInt = (int)$ownerID['clientID'];
var_dump($ownerInt);

$ownerName = $_POST["owner"];
var_dump($ownerName);

//address from form
$species = $_POST["species"];
var_dump($species);

//address from form
$breed = $_POST["breed"];
var_dump($breed);

$size = $_POST["size"];
var_dump($size);

$sex = $_POST["female"] || $_POST["male"]; //Change string to Boolean for simplicity
if ($sex == "female") {
    $sex = True;
} else {
    $sex = false;
}
var_dump($sex);

$neutered = $_POST["nYes"] || $_POST['nNo'];
var_dump($neutered);
if ($neutered == "yes") {
    $neutered = true;
} else {
    $neutered = false;
}
var_dump($neutered);

$friendly = $_POST["friendlyYes"] || $_POST['friendlyNo'];
if ($friendly == "yes") {
    $friendly = true;
} else {
    $friendly = false;
}
var_dump($friendly);

$rate = $_POST["rate"];
var_dump($rate);

$checkIn = $_POST["checkInYes"] || $_POST['checkInNo'];
if ($checkIn == "yes") {
    $checkIn = true;
} else {
    $checkIn = false;
}
var_dump($checkIn);

$notes = $_POST["notes"];
var_dump($notes);

$vet = $_POST["vets"];
var_dump($vet);

$vac1 = $_POST["vac1Date"];
var_dump($vac1);

$vac2 = $_POST["vac2Date"];
var_dump($vac2);

$vac3 = $_POST["vac3Date"];
var_dump($vac3);

$med = $_POST["med"];
var_dump($med);

//Adding the reservation

$dateIn = $_POST["dateIn"];
var_dump($dateIn);

$dateOut = $_POST["dateOut"];
var_dump($dateOut);

$room = $_POST["room"];
var_dump($room);

//test to make sure values that can not be null are filled and deincriment on fail submit
if (empty($animalName)) {
    echo "Animal name needed";
    $animalInt = $animalInt - 1;
} else if (empty($owner)) {
    echo "Owner name needed.";
    $animalInt = $animalInt - 1;
} else if (empty($species)) {
    echo "Species needed.";
    $animalInt = $animalInt - 1;
} else if (empty($breed)) {
    $breed = "unknown";
    $animalInt = $animalInt - 1;
} else if (empty($size)) {
    echo "Size needed.";
    $animalInt = $animalInt - 1;
} else if (empty($sex) || empty($neutered) || empty($friendly) || empty($checkIn)) {
    echo "Sex, neutered, friendly, or checked in status needed.";
    $animalInt = $animalInt - 1;
} else if (empty($vac1) || empty($vac2) || empty($vac3)) {
    echo "Vaccine dates needed.";
    $animalInt = $animalInt - 1;
} else if (empty($dateIn) || empty($dateOut) || empty($room)) {
    echo "Dates or room needed";
    $animalInt = $animalInt - 1;
} else {
    $newAnimalQ = "INSERT INTO animal (animalID, animalName, species, breed, sex, size, friendly, neutered,
                  checkedIn, ownerID, ownerLastname, rate, vacDate1, vacDate2, vacDate3, medication, veterinarian, notes) VALUES
                  ('" . $animalInt . "', '" . $animalName . "', '" . $species . "', '" . $breed . "', '" . $sex . "', '" . $size . "', '" . $friendly . "', '" . $neutered . "',
                  '" . $checkIn . "', '" . $ownerInt . "', '" . $ownerName . "', '" . $rate . "', '" . $vac1 . "', '" . $vac2 . "', '" . $vac3 . "', '" . $med . "', '" . $vet . "', '" . $notes . "')";
    $newResQ = "INSERT INTO reservations (resID, clientID, dateIN, dateOut, room) VALUES ('" . $resID . "','" . $ownerInt . "','" . $dateIn . "','" . $dateOut . "','" . $room . "')";

    $newRes = mysqli_query($connection, $newResQ);
    $newAnimal = mysqli_query($connection, $newAnimalQ);
    if (empty($newAnimal)) {
        echo "animal fail";
    } else if (empty($newRes)) {
        $errorMessage = mysqli_error($connection);
        echo "Error with query: " . $errorMessage;
        // if empty result
    } else {
        echo "The animal and reservation have been successfully added to the database.";
    }
}
}
mysqli_close($connection);
?>
</body>
</html>
