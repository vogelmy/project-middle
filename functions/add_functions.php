<?php

define('MAX_IMAGE_SIZE', 1024 * 1024 * 5);
require 'functions/validations.php';

function add_post() {
    global $db;

    $messages = [];

    if (!validate_str($_POST['hding'])) {
        $messages[] = 'Your heading is invalid.';
    }
    if (!validate_str($_POST['tarea'])) {
        $messages[] = 'Your textarea is invalid.';
    }
    if ($messages) {
        return $messages;
    }

    if (isset($_FILES['post_image'])) {
        
        $saved_file = upload_image($messages, 'post_image');
        
        if($saved_file){
            echo 'saved file worked!';
        }else{
            echo 'didn\'t work!';
        } 
    }
    
    if ($messages) {
        return $messages;
    }

    $_POST = array_map('trim', $_POST);
    $saved_file = $saved_file ?? "";
    $query = "INSERT INTO posts (post_author, post_title, post_content, post_image) "
            . "VALUES ('$_SESSION[user_name]', '$_POST[hding]', '$_POST[tarea]', '$saved_file')";

    if (mysqli_query($db, $query)) {
        $messages[] = 'Your post has been uploaded succesfuly.';
    } else {
        $messages[] = 'Temporary error, please try agin later';
        error_log('Could not query the DB, insert user ' . mysqli_error($db));
        echo mysqli_error($db);
    }
    return $messages;
}

