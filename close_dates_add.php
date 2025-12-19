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

$page_title = "Home";
require_once "assets/components/head.php";

?>

<body>
    <?php 
        require_once "assets/components/nav.php";

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $user_id        = $_SESSION['user']->id;
            $date_close = $_POST['date_close']; 
            $time_start = $_POST['time_start']; 
            $time_end = $_POST['time_end']; 

            $sql = "SELECT 1 FROM close_dates WHERE date_close = ? AND time_start = ? AND time_end = ?";
            $values = [$date_close, $time_start, $time_end];
            $already_exists = execute($sql, $values)->fetch();

            if (!$already_exists) {
                $sql = "INSERT INTO close_dates (user_id, date_close, time_start, time_end) VALUES (?, ?, ?, ?)";
                $values = [$user_id, $date_close, $time_start, $time_end];
                execute($sql, $values);

                header("Location: close_dates_index.php");
            } else {
                echo "<script>alert('Date already closed')</script>";
            }
        }
    ?>

    <a href="close_dates_index.php">Back to close_dates</a>
    <div class="uk-container" style="border: 1px solid red;">
        <form action="" method="POST">
            <h2>Create new Service</h2>

            <div>
                <label for="date_close">date_close</label>
                <input type="date" name="date_close" id="date_close">
                <input type="time" name="time_start" id="time_start">
                <input type="time" name="time_end" id="time_end">
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
