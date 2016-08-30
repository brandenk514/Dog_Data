<?php
/**
 * Created by PhpStorm.
 * User: brandenkaestner
 * Date: 7/24/16
 * Time: 3:43 PM
 */
$configuration = array(
    'db_dsn'  => 'mysql:host=localhost;dbname=dogdatadb',
    'db_user' => 'root',
    'db_pass' => null,
);

require_once __DIR__. "src/Model/AbstractAnimal.php";