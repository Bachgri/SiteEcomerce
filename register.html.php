<?php
   
    if(isset($_POST['registre'])){
        $email =  $_POST['email']; $name = $_POST['name']; $adresse = $_POST['adresse']; $pass = $_POST['pass']; $re_pass = $_POST['re_pass'];
        /*if($_FILES['image']['name']=="") $image = "avatare.png"; else*/ 
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = './images/profiles/'.$image;
        if($name=="" || $email="" || $pass =="" || $re_pass==""){
            $messages = "Veullez Remplire tous les champs";
            
        }else{
            if($pass!=$re_pass){
                $messages = "les mot de passe ne sont pas identique";
            }else{
                $bd = mysqli_connect('localhost', 'root', '', 'miniprojet');
                $pass = md5($pass);
                $sql = "INSERT INTO Client(email, namec, pass, adresse, imageP) VALUES('".$_POST['email']."', '$name', '$pass', '$adresse', '$image')";
                $rep = mysqli_query($bd, $sql);
                if($rep){
                    move_uploaded_file($image_tmp_name,$image_folder);
                    header('location:./login.html.php');
                }else{
                    $messages = "Une erreur veullez resseyz". mysqli_error($bd);
                }
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>register</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- cusom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <style>
                
        .form-control {
        display: block;
        width: 100%;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 400;
        line-height: 1.5;
        color: #212529;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        border-radius: 0.25rem;
        transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        @media (prefers-reduced-motion: reduce) {
        .form-control {
            transition: none;
        }
        }
        .form-control[type=file] {
        overflow: hidden;
        }
        .form-control[type=file]:not(:disabled):not([readonly]) {
        cursor: pointer;
        }
        .form-control:focus {
        color: #212529;
        background-color: #fff;
        border-color: #86b7fe;
        outline: 0;
        box-shadow: 0 0 0 0.25rem rgba(13, 110, 253, 0.25);
        }
        .form-control::-webkit-date-and-time-value {
        height: 1.5em;
        }
        .form-control::-moz-placeholder {
        color: #6c757d;
        opacity: 1;
        }
        .form-control::placeholder {
        color: #6c757d;
        opacity: 1;
        }
        .form-control:disabled, .form-control[readonly] {
        background-color: #e9ecef;
        opacity: 1;
        }
        .form-control::file-selector-button {
        padding: 0.375rem 0.75rem;
        margin: -0.375rem -0.75rem;
        -webkit-margin-end: 0.75rem;
        margin-inline-end: 0.75rem;
        color: #212529;
        background-color: #e9ecef;
        pointer-events: none;
        border-color: inherit;
        border-style: solid;
        border-width: 0;
        border-inline-end-width: 1px;
        border-radius: 0;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        @media (prefers-reduced-motion: reduce) {
        .form-control::file-selector-button {
            transition: none;
        }
        }
        .form-control:hover:not(:disabled):not([readonly])::file-selector-button {
        background-color: #dde0e3;
        }
        .form-control::-webkit-file-upload-button {
        padding: 0.375rem 0.75rem;
        margin: -0.375rem -0.75rem;
        -webkit-margin-end: 0.75rem;
        margin-inline-end: 0.75rem;
        color: #212529;
        background-color: #e9ecef;
        pointer-events: none;
        border-color: inherit;
        border-style: solid;
        border-width: 0;
        border-inline-end-width: 1px;
        border-radius: 0;
        -webkit-transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }
        @media (prefers-reduced-motion: reduce) {
        .form-control::-webkit-file-upload-button {
            -webkit-transition: none;
            transition: none;
        }
        }
        .form-control:hover:not(:disabled):not([readonly])::-webkit-file-upload-button {
        background-color: #dde0e3;
        }

    </style>

</head>
<body>
  
<!-- header section starts  -->
<?php 

function connect(){
    $bd = mysqli_connect('localhost', 'root', '', 'miniprojet');
    return $bd;
}
function getName($email, $pass){
    $bd = mysqli_connect('localhost', 'root', '', 'miniprojet');
    $sql = "SELECT * from Client WHERE email = '$email' AND pass = '$pass'";
        $rep = mysqli_query($bd, $sql);
        ($d = $rep->fetch_assoc());
        return  $d['namec'] ;
}
function estAdmin($email, $pass){
    $bd = mysqli_connect('localhost', 'root', '', 'miniprojet');
    $sql = "SELECT * from Client WHERE email = '$email' AND pass = '$pass'";
        $rep = mysqli_query($bd, $sql);
        $d = $rep->fetch_assoc();
        return  $rep->num_rows>=1 ? $d['estAdmin'] : 0 ;
}

?>
<header class="header">
    
    <div class="icons">
        <div id="menu-btn" class="fas fa-bars">

        </div>
    </div>
    <a href="index.php" class="logo"> <i class="fas fa-store"></i> OUALID </a>

    <form action="" class="search-form">
        <input type="search" id="search-box" placeholder="search here...">
        <label for="search-box" class="fas fa-search"></label>
    </form>

    <div class="icons">

        <div id="search-btn" class="fas fa-search"></div>
        
        <a href="login.html.php" class="fas fa-user"></a>
        <a href="cart.html.php" class="fas fa-shopping-cart"></a>
    </div>

</header>

<!-- header section ends -->

<!-- side-bar section starts -->

<div class="side-bar">

    <div id="close-side-bar" class="fas fa-times"></div>

    <div class="user">
        <img src="image/profiles/avatre.png" alt="">
        <h3>USername </h3>
        <a href="#">log out</a>
    </div>

    <nav class="navbar">
        <a href="index.php"> <i class="fas fa-angle-right"></i> home </a>
        <a href="about.html.php"> <i class="fas fa-angle-right"></i> about </a>
        <a href="products.html.php"> <i class="fas fa-angle-right"></i> Produits </a>
        <a href="contact.html.php"> <i class="fas fa-angle-right"></i> contact </a>
        <a href="login.html.php"> <i class="fas fa-angle-right"></i> login </a>
        <a href="register.html.php"> <i class="fas fa-angle-right"></i> register </a>
        <a href="cart.html.php"> <i class="fas fa-angle-right"></i> Panier </a>
    </nav>

</div>


<section class="register">

    <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
        <h3>register now</h3>
        <input type="text" name="name" placeholder="enter your name" id="" class="box">
        <input type="email" name="email" placeholder="enter your email" id="" class="box">
        <input type="text" name="adresse" placeholder="enter your adresse" id="" class="box">
        <input type="password" name="pass" placeholder="enter your password" id="" class="box">
        <input type="password" name="re_pass" placeholder="re-enter your password" id="" class="box">
        <input type="file" name="image" id="" class="box form-control" accept="image/png, image/jpg, image/jpeg">
        <input type="submit" name="registre" value="register now" class="btn">
        <p style="color: #EF4122;"> <?php if(isset($messages)) echo "$messages"; ?> </p>
        <p>already have an account?</p>
        <a href="login.html.php" class="btn link">login now</a>
    </form>

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

    <p> created by <span> Oualid lachgar && Oualid el-ferraoui</span> | all rights reserved! </p>

    <img src="images/card_img.png" alt="">

</section>


<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

</body>
</html>