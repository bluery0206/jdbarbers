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

$sql = "DELETE FROM services WHERE id = ?";
$values = [$id];
execute($sql, $values);
sys_log($id, "services", "delete");
header("Location: services_index.php");
