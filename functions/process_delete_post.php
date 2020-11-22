<?php

validate_user();

if (!isset($_POST['delete_post'])) {
    header('Location: index.php');
    die();
}

$query = "DELETE FROM posts "
        . "WHERE post_id = $id "
        . "LIMIT 1;";


if (mysqli_query($db, $query)) {
    header("location: blog.php");
    die();
} else {
    echo 'נתקלנו בבעיה זמנית, נסו שוב מאוחר יותר.';
    error_log('Could not query the DB, insert post ' . mysqli_error($db));
    die();
}

