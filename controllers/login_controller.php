<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    $errors = validateLogin($email, $password);

    if (!empty($errors)) {
        setMessage('danger', implode('<br>', $errors));
        header('location: index.php?page=login');
        exit();
    }

    if (login($email, $password)) {
        setMessage("success", "Login Sucessfully");
        header("location: index.php");
        exit;
    } else {
        setMessage("danger", "Invaild email or password");
        header("location: index.php?page=login");
        exit;
    }
}
