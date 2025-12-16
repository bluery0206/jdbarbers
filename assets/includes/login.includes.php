<?php 
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
            $sql    = "INSERT INTO log (user_id, category, action, date_created) 
                        VALUES (?, ?, ?, CURTIME());";
            $values = [$user->id, "user", "login"];
            execute($sql, $values);

            // Store user deets in current session along
            // with the seesion tokern yea
            session_start();
            $_SESSION["user"] = $user;

            // Redirect the user to the home page
            header("location: dashboard.php");
        } else {
            // Says the same thing regardless if the
            // user doesnt exists or the password is wrong for security reasons
            $error = "Wrong username and password.";
        }

    } else {
        $error = "Username and password cannot be empty.";
    }
}
