<?php

if (session_status() === PHP_SESSION_NONE) {
    session_name('my_blog');
    session_start();
}

// Remote database connection
$db = mysqli_connect('sql7.freemysqlhosting.net', 'sql7378008', 'bRRWVuN2zP', 'sql7378008');

// Development connection
//$db = mysqli_connect('127.0.0.1', 'root', '', 'my_db');

if (!$db) {
    echo 'Can not connect to server.';
    error_log('Can not connect to server.' . mysqli_connect_error());
    die();
}

mysqli_query($db, 'SET NAMES UTF 8');

function validate_user()
{
    if (isset($_SESSION['user_id'])) {
        if ($_SESSION['user_ip'] != $_SERVER['REMOTE_ADDR'] ||
                $_SESSION['user_agent'] != $_SERVER['HTTP_USER_AGENT']) {
            unset($_SESSION['user_id']);
            header('Location: index.php');
            die();
        }
        return true;
    }
}

function check_token()
{
    if (empty($_SESSION['token']) ||
            empty($_POST['token']) ||
            $_SESSION['token'] !== $_POST['token']) {
        echo 'Failed, please try again.';
        die();
    }
}

function get_token()
{
    return $_SESSION['token'] = uniqid('token_', true);
}