<?php

function requirements($field , $value){
    return empty($value) ? "$field is required" : null;
}

function validateEmail($email){
    return filter_var($email, FILTER_VALIDATE_EMAIL) ? null : "Invalid Email";
}

function validatePassword($password){
    if (strlen($password) < 8) {
        return "Password must be at least 8 characters long";
    }
    if (!preg_match("/[0-9]/", $password)) {
        return "Password must contain at least one number";
    }
    if (!preg_match("/[A-Z]/", $password)) {
        return "Password must contain uppercase letter";
    }
    if (!preg_match("/[!@#$%^&*(),.?':{}|<>]/", $password)) {
        return "Password must contain special characters";
    }
    return null;
}

function validatePasswordMatch($password, $confirm_password){
    return $password === $confirm_password ? null : "Password does not match";
}

function maxLength($field , $value , $max){
    return trim(strlen($value)) > $max ? "$field must be less than or equal to $max characters" : null;
}

function minLength($field , $value , $min){
    return trim(strlen($value)) < $min ? "$field must be at least $min characters long" : null;
}

function validateRegister($name, $email, $password, $confirm_password){
    $errors = [];

    $fields = [
        'Name' => $name,
        'Email' => $email,
        'Password' => $password,
        'Confirm Password' => $confirm_password
    ];

    foreach ($fields as $field => $value) {
        if ($error = requirements($field , $value)) {
            $errors[] = $error;
        }
    }

    if ($error = maxLength("Name" , $name , 50)){
        $errors[] = $error;
    }

    if ($error = minLength("Name" , $name , 3)){
        $errors[] = $error;
    }

    if ($error = validateEmail($email)) {
        $errors[] = $error;
    }

    if ($error = validatePassword($password)) {
        $errors[] = $error;
    }

    if ($error = validatePasswordMatch($password , $confirm_password)) {
        $errors[] = $error;
    }

    return $errors;
}

function validateLogin($email, $password){
    $errors = [];

    $fields = [
        'Email' => $email,
        'Password' => $password,
    ];

    foreach ($fields as $field => $value) {
        if ($error = requirements($field , $value)) {
            $errors[] = $error;
        }
    }

    if ($error = validateEmail($email)) {
        $errors[] = $error;
    }

    return $errors;
}
?>

