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

        // Get service ID from query parameter
        $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

        if (!$id) {
            header("Location: close_dates_index.php");
            exit;
        }

        // Get the service details
        $sql = "SELECT * FROM close_dates WHERE id = ?";
        $values = [$id];
        $close_date = execute($sql, $values)->fetch();

        if (!$close_date) {
            header("Location: close_dates_index.php");
            exit;
        }
                if ($_SERVER['REQUEST_METHOD'] == "POST") {
                    $user_id    = $_SESSION['user']->id;
                    $date_close = $_POST['date_close']; 
                    $time_start = $_POST['time_start']; 
                    $time_end   = $_POST['time_end']; 

                    $sql = "UPDATE close_dates SET date_close = ?, time_start = ?, time_end = ? WHERE id = ?";
                    $values = [$date_close, $time_start, $time_end, $id];
                    execute($sql, $values);

                    header("Location: close_dates_index.php");
                }
    ?>

    <a href="close_dates_index.php">Back to close_dates</a>
    <div class="uk-container" style="border: 1px solid red;">
        <form action="" method="POST">
            <h2>Create new Service</h2>

            <div>
                <label for="date_close">date_close</label>
                <input type="date" name="date_close" id="date_close" value="<?= $close_date->date_close ?>">
                <input type="time" name="time_start" id="time_start" value="<?= $close_date->time_start ?>">
                <input type="time" name="time_end" id="time_end" value="<?= $close_date->time_end ?>">
            </div>
            <div>
                <input type="submit" value="Appoint of date_appointment">
            </div>
        </form>
    </div>
    <?php 
    
        require_once "assets/components/footer.php";

    ?>
</body>
</html>
