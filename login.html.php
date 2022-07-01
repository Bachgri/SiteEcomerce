<?php  
    
    function exist($email, $pass){
        $bd =  mysqli_connect('localhost', 'root', '', 'miniprojet');
        $sql = "SELECT email, pass from Client WHERE email = '$email' AND pass = '$pass'";
        $rep = mysqli_query($bd, $sql);
        return $rep->num_rows==1;
    }
    function estAdminCookie($email, $mdp){
        $bd =  mysqli_connect('localhost', 'root', '', 'miniprojet');
        $sql = "SELECT * from Client WHERE email = '$email' AND pass = '$mdp'";
        $rep = mysqli_query($bd, $sql);
        ($d = $rep->fetch_assoc());
        return  $rep->num_rows>=1 ?  $d['estAdmin'] : 0;
    }
    if(isset($_POST['login'])){
        $email =  $_POST['email']; $password = $_POST['password'];
        $password = md5($password);
        if( $email=="" || $password=="" ){
            $messages = "Veullez remplir tous les champs";
        }else{
            if(exist($email, $password)){
                if(isset($_POST['remebre_me'])){
                    session_start();
                    $_SESSION['UtilisateurEmail'] = $email;
                    $_SESSION['UtilisateurPassword'] = $password;
                }
                if(estAdminCookie($email, $password)){
                    $_COOKIE['admin'] = 'admin';
                    setcookie('admin', 'admin');
                }
                $_COOKIE['UtilisateurEmail'] = $email;
                $_COOKIE['UtilisateurPassword'] = $password;
                setcookie('UtilisateurEmail', $email);
                setcookie('UtilisateurPassword', $password);
                header('location:./index.php');
            }else{
                $messages ="email ou mot de passe incorrect";
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
    <title>login</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <link rel="stylesheet" href="css/style.css">

</head>
<body>
  
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
        return  $d['estAdmin'] ;
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


<div class="side-bar">

    <div id="close-side-bar" class="fas fa-times"></div>

    <div class="user">
        <img src="image/profiles/avatre.png" alt="">
        <h3>
            <?php 
                if(isset($_COOKIE['UtilisateurPassword']) && isset($_COOKIE['UtilisateurEmail'])){
                    echo getName($_COOKIE['UtilisateurEmail'], $_COOKIE['UtilisateurPassword']);
                }else echo "Prfl";
            ?>
        </h3>
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

<section class="login">
    <form action="" method="post">
        <h3>login now</h3>
        <input type="email" name="email" placeholder="entre votre email" id="" class="box" value="<?php if(isset($email)) echo $email; ?>">
        <input type="password" name="password" placeholder="entre votre password" id="" class="box" value="<?php if(isset($password)) echo $password; ?>">
        <div class="remember">
            <input type="checkbox" name="remeber_me" id="remember-me">
            <label for="remember-me"> remember me </label>
        </div>
        <input type="submit" name="login" value="login now" class="btn">
        <p style="color: #EF4124;"><?php
            if(isset($messages)) echo $messages;
        ?></p>
        <p>vous n'avez pas de compte?</p>
        <a href="register.html.php" class="btn link">crée un</a>
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

    <p> created by <span>Oualid LACHGAR && Oualid ELFERRAOUI</span> | </p>

    <img src="images/card_img.png" alt="">

</section>

<script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

</body>
</html>