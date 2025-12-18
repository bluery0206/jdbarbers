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
require_once 'assets/components/calendar.php';

?>
dsad
<?php 

$sql = "SELECT * FROM appointment";
$close_dates = execute($sql)->fetchAll();

?>

<?php if ($close_dates) : ?>
    <table border="1">
        <tr>
            <th>id</th>
            <th>customer_id</th>
            <th>service_id</th>
            <th>status</th>
            <th>date_appointmtent</th>
            <th>date_created</th>
            <th>date_updated</th>
            <th>actions</th>
        </tr>
        <?php foreach ($close_dates as $close_date) : ?>
            <tr>
                <td><?= $close_date->id ?></td>
                <td><?= $close_date->customer_id ?></td>
                <td><?= $close_date->service_id ?></td>
                <td><?= $close_date->status ?></td>
                <td><?= $close_date->date_appointment ?></td>
                <td><?= $close_date->date_created ?></td>
                <td><?= $close_date->date_updated ?></td>
                <td>
                    <a class="calendar-day-link" href="#modal-container-<?= $day_count?>" uk-toggle>
                        <div><?= $day_count ?></div>
                        <div>slots available</div>
                    </a>

                    <div id="modal-container-<?= $day_count?>" class="uk-modal-container" uk-modal>
                        <div class="uk-modal-dialog">
                            <button class="uk-modal-close-default" type="button" uk-close=""></button>
                            <div class="uk-modal-header">
                                <h2 class="uk-modal-title">Set appointment on <?= date("F d, Y, l", strtotime($close_date->date_appointment))?></h2>
                            </div>
                            <div class="uk-modal-body">
                                <?php include "assets/components/form/appointment_add.php"; ?>
                            </div>
                        </div>
                    </div>
                    
                    <a href="appointment_delete.php?id=<?= $close_date->id ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php endif?>

    
</body>
</html>
