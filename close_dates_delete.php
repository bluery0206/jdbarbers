<?php
session_start();

require_once "db.php";
require_once "config.php";
require_once "helpers.php";
require_once 'redirect.php';

// Get service ID from query parameter
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
echo "id: "; var_dump($id); echo "<br>";

if (!$id) {
    header("Location: close_dates_index.php");
    exit;
}

// Get the service details
$sql = "SELECT * FROM close_dates WHERE id = ?";
$values = [$id];
$close_date = execute($sql, $values)->fetch();
echo "close_date: "; var_dump($close_date); echo "<br>";

if (!$close_date) {
    header("Location: close_dates_index.php");
    exit;
}

$sql = "DELETE FROM close_dates WHERE id = ?";
$values = [$id];
execute($sql, $values);
sys_log($id, "close_dates", "delete");
header("Location: close_dates_index.php");