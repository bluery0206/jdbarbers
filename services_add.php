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

        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $name           = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description    = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $price          = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);

            $sql = "SELECT 1 FROM services WHERE name = ? AND  description = ?";
            $values = [$name, $description];
            $already_exists = execute($sql, $values)->fetch();

            if (!$already_exists) {
                $sql = "INSERT INTO services (name, description, price) VALUES (?, ?, ?)";
                $values = [$name, $description, $price];
                execute($sql, $values);

                header("Location: services_index.php");
            } else {
                echo "<script>alert('Service already exists')</script>";
            }
        }
    ?>

    <a href="services_index.php">Back to Services</a>
    <div class="uk-container" style="border: 1px solid red;">
        <form action="" method="POST">
            <h2>Create new Service</h2>

            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name">
            </div>
            <div>
                <label for="description">description</label>
                <textarea name="description" id="description"></textarea>
            </div>
            <div>
                <label for="price">Price</label>
                <input type="number" name="price" id="price" step="0.01" min="0">
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
