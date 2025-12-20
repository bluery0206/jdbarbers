<?php
session_start();

require_once "db.php";
require_once "config.php";
require_once "helpers.php";
require_once 'redirect.php';

$id       = filter_var($_GET['id'], FILTER_SANITIZE_STRING) ?? null;
$sql = "SELECT 
            AP.*, 
            S.name AS service_name, 
            S.price AS service_price, 
            S.id AS service_id, 
            C.id AS customer_id,
            C.name,
            C.email,
            C.mobile
        FROM 
            appointment AP
        INNER JOIN 
            services S
        ON 
            AP.service_id = S.id
        INNER JOIN 
            customer C
        ON 
            AP.customer_id = C.id
        WHERE
            AP.id = ?
        LIMIT 1"; 
$values = [$id];
$appointment = execute($sql, $values)->fetch();
echo "appointment: "; var_dump($appointment); echo "<BR>";

if (!$appointment) {
    header("location: appointment_index.php");
}

$name       = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email      = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING);
$mobile     = filter_input(INPUT_POST, 'mobile', FILTER_SANITIZE_STRING);
$service_id = filter_input(INPUT_POST, 'service_id', FILTER_SANITIZE_STRING);

$sql = "UPDATE customer 
        SET 
            name = ?, 
            email = ?, 
            mobile = ? 
        WHERE id = ?"; 
$values = [$name, $email, $mobile, $appointment->customer_id];
$customer = execute($sql, $values);
sys_log($appointment->customer_id, "customer", "delete");

$sql = "UPDATE appointment 
        SET service_id = ? 
        WHERE id = ?"; 
$values = [$service_id, $id];
$appointment = execute($sql, $values);
sys_log($id, "appointment", "UPDATE");

header("location: appointment_index.php?token=$token");