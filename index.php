<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>home</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>

    <link rel="stylesheet" href="css/style.css">

</head>
<body>
    
<?php
    include('./Includes/menuin.inc.html.php')
?>

<section class="home">

    <div class="swiper home-slider">
        <div class="swiper-wrapper">
            <?php 
                $conn = connect();
                $sql = "SELECT * from Produits WHERE prix > 1000 ";
                $rep = mysqli_query($conn, $sql);
                while($row=$rep->fetch_assoc()){
            ?>
            <div class="swiper-slide slide">
                <div class="image">
                    <img src="images/<?php echo $row['images']?>" alt="">
                </div>
                <div class="content">
                    <span> <?php echo $row['prix']?> </span>
                    <h3> <?php echo $row['Designation']?> </h3>
                       
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#p<?php echo $row['Ref'] ?>">
                    acheter
                    </button>
                    <div class="modal fade" id="p<?php echo $row['Ref'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Title</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                body
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary">Save changes</button>
                            </div>
                            </div>
                        </div>
                    </div>
                    
                    
                </div>
            </div>
            <?php } ?>
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>
 
</section>

<section class="banner">

    <div class="box-container">
        <?php 
            $conn = connect();
            $sql = "SELECT * from Produits WHERE prix < 1000";
            $rep = mysqli_query($conn, $sql);
            while($row=$rep->fetch_assoc()){
        ?>
        <a href="#" class="box">
            <img src="images/<?php echo $row['images']?>" alt="<?php echo $row['Ref']?>" width="100" height="70" >
            <div class="content">
                <span>offere special </span>
                <h3><?php echo $row['prix']-rand(10,70) ?></h3>
            </div>
        </a>
    <?php } ?>
    </div>

</section>

<section class="arrivals">

    <h1 class="heading"> new <span>arrivals</span> </h1>

    <div class="box-container">
        <?php 
            $conn = connect();
            $sql = "SELECT * from Produits LIMIT 10";
            $rep = mysqli_query($conn, $sql);
            while($row=$rep->fetch_assoc()){
        ?>
                <div class="box">
                    <div class="image">
                        <img src="images/<?php echo $row['images']  ?>" class="main-img" alt="">
                        <img src="images/<?php echo explode('.', $row['images'])[0]  ?>-hover.jpg" class="hover-img" alt="">
                    </div>
                    <div class="content">
                        <h3><?php echo $row['Designation']  ?></h3>
                        <div class="price"> <?php echo $row['prix']  ?> <span><?php echo $row['prix'] + rand(20,50)  ?></span> </div>
                        <div class="stars">
                            <?php $i = rand(3,5); 
                            for($x=2;$x<$i;$x++){ ?>
                                <i class="fas fa-star"></i>
                            <?php } ?>
                        </div>
                    </div>
                </div>
        <?php }?>
    </div>
    

</section>

<section class="quick-links">

    <a href="home.html.php" class="logo"> <i class="fas fa-store"></i> OUALIDs </a>

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

    <p> created by <span>Oualid LACHGAR && Oualid EL-FERRAOUI</span> | all rights reserved! </p>

    <img src="images/card_img.png" alt="">

</section>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

</body>
</html>