<?php
    include('./Includes/connexion.php');   
    $ref= $_GET['RefP'];
    $numcmd = $_GET['NumCmd'];
    $conn = connect();
    $sql1 = "SELECT * FROM produits WHERE Ref = '$ref' ";
    $rep1 = mysqli_query($conn, $sql1);
    $sql2 = "SELECT * FROM lignecommande WHERE NumCmd = '$numcmd' ";
    $rep2 = mysqli_query($conn, $sql2);
    $row1 = $rep1->fetch_assoc();
    $row2 = $rep2->fetch_assoc();
    @$quantiteStock =  $row1['qtt']; 
    @$qttcommande =  $row2['quantite'];
    if($qttcommande<= $quantiteStock){
        $x = $quantiteStock-$qttcommande;
        $email = explode('-', $numcmd)[1];
        $sqlUpdat = "UPDATE produits SET qtt = '$x'  WHERE Ref = '$ref'";
        // echo $sqlUpdat;
        $rep = mysqli_query($conn, $sqlUpdat);
        $sqlDelete  = "DELETE FROM commande WHERE emailClt = '$email'";
        $sqlDelete0 = "DELETE FROM lignecommande WHERE NumCmd = '$numcmd' ";
        $rep00 = mysqli_query($conn, $sqlDelete);
        $rep01 = mysqli_query($conn, $sqlDelete0);
        // echo $sqlDelete;
        if($rep00 && $rep01)
            echo "Votre commande serra livree à votre adresse<br>";
        else{
            echo mysqli_error($conn);
        }
    }else{
        echo "La quantité commander est superieur a celle du stock<br>";
        
    }
    header('location:payment.html.php');
?>