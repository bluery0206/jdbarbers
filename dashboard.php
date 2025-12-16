<?php
session_start();

require_once "db.php";
require_once 'vendor/autoload.php';
require_once 'assets/includes/login.includes.php';

?>

<!DOCTYPE html>
<html lang="en">

<?php 

$page_title = "Dashboard";
require_once "assets/components/head.php";

?>

<body>

<?php 

require_once "assets/components/nav.php";
require_once "assets/components/carousel.php";
require_once "assets/components/calendar.php";

?>

    <div class="uk-container">
        <div class="uk-divider-icon"></div>

        <div class="uk-section" id="status">
            <h2 class="uk-text-center">Already have a appointment id?</h2>
            
            <form action="">
                <label for="appointment_id">Appointment ID</label>
                <input type="text" name="appointment_id" id="appointment_id">

                <input type="submit" value="Check Status">
            </form>
        </div>

        <div class="uk-divider-icon"></div>
        <div class="uk-section ">
            <div>
                <h2 class="uk-text-center">Service Offered</h2>
                <hr class="uk-divider-small">
                <div class="uk-child-width-1-3@m" uk-grid>
                    <div>
                        <div class="uk-card uk-card-default">
                            <div class="uk-card-media-top">
                                <img src="assets/images/services/haircut.png" width="1800" height="1200" alt="">
                            </div>
                            <div class="uk-card-body">
                                <h3 class="uk-card-title">Haircut</h3>
                                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p> -->
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default">
                            <div class="uk-card-body">
                                <h3 class="uk-card-title">Shave</h3>
                                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p> -->
                            </div>
                            <div class="uk-card-media-bottom">
                                <img src="assets/images/services/shaving.png" width="1800" height="1200" alt="">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default">
                            <div class="uk-card-media-top">
                                <img src="assets/images/services/trim.png" width="1800" height="1200" alt="">
                            </div>
                            <div class="uk-card-body">
                                <h3 class="uk-card-title">Trim</h3>
                                <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt.</p> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="uk-divider-icon"></div>

        <div class="uk-section uk-text-center" id="location">
            <div>
                <h2>Location</h2>
                <div>
                    <iframe src="http://maps.google.com/maps?q=9.957839432490614,124.02508566200866&z=17&output=embed"
                        height="300" style="width: 100%;" allowfullscreen="true" 
                        loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>  
                </div>
            </div>
        </div>
        <div class="uk-divider-icon"></div>
    </div>
    <div class="uk-section">
        <?php 
        
        require_once "assets/components/form/login.php";
        
        ?>
        footer links and etc
    </div>
</body>
</html>