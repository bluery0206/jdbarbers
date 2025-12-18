
    <div uk-sticky="animation: uk-animation-slide-top; sel-target: .uk-navbar-container;">

        <nav class="uk-navbar-container">
            <div class="uk-container">
                <div uk-navbar>
                    <div class="uk-navbar-left">
                        <!-- Logo -->
                        <a class="uk-navbar-item uk-logo" href="index.php">
                            JDBarbers
                        </a>
                    </div>

                    <!-- Left Navigation -->
                    <div class="uk-navbar-center">

                        <!-- Navigation -->
                        <ul class="uk-navbar-nav">

                            <li><a href="#calendar" uk-scroll>Calendar</a></li>
                            <li><a href="#status" uk-scroll>Appointment Status</a></li>
                            <li><a href="#location" uk-scroll>Location</a></li>

                        </ul>
                    </div>

                    <!-- Apila if mulogin ug balik, i logout tung nakalogin na -->
                    <?php if (isAuthorized()) :?>
                        <div class="uk-navbar-right">
                            <ul class="uk-navbar-nav">
                                <li>
                                    <a href="#">Manage</a>
                                    <div class="uk-navbar-dropdown">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li <?= isViewActive("appointment_index") ? "class='uk-active'" : "" ?>><a href="appointment_index.php">Appointments</a></li>
                                            <li <?= isViewActive("close_dates") ? "class='uk-active'" : "" ?>><a href="close_dates_index.php">Close Dates</a></li>
                                            <li <?= isViewActive("services") ? "class='uk-active'" : "" ?>><a href="services_index.php">Services</a></li>
                                        </ul>
                                    </div>
                                </li>
                                <li><a href="logout.php">Logout <?= $_SESSION['user']->username ?></a></li>
                            </ul>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </nav>

    </div>