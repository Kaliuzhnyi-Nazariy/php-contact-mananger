<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {

    case '/':
        require 'home.php';
        break;

    case '/signin':
        require 'signin.php';
        break;

    case '/signup':
        require 'signup.php';
        break;

    case '/create':
        require 'create.php';
        break;

    default:
        http_response_code(404);
        break;
    
}

?>