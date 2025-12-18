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

    $date_appointment = filter_var($_GET['date_appointment'], FILTER_SANITIZE_STRING) ?? null;

    var_dump($date_appointment);

    $appointment_token = bin2hex(random_bytes(3)) ?? $_POST['appointment_token'];

    var_dump($appointment_token);
?>

<div class="uk-container" style="border: 1px solid red;">
    <form action="">
        <h2>Set appointment on <?= date("F d, Y, l", strtotime($date_appointment))?></h2>

        <div>
            <div>
                <label for="">Token</label>
                <br>
                <small>Take note this token. You will need this to check your appointment's status</small>
            </div>
            <input type="text" name="token" id="token" value="<?= $appointment_token?>" disabled>
        </div>

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
            <?php 
                $sql = "SELECT * FROM services";
                $jbas_services = execute($sql)->fetchAll();
            ?>

            <div uk-form-custom="target: > * > span:last-child">
                <option value="">------</option>
                <select aria-label="Custom controls">
                    <?php foreach ($jbas_services as $service) : ?>
                        <option value="<?= $service->id ?>"><?= $service->name ?> <?= $service->price ?></option>
                    <?php endforeach?>
                    </select>
                <span class="uk-link">
                    <span uk-icon="icon: pencil"></span>
                    <span></span>
                </span>
            </div>
        </div>
        <div>
            <input type="submit" value="Appoint of date_appointment">
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
