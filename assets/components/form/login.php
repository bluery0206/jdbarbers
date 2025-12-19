<form method="POST" class="uk-form-horizontal" action="login.php">
    <legend class="uk-legend">Login</legend>

    <?php if (isset($error)): ?>
        <div class="uk-alert-danger" uk-alert>
            <a href class="uk-alert-close" uk-close></a>
            <?= $error ?>
        </div>
    <?php endif ?>

    <div class="uk-margin">
        <label class="uk-form-label" for="username">Username</label>
        <div class="uk-form-controls">
            <input class="uk-input k-form-controls-text" type="text" name="username" placeholder="jdelacruz" id="username" required>
        </div>
    </div>
    <div class="uk-margin">
        <label class="uk-form-label" for="password">Password</label>
        <div class="uk-form-controls">
            <input class="uk-input uk-form-controls-text" type="password" name="password" placeholder="Jd4laCrUz123" id="password" required>
        </div>
    </div>

    <input class="uk-button uk-button-secondary uk-width-1" type="submit" name="login" value="Login">
</form>