<?php
session_start();

require_once "db.php";
require_once 'vendor/autoload.php';
require_once 'redirect.php';

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

    $sql = "SELECT AP.*, S.name AS service_name, S.price AS service_price, C.name FROM services S, appointment AP, customer C";
    $appointments = execute($sql)->fetchAll();

?>

<div class="uk-container uk-margin">
    <?php if ($appointments) : ?>
        <div class="uk-overflow-auto ">
            <table class="uk-table uk-table-responsive uk-table-divider">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Service</th>
                        <th>Status</th>
                        <th>Appointment</th>
                        <th>Created</th>
                        <th>Updated</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointments as $appointment) : ?>
                        <?php 
                        
                            $date = date("F d, Y, l", strtotime($appointment->date_appointment));
                            
                        ?>
                        <tr>
                            <td><?= $appointment->name ?></td>
                            <td><?= $appointment->service_name ?> - &#8369;<?= $appointment->service_price ?></td>
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
                                            <h2 class="uk-modal-title">Set appointment on <?= $date ?></h2>
                                        </div>
                                        <div class="uk-modal-body">
                                            <?php 
                                            
                                                $action = "appointment_edit.php?date_appointment=$date";
                                            
                                            ?>
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
