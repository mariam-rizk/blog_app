<?php
session_start();
require_once 'config/db.php';
require_once 'core/functions.php';
require_once 'core/validation.php';

require_once 'views/layouts/header.php';

getMessages();


$page = isset($_GET['page']) ? $_GET['page'] : 'home';


$allowed_pages = ['home', 'login', 'register', 'login_controller', 'register_controller'];
if (!isset($_SESSION['user'])) {
    if (!in_array($page, $allowed_pages)) {
        setMessage('danger', 'You must login first.');
        header('Location: index.php?page=login');
        exit;
    }
}



switch($page){
    case 'home' : 
        include 'views/home.php';
        break;

    case 'register' : 
        include 'views/auth/register.php';
        break;
    
    case 'login' :
        include 'views/auth/login.php';
        break;

    case 'register_controller' :
        include 'controllers/register_controller.php';
        break;

    case 'login_controller' :
        include 'controllers/login_controller.php';
        break;

    case 'logout' :
        include 'controllers/logout_controller.php';
        break;

    case 'blogs' :
        include 'views/blogs/index.php';
        break;

    case 'create' :
        include 'views/blogs/create.php';
        break;

    case 'add_blog' :
        include 'controllers/blogs/blog_controller.php';
        break;

    case 'delete_blog' :
        include 'controllers/blogs/blog_controller.php';
        break;

    case 'edit_blog' :
        include 'views/blogs/edit.php';
        break;

    case 'update_blog' :
        include 'controllers/blogs/blog_controller.php';
        break;
    
    case 'view_blog' :
        include 'views/blogs/view_blog.php';
        break;
        

    default : 
        header('location:views/not_found.php');


}

include_once 'views/layouts/footer.php';