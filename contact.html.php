<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>contact</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- cusom css file link  -->
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
  
<?php
    include('./Includes/menuin.inc.html.php')
?>
<section class="info-container">

    <div class="box-container">

        <div class="box">
            <i class="fas fa-map"></i>
            <h3>address</h3>
            <p>Salé</p>
        </div>

        <div class="box">
            <i class="fas fa-envelope"></i>
            <h3>email</h3>
            <p>Oualidlachgar7@gmail.com</p>
            <p>oualiedelferraoui@gmail.com</p>
        </div>

        <div class="box">
            <i class="fas fa-phone"></i>
            <h3>number</h3>
            <p>+212 622 115470</p>
            <p>+212 622 33333</p>
        </div>

    </div>

</section>

<!-- contact info section ends -->

<!-- contact section starts  -->

<section class="contact">

    <form action="">
        <h3>Reclamation</h3>
        <p>Si vous rencontre des problèmes n'hésitez pas à nous contacter a partir de formulaire en bas</p>
        <div class="inputBox">
            <input type="text" placeholder="votre nom">
            <input type="email" placeholder="Votre email">
        </div>
        <div class="inputBox">
            <input type="number" placeholder="Votre numéro de téléphone">
            <input type="text" placeholder="Sujet">
        </div>
        <textarea name="" placeholder="Votre message" id="" cols="30" rows="10"></textarea>
        <input type="submit" value="Envoyez message" class="btn">
    </form>

    <iframe class="map" src="https://www.google.com/maps/embed" allowfullscreen="" loading="lazy"></iframe>

</section>




<section class="quick-links">

    <a href="home.html.php" class="logo"> <i class="fas fa-store"></i> OUALID </a>

    <div class="links">
        <a href="home.html.php"> home </a>
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

    <p> created by <span>Oualid LACHGAR && Oualid ELFERRAOUI</span> </p>

    <img src="images/card_img.png" alt="">

</section>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

</body>
</html>