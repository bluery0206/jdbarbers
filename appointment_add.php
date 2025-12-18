<?php
session_start();

require_once "db.php";
require_once 'vendor/autoload.php';
require_once 'assets/includes/login.includes.php';

?>

<!DOCTYPE html>
<html lang="en">

<?php 

$page_title = "Home";
require_once "assets/components/head.php";

?>

<body>

<?php 

    $date       = filter_var($_GET['date_appointment'], FILTER_SANITIZE_STRING) ?? null;
    $name       = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email      = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
    $mobile     = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);
    $service_id = filter_input(INPUT_POST, 'service_id', FILTER_SANITIZE_STRING);

    $sql = "SELECT id FROM customer WHERE name = ? AND email = ? AND mobile = ? LIMIT 1"; 
    $values = [$name, $email, $mobile];
    $customer = execute($sql, $values)->fetch();

    if (!$customer) {
        $sql = "INSERT INTO customer (name, email, mobile) VALUES (?, ?, ?)";
        $values = [$name, $email, $mobile];
        execute($sql, $values);

        $sql = "SELECT id FROM customer WHERE name = ? AND email = ? AND mobile = ? LIMIT 1"; 
        $values = [$name, $email, $mobile];
        $customer = execute($sql, $values)->fetch();
    }

    $customer_id = $customer->id;

    $token = bin2hex(random_bytes(3)) ?? $_POST['appointment_token'];

    $sql = "INSERT INTO appointment (
                token,
                customer_id, 
                service_id, 
                date_appointment) 
            VALUES (?, ?, ?, ?)"; 
    $values = [$token, $customer_id, $service_id, $date];
    execute($sql, $values);
    header("location: appointment_success.php?token=$token");
?>