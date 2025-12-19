<?php
session_start();

require_once "db.php";
require_once 'vendor/autoload.php';
require_once 'redirect.php';

?>

<!DOCTYPE html>
<html lang="en">

<?php 

$page_title = "Services";
require_once "assets/components/head.php";

?>

<body>

<?php 

    require_once "assets/components/nav.php";

    $sql = "SELECT * FROM services";
    $jbas_services = execute($sql)->fetchAll();

?>

<div class="uk-container uk-margin">
    <?php if ($jbas_services) : ?>
        <div class="uk-overflow-auto ">
            <div class="uk-flex uk-flex-between uk-flex-middle">
                <h2>Services</h2>
                <a class="uk-button uk-button-primary" href="#modal-container-new" uk-toggle>
                    <div>Add new</div>
                </a>
                <div id="modal-container-new" class="uk-modal-container" uk-modal>
                    <div class="uk-modal-dialog">
                        <button class="uk-modal-close-default" type="button" uk-close=""></button>
                        <div class="uk-modal-header">
                            <h2 class="uk-modal-title">Add New Service</h2>
                        </div>
                        <div class="uk-modal-body">
                            <?php 
                            
                                $action = "services_add.php";
                            
                            ?>
                            <?php include "assets/components/form/services.php"; ?>
                        </div>
                    </div>
                </div>
            </div>
            <table class="uk-table uk-table-divider uk-table-striped uk-table-hover uk-table-small">
                <thead>
                    <tr>
                        <!-- <th class="uk-table-shrink">Status</th> -->
                        <th class="uk-table-shrink">Name</th>
                        <th>Description</th>
                        <th class="uk-table-shrink">Fee</th>
                        <th class="uk-table-shrink">Created</th>
                        <th class="uk-table-shrink">Updated</th>
                        <th class="uk-table-shrink uk-text-right">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($jbas_services as $service) : ?>
                        <tr>
                            <td class="uk-text-nowrap"><?= $service->name ?></td>
                            <td><?= $service->description ?></td>
                            <td class="uk-text-nowrap">&#8369;<?= $service->price ?></td>
                            <td class="uk-text-nowrap"><?= date("M d, Y", strtotime($service->date_created)) ?></td>
                            <td class="uk-text-nowrap"><?= date("M d, Y", strtotime($service->date_updated)) ?></td>
                            <td class="uk-button-group uk-flex uk-flex-end">
                                <a class="uk-button uk-button-small uk-flex uk-flex-middle" href="#modal-container-<?= $service->id ?>" uk-toggle>
                                    <span class="uk-text-small"uk-icon="file-edit"></span>
                                    <div>Edit</div>
                                </a>
                                <div id="modal-container-<?= $service->id ?>" class="uk-modal-container" uk-modal>
                                    <div class="uk-modal-dialog">
                                        <button class="uk-modal-close-default" type="button" uk-close=""></button>
                                        <div class="uk-modal-header">
                                            <h2 class="uk-modal-title">Edit Close Date</h2>
                                        </div>
                                        <div class="uk-modal-body">
                                            <?php 
                                            
                                                $action = "services_edit.php?id=$service->id";
                                            
                                            ?>
                                            <?php include "assets/components/form/services.php"; ?>
                                        </div>
                                    </div>
                                </div>
                                <a class="uk-button uk-button-danger uk-button-small uk-flex uk-flex-middle" 
                                    href="services_delete.php?id=<?= $service->id ?>">
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
        <h1>No close dates yet</h1>
    <?php endif ?>
</div>
</body>
</html>
