<?php

session_start();

require_once "db.php";
require_once "config.php";
require_once "helpers.php";

if ($_SESSION["user"]) {
    sys_log($_SESSION["user"]->id, "user", "logout");
}

// Destroy session safely
session_unset();
session_destroy();

// Redirect to login
header("Location: index.php");
exit;