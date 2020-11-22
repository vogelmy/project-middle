<?php

validate_user();
define('MAX_IMG_SIZE', 1024 * 1024 * 10);

require 'validations.php';
global $db;

$messages = [];

$post_title = trim(filter_input(INPUT_POST, 'post_title', FILTER_SANITIZE_STRING));
$post_content = trim(filter_input(INPUT_POST, 'post_content', FILTER_SANITIZE_STRING));

if (!validate_str($post_title)) {
    $messages[] = "Your title is incorrect.";
}
if (!validate_str($post_content)) {
    $messages[] = "Your input is incorrect.";
}

if ($messages) {
    return;
}

if ((!empty($_FILES['post_image']['name']))) {

    $saved_file = upload_image($messages, 'post_image');
}

if ($messages) {
    return;
}

$saved_file = $saved_file ?? "";

$post_title = mysqli_real_escape_string($db, $post_title);
$post_content = mysqli_real_escape_string($db, $post_content);
$query = "INSERT INTO posts (post_author, post_title, post_content, post_image) "
        . "VALUES ('$_SESSION[user_id]', '$post_title', '$post_content', '$saved_file')";

if (mysqli_query($db, $query)) {
    $id = mysqli_insert_id($db);
    $messages[] = 'Your post has been added to the blog successfuly';
    $messages[] = "<a href='post.php?post_id=$id'>Visit post</a>";
} else {
    $messages[] = 'Temporary error, please try again later.';
    error_log('Could not query the DB, insert post ' . mysqli_error($db));
}

