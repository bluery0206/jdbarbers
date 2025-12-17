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
                <td><?= $close_date->date_appointmtent ?></td>
                <td><?= $close_date->date_created ?></td>
                <td><?= $close_date->date_updated ?></td>
                <td>
                    <a href="appointment_edit.php?id=<?= $close_date->id ?>">Edit</a>
                    <a href="appointment_delete.php?id=<?= $close_date->id ?>">Delete</a>
                </td>
            </tr>
        <?php endforeach ?>
    </table>
<?php endif?>

    
</body>
</html>
