<?php

require_once "db.php";
require 'vendor/autoload.php';


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

<?php 

    $page_title = "Home";
    include "assets/components/head.php";

?>

<body>
    <!-- 
        nav
            uk-navbar => 
            .uk-navbar-container => Adds the navbar background style.

            .uk-navbar-transparent => Transparent BG
        div
            .uk-navbar-[left, center, right] =>Aligns the navigation.
        ul
            .uk-navbar-nav => to create the navigation. Use <a> elements as menu items within the list.
        li
            .uk-parent	Add this class to indicate a parent menu item
            .uk-active	Add this class to indicate an active menu item.
    -->
    <nav class="uk-navbar-container">
        <div class="uk-container">
            <div uk-navbar>
                <div class="uk-navbar-left">
                    <ul class="uk-navbar-nav">
                        <li class="uk-logo">JDBarbers</li>
                        <li class="uk-active"><a href="">dsad</a></li>
                        <li class="uk-parent">
                            <a href="#">Parent</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li class="uk-active"><a href="#">Active</a></li>
                                    <li><a href="#">Item</a></li>
                                    <li><a href="#">Item</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <a href="">
                                <div>
                                    dasds
                                    <div class="uk-navbar-subtitle">Subtitle</div>
                                </div>        
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="uk-navbar-center">
                    <ul class="uk-navbar-nav">
                        <li><a href="">IIdk</a></li>
                    </ul>
                </div>
                <div class="uk-navbar-right">
                    <ul class="uk-navbar-nav">
                        <li><a href="">IIdk</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>


    <div class="uk-container uk-overflow-auto">
        <table class="calendar-table">
            <tr>
                <th>Sunday</th>
                <th>Monday</th>
                <th>Tuesday</th>
                <th>Wednesday</th>
                <th>Thursday</th>
                <th>Friday</th>
                <th>Saturday</th>
            </tr>

            <?php
                $days_in_month = date("t");
                $year  = date('Y');
                $month = date('m');
                $day_count = 1;
            ?>
            <?php while ($day_count <= $days_in_month) : ?>
                <tr>
                    <?php foreach (range(0, 6) as $week_day) : ?>
                        <td>
                            <?php if ($week_day == date("w", strtotime($year."-".$month."-".$day_count))) : ?>
                                <?= $day_count ?>
                                <?php $day_count++; ?>
                            <?php endif ?>
                        </td>
                    <?php endforeach ?>
                </tr>
            <?php endwhile ?>
        </table>
    </div>

    <form method="post">
        <h2>JDBarbers</h2>

        <?php if ($error): ?>
            <div>
                <?= $error ?>
            </div>
        <?php endif ?>

        <div>
            <div>
                <label for="username">Username</label>
                <input type="text" name="username" placeholder="jdelacruz" id="username" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Jd4laCrUz123" id="password" required>
            </div>
        </div>

        <input type="submit" value="Login">
    </form>

    <div class="uk-container" style="border: 1px solid red;">
        <div class="uk-section">
            <div>img carousel of barbers</div>
            <div>Sharp Looks, Like an Eagle</div>
            <button>Book Now</button>
        </div>
        <div class="uk-section">
            <div>
                services offered
                <ul>
                    <li>haircut</li>
                    <li>shave</li>
                    <li>trim</li>
                </ul>
            </div>
        </div>
        <div class="uk-section">
            <div>
                ratings & testomonies
                <ul>
                    <li>haircut</li>
                    <li>shave</li>
                    <li>trim</li>
                </ul>
            </div>
        </div>
        <div class="uk-section">
            <div>
                hours and location
                <div>
                    <ul>
                        <li>haircut</li>
                        <li>shave</li>
                        <li>trim</li>
                    </ul>
                </div>
                <div>
                    <iframe src="http://maps.google.com/maps?q=9.957839432490614,124.02508566200866&z=17&output=embed"
                        height="300" style="width: 100%;" allowfullscreen="true" 
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  
                </div>
            </div>
        </div>
    </div>
    <!-- 
    will log the changes of the price

    services
        name
        description
        price

    log
        id
        userId
        action
        datetime

    calendar
        id
        is_available

    appointment
        id
        userId

    -->
    <div class="uk-section">
        footer links and etc
    </div>
</body>
</html>