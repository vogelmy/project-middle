<?php
require 'functions/config.php';
require 'functions/blog_functions.php';

validate_user();

if (!isset($_GET['post_id'])) {
    header('location: blog.php');
    die();
}

$id = (int) $_GET['post_id'];

if (isset($_POST['delete_post'])) {
    check_token();
    require 'functions/process_delete_post.php';
}

$post = get_post($id);

$title = 'Delete post';
require 'templates/header.php';
?>

<h1>Delete Post</h1>
<h2>Click the delete button if you would like to delete the post.</h2>

<div class="my-post">
    <h1><?= $post['title']; ?></h1>
    <?php if (!empty($post['image'])): ?>
        <img src="uploads/<?= $post['image']; ?>" alt="<?= $post['title']; ?>">
    <?php endif; ?>
    <div><?= $post['content']; ?></div>
</div>
<div>
    <form method="post">
        <input type="hidden" name="token" value="<?= get_token(); ?>"> 
        <input type="submit" value="Delete Post" name="delete_post">
    </form>
</div>
<?php
require 'templates/footer.php';

