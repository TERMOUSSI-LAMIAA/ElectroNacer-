<?php 
session_start();
include 'db.php';



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <title>Document</title>
</head>

<body class="body-home">
    <nav>
        <img src="assets/imgs/logo.png" alt="logo" height="60" width="300">
        <div>
            <p>+212601020304</p>
            <p>electro_nacer@gmail.com</p>
        </div>
    </nav>
    <section>
        <div class="sidebar">
            <p class="active" id="tousLesProduits">Tous les produits</p>

            <button class="dropdown-btn" onclick="toggleDropdown()">Catégories de produits
                <i class="fa fa-caret-down"></i>
            </button>
            <div class="dropdown-container">
                <p>Categorie 1</p>
                <p>Categorie 2</p>
                <p>Categorie 3</p>
            </div>
            <p>Les produits en rupture de stock</p>
        </div>

        <div class="main-content" id="productList">
            <?php 
              $query="SELECT * FROM produit";
              $statement=$pdo->prepare($query);
              $statement->execute();
              $result=$statement->fetchAll();
              if($result){
                    foreach($result as $row){
                        ?>
                            <div class="product">
                                <img src="data:image/jpg;base64,<?= base64_encode($row['image']) ?>" alt="Product Image" width="300" height="300">
                                <p>Libelle:<?= $row['libelle'] ?></p>
                                <p>Reference:<?= $row['ref_prod'] ?></p>
                                <p>Prix unitaire:<?= $row['pru'] ?></p>
                                <p>Quantité minimale:<?= $row['qte_min'] ?></p>
                                <p>Quantité stock:<?= $row['qte_stock'] ?></p>
                            </div>
                            
                        <?php
                    }
                }
              else{
                ?>
                <p>no record found</p>
                <?php
              }
            ?>
        </div>
    </section>










    <script src="assets/js/main.js"></script>
</body>

</html>