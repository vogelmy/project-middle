<?php
require 'functions/config.php';
require 'functions/blog_functions.php';

if (!isset($_GET['post_id'])) {
    header('location: blog.php');
    die();
}

$id = (int) $_GET['post_id'];
$post = get_post($id);

require 'templates/header.php';
?>

<div class="my-post">
    <h1><?= $post['title']; ?></h1>
    <?php if (validate_user() && $post['author'] == $_SESSION['user_id']): ?>
        <div class="actions">
            <a href="edit_post.php?post_id=<?= $id; ?>"><img src="css/img/pencil.png"></a>
            <a href="delete_post.php?post_id=<?= $id; ?>"><img src="css/img/rubbish.png"></a>
        </div> 
    <?php endif; ?>
    <?php if (!empty($post['image'])): ?>
        <img src="uploads/<?= $post['image']; ?>" alt="<?= $post['title']; ?>">
    <?php endif; ?>
    <div><?= $post['content']; ?></div>
</div>


<?php
require 'templates/footer.php';
