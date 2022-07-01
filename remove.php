<?php 
include('./Includes/connexion.php');
$n = $_GET['NC'];
$e = $_GET['NCL'];
$conn =connect();
$sql = "DELETE from lignecommande WHERE NumCmd = '$n'";
$rep = mysqli_query($conn, $sql);
$sql = "DELETE from commande WHERE emailClt = '$e'";
$rep = mysqli_query($conn, $sql);
header('Location: ' . $_SERVER['HTTP_REFERER'] );
?>