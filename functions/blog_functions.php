<?php

$posts_result = '';


global $db;
global $posts_result;

$query = "SELECT *, DATE_FORMAT(post_created, '%d.%m.%y') AS post_created "
        . "FROM posts p "
        . "JOIN users u "
        . "ON p.post_author = u.user_id "
        . "ORDER BY p.post_created ASC;";

$query = "SELECT *, DATE_FORMAT(post_created, '%d.%m.%y') AS post_created "
        . " FROM posts "
        . "JOIN users ON post_author = user_id;";

if (isset($_POST['title_order'])) {
    $query = "SELECT *, DATE_FORMAT(post_created, '%d.%m.%y') AS post_created "
            . " FROM posts "
            . "JOIN users ON post_author = user_id "
            . "ORDER BY post_title ASC;";
}

if (isset($_POST['date_order'])) {
    $query = "SELECT *, DATE_FORMAT(post_created, '%d.%m.%y') AS post_created "
            . " FROM posts "
            . "JOIN users ON post_author = user_id "
            . "ORDER BY post_id DESC;";
}

$posts_result = mysqli_query($db, $query);

if (!$posts_result) {
    //Could not run the query.
    echo 'Oppss we have a temporary error, please try again later.';
    error_log('Could not get posts ' . mysqli_error($db));
    die();
}








function get_post($id) {
    global $db;

    $query = "SELECT p.*, u.user_name "
            . "FROM posts p "
            . "JOIN users u ON p.post_author = u.user_id "
            . "WHERE p.post_id = '$id' "
            . "LIMIT 1;";

    if ($result = mysqli_query($db, $query)) {
        if (!$row = mysqli_fetch_assoc($result)) {
            echo 'The post you requested isn\'t in our system';
            die();
        }
    } else {
        echo 'Temporary error, please try again later';
        error_log('Cloud not query the DB ' . mysqli_error($db));
        die();
    }

    //Encode special characters into thier HTML entities for
    //preventing XSS attacks.
    //The forth parameter prevents duble encoding of characters.
    $post['title'] = htmlentities($row['post_title'], ENT_HTML5, "utf-8", false);
    $post['content'] = htmlentities($row['post_content'], ENT_HTML5, "utf-8", false);
    $post['image'] = $row['post_image'];
    $post['author'] = $row['post_author'];
    $post['author_name'] = htmlentities($row['user_name'], ENT_HTML5, "utf-8", false);

    return $post;
}
