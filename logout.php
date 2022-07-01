<?php 
    session_start();
    session_unset();
    session_destroy();
    
    setcookie('admin');
    
    setcookie('UtilisateurEmail');
    setcookie('UtilisateurPassword');
    header('location:index.php');
    
?>