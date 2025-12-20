<?php
session_start();

require_once "db.php";
require_once "config.php";
require_once "helpers.php";
require_once 'redirect.php';


if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name           = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description    = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price          = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);

    $sql = "SELECT 1 FROM services WHERE name = ? AND description = ? AND price = ?";
    $values = [$name, $description, $price];
    $already_exists = execute($sql, $values)->fetch();

    if (!$already_exists) {
        $sql = "INSERT INTO services (name, description, price) VALUES (?, ?, ?)";
        $values = [$name, $description, $price];
        execute($sql, $values);
        
        $sql = "SELECT id FROM services WHERE name = ? AND description = ? AND price = ?";
        $values = [$name, $description, $price];
        $service_id = execute($sql, $values)->fetch(PDO::FETCH_COLUMN);
        sys_log($service_id, "services", "create");
        

        header("Location: services_index.php");
    } else {
        echo "<script>alert('Service already exists')</script>";
    }
}