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

    $token = filter_input(INPUT_GET, 'token', FILTER_SANITIZE_STRING);

    var_dump($token);
    $sql = "SELECT 
                a.token,
                a.date_appointment,
                s.name AS service_name,
                c.name AS customer_name,
                c.email AS customer_email,
                c.mobile AS customer_mobile
            FROM appointment a
            JOIN services s ON a.service_id = s.id
            JOIN customer c ON a.customer_id = c.id
            WHERE a.token = ? LIMIT 1";
    $values = [$token];
    $appointment = execute($sql, $values)->fetch();
    var_dump($appointment);