<?php
session_start();
require_once 'config/db.php';
require_once 'core/functions.php';
require_once 'core/validation.php';

require_once 'views/layouts/header.php';

getMessages();

 

$page = isset($_GET['page']) ? $_GET['page'] : 'home';
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
    default : 
        header('location:views/not_found.php');
}

include_once 'views/layouts/footer.php';