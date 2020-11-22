<?php

validate_user();

define('MAX_IMG_SIZE', 1024 * 1024 * 10);
require 'validations.php';
global $db;

$post_title = trim(filter_input(INPUT_POST, 'post_title', FILTER_SANITIZE_STRING));
$post_content = trim(filter_input(INPUT_POST, 'post_content', FILTER_SANITIZE_STRING));
$post_image = $_FILES['post_image']['name'];


//This 'IF' and query2 is for unlinking the old image file
$query2 = "SELECT post_image FROM `posts` WHERE post_id = $id";

if ($result = mysqli_query($db, $query2)) {
    $row = mysqli_fetch_assoc($result);
    $old_image = $row['post_image'];
} else {
    $messages[] = 'Temporary error, please try again later.';
    error_log('Could not query the DB, insert post ' . mysqli_error($db));
}

$query = "UPDATE posts "
        . "SET post_image = '$post_image', post_title = '$post_title', post_content =  '$post_content' "
        . "WHERE post_id = $id;";



if (mysqli_query($db, $query)) {
    move_uploaded_file($_FILES['post_image']['tmp_name'], 'uploads/' . $post_image);
//Remove old image file
    unlink('uploads/' . $old_image);
    echo $old_image;
    header("location: post.php?post_id=$id");
    die();
} else {
    $messages[] = 'Temporary error, please try again later.';
    error_log('Could not query the DB, insert post ' . mysqli_error($db));
}

