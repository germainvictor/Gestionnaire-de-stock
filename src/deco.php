<?php 
    session_start();
    $_SESSION = array();
    session_unset();
    session_destroy();
    if (empty($_SESSION)) {
        header('Location: ./connexion.php');
    }
    
    include 'includes/config.php';

?>