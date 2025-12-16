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

require_once "assets/components/nav.php";

?>

<?php 

$idk = filter_var($_GET['date_appointment'], FILTER_SANITIZE_STRING) ?? null;

// $sql = "INSERT INTO customer (name, email, mobile) VALUES (?, ?, ?)";
// $values = []
// $close_dates = execute($sql)->fetchAll(PDO::FETCH_COLUMN);
// $close_dates = array_map(
//     fn($date_str) => date("j", strtotime($date_str)), 
//     $close_dates
// );

// var_dump($close_dates);

?>
    <div class="uk-container" style="border: 1px solid red;">
        <form action="">
            <h2>Set appointment on <?= date("F d, Y, l", strtotime($idk))?></h2>
            <div>
                <label for="">Name</label>
                <input type="text" name="name" id="name">
            </div>
            <div>
                <label for="">Email</label>
                <input type="email" name="email" id="email">
            </div>
            <div>
                <label for="">Mobile</label>
                <input type="text" name="mobile" id="mobile" pattern="[0-9]{11}">
            </div>
            <div>
                <label for="">Service</label>
                <select name="service" id="service">
                    <option value=""></option>
                </select>
            </div>
            <div>
                <input type="submit" value="Appoint of idk">
            </div>
        </form>
    </div>
    <div class="uk-section">
        footer links and etc

        <form action="" method="POST">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <input type="submit" value="Login" name="login">
            </div>
        </form>
    </div>
</body>
</html>
