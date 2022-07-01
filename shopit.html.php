<?php
    include('./Includes/connexion.php');

    if(isset($_COOKIE['UtilisateurEmail']) &&  isset($_COOKIE['UtilisateurPassword'])){
        $email =$_COOKIE['UtilisateurEmail'];
        $produit = $_GET['Ref'];
        $cmd = $email."-".$produit;
        $date = date("Y-m-d");
        $conn = connect();
        $sql = "INSERT INTO Commande (Num, DateCmd, emailClt)VALUES ('$cmd', '{$date}', '$email')";
        $rep = mysqli_query($conn, $sql);
        $sql = "INSERT INTO LigneCommande (NumCmd, refProd, quantite) VALUES ('$cmd','$produit','1')";
        $rep = mysqli_query($conn,$sql);
        header('Location: ' . $_SERVER['HTTP_REFERER'] );
    }else{  
        header('location:./login.html.php');
    }

?>