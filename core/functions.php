<?php
function setMessage($type, $message)
{
    $_SESSION['message'] = [
        'type' => $type,
        'text' => $message,
    ];
}

function getMessages()
{
    if (isset($_SESSION['message'])) {
        $type = $_SESSION['message']['type'];
        $text = $_SESSION['message']['text'];

        echo "<div class='text-center'><div class='alert alert-$type'>$text</div></div>";
        unset($_SESSION['message']);
    }
}

function register($name, $email, $password)
{
    $connection = $GLOBALS['conn'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO `users`(`name`,`email`,`password`) VALUES ('$name','$email','$hashedPassword')";

    $result = mysqli_query($connection, $sql);

    if ($result) {
        return true;
    } else {
        return false;
    }
}


function emailExists($email) {
    $connection = $GLOBALS['conn'];
    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";
    $result = mysqli_query($connection, $sql);
    return mysqli_num_rows($result) > 0;
}



function login($email, $password)
{
    $connection = $GLOBALS['conn'];
    $sql = "SELECT * FROM `users` WHERE `email` = '$email'";

    $result = mysqli_query($connection, $sql);

    if (mysqli_num_rows($result) == 0) {
        setMessage("danger", "Invalid email");
        header("location: index.php?page=login");
        exit;
    }

    $user = mysqli_fetch_assoc($result);
    
    if (password_verify($password, $user['password'])) {
        $_SESSION['user_name'] = $user['name'];
        return true;
    } else {
        return false;
    }
}