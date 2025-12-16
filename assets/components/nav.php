
    <div uk-sticky="show-on-up: true; animation: uk-animation-slide-top; sel-target: .uk-navbar-container;">

        <nav class="uk-navbar-container">
            <div class="uk-container">
                <div uk-navbar>
                    <!-- Left Navigation -->
                    <div class="uk-navbar-left">
                        <!-- Logo -->
                        <a class="uk-navbar-item uk-logo" href="index.php">
                            JDBarbers
                        </a>

                        <!-- Navigation -->
                        <ul class="uk-navbar-nav">

                            <li><a href="#status" uk-scroll>Status</a></li>
                            <li><a href="#calendar" uk-scroll>Calendar</a></li>
                            <li><a href="#location" uk-scroll>Location</a></li>

                            <!-- Dropdown -->
                            <li class="uk-parent">
                                <a href="#">
                                    <div>
                                        Right Hand 
                                        <!-- <div class="uk-navbar-subtitle">1 Column</div> -->
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
                                    <span uk-navbar-parent-icon></span>
                                    <div>
                                        Left Hand 
                                        <!-- Parent
                                        <div class="uk-navbar-subtitle">2 Columns</div> -->
                                    </div>
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
                        <div class="uk-navbar-item">
                            User: <?= $_SESSION['user']->username ?>
                        </div>
                        
                        <!-- Toggle -->
                        <a class="uk-navbar-toggle" href="#">
                            <span uk-navbar-toggle-icon></span> 
                            <span class="uk-margin-xsmall-left">Menu</span>
                        </a>
                        <div class="uk-navbar-dropdown">
                            <ul class="uk-nav uk-navbar-dropdown-nav">
                                <li><a href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </nav>

    </div>