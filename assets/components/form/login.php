
<form method="post">
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