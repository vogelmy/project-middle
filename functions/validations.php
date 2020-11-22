<?php


$email = !empty($_POST['email']) ? trim($_POST['email']) : '';
$password = !empty($_POST['password']) ? trim($_POST['password']) : '';
$formValid = true;
$emailRegex = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";

function validate_str($fname) {
    $name = !empty($_POST['name']) ? trim($_POST['name']) : '';
    if (!$name || mb_strlen($name) < 2 || mb_strlen($name) > 70) {
        return true;
    }
}

function validate_email($email) {
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailRegex = "/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix";
        return (!preg_match($emailRegex, $email)) ? FALSE : TRUE;
    }
}

function validate_pw($pw) {

    if (!$pw || strlen($pw) > 6 || strlen($pw) < 10) {
        return true;
    }
}

function upload_image(&$errors, $field) {
    if ($_FILES[$field]['error'] !== 0) {
        $errors['file'] = 'We have a problem...' . $_FILES[$field]['name'];
        return;
    }


    if ($_FILES[$field]['size'] === 0) {
        $errors['file'] = 'We hve a problem detecting your file.';
        return;
    }

    if (!is_uploaded_file($_FILES[$field]['tmp_name'])) {
        error_log('Possible file attack');
        return;
    }

    $file_name = date('d-m-y-h-i-s') . "_" . $_FILES[$field]['name'];
    $moved = move_uploaded_file($_FILES[$field]['tmp_name'], 'uploads/' . $file_name);



    if ($moved) {
        return $file_name;
        echo $file_name;
    } else {
        $errors[$file] = 'We have a problem...';
        echo $errors;
    }
}
