<?php
require 'functions/config.php';
require 'functions/blog_functions.php';

validate_user();

if ( ! isset($_GET['post_id'])) {
    header('location: blog.php');
    die();
}

$id = (int) $_GET['post_id'];

if (isset($_POST['edit_post'])) {
    check_token();   
    require 'functions/process_edit_post.php';
}

$title = 'Edit post';
require 'templates/header.php';
$post = get_post($id);
?>

<h1>Edit Post</h1>
<?php if (!empty($messages)): ?>
    <?php foreach ($messages as $message): ?>
        <p><?= $message; ?></p>
    <?php endforeach; ?>
<?php endif; ?>

<form method="post" enctype="multipart/form-data"> 
    <p><label for="post-title">Heading</label>
        <input id="post-title" type="text" name="post_title" value="<?=  $post['title']; ?>" >
    </p>
    <p><label for="post-content">Body</label>
        <textarea id="post-content" name="post_content"><?= $post['content']; ?></textarea>
    </p>
    <?php if (!empty($post['image'])): ?>
        <p><img src="uploads/<?= $post['image']; ?>" alt="<?= $ $post['title']; ?>"></p>
    <?php endif; ?>
    <p><label for="post-image">Upload a new photo if you would like to change the current one</label>
        <input id="post-image" name="post_image" type="file" name="post_image" accept="image/*">
    </p>
    <input type="hidden" name="token" value="<?= get_token(); ?>"> 
    <p><input type="submit" value="Save Post" name="edit_post">
    </p>
</form>
<?php
require 'templates/footer.php';

