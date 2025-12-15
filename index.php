<?php

require_once "db.php";
require_once 'vendor/autoload.php';
require_once 'assets/includes/login.includes.php';

?>

<!DOCTYPE html>
<html lang="en">

<?php 

$page_title = "Home";
include "assets/components/head.php";

?>

<body>
    <div uk-sticky="sel-target: .uk-navbar-container; cls-active: uk-navbar-sticky;">
        <nav class="uk-navbar-container">
            <div class="uk-container">
                <div uk-navbar>
                    <!-- Left Navigation -->
                    <div class="uk-navbar-left">
                        <!-- Logo -->
                        <a class="uk-navbar-item uk-logo" href="">
                            JDBarbers
                        </a>

                        <!-- Navigation -->
                        <ul class="uk-navbar-nav">

                            <!-- Active Button -->
                            <li class="uk-active">
                                <a href="">Home</a>
                            </li>

                            <!-- Dropdown -->
                            <li class="uk-parent">
                                <a href="#">
                                    <div>
                                        Parent 
                                        <div class="uk-navbar-subtitle">1 Column</div>
                                    </div>
                                    <span uk-navbar-parent-icon></span>
                                </a>
                                <div class="uk-navbar-dropdown">
                                    <ul class="uk-nav uk-navbar-dropdown-nav">

                                        <!-- Header -->
                                        <li class="uk-nav-header">Header</li>
                                        <li><a href="#">Item</a></li>
                                        <li><a href="#">Item</a></li>

                                        <!-- Divider -->
                                        <li class="uk-nav-divider"></li>
                                        <li><a href="#">Item</a></li>
                                    </ul>
                                </div>
                            </li>

                            <!-- Dropdown -->
                            <!-- Two Column -->
                            <li>
                                <a href="#">
                                    <div>
                                        Parent
                                        <div class="uk-navbar-subtitle">2 Columns</div>
                                    </div>
                                    <span uk-navbar-parent-icon></span>
                                </a>
                                <div class="uk-navbar-dropdown uk-navbar-dropdown-width-2">
                                    <div class="uk-drop-grid uk-child-width-1-2" uk-grid>
                                        <div>
                                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                                <li class="uk-nav-header">Header</li>
                                                <li><a href="#">Item</a></li>
                                                <li class="uk-nav-divider"></li>
                                                <li><a href="#">Item</a></li>
                                            </ul>
                                        </div>
                                        <div>
                                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                                <li class="uk-nav-header">Header</li>
                                                <li><a href="#">Item</a></li>
                                                <li class="uk-nav-divider"></li>
                                                <li><a href="#">Item</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>

                    <!-- Center Navigation -->
                    <div class="uk-navbar-center">
                        <div class="uk-navbar-item">
                            <form action="javascript:void(0)">
                                <input class="uk-input uk-form-width-small" type="text" placeholder="Input" aria-label="Input">
                                <button class="uk-button uk-button-default">Button</button>
                            </form>
                        </div>
                    </div>

                    <!-- Right Navigation -->
                    <div class="uk-navbar-right">
                        <ul class="uk-navbar-nav">
                            <li>
                                <a href="">
                                    Profile
                                </a>
                            </li>
                        </ul>
                        
                        <!-- Toggle -->
                        <a class="uk-navbar-toggle" href="#">
                            <span uk-navbar-toggle-icon></span> 
                            <span class="uk-margin-xsmall-left">Menu</span>
                        </a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><a href="#">Active</a></li>
                                <li><a href="#">Item</a></li>
                                <li><a href="#">Item</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
    </div>


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