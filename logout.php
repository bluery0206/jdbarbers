<?php

function connect() {
    static $pdo = null;

    if ($pdo == null) {
        // User Credentials
        $hostname = "localhost";
        $username = "jdegamo_admin";
        $password = "jdegamo_admin";
        $database = "jdegamo";

        $dsn = "mysql:host=$hostname;dbname=$database";
       
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    return $pdo;
}

function execute($statement, $values=[]) {
    $pdo = connect();
    $stmt = $pdo->prepare($statement);
    $stmt->execute($values);
    return $stmt;
}

// To be able to use the session varirables
session_start();

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
header("Location: login.php");
exit;