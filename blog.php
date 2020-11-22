<?php
require 'functions/config.php';
require 'functions/blog_functions.php';
$title = 'Coolest blog ever!';
$menu_item = 'blog';
require 'templates/header.php';

//get_posts();
$posts = $posts_result;
?>

<link rel="stylesheet" href="css/style_blog.css">

<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<h1><?= $title . '<br>' . '<br>' ?></h1>

<form method="post">
    <label> Sort posts by:</label>
    <div id="post_order">
        <input type="submit" name="date_order" value="post date">
        <input type="submit" name="title_order" value="post title">
    </div>
</form>

<?php if (validate_user()): ?>
    <a href="add_post.php">Add a new post</a>
<?php endif; ?>

<?php if ($posts): ?>
    <div class="posts-container">
        <?php if (!mysqli_num_rows($posts)): ?>
            <h2>No posts to show right now :(</h2>       
        <?php else: ?>
            <?php
            while ($row = mysqli_fetch_assoc($posts)):

                $title = htmlentities($row['post_title'], ENT_HTML5, "utf-8", false);
                $content = htmlentities($row['post_content'], ENT_HTML5, "utf-8", false);
                $user_name = htmlentities($row['user_name'], ENT_HTML5, "utf-8", false);
                $excerpt = mb_strlen($content) < 400 ? $content : mb_substr($content, 0, 400) . "...";
                ?>
                <div class="single-post border border-info rounded">  
                    <h2><?= $title; ?><span> 

                            <h6> Written on: <?= $row['post_created']; ?></h6>

                            <h6> By: <?= $row['user_name']; ?></h6>

                            <?php if (!empty($row['post_image'])): ?>
                                <img src="uploads/<?= $row['post_image']; ?>" alt="<?= $title; ?>">
                            <?php endif; ?> 



                            <div><?= $excerpt; ?></div>
                            <a href="post.php?post_id=<?= $row['post_id']; ?>">Read more..</a>
                            <?php if (isset($_SESSION['user_id']) && $row['post_author'] == $_SESSION['user_id']): ?>
                                <div class="actions">
                                    <a href="edit_post.php?post_id=<?= $row['post_id']; ?>"><img src="css/img/pencil.png"></a>
                                    <a href="delete_post.php?post_id=<?= $row['post_id']; ?>"><img src="css/img/rubbish.png"></a>
                                </div> 

                            <?php endif; ?>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php
                require 'templates/footer.php';
                