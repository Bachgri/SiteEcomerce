<?php 
    include('../Includes/connexion.php');
    $conn = mysqli_connect('localhost', 'root', '', 'miniprojet');
    $refe = $_GET['remove'];
    
    $sql = "DELETE FROM Produits WHERE Ref = '$refe'";
    $r = mysqli_query($conn, $sql);
    if($r)
        echo "deleted succfully";
        else
        echo "erreor". mysqli_error($conn);
    header('location:./gestionProduit.html.php');

?>