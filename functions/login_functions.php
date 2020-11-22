<?php

$db = mysqli_connect('127.0.0.1', 'root', '', 'my_db');

if (!$db) {
    echo 'Can not connect to server.';
    error_log('Can not connect to server.' . mysqli_connect_error());
    die();
}


if (isset($_POST['login'])) {

    global $db;

    require 'validations.php';

    $login_err = [];

    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if (!$email) {
        $login_err[] = 'כתובת המייל אינה תקנית, נסו שוב.';
    }

    $pw = trim($_POST['pw']);
    if (!validate_pw($pw)) {
        $login_err[] = 'הססמה אינה תקנית, נסו שוב.';
    }

    if ($login_err) {
        return;
    }

    $email = mysqli_real_escape_string($db, $email);
    $query = "SELECT user_id, user_name, user_pw, user_image "
            . "FROM users "
            . "WHERE user_email = '$email';";

    if ($result = mysqli_query($db, $query)) {

        if ($row = mysqli_fetch_assoc($result)) {

            $pw_match = password_verify($pw, $row['user_pw']);
            if ($pw_match) {


                $_SESSION['user_name'] = htmlentities($row['user_name'], ENT_HTML5, "utf-8", false);

                $_SESSION['user_id'] = $row['user_id'];
                $_SESSION['user_image'] = $row['user_image'];

                $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
                $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];

                header('Location: blog.php');
                die();
            } else {
                $login_err[] = 'ססמה או אימייל שגויים.';
            }
        } else {
            $login_err[] = 'ססמה או אימייל שגויים.';
        }
    } else {
        error_log('Could not query...' . mysqli_error($db));
    }
}

if (isset($_POST['logout'])) {
    $_SESSION = [];
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 60 * 60, $params['path']);
    session_destroy();
}