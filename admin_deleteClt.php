<?php 
    @include('../Includes/connexion.php');
    $conn = mysqli_connect('localhost', 'root', '', 'miniprojet');
    $email = $_GET['remove'];
    
    $sql = "DELETE FROM client WHERE email = '$email'";
    $r = mysqli_query($conn, $sql);
    if($r){
        echo "deleted succfully";
        header('Location: ' . $_SERVER['HTTP_REFERER'] );
    }else{
        echo "erreor". mysqli_error($conn);
        header('Location: ' . $_SERVER['HTTP_REFERER'] );
    }
?>