<?php
include('./Includes/connexion.php');
$bd = connect();

    $ref = $_GET['refprod'];
    $quant = $_GET['qtt'];
    $sql = "UPDATE lignecommande SET quantite = '$quant' WHERE refProd = '$ref'";
    $rep = mysqli_query($bd, $sql);
    // if($rep){
    //     echo "updated";
    // }else{
    //     echo "not updated";
    // }
    header('location:./cart.html.php');
?>   