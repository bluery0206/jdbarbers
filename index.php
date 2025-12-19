<?php
session_start();

require_once "db.php";
require_once "config.php";
require_once "helpers.php";

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
require_once "assets/components/carousel.php";
require_once "assets/components/calendar.php";

?>

    <div class="uk-container">
        <div class="uk-divider-icon"></div>

        <div class="uk-section" id="status">
            <h2 class="uk-text-center">Already Have An Appointment Token?</h2>
            <hr class="uk-divider-small">
            <form method="GET" action="appointment_check.php" class="uk-form-horizontal">

                <?php if (isset($error)): ?>
                    <div>
                        <?= $error ?>
                    </div>
                <?php endif ?>

                <div class="uk-margin">
                    <label class="uk-form-label" for="token">Appointment Token</label>
                    <div class="uk-form-controls">
                        <input class="uk-input k-form-controls-text" type="text" name="token" placeholder="d1Q4B3" 
                            id="token" required>
                    </div>
                </div>

                <input class="uk-button uk-button-secondary uk-width-1" type="submit" value="Check Status">
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
                                <img src="assets/images/services/haircut.png" width="1800" height="1200" alt="" loading="lazy">
                            </div>
                            <div class="uk-card-body">
                                <h3 class="uk-card-title">Haircut</h3>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default">
                            <div class="uk-card-body">
                                <h3 class="uk-card-title">Shave</h3>
                            </div>
                            <div class="uk-card-media-bottom">
                                <img src="assets/images/services/shaving.png" width="1800" height="1200" alt="" loading="lazy">
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="uk-card uk-card-default">
                            <div class="uk-card-media-top">
                                <img src="assets/images/services/trim.png" width="1800" height="1200" alt="" loading="lazy">
                            </div>
                            <div class="uk-card-body">
                                <h3 class="uk-card-title">Trim</h3>
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
    </div>
    <?php 
    
        require_once "assets/components/footer.php";

    ?>
</body>
</html>