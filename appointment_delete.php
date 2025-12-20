<?php
session_start();

require_once "db.php";
require_once "config.php";
require_once "helpers.php";
require_once 'redirect.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$sql = "SELECT * FROM appointment WHERE id = ?"; 
$values = [$id];
$appointment = execute($sql, $values)->fetch(PDO::FETCH_COLUMN);

if (!$appointment) {
    header("location: appointment_index.php");
}

// Getting the customer ID so that we can delete the user if he doesnt have any appointments
$sql = "SELECT C.id FROM customer C, appointment WHERE appointment.customer_id = ?"; 
$values = [$id];
$customer_id = execute($sql, $values)->fetch();

$sql = "DELETE FROM appointment WHERE id = ?";
$values = [$id];
execute($sql, $values);
sys_log($id, "appointment", "delete");

$sql = "SELECT id FROM customer WHERE id = ?"; 
$values = [$id];
$customer_id = execute($sql, $values)->fetch(PDO::FETCH_COLUMN);

if (!$customer_id) {
    $sql = "DELETE FROM customer WHERE id = ?"; 
    $values = [$customer_id];
    $customer_deleted = execute($sql, $values);
    sys_log($customer_id, "customer", "delete");
}

header("location: appointment_index.php");
