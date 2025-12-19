<?php
session_start();

require_once "db.php";
require_once 'vendor/autoload.php';
require_once 'redirect.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name           = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description    = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price          = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);

    $sql = "SELECT 1 FROM services WHERE name = ? AND  description = ?";
    $values = [$name, $description];
    $already_exists = execute($sql, $values)->fetch();

    if (!$already_exists) {
        $sql = "INSERT INTO services (name, description, price) VALUES (?, ?, ?)";
        $values = [$name, $description, $price];
        execute($sql, $values);
        

        header("Location: services_index.php");
    } else {
        echo "<script>alert('Service already exists')</script>";
    }
}