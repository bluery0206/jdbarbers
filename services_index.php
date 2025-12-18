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

    $sql = "SELECT * FROM services";
    $jbas_services = execute($sql)->fetchAll();

?>

<a href="services_add.php">Add New Service</a>

<?php if ($jbas_services) : ?>
    <table border="1">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>description</th>
            <th>price</th>
            <th>date_created</th>
            <th>date_updated</th>
            <th>actions</th>
        </tr>
        <?php foreach ($jbas_services as $service) : ?>
            <tr>
                <td><?= $service->id ?></td>
                <td><?= $service->name ?></td>
                <td><?= $service->description ?></td>
                <td><?= $service->price ?></td>
                <td><?= $service->date_created ?></td>
                <td><?= $service->date_updated ?></td>
                <td>
                    <a href="services_edit.php?id=<?= $service->id ?>">Edit</a>
                    <a href="services_delete.php?id=<?= $service->id ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php endif?>

    
</body>
</html>
