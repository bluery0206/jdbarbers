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

$page_title = "Close Dates";
require_once "assets/components/head.php";

?>

<body>

<?php 

    require_once "assets/components/nav.php";

    $sql = "SELECT * FROM close_dates";
    $jbas_close_dates = execute($sql)->fetchAll();

?>

<div class="uk-container uk-margin">
    <div class="uk-overflow-auto ">
        <div class="uk-flex uk-flex-between uk-flex-middle">
            <h2>Close Dates</h2>
            <a class="uk-button uk-button-primary" href="#modal-container-new" uk-toggle>
                <div>Add New</div>
            </a>
            <div id="modal-container-new" class="uk-modal-container" uk-modal>
                <div class="uk-modal-dialog">
                    <button class="uk-modal-close-default" type="button" uk-close=""></button>
                    <div class="uk-modal-header">
                        <h2 class="uk-modal-title">Add New Close Dates</h2>
                    </div>
                    <div class="uk-modal-body">
                        <?php 
                        
                            $action = "close_dates_add.php";
                        
                        ?>
                        <?php include "assets/components/form/close_dates.php"; ?>
                    </div>
                </div>
            </div>
        </div>
        <?php if ($jbas_close_dates) : ?>
            <table class="uk-table uk-table-divider uk-table-striped uk-table-hover uk-table-small">
                <thead>
                    <tr>
                        <!-- <th class="uk-table-shrink">Status</th> -->
                        <th class="uk-table-shrink">Close</th>
                        <th class="uk-table-shrink">Time Start</th>
                        <th class="uk-table-shrink">Time End</th>
                        <th class="uk-table-shrink">Created</th>
                        <th class="uk-table-shrink">Updated</th>
                        <th class="uk-table-shrink uk-text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jbas_close_dates as $close_date) : ?>
                        <tr> 

                            <td class="uk-text-nowrap"><?= date("M d, Y", strtotime($close_date->date_close)) ?></td>
                            <td class="uk-text-nowrap"><?= date("h:i A", strtotime($close_date->time_start)) ?></td>
                            <td class="uk-text-nowrap"><?= date("h:i A", strtotime($close_date->time_end)) ?></td>
                            <td class="uk-text-nowrap"><?= date("M d, Y", strtotime($close_date->date_created)) ?></td>
                            <td class="uk-table-shrink"><?= date("M d, Y", strtotime($close_date->date_updated)) ?></td>
                            <td class="uk-button-group uk-flex uk-flex-center">
                                <a class="uk-button uk-button-small uk-flex uk-flex-middle" href="#modal-container-<?= $close_date->id ?>" uk-toggle>
                                    <span class="uk-text-small"uk-icon="file-edit"></span>
                                    <div>Edit</div>
                                </a>
                                <div id="modal-container-<?= $close_date->id ?>" class="uk-modal-container" uk-modal>
                                    <div class="uk-modal-dialog">
                                        <button class="uk-modal-close-default" type="button" uk-close=""></button>
                                        <div class="uk-modal-header">
                                            <h2 class="uk-modal-title">Edit Close Date</h2>
                                        </div>
                                        <div class="uk-modal-body">
                                            <?php 
                                            
                                                $action = "close_dates_edit.php?id=$close_date->id";
                                            
                                            ?>
                                            <?php include "assets/components/form/close_dates.php"; ?>
                                        </div>
                                    </div>
                                </div>
                                <a class="uk-button uk-button-danger uk-button-small uk-flex uk-flex-middle" 
                                    href="close_dates_delete.php?id=<?= $close_date->id ?>">
                                    <span uk-icon="trash"></span>
                                    Delete
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <h1 class="uk-text-center">No close dates yet</h1>
        <?php endif ?>
    </div>
</div>

</body>
</html>
