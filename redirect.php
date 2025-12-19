<?php 

if (in_array(session_status(), [0, 1])) {
    session_start();
}

if (!isset($_SESSION['user'])) {
    header("location: index.php");
}

$sql = "SELECT is_admin FROM users WHERE id = ?";
$values = [$_SESSION['user']->id];
$is_admin = execute($sql, $values)->fetch(PDO::FETCH_COLUMN);

if (!$is_admin) {
    header("localtion: index.php");
}
