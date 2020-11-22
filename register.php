<?php
$title = 'Register';
require 'functions/config.php';
require 'templates/header.php';

if (isset($_POST['submit'])) {

    check_token();

    require 'functions/reg_functions.php';
    $msg = register_user();
}
?>

<h1>Registration</h1><br>
<?php if (isset($msg)): ?>
    <?php foreach ($msg as $error): ?>
        <p><?= $error; ?></p>
    <?php endforeach; ?>
<?php endif; ?>

<form id="register" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <p><label for="fname">Name</label><br>
            <input id="fname" type="text" name="fname"><br></p>
        <div id="fname-error" class="error-msg"></div>
    </div>
    <p> <label for="email">Email</label><br>
        <input id="email" type="email" name="email"></p>
    <div id="email-error" class="error-msg"></div>
    <p><label for="pw">Password</label><br>
        <input  id="pw" type="password" name="pw"></p>
    <div id="pass-error" class="error-msg"></div>
    <p><label for="image">image</label><br>
        <input id="image" type="file" name="profile_image" accept="image/*"></p>
    <p><input type="submit" name="submit" value="register"></p>
    <input type="hidden" name="token" value="<?= get_token(); ?>"> 
</form>





<script src="js/jquery-3.4.1.min.js"></script>
<script src="js/script.js"></script>

<?php
require 'templates/footer.php';
