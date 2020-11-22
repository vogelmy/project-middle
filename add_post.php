<?php

require 'functions/config.php';
if (isset($_POST['add_new_post'])) {
    require 'functions/process_add_post.php';
}

$title = 'Add new post';
require 'templates/header.php';
?>

<h1>Write a new post</h1><br>

<?php if (!empty($messages)): ?>
    <?php foreach ($messages as $message): ?>
        <p><?= $message; ?></p>
    <?php endforeach; ?>
<?php endif; ?>
        
<form method="post" enctype="multipart/form-data"> 
    <p><label for="post-title">Heading</label><br>
        <input id="post-title" type="text" name="post_title" >
    </p>
    <p><label for="post-content">Body</label><br>
        <textarea id="post-content" name="post_content"></textarea>
    </p>
    <p><label for="post-image">Photo</label><br>
        <input id="post-image" type="file" name="post_image" accept="image/*">
    </p>
       <input type="hidden" name="token" value="<?= get_token(); ?>"> 
    <p><input type="submit" value="send post" name="add_new_post">
    </p>
</form>
<?php
require 'templates/footer.php';

