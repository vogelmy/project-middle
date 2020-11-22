<?php

validate_user();

define('MAX_IMG_SIZE', 1024 * 1024 * 10);
require 'validations.php';
global $db;

$messages = [];

$post_title = trim(filter_input(INPUT_POST, 'post_title', FILTER_SANITIZE_STRING));
$post_content = trim(filter_input(INPUT_POST, 'post_content', FILTER_SANITIZE_STRING));

if (!validate_str($post_title)) {
    $messages[] = 'The title isn\'t valid.';
}

if (!validate_str($post_content)) {
    $messages[] = 'The content isn\'t valid';
}

if ($messages) {
    return;
}

if (!empty($_FILES['post_image']['name'])) {
    $saved_file = upload_image($messages, 'post_image');
}

if ($messages) {
    return;
}

$file = $saved_file ? ", post_image = '$saved_file'" : "";

$post_title = mysqli_real_escape_string($db, $post_title);
$post_content = mysqli_real_escape_string($db, $post_content);

$query = "UPDATE posts "
        . "SET post_title = '$post_title', post_content =  '$post_content' $file "
        . "WHERE post_id = $id;";

if (mysqli_query($db, $query)) {

    header("location: post.php?post_id=$id");
    die();
} else {
    $messages[] = 'Temporary error, please try again later.';
    error_log('Could not query the DB, insert post ' . mysqli_error($db));
}
