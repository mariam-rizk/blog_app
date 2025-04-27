<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars(trim($_POST['password']));
    $confirm_password = htmlspecialchars(trim($_POST['confirm_password']));

    $errors = validateRegister($name, $email, $password, $confirm_password);

    if (!empty($errors)) {
        setMessage('danger', implode('<br>', $errors));
        header('location: index.php?page=register');
        exit();
    }
    


    if (emailExists($email)) {
        setMessage('danger', "You have already registered with this email before");
        header('location: index.php?page=register');
        exit();
    }

    $register = register($name, $email, $password);
    if ($register == true) {
        $_SESSION['user_name'] = $name;
        setMessage('success', "Registered Successfully");
        header('location: index.php');
        exit();
    } else {
        setMessage('danger', "Failed to Register");
        header('location: index.php?page=register');
        exit();
    }
}

