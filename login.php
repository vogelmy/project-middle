<?php

require 'functions/config.php';
require 'functions/login_functions.php';

$title = 'Login';
require 'templates/header.php';


$h1_title = isset($_SESSION['user_id']) ? "Logout" : "Login";
?>

<h1><?= $h1_title; ?></h1><br>

<?php if (!empty($login_err)): ?>
    <?php foreach ($login_err as $error): ?>
        <p><?= $error; ?></p>
    <?php endforeach; ?>
<?php endif; ?>

<?php if (validate_user()): ?>
    <form method="post">  
        <h3>Are you sure you want to log out?</h3><br>
        <p><input type="submit" name="logout" value="Logout"></p>
    </form>      
<?php else: ?>
    <form method="post">
        <p><label for="email">Email</label><br>
            <input id="email" type="email" name="email"></p> 
        <p><label for="pw">Password</label><br>
            <input  id="pw" type="password" name="pw"></p>    
        <input type="hidden" name="token" value="<?= get_token(); ?>"> 
        <p><input type="submit" name="login" value="Login"></p>
    </form>
<?php endif; ?>
<?php
require 'templates/footer.php';

