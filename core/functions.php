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
        $id = mysqli_insert_id($connection);
        $_SESSION['user'] =
        [
            'id' => $id,
            'user_name' => $name,
        ];
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


function getBlogs(){
    $connection = $GLOBALS['conn'];
    if(!isset($_SESSION['user']['id'])){
        return [];
    }else{
       $user_id = $_SESSION['user']['id'];
       $sql = "SELECT * FROM `posts` WHERE `user_id` = $user_id ";
       $result = mysqli_query($connection , $sql);
   
       return mysqli_fetch_all($result , MYSQLI_ASSOC);
    }

}

function getAllBlogs(){
    $connection = $GLOBALS['conn'];
    $sql = "SELECT P.* , U.`name` FROM `posts` P JOIN `users` U WHERE P.`user_id` = U.`id` ORDER BY P.`id` DESC";
    $result = mysqli_query($connection , $sql);
    if($result){
        return mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
}

function addBlog($title, $content, $image){
    $connection = $GLOBALS['conn'];
    $image_name = $image['name'];
    $full_path = realpath(__DIR__ . "/../assets/img") . "/" . $image_name;
    $relative_path = "/assets/img/" . $image_name ;
    if(!move_uploaded_file($image['tmp_name'],$full_path)){
        die("Fail to upload image");
    }
        $user_id = $_SESSION['user']['id'];
        $sql = "INSERT INTO `posts` (`title`,`content`,`image`,`created_at`,`user_id`)
                VALUES ('$title','$content','$relative_path',now(),'$user_id')";
        
        $result = mysqli_query($connection,$sql);

        if($result){
            return true;

        }else{
            return false;
        }
}

function findBlog($id){
    $connection = $GLOBALS['conn'];
    $sql = "SELECT * FROM `posts` WHERE `id` = '$id'";
    $result = mysqli_query($connection,$sql);
    
    if (mysqli_num_rows($result) === 0) {
        setMessage("danger", "Post Not Found");
        header("location: index.php?page=blogs");
        exit;
    }
    return mysqli_fetch_assoc($result);
}

function deleteBlog($id){
    findBlog($id);
    $connection = $GLOBALS['conn'];
    $sql = "DELETE FROM `posts` WHERE id = '$id'";
    $result = mysqli_query($connection,$sql);
    if($result){
        return true;
    }else{
        return false;
    }
}

function updateBlog($id, $title, $content, $image){
    $blog = findBlog($id);
    $connection = $GLOBALS['conn'];
    $imagePath = realpath(__DIR__.'/../'.$blog['image']);
    if($imagePath && $image && file_exists($imagePath)){
        unlink($imagePath);
    }
    $image_name = $image['name'];
    $fullPath = realpath(__DIR__ . "/../assets/img") . "/" . $image_name;
    $relativePath = "/assets/img/" . $image_name;
    
    if(!move_uploaded_file($image['tmp_name'],$fullPath)){
        setMessage("danger","Fail to upload image");
        header("location:index.php?page=blogs");
        exit;
    }
    $sql = "UPDATE `posts` SET `title` = '$title' , `content` = '$content' , `image` = '$relativePath' where `id` = '$id'";
    $result = mysqli_query($connection,$sql);
    if($result){
        return true;
    }else{
        return false;
    }
}



   

