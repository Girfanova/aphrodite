<?php session_start(); 
if(isset ($_SESSION['auth'])){
    $_SESSION['auth'] = false; 
    unset($_SESSION['user_role']); 
    session_destroy();
    header("Location: /");
} 
