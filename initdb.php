<?php
/**
 * Created by PhpStorm.
 * User: brandenkaestner
 * Date: 7/24/16
 * Time: 3:32 PM
 */

/*
 * SETTINGS!
 */
$databaseName = 'dog_data_db';
$databaseUser = 'root';
$databasePassword = 'root';

/*
 * CREATE THE DATABASE
 */

try {
    /*
     * CREATE THE DATABASE
     */
    $pdoDatabase = new PDO('mysql:host=localhost', $databaseUser, $databasePassword);
    $pdoDatabase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdoDatabase->exec('CREATE DATABASE IF NOT EXISTS dog_data_db');

    /*
     * CREATE THE TABLE
     */
    $pdo = new PDO('mysql:host=localhost;dbname=' . $databaseName, $databaseUser, $databasePassword);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// initialize the table
    $pdo->exec('DROP TABLE IF EXISTS animal;');

    $pdo->exec('CREATE TABLE `animal` (
 `id` int(11) NOT NULL AUTO_INCREMENT,
 `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
 `species` CHAR(10) NOT NULL,
 `breed` CHAR(20) NOT NULL,
 `sex` CHAR(6) NOT NULL,
 PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci');

    /*
     * INSERT SOME DATA!
     */
    $pdo->exec('INSERT INTO animal
    (name, species, breed, sex) VALUES
    ("Meeko", "Dog", "Husky", "Male")'
    );
    $pdo->exec('INSERT INTO animal
    (name, species, breed, sex) VALUES
    ("Frank", "Cat", "Somecat", "Female")'
    );
    $pdo->exec('INSERT INTO animal
    (name, species, breed, sex) VALUES
    ("Roger", "Bird", "Parrot", "Male")'
    );
    $pdo->exec('INSERT INTO animal
    (name, species, breed, sex) VALUES
    ("Luna", "Dog", "Husky", "Female")'
    );

    echo 'Ding!';

} catch (PDOException $e) {
    echo $e->getMessage();
}