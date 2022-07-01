<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>products</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <link rel="stylesheet" href="css/style.css">
    <style>
        #filtre{
            font-size: x-large;
            cursor: pointer;
            box-shadow: 4px 6px 8px  lightgray;border-radius: 4px;
        }
        
        .displayed{
            display: none;
        }
        .m9luba{
            transform: rotate(180deg);
        }
    </style>
    <!-- <script>
        document.querySelector("#filtre").onclick = () =>{
            let w = document.querySelector('#filtreDiv');
            w.classList.toggle('displayed');
        } -->
    </script>
</head>
<body>
  
<?php
    include('./Includes/menuin.inc.html.php');
?>

<section class="product">
    <span id="filtre">
        <img src="./images/ftltr.png" alt="" height="30" width="30" id="icnfl" class="" >
    </span><br>
    <div class="row " id="filtreDiv" style="background-color: rgba(24,240,49,.04);padding:0.5rem"><br>
        <div class="col-sm-2">
            <h1 class="heading"> Trie : <span>Prix</span> </h1>
        </div>
        <div class="col-sm-9">
            <form method="post" action="<?php echo $_SERVER['PHP_SELF'];  ?>">
                <div class="row">
                    <div class="col-sm-12">
                        <label for="init" style="font-size: 1.2rem;"> De :</label>
                        <input type="text" name="prix1" class="box" value="<?php if(isset($prix1)) echo $prix1; else echo '00'; ?>"  placeholder="" style="font-size: 1.5rem; width:10%;height:36px; text-align:center">
                        <label for="final" style="font-size: 1.2rem;"> à :</label>
                        <input type="text" name="prix2" class="box" value="<?php if(isset($prix1)) echo $prix2; else echo '00'; ?>"  placeholder="" style="font-size: 1.5rem; width:11%;height:36px; text-align:center">
                        <!-- <input type="submit" class="btn " value="searche" style="position: relative;top:0;"> -->
                        <label for="" style="font-size: 2rem;">Categorie:</label>
                        <input type="search" name="categorie" value="<?php if(isset($categori)) echo $categorie; else echo '' ; ?>" id="search-box" placeholder="cetgorie..." style="font-size: 1.5rem;height:36px; width:20%">
                        <span style="font-size:18px">Grouper par</span>
                        <select id="groupBy" name="groupBy" class="" style="width: 17%;height:37px;font-size:1.9rem; background: white;">
                            <option value="Categorie">Categorie</option>
                            <option value="prix">prix</option>
                            <option value="Designation">Designation</option>
                        </select>
                        <button type="submit" name="par_prix" class=""><span class="fas fa-search" style="font-size:2rem;padding:10px; border-radius: 0 10px 10px 0;"></span></button>

                    </div>
                </div>
            </form>
        </div>
    </div>
    <section class="products">
        <?php 
            if($RepRech!=null){
        ?>
        <h1 class="heading"> search <span>products</span> </h1>

        <div class="box-container">
            <?php 
                while($row = $RepRech->fetch_assoc()){
            ?>
                <div class="box">
                    <div class="image">
                        <img src="images/<?php echo $row['images'] ?>" class="main-img" alt="">
                        <img src="images/<?php $files = explode(".",$row['images']); echo $files[0] ?>-hover.jpg" class="hover-img" alt="">
                        <div class="icons">
                            <a href="./shopit.html.php?Ref=<?php echo $row['Ref']?>" class="fas fa-shopping-cart"></a>
                            <a href="#" class="fas fa-search-plus"></a>
                            <a href="#" class="fas fa-heart"></a>
                            <a href="#" class="fas fa-share"></a>
                        </div>
                    </div>
                    <div class="content">
                        <h3><?php echo $row['Designation'] ?> </h3>
                        <div class="price"> <?php echo $row['prix'] ?><span> <?php echo $row['prix'] + rand(0,25) ?></span></div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                    </div>
                </div>
            <?php }} ?>
            
        </div>

    </section>
    
    <section class="products">

        
            <?php $conn = connect();
                if(isset($_POST['par_prix'])){
                    ?>
                    <h1 class="heading"> search <span>products</span> </h1><br><br>
        <div class="box-container">
                    
                    <?php
                    $prix1 = $_POST['prix1'];
                    $prix2 = $_POST['prix2'];
                    $categorie = $_POST['categorie'];
                    $groupBy = $_POST['groupBy'];
                    $sql = "SELECT * FROM Produits WHERE prix BETWEEN $prix1 AND $prix2 AND Categorie LIKE '%$categorie%' ORDER BY $groupBy";
                    $rep = mysqli_query($conn, $sql);
                    if($rep){
                        while($row = $rep->fetch_assoc()){
            ?>
                        <div class="box">
                            <div class="image">
                                <img src="images/<?php echo $row['images'] ?>" class="main-img" alt="">
                                <img src="images/<?php $files = explode(".",$row['images']); echo $files[0] ?>-hover.jpg" class="hover-img" alt="">
                                <div class="icons">
                                    <a href="./shopit.html.php?Ref=<?php echo $row['Ref']?>" class="fas fa-shopping-cart"></a>
                                    <a href="#" class="fas fa-search-plus"></a>
                                    <a href="#" class="fas fa-heart"></a>
                                    <a href="#" class="fas fa-share"></a>
                                </div>
                            </div>
                            <div class="content">
                                <h3><?php echo $row['Designation'] ?> </h3>
                                <div class="price"> <?php echo $row['prix'] ?><span> <?php echo $row['prix'] + rand(0,25) ?></span></div>
                                <div class="stars">
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star-half-alt"></i>
                                </div>
                            </div>
                        </div>
            <?php } }}?>
            
        </div>

    </section>
</section>


<section class="products">

    <h1 class="heading"> All <span>products</span> </h1>

    <div class="box-container">
        <?php 
            $sql = "SELECT * FROM Produits";
            $rep = mysqli_query($conn, $sql);
            if($rep){
                while($row = $rep->fetch_assoc()){
        ?>
                    <div class="box">
                        <div class="image">
                            <img src="images/<?php echo $row['images'] ?>" class="main-img" alt="">
                            <img src="images/<?php $files = explode(".",$row['images']); echo $files[0] ?>-hover.jpg" class="hover-img" alt="">
                            <div class="icons">
                                <a href="./shopit.html.php?Ref=<?php echo $row['Ref']?>" class="fas fa-shopping-cart"></a>
                                <a href="#" class="fas fa-search-plus"></a>
                                <a href="#" class="fas fa-heart"></a>
                                <a href="#" class="fas fa-share"></a>
                            </div>
                        </div>
                        <div class="content">
                            <h3><?php echo $row['Designation'] ?> </h3>
                            <div class="price"> <?php echo $row['prix'] ?><span> <?php echo $row['prix'] + rand(0,25) ?></span></div>
                            <div class="stars">
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star"></i>
                                <i class="fas fa-star-half-alt"></i>
                            </div>
                        </div>
                    </div>
        <?php } }?>
        
    </div>

</section>


<!-- des Ofrese -->

<!-- <section class="product-banner">

    <h1 class="heading"> <span>deal</span> of the day </h1>

    <div class="box-container">

        <div class="box">
            <img src="images/product-banner-1.jpg" alt="">
            <div class="content">
                <span>special offer</span>
                <h3>upto 50% off</h3>
                <a href="#" class="btn">shop now</a>
            </div>
        </div>

        <div class="box">
            <img src="images/product-banner-2.jpg" alt="">
            <div class="content">
                <span>special offer</span>
                <h3>upto 50% off</h3>
                <a href="#" class="btn">shop now</a>
            </div>
        </div>

    </div>
    
</section> -->

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
<script src="js/js.js"></script>

</body>
</html>