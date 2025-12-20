<?php

session_start();

require_once "db.php";
require_once "config.php";
require_once "helpers.php";
require_once 'redirect.php';

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
echo "id: "; var_dump($id); echo "<br>";

$sql = "SELECT id FROM appointment WHERE id = ?"; 
$values = [$id];
$appointment_id = execute($sql, $values)->fetch(PDO::FETCH_COLUMN);
echo "appointment_id: "; var_dump($appointment_id); echo "<br>";

if (!$appointment_id) {
    header("location: appointment_index.php");
}

$sql = "UPDATE appointment SET status = ? WHERE id = ?"; 
$values = ["confirmed", $id];
$confirmation = execute($sql, $values);
echo "confirmation: "; var_dump($confirmation); echo "<br>";

sys_log($appointment_id, "appointment", "update");

header("location: appointment_index.php");