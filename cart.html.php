<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cart</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <link rel="stylesheet" href="css/style.css">


</head>
<body>
    

  
<?php
    include('./Includes/menuin.inc.html.php')
?>
<section class="shopping-cart">

    <h1 class="heading">your <span>products</span></h1>

    <div class="box-container">
        <?php 
        if(isset($_COOKIE['UtilisateurEmail']) &&  isset($_COOKIE['UtilisateurPassword'])){

            $conn =connect();
            $sql = "SELECT * from commande JOIN lignecommande on Num=NumCmd join produits on Ref = refProd 
                    WHERE emailClt = '".$_COOKIE['UtilisateurEmail']."'";
            $rep = mysqli_query($conn, $sql);
            if($rep){$i=0;
                while($row = $rep->fetch_assoc()){
        ?>
            <div class="box">
                <a href="./remove.php?NC=<?php echo $row['NumCmd']?>&NCL=<?php echo $row['emailClt'] ?>"><button type="submit" class="fas fa-times" href="./remove?NC=<?php echo $row['NumCmd'] ?>"></button></a>
                <img src="images/<?php echo $row['images']   ?>" alt="">
                <div class="content">
                    <h3><?php echo $row['Designation']   ?></h3>
                    <form action="./updateqtt.php">
                        <span>quantity : </span>
                        <input type="hidden" name="prix" id="pxi<?php echo $i?>" value="<?php $row['prix'] ?>"><!-- prix -->
                        <input type="number" name="qtt" value="<?php echo $row['quantite']?>" id="qtt<?php echo $i?>" > 
                        <input type="hidden" name="refprod" value="<?php echo $row['Ref'] ?>">
                        <button class="btn btn-success fa " type="submit">&#xf021;</button>
                    </form>
                    <div class="price"  ><i id="px<?echo $i?>"><?php echo $row['prix']*$row['quantite']   ?></i> DHs</div>
                    <a href="finalise.php?NumCmd=<?php echo $row['NumCmd'] ?>&RefP=<?php echo $row['Ref'] ?>" class="btn btn-info" style="background-color: red ;">Acheter</a>
                </div>
            </div>
        <?php $i++; } }}?>

    </div>

    <div class="cart-total">
        <h3> 
            Total : 
            <span> 
                <?php 
                    if(isset($_COOKIE['UtilisateurEmail']) &&  isset($_COOKIE['UtilisateurPassword'])){

                        $sql = "SELECT sum(prix*quantite), NumCmd, Ref from commande JOIN lignecommande on Num=NumCmd join produits on Ref = refProd WHERE emailClt = '".$_COOKIE['UtilisateurEmail']."'";
                        $conn = connect();
                        $rep = mysqli_query($conn, $sql);
                        if($rep){
                            $d = $rep->fetch_array();
                            echo $d[0]." ";
                        }else echo "0";
                    }
                ?> 
            </span> 
            DHs 
        </h3>
        <form method="POST">
            <input type="hidden" name="RefP" value="<?php echo $d[2] ?>">
            <input type="hidden" name="NumCmd" value="<?php echo $d[1] ?>">
            <button name="allcommander" class="btn ">Finaliser tout les commandes </button>
                    
        </form>
        <?php 
        $message;$err;
            if(isset($_POST['commander'])){
                
            }
        ?>
        <span>
            <?php
                if(isset($err)){
                    echo $err;
                }
                if(isset($message)){
                    echo $message;
                }
            ?>
        </span>
    </div>

</section>

<section class="quick-links">

    <a href="index.php" class="logo"> <i class="fas fa-store"></i> OUALID </a>

    <div class="links">
        <a href="index.php"> home </a>
        <a href="about.html.php"> about </a>
        <a href="products.html.php"> products </a>
        <a href="contact.html.php"> contact </a>
        <a href="login.html.php"> login </a>
        <a href="register.html.php"> register </a>
        <a href="cart.html.php"> cart </a>
    </div>

    <div class="share">
        <a href="#" class="fab fa-facebook-f"></a>
        <a href="#" class="fab fa-twitter"></a>
        <a href="#" class="fab fa-instagram"></a>
        <a href="#" class="fab fa-linkedin"></a>
    </div>

</section>

<section class="credit">

    <p> created by <span>Oualid LACHGAR && Oualid ELFERRAOUI</span> | all rights reserved! </p>

    <img src="images/card_img.png" alt="">

</section>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>
</body>
</html>