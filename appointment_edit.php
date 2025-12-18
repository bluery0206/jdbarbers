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

        if ($_SESSION['REQUEST_METHOD'] == "POST") {
            $name           = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $description    = filter_input(INPUT_POST, 'description', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $price          = filter_input(INPUT_POST, 'price', FILTER_SANITIZE_NUMBER_FLOAT);

            $sql = "INSERT INTO services (name, description, price) VALUES (?, ?, ?)";
            $values = [$name, $description, $price];
            execute($sql, $values);
        }
    ?>

    <div class="uk-container" style="border: 1px solid red;">
        <form action="">
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
    <div class="uk-section">
        footer links and etc

        <form action="" method="POST">
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" id="username">
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <input type="submit" value="Login" name="login">
            </div>
        </form>
    </div>
    <?php 
    
        require_once "assets/components/footer.php";

    ?>
</body>
</html>
