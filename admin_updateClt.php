<?php
     
    @include('./includes/connexion.php');
    $conn = connect();
    $emailo = $_GET['edite'];
    $sql = "SELECT * FROM client WHERE email = '$emailo'";
    $rep = mysqli_query($conn, $sql);
    $d = $rep->fetch_assoc();
    $nameco = $d['namec'];
    $passo = $d['pass'];
    $repasso = $d['pass'];
    $adresseo = $d['adresse'];





    if(isset($_POST['edite_client'])){
        $namec = $_POST['name'];
        $email = $_POST['email'];
        $pass = $_POST['pass'];$pass= md5($pass);
        $repass = $_POST['repass'];$repass = md5($repass);
        $adresse = $_POST['adresse'];
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'images/profiles/'.$image;
        if( empty($namec) || empty($email) || empty($adresse) || empty($pass) || empty($repass) ){
            $message[] = "Tous les champs sont opligatoires";
        }else{
            echo "here";
            if($pass == $repass){
                $sql ="UPDATE client set namec = '$namec', email = '$email', pass = '$pass', adresse ='$adresse', imageP = '$image' WHERE email = '". $_GET['edite'] ."' ";
                $upload = mysqli_query($conn, $sql);
                echo $sql;
                if($upload){
                    move_uploaded_file($image_tmp_name,$image_folder);
                    header('location:./gestionProduit.html.php');
                }else{
                    $message[] = "Erreur client n'est pas Modifier ".mysqli_error($conn);
                }
            }else{
                echo "non";
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
    <title>Document</title>
    
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
</head>
<body>
<div class="container clients displayed register" id="clients">
        <div>
            <form action="" method="post" enctype="multipart/form-data">
                <h3>Modifier un client</h3>
                <input type="text" name="name" placeholder="enter your name" id="" class="box" value="<?php echo $nameco ?>" >
                <input type="email" name="email" placeholder="enter your email" id="" class="box" value="<?php echo $emailo ?>" >
                <input type="text" name="adresse" placeholder="enter your adresse" id="" class="box" value="<?php echo $adresseo ?>" >
                <input type="password" name="pass" placeholder="enter your password" id="" class="box" value="<?php echo $passo ?>" >
                <input type="password" name="repass" placeholder="re-enter your password" id="" class="box" value="<?php echo $repasso ?>" >
                <input type="file" name="image" id="" class="box form-control" accept="image/png, image/jpg, image/jpeg">
                <p style="color: #EF4122;"> <?php if(isset($messages)) echo "$messages"; ?> </p>
                <input type="submit" name="edite_client" class="btn btn-info " value="Modifier" >
            </form>
        </div>
       
        
    </div>
</body>
</html>