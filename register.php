<?php

include 'db.php';

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

        if (empty($user)) {
            // Query for logging the current date and the time the user logged in
            $sql    = "INSERT INTO users (username, password) 
                        VALUES (?, ?);";
            $values = [$username, password_hash($password, PASSWORD_DEFAULT)];
            execute($sql, $values);

            // Redirect the user to the home page
            header("location: login.php");
        } else {
            // Says the same thing regardless if the
            // user doesnt exists or the password is wrong for security reasons
            $error = "Username is already taken";
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
        <h2>Register</h2>

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

        <input class="form-button form-button-primary" type="submit" value="Register">
        <a class="form-button form-button-outline" href="login.php">Login</a>

    </form>
</body>
</html>