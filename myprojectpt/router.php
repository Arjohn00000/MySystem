<?php
session_start();
require("backend.php");
if (isset($_POST['choice'])) {
    switch ($_POST['choice']) {
        case 'login':
            $backend = new backend();
            echo $backend->doLogin($_POST['user'],$_POST['pass']);
            break;
        case 'register':
            $backend = new backend();
            echo $backend->doRegister($_POST['user'],$_POST['pass']);
            break;    
        case 'logout':
            session_unset();
            session_destroy();
            echo "200";
            break;
        
        default:
            echo "404";
            break;
    }
}