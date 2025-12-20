<?php
session_start();

require_once "db.php";
require_once "config.php";
require_once "helpers.php";
require_once 'redirect.php';

// Get service ID from query parameter
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

if (!$id) {
    header("Location: services_index.php");
    exit;
}

// Get the service details
$sql = "SELECT * FROM services WHERE id = ?";
$values = [$id];
$service = execute($sql, $values)->fetch();

if (!$service) {
    header("Location: services_index.php");
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $name           = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $description    = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $price          = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);

    $sql = "UPDATE services SET name = ?, description = ?, price = ? WHERE id = ?";
    $values = [$name, $description, $price, $id];
    execute($sql, $values);
    sys_log($id, "services", "update");

    header("Location: services_index.php");
}