<?php
session_start();

require_once "db.php";
require_once "config.php";
require_once "helpers.php";
require_once 'redirect.php';

?>

<!DOCTYPE html>
<html lang="en">

<?php 

    $page_title = "Appointments";
    require_once "assets/components/head.php";

?>

<body>

<?php 

    require_once "assets/components/nav.php";

    $sql = "SELECT 
                AP.*, 
                S.name AS service_name, 
                S.price AS service_price, 
                C.name,
                C.email,
                C.mobile
            FROM 
                appointment AP
            INNER JOIN 
                services S
            ON 
                AP.service_id = S.id
            INNER JOIN 
                customer C
            ON 
                AP.customer_id = C.id";

    $appointments = execute($sql)->fetchAll();

?>

<div class="uk-container uk-margin">
    <?php if ($appointments) : ?>
        <div class="uk-overflow-auto ">
            <h2>Appointments</h2>
            <table class="uk-table uk-table-divider uk-table-striped uk-table-hover uk-table-small">
                <thead>
                    <tr>
                        <th class="uk-table-shrink">Token</th>
                        <th class="uk-table-shrink">Customer</th>
                        <th>Service</th>
                        <th class="uk-table-shrink uk-text-center">Status</th>
                        <th class="uk-table-shrink">Appointment</th>
                        <th class="uk-table-shrink">Created</th>
                        <th class="uk-table-shrink">Updated</th>
                        <th class="uk-table-shrink uk-text-right uk-text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($appointments as $appointment) : ?>
                        <?php 

                            $date = date("F d, Y, l", strtotime($appointment->date_appointment));

                        ?>
                        <tr class="
                            <?php if ($appointment->status == "rejected" ) : ?>
                                uk-text-danger
                            <?php elseif ($appointment->status == "confirmed" ) : ?>
                                uk-text-primary
                            <?php else : ?>
                                uk-text-muted
                            <?php endif ?>">
                            <td class="uk-text-nowrap"><?= $appointment->token ?></td>
                            <td class="uk-text-nowrap"><?= $appointment->name ?></td>
                            <td><?= $appointment->service_name ?> - &#8369;<?= $appointment->service_price ?></td>
                            <td class="uk-flex uk-flex-center" ?><?= $appointment->status ?></td>
                            <td class="uk-text-nowrap"><?= date("M d, Y", strtotime($appointment->date_appointment)) ?></td>
                            <td class="uk-text-nowrap"><?= date("M d, Y", strtotime($appointment->date_created)) ?></td>
                            <td class="uk-text-nowrap"><?= date("M d, Y", strtotime($appointment->date_updated)) ?></td>
                            <td class="uk-button-group uk-flex uk-flex-right">
                                
                                <!-- Show different buttons per status -->
                                <?php if (!in_array($appointment->status, ["confirmed", "rejected"])) :?>
                                
                                    <a class="uk-button uk-button-primary uk-button-small uk-flex uk-flex-middle" 
                                        href="appointment_confirm.php?id=<?= $appointment->id ?>">
                                        <span class="uk-text-small"uk-icon="check"></span>
                                        Confirm
                                    </a>
                                    <a class="uk-button uk-button-small uk-flex uk-flex-middle" 
                                        href="appointment_reject.php?id=<?= $appointment->id ?>">
                                        <span class="uk-text-small"uk-icon="close"></span>
                                        Reject
                                    </a>
                                
                                <?php elseif (in_array($appointment->status, ["pending", "rejected"])) :?>
                                
                                    <a class="uk-button uk-button-primary uk-button-small uk-flex uk-flex-middle" 
                                        href="appointment_confirm.php?id=<?= $appointment->id ?>">
                                        <span class="uk-text-small"uk-icon="check"></span>
                                        Confirm
                                    </a>
                                
                                <?php elseif (in_array($appointment->status, ["pending", "confirmed"])) :?>
                                    <a class="uk-button uk-button-small uk-flex uk-flex-middle" 
                                
                                        href="appointment_reject.php?id=<?= $appointment->id ?>">
                                        <span class="uk-text-small"uk-icon="close"></span>
                                        Reject
                                    </a>
                                
                                <?php endif ?>

                                <a class="uk-button uk-button-small uk-flex uk-flex-middle" href="#modal-container-<?= $appointment->id ?>" uk-toggle>
                                    <span class="uk-text-small"uk-icon="file-edit"></span>
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
                                            
                                                $action = "appointment_edit.php?id=$appointment->id";
                                            
                                            ?>
                                            <?php include "assets/components/form/appointment.php"; ?>
                                        </div>
                                    </div>
                                </div>
                                <a class="uk-button uk-button-danger uk-button-small uk-flex uk-flex-middle" 
                                    href="appointment_delete.php?id=<?= $appointment->id ?>">
                                    <span uk-icon="trash"></span>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    <?php else: ?>
        <h1 class="uk-text-center">No appointments yet</h1>
    <?php endif ?>
</div>

</body>
</html>
