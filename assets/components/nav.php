
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
                                <li><a href="logout.php">Logout <?= $_SESSION['user']->username ?></a></li>
                            </ul>
                        </div>
                    <?php endif ?>
                </div>
            </div>
        </nav>

    </div>