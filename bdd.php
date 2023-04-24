<?php

$host = "localhost";
$dbname = "socialmedia";
$username = "root";
$password = "";

try {

    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);

} catch (PDOException $e) {

    var_dump($e->getMessage());
    die;

}