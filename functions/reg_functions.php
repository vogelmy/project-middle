<?php

define('MAX_IMAGE_SIZE', 1024 * 1024 * 5);
require 'functions/validations.php';

function register_user() {
    global $db;
    $messages = [];

    $fname = trim(filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING));
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL));
    
    if (!validate_str($fname)) {
        $messages[] = "That name isn't good";
    }
    
    $pw = trim($_POST['pw']);
    if (!validate_pw($pw)) {
        $messages[] = "That password isn't good.";
    }

    if (!$email) {
        $messages[] = "That email isn't good.";
    } else {

        check_email_exists($email, $messages);
    }

    if ($messages) {
        return $messages;
    }

    if (!empty($_FILES['profile_image']['name'])) {

        $saved_file = upload_image($messages, 'profile_image');
    }

    if ($messages) {
        return $messages;
    }

    $fname = mysqli_real_escape_string($db, $fname);
    $email = mysqli_real_escape_string($db, $email);
  
    $saved_file = $saved_file ?? "";
    $pw = password_hash($pw, PASSWORD_DEFAULT);
    $query = "INSERT INTO users (user_name, user_pw, user_email, user_image) "
            . "VALUES ('$fname', '$pw', '$email', '$saved_file')";

    if (mysqli_query($db, $query)) {

        $messages[] = 'Welcome to the Blog! Please login to write your first post.';
        echo '<a href="login.php">Login Here</a>';
    } else {

        $messages[] = 'Temporary error, please try again later.';
        error_log('Could not query the DB, insert user ' . mysqli_error($db));
    }

    return $messages;
}

function check_email_exists($email, &$messages) {
    global $db;

    $email = mysqli_real_escape_string($db, $email);
    $query = "SELECT user_email "
            . "FROM users "
            . "WHERE user_email = '$email'";

    $result = mysqli_query($db, $query);

    if ($result) {


        $row = mysqli_num_rows($result);

        if ($row) {

            $messages['email_exists'] = 'We already have a user with this email.';
        }
    } else {

        error_log('Could not query the DB, select email ' . mysqli_error($db));
    }
}
