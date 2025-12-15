<?php
/**
 * The function that connects us to the MySQL Database
 * This uses prepared statements and other layers
 * of security so this is a much better way.
 * Also, this uses OOP so the methods to get
 * the data is SO MUCHH easier than memorizing kadtung
 * mysqli_fetch_assoc or unsa tong mga amawa to
 */
function connect(): PDO {
    // set as static, meaning ma-save sa cache
    // para dile magsige ug gama ug bag-ong connection
    // sa database, kani nalang ang kuhaon if ever makaset
    // na ug connection
    static $pdo = null;

    if ($pdo == null) {
        // User Credentials
        $hostname = "localhost";
        $username = "jdegamo_admin";
        $password = "jdegamo_admin";
        $database = "jdegamo";

        $dsn = "mysql:host=$hostname;dbname=$database";
       
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // A config to make the fetching of the data in OOP way instead
        // of array like $row['colName'] becomes $row->colName which
        // is something I find more readable and tbh, contrasty
        $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    }

    return $pdo;
}

/**
 * Just a lil function wrapper for the connection
 * to lessen the code
 * 
 * @var string $statement - The prepared statement or query
 *      Example: SELECT * FROM users WHERE id = ?
 * @var list $values - The values to supply the placeholders
 *      Example: 1 // So kuhaon ang user nga naay id nga 1
 */
function execute($statement, $values=[]) {
    $pdo = connect();
    $stmt = $pdo->prepare($statement);
    $stmt->execute($values);
    return $stmt;
}

$error = NULL;

if($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve username and password from form
    $username = filter_input(INPUT_POST,"username", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $password = filter_input(INPUT_POST,"password", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    // Proceed to the validation if the user has entered
    // both the username and password
    if ($username && $password) {
        // Query to get the user
        $sql    = "SELECT * FROM users WHERE username = ?";
        $values = [$username];
        $user   = execute($sql, $values)->fetch();

        // Proceed to the validation if the user with the username exists and
        // if the password if correct
        if (isset($user->password) && password_verify($password, $user->password)) {
            // Query for logging the current date and the time the user logged in
            // with the session_token
            $session_token = uniqid("user_log_");
            $sql    = "INSERT INTO user_log (username, session_token, date, time_in) 
                        VALUES (?, ?, CURDATE(), CURTIME());";
            $values = [$username, $session_token];
            execute($sql, $values);

            // Store user deets in current session along
            // with the seesion tokern yea
            session_start();
            $_SESSION["user"] = $user;
            $_SESSION["session_token"] = $session_token;

            // Redirect the user to the home page
            header("location: home.php");
        } else {
            // Says the same thing regardless if the
            // user doesnt exists or the password is wrong for security reasons
            $error = "Wrong username and password.";
        }

    } else {
        $error = "Username and password cannot be empty.";
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JDegamo - Login</title>
    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Trebuchet MS';
        }

        body {
            min-height: 100dvh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .form-login {
            /* border: 1px solid blue; */
            padding: 50px 25px;
            display: grid;
            row-gap: 1em;
            width: 300px;
            box-shadow: 2px 2px 5px 2px rgba(0, 0, 0, 0.25)
        }

        .form-fieldset {
            /* border: 1px solid green; */

            display: grid;
            row-gap: 15px;
        }

        .form-field {
            /* border: 1px solid red; */
            margin: 0.125em 0;

            display: grid;
            row-gap: 0;
        }

        .form-error {
            padding: 0.25em 0.5em;
            border-radius: 6px;
            background: rgb(218, 15, 15);
            color: white;
        }

        .form-button {
            padding: 0.5em 0;
            border: none;
            border-radius: 6px;
            text-align: center;
            text-decoration: none;
            color: black;
            font-size: 0.8em;
        }

        .form-button.form-button-primary {
            background: rgba(96, 88, 212, 1);
            color: white;
        }

        .form-button.form-button-outline {
            border: 1px solid rgb(80, 80, 80);
        }

        .form-label {
        }

        .form-input {
            padding: 0.5em 0.25em;
            border: none;
            border-bottom: 1px solid rgb(80, 80, 80);
        }

        .form-button:hover {
            outline: 1px solid rgb(80, 80, 80);
        }
    </style>
</head>
<body>
    <form class="form-login" method="post">
        <h2>Login</h2>

        <!-- Only shows if there are errors -->
        <?php if ($error): ?>
            <div class="form-error">
                <?= $error ?>
            </div>
        <?php endif ?>

        <div class="form-fieldset">
            <div class="form-field">
                <label for="username" class="form-label">Username</label>
                <input type="text" name="username" placeholder="jdelacruz" id="username" class="form-input" required>
            </div>
            <div class="form-field">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" placeholder="Jd4laCrUz123" id="password" class="form-input" required>
            </div>
        </div>

        <input class="form-button form-button-primary" type="submit" value="Login">
        <a class="form-button form-button-outline" href="register.php">Register</a>
    </form>
</body>     
</html>