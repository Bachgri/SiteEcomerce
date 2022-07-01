<?php
   
    if(isset($_POST['registre'])){
        $email =  $_POST['email']; $name = $_POST['name']; $adresse = $_POST['adresse']; $pass = $_POST['pass']; $re_pass = $_POST['re_pass'];
        /*if($_FILES['image']['name']=="") $image = "avatare.png"; else*/ 
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = './images/profiles/'.$image;
        if($name=="" || $email="" || $pass =="" || $re_pass==""){
            $messages[] = "Veullez Remplire tous les champs";
            
        }else{
            if($pass!=$re_pass){
                $messages[] = "les mot de passe ne sont pas identique";
            }else{
                $bd = mysqli_connect('localhost', 'root', '', 'miniprojet');
                $sql = "INSERT INTO Client(email, namec, pass, adresse, imageP) VALUES('".$_POST['email']."', '$name', '$pass', '$adresse', '$image')";
                $rep = mysqli_query($bd, $sql);
                if($rep){
                    move_uploaded_file($image_tmp_name,$image_folder);
                }else{
                    $messages[] = "Une erreur veullez resseyz". mysqli_error($bd);
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
    <title>Produits</title>
    <!--  cdn   -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- swiper css  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />
    <!-- css   -->
    <link rel="stylesheet" href="./css/style.css">
    <!-- bootstrap -->
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- swiper css link  -->
    <link rel="stylesheet" href="https://unpkg.com/swiper@7/swiper-bundle.min.css" />

    <!-- cusom css file link  -->
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css'>
    <style>
        .container{
            max-width: 1200px;
            padding: 2rem;
            margin: 0 auto;
            font-size: 1.5rem;
        }
        .admin-product-form-container form{
            max-width: 50rem;
            margin: 0 auto; padding: 2rem; border-radius: .5rem; background-color: rgba(255, 230, 240, .8);
        }
        .admin-product-form-container form h3{
            text-transform: uppercase; color: black;margin-bottom: 1rem; text-align: center; font-size: 2.5rem;
        }
        .alert{
            max-width: 50rem; border-radius: .5rem;margin: 0 auto;
        }
        .product-display{
            margin: 2rem 0;
            overflow-y: scroll;
        }
        .product-display table{
            width: 100%;
        }
        .product-display table thead{
            padding: 1rem;
            font-size: 2rem;
        }
        table td {
            padding: 1rem;
            line-height: 2em;
            font-size: 2rem;
        }
        .displayed{
            display: none;
        }
        button{
            width: 25.5rem;height: 5rem;font-size: 2rem !important;
        }
        form input{
            font-size: 2rem !important;
        }
        form label{
            font-size: 2rem;
        }
        .btnGest{
            width: 64rem;
            margin-left: 32%;
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

    <form action="" class="search-form">
        <input type="search" id="search-box" placeholder="search here...">
        <label for="search-box" class="fas fa-search"></label>
    </form>

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
        <a href="cart.html.php" class="fas fa-shopping-cart"></a>
    </div>

</header>
<div class="side-bar">

    <div id="close-side-bar" class="fas fa-times"></div>

    <div class="user">
        <?php 
            if(isset($_COOKIE['UtilisateurPassword']) && isset($_COOKIE['UtilisateurEmail'])){
                $p = getImage($_COOKIE['UtilisateurEmail'], $_COOKIE['UtilisateurPassword']);
                echo '<img src="./images/profiles/'. $p .'" >';
                echo $p;
            }else echo '<img src="./images/profiles/avatar.png" alt="">';
        ?>
        <h3>
            <?php 
                if(isset($_COOKIE['UtilisateurPassword']) && isset($_COOKIE['UtilisateurEmail'])){
                    echo getName($_COOKIE['UtilisateurEmail'], $_COOKIE['UtilisateurPassword']);
                }else echo "Prfl";
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

<?php 
    if(isset($_POST['add_product'])){
        $ref = $_POST['ref'];
        $designation = $_POST['Designation'];
        $prix = $_POST['prix'];
        $qtt = $_POST['qtt'];
        $categorie = $_POST['categorie'];
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = './images/'.$image;
        $image_hover = $_FILES['image_hover']['name'];
        $image_hover_tmp_name = $_FILES['image_hover']['tmp_name'];
        $image_hover_folder = './images/'.$image_hover;
        

        if( empty($ref) || empty($designation) || empty($prix) || empty($qtt) || empty($image) || empty($categorie)){
            $message[] = "Tous les champs sont opligatoires";
        }else{
            $conn = connect();
            $sql ="INSERT INTO Produits(Ref, Designation, prix, qtt, images, categorie)
                    VALUES('$ref','$designation','$prix','$qtt','$image', '$categorie')";
            $upload = mysqli_query($conn, $sql);
            if($upload){
                move_uploaded_file($image_tmp_name,$image_folder);
                move_uploaded_file($image_hover_tmp_name,$image_hover_folder);
                $messageSuc[] = "Produit Ajouté";
            }else{
                $message[] = "Erreur: Produit n'a pas été ajouté ";
            }
        }
    }


?>
    <div class="btnGest">
        <button class="btn btn-info" id="editClt">
            Gestion des client
        </button>
        <button class="btn btn-info" id="editProd">
            Gestion des Produits
        </button>
    </div>
    <div class="container products" id="products">
        <div class="admin-product-form-container">
            <?php 
                if(isset($message)){
                    foreach($message as $m){
                        echo '<p class="alert alert-danger">'.$m.'</p><br>';
                    }
                }
                if(isset($messageSuc)){
                    foreach($messageSuc as $m){
                        echo '<p class="alert alert-success">'.$m.'</p><br>';
                    }
                } 
            ?>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h3>Ajouter un produit</h3>
                <label for="reference">Reférence de produit</label>
                <input type="text" name="ref" placeholder="Reference du produit" class="form-control" id="reference">
                <label for="reference">Categorie de produit</label>
                <input type="text" name="categorie" placeholder="Reference du produit" class="form-control" id="reference">
                <label for="des">Designation </label>
                <textarea name="Designation" id="des" cols="10" rows="1" class="form-control" ></textarea>
                <label for="prix">Prix</label>
                <input type="text" name="prix" placeholder="Reference du produit" class="form-control" id="prix">
                <label for="qtt">Quantite</label>
                <input type="text" name="qtt" placeholder="Reference du produit" class="form-control" id="qtt">
                <div class="row">
                    <div class="col-sm-6">
                    <label for="qtt">image</label>
                        <input type="file" name="image" placeholder="Reference du produit" class="form-control" accept="image/png, image/jpg, image/jpeg">
                    </div>
                    <div class="col-sm-6">
                    <label for="qtt">image hover </label>
                        <input type="file" name="image_hover" placeholder="Reference du produit" class="form-control" accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>
                <br>
                <input type="submit" name="add_product" id="" value="Ajouter" class="btn btn-success form-control">

            </form>
        </div>
        <?php 
            $conn = connect();
            $sql = "SELECT * FROM Produits ";
            $select = mysqli_query($conn, $sql);
        ?>
        <div class="product-display">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Reference</th>
                    <th scope="col">Designation</th>
                    <th scope="col">Categorie</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Quantité</th>
                    <th scope="col" colspan="2">Action</th>   
                </tr>
            </thead>
            <tbody>
                <?php 
                    while($row = $select->fetch_assoc()){
                ?>    
                <tr>
                    <th >
                        <img src="images/<?php echo $row['images']?>" class="rounded" width="100" height="100" alt="">
                    </th>
                    <td><?php  echo $row['Ref']?></td>
                    <td><?php  echo $row['Designation'] ?></td>
                    <td><?php  echo $row['Categorie'] ?></td>
                    <td><?php  echo $row['prix'] ?></td>
                    <td style="text-align: center;"><?php  echo $row['qtt'] ?></td>
                    <td>
                        <a href='admin_update.html.php?edite=<?php echo $row['Ref'] ?>' class="btn btn-success">
                            <span class="fa fa-edit"></span>
                        </a>
                    </td>
                    <td>
                        <a href='admin_delete.php?remove=<?php echo $row['Ref'] ?>' class="btn btn-danger">
                            <span class="fa fa-remove"></span>
                        </a>
                    </td>

                </tr>

                <?php }?>

            </tbody>
        </table>
        </div>
    </div>
    <div class="container clients displayed register" id="clients">
        <div>
            <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                <h3>Ajouter un client</h3>
                <input type="text" name="name" placeholder="enter your name" id="" class="box">
                <input type="email" name="email" placeholder="enter your email" id="" class="box">
                <input type="text" name="adresse" placeholder="enter your adresse" id="" class="box">
                <input type="password" name="pass" placeholder="enter your password" id="" class="box">
                <input type="password" name="re_pass" placeholder="re-enter your password" id="" class="box">
                <input type="file" name="image" id="" class="box form-control" accept="image/png, image/jpg, image/jpeg">
                <input type="submit" name="registre" value="Ajouter" class="btn btn-info">
                <p style="color: #EF4122;"> <?php if(isset($messages)) echo "$messages"; ?> </p>
            </form>
        </div>
        <?php 
            $conn = connect();
            $sql = "SELECT * FROM client ";
            $select = mysqli_query($conn, $sql);
        ?>
        <div class="product-display">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Email</th>
                    <th scope="col">adresse</th>
                    <th scope="col" colspan="2">Action</th>   
                </tr>
            </thead>
            <tbody>
                <?php 
                    while($row = $select->fetch_assoc()){
                ?>    
                <tr>
                    <th>
                        <img src="images/<?php echo $row['imageP']?>" class="rounded" width="100" height="100" alt="">
                    </th>
                    <td><?php  echo $row['namec']?></td>
                    <td><?php  echo $row['email'] ?></td>
                    <td><?php  echo $row['adresse'] ?></td>
                    <td>
                        <a href='admin_updateClt.php?edite=<?php echo $row['email'] ?>' class="btn btn-success">
                            <span class="fa fa-edit"></span>
                        </a>
                    </td>
                    <td>
                        <a href='admin_deleteClt.php?remove=<?php echo $row['email'] ?>' class="btn btn-danger">
                            <span class="fa fa-remove"></span>
                        </a>
                    </td>

                </tr>

                <?php }?>

            </tbody>
        </table>
        </div>
    </div>
    
    <!-- swiper js -->
    <script src="https://unpkg.com/swiper@7/swiper-bundle.min.js"></script>

    <!-- js file -->
    <script src="./js/script.js"></script>
    <script src="./js/prodclt.js"></script>
</body>
</html>