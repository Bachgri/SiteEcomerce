<!DOCTYPE html>
<html lang="en">
    <?php

    @include('./includes/connexion.php');
    $conn = connect();
    $ref = $_GET['edite'];
    $sql = "SELECT * FROM produits WHERE Ref = '$ref'";
    $rep = mysqli_query($conn, $sql);
    $d = $rep->fetch_assoc();
    $categ = $d['Categorie'];
    $desi = $d['Designation'];
    $prx = $d['prix'];
    $quant = $d['qtt'];
    $img = $d['images'];





    if(isset($_POST['edite_product'])){
        $designation = $_POST['Designation'];
        $prix = $_POST['prix'];
        $qtt = $_POST['qtt'];
        $image = $_FILES['image']['name'];
        $image_tmp_name = $_FILES['image']['tmp_name'];
        $image_folder = 'product_pecture/'.$image;

        if( empty($designation) || empty($prix) || empty($qtt) || empty($image) ){
            $message[] = "Tous les champs sont opligatoires";
        }else{
            $sql ="UPDATE produits set Designation ='$designation', prix='$prix', qtt ='$qtt', images = '$image' WHERE Ref = '$ref' ";
            $upload = mysqli_query($conn, $sql);
            if($upload){
                move_uploaded_file($image_tmp_name,$image_folder);
                header('location:./gestionProduit.html.php');
            }else{
                $message[] = "Erreur Produit n'est pas Modifier ".mysqli_error($conn);
            }
        }
    }

    ?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update </title>
    <link rel="stylesheet" href="./bootstrap/css/bootstrap.css">
</head>
<body>
<div class="container">
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
                <h3>Modifier un produit</h3>
                <label for="reference">Reférence de produit</label>
                <input type="text" value="<?php if(isset($ref)) echo $ref;  ?>" name="ref" disabled placeholder="Reference du produit" class="form-control" id="reference" value="<?php echo $_GET['edite']?>">
                <label for="des">Designation </label>
                <textarea name="Designation" id="des" cols="10" rows="1" class="form-control" > <?php if(isset($desi)) echo $desi;  ?></textarea>
                <label for="prix">Prix</label>
                <input type="text" name="prix" value="<?php if(isset($prx)) echo $prx;  ?>" placeholder="Prix du produit" class="form-control" id="prix">
                <label for="qtt">Quantite</label>
                <input type="text" name="qtt" value="<?php if(isset($quant)) echo $quant;  ?>" placeholder="quantité du produit" class="form-control" id="qtt">
                
                <div class="row" >
                    <div class="col-sm-6">
                        <label for="qtt">image</label>
                        <input type="file" name="image" value="<?php if(isset($img)) echo $img; else echo 'no one'  ?>" placeholder="image du produit" class="form-control" id="qtt" accept="image/png, image/jpg, image/jpeg">
                    </div>
                    <div class="col-sm-6">
                    <label for="qtt">image hover</label>
                        <input type="file" name="image" value="<?php if(isset($img)) echo $img; else echo 'no one'  ?>" placeholder="image du produit" class="form-control" id="qtt" accept="image/png, image/jpg, image/jpeg">
                    </div>
                </div>
                <br>
                <input type="submit" value="Modifier" name="edite_product" id="" value="Modifier" class="btn btn-success form-control">

            </form>
        </div>
</div>

</body>
</html>