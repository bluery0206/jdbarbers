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

    $sql = "SELECT * FROM close_dates";
    $jbas_close_dates = execute($sql)->fetchAll();

?>

<a href="close_dates_add.php">Add New Service</a>

<?php if ($jbas_close_dates) : ?>
    <table border="1">
        <tr>
            <th>id</th>
            <th>user_id</th>
            <th>date_close</th>
            <th>time_start</th>
            <th>time_end</th>
            <th>date_created</th>
            <th>date_updated</th>
            <th>actions</th>
        </tr>
        <?php foreach ($jbas_close_dates as $service) : ?>
            <tr>
                <td><?= $service->id ?></td>
                <td><?= $service->user_id ?></td>
                <td><?= $service->date_close ?></td>
                <td><?= $service->time_start ?></td>
                <td><?= $service->time_end ?></td>
                <td><?= $service->date_created ?></td>
                <td><?= $service->date_updated ?></td>
                <td>
                    <a href="close_dates_edit.php?id=<?= $service->id ?>">Edit</a>
                    <a href="close_dates_delete.php?id=<?= $service->id ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php endif?>

<?php 

    require_once "assets/components/footer.php";

?>
</body>
</html>
