<?php
session_start();

require_once "db.php";
require_once 'vendor/autoload.php';

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

    if (!isset($token)) {
        header("Location: index.php");
    }

    $sql = "SELECT A.*, S.name AS service_name, S.price AS service_price, C.* 
            FROM appointment A, services S, customer C
            WHERE a.token = ? LIMIT 1";
    $values = [$token];
    $appointment = execute($sql, $values)->fetch();
?>

<?php 

require_once "assets/components/nav.php";

?>


<div class="uk-container uk-margin">
    <?php if ($appointment) : ?>
        <div class="uk-overflow-auto">
            <h2 class="uk-heading-1">
                Appointment (<?= $token ?>) on <?= date("M d, Y", strtotime($appointment->date_appointment)) ?>
            </h2>
            <table class="uk-table  uk-table-responsive uk-table-divider">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $appointment->name ?></td>
                        <td><?= $appointment->service_name ?> - &#8369;<?= $appointment->service_price ?></td>
                        <td><?= $appointment->status ?></td>
                    </tr>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <h1 class="uk-text-center">Appointment Not Found</h1>
    <?php endif ?>
</div>

</body>
</html>