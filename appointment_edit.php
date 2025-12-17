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

if (!isset($_GET['id'])) {
    header("location: appointment_index.php"); 
}

$id = $_GET['id'];
$sql = "SELECT * FROM appointment WHERE id = ? LIMIT 1";
$values = [$id];
$close_date = execute($sql, $values)->fetch();

if (!$close_date) {
    header("location: appointment_index.php"); 
}

var_dump($close_date);

?>
    <div class="uk-container" style="border: 1px solid red;">
        <form action="">
            <h2>Set appointment on <?= date("F d, Y, l", strtotime($idk))?></h2>
            <div>
                <label for="">Customer ID</label>
                <input type="text" name="customer_id" id="customer_id" value="<?= $close_date->customer_id ?>">
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
