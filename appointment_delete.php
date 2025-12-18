<?php
session_start();

require_once "db.php";
require_once 'vendor/autoload.php';
require_once 'redirect.php';

$id = filter_input(INPUT_GET, "id", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

$sql = "SELECT * FROM appointment WHERE id = ?"; 
$values = [$id];
$appointment = execute($sql, $values)->fetch(PDO::FETCH_COLUMN);

// var_dump($appointment);

if (!$appointment) {
    // header("location: appointment_index.php");
}

// Getting the customer ID so that we can delete the user if he doesnt have any appointments
$sql = "SELECT C.id FROM customer C, appointment WHERE appointment.customer_id = ?"; 
$values = [$id];
$customer_id = execute($sql, $values)->fetch();

// var_dump($customer_id);

$sql = "DELETE FROM appointment WHERE id = ?";
$values = [$id];
// execute($sql, $values);

// var_dump($sql);

$sql = "SELECT 1 FROM customer WHERE id = ?"; 
$values = [$id];
$customer_exists = execute($sql, $values)->fetch(PDO::FETCH_COLUMN);

echo "customer_exists: "; var_dump($customer_exists); echo "<br>";

if (!$customer_exists) {
    $sql = "DELETE FROM customer WHERE id = ?"; 
    $values = [$id];
    $customer_deleted = execute($sql, $values);
    echo "customer_deleted: "; var_dump($customer_deleted); echo "<br>";
}

// header("location: appointment_check.php?token=$token");
