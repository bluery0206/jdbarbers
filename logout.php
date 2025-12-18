<?php

session_start();

require_once "db.php";

if ($_SESSION["user"] && $_SESSION['session_token']) {
    // Query to get the user log he haven't logged out yet
    $sql    = "UPDATE user_log SET time_out = CURTIME() 
                WHERE session_token = ?";
    $values = [$_SESSION["session_token"]];
    execute($sql, $values);
}

// Destroy session safely
session_unset();
session_destroy();

// Redirect to login
header("Location: index.php");
exit;