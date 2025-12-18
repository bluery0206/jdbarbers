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

    require_once "assets/components/nav.php";

    $sql = "SELECT AP.*, C.* FROM appointment AP, customer C";
    $appointments = execute($sql)->fetchAll();

?>

<div class="uk-container">
    <?php if ($appointments) : ?>
        <div class="uk-overflow-auto">
            <table class="uk-table  uk-table-responsive uk-table-divider">
                <thead>
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
                </thead>
                <tbody>
                    <?php foreach ($appointments as $appointment) : ?>
                        <tr>
                            <td><?= $appointment->id ?></td>
                            <td><?= $appointment->customer_id ?></td>
                            <td><?= $appointment->service_id ?></td>
                            <td><?= $appointment->status ?></td>
                            <td><?= $appointment->date_appointment ?></td>
                            <td><?= $appointment->date_created ?></td>
                            <td><?= $appointment->date_updated ?></td>
                            <td>
                                <a class="calendar-day-link" href="#modal-container-<?= $appointment->id ?>" uk-toggle>
                                    <div>Edit</div>
                                </a>

                                <div id="modal-container-<?= $appointment->id ?>" class="uk-modal-container" uk-modal>
                                    <div class="uk-modal-dialog">
                                        <button class="uk-modal-close-default" type="button" uk-close=""></button>
                                        <div class="uk-modal-header">
                                            <h2 class="uk-modal-title">Set appointment on <?= date("F d, Y, l", strtotime($appointment->date_appointment))?></h2>
                                        </div>
                                        <div class="uk-modal-body">
                                            <?php include "assets/components/form/appointment_add.php"; ?>
                                        </div>
                                    </div>
                                </div>
                                
                                <a href="appointment_delete.php?id=<?= $appointment->id ?>">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <h1>No appointments yet</h1>
    <?php endif ?>
</div>


<?php 

    require_once "assets/components/footer.php";

?>
</body>
</html>
