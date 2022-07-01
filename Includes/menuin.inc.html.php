<!-- header section starts  -->
<?php 
    $RepRech=null;
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
    function getImage($email, $pass){
        $bd = mysqli_connect('localhost', 'root', '', 'miniprojet');
        $sql = "SELECT * from Client WHERE email = '$email' AND pass = '$pass'";
            $rep = mysqli_query($bd, $sql);
            ($d = $rep->fetch_assoc());
            return  $d['imageP'] ;
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

    <form method="POST" action="" class="search-form">
        <input name="s" type="search" id="search-box" placeholder="search here...">
        <button name="q" for="search-box" class="fas fa-search" style="font-size: 3rem;border-radius:50%; padding:1rem;margin-left:10rem !important;"></button>
    </form>
    <?php
        if(isset($_POST['q'])){
            $conn =connect();
            $q = $_POST['s'];
            $sql = "SELECT * FROM produits WHERE Designation LIKE '%$q%' OR categorie LIKE '%$q%'";
            $RepRech = mysqli_query($conn, $sql);            
        }
    ?>
    <div class="icons">

        <div id="search-btn" class="fas fa-search"></div>
        <?php 
            if(isset($_COOKIE['UtilisateurEmail']) &&  isset($_COOKIE['UtilisateurPassword'])){
                if(estAdmin( $_COOKIE['UtilisateurEmail'], $_COOKIE['UtilisateurPassword'])){
                    echo ' <a href="./gestionProduit.html.php" class="fas fa-tasks"></a>';
                }
            }

        ?>
        <a href="login.html.php" class="fas fa-user"></a>
        <a href="cart.html.php" class="fas fa-shopping-cart">
            <?php 
            if(isset($_COOKIE['UtilisateurEmail']) &&  isset($_COOKIE['UtilisateurPassword'])){

                $conn =connect();
                $sql = "SELECT count(*) from commande JOIN lignecommande on Num=NumCmd join produits on Ref = refProd   WHERE emailClt ='".$_COOKIE['UtilisateurEmail']."'";
                $rep = mysqli_query($conn, $sql);
                if($rep){
                    $d = $rep->fetch_array();
                    echo $d[0];
                }
            }
            ?>
        </a>
    </div>

</header>

<!-- header section ends -->

<!-- side-bar section starts -->

<div class="side-bar">

    <div id="close-side-bar" class="fas fa-times"></div>

    <div class="user">
        <?php 
            if(isset($_COOKIE['UtilisateurPassword']) && isset($_COOKIE['UtilisateurEmail'])){
                $p = getImage($_COOKIE['UtilisateurEmail'], $_COOKIE['UtilisateurPassword']);
                echo '<img src="./images/profiles/'. $p .'" >';
                //echo $p;
            }else echo '<img src="./images/profiles/avatar.png" alt="">';
        ?>
        <h3>
            <?php 
                if(isset($_COOKIE['UtilisateurPassword']) && isset($_COOKIE['UtilisateurEmail'])){
                    echo getName($_COOKIE['UtilisateurEmail'], $_COOKIE['UtilisateurPassword']);
                }else echo "Utilisateur inconnu";
            ?>
        </h3>
        <a href="logout.php">log out</a>
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
