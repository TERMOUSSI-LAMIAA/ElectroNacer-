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
        <div class="logo">
            <img src="assets/imgs/logo1.png" alt="logo" height="60" width="60">
            <p>ElectroNacer</p>
        </div>

        <div>
            <p>+212601020304</p>
            <p>electro_nacer@gmail.com</p>
        </div>
    </nav>
    <section class="wrapper">
        <div class="sidebar">

            <select id="categories" name="categories" onchange="filterProducts()">
                <option value="tout">Tout les produits</option>
                <option value="1">cartes de developpement</option>
                <option value="2">capteurs</option>
                <option value="3">composants electroniques</option>
            </select>

            <a href="?showOutOfStock=true">Les produits en rupture de stock</a>
            <a href="logout.php">Déconnexion</a>
        </div>

        <div class="main-content" id="productList">
            <?php
            $query = "SELECT * FROM produit";
            $statement = $pdo->prepare($query);
            $statement->execute();
            $result = $statement->fetchAll();

            $showOutOfStock = isset($_GET['showOutOfStock']);

            if ($showOutOfStock) {
                $outOfStockProducts = array_filter($result, function ($row) {
                    return $row['qte_stock'] <= $row['qte_min'];
                });
                if (!empty($outOfStockProducts)) {
                    foreach ($outOfStockProducts as $row) {
                        ?>
                        <div class="product category-<?= $row['fk_idCat'] ?>">
                            <img src="data:image/jpg;base64,<?= base64_encode($row['image']) ?>" alt="Product Image" width="300"
                                height="300">
                            <p>Libelle:
                                <?= $row['libelle'] ?>
                            </p>
                            <p>Reference:
                                <?= $row['ref_prod'] ?>
                            </p>
                            <p>Prix unitaire:
                                <?= $row['pru'] ?>
                            </p>
                            <p>Quantité stock:
                                <?= $row['qte_stock'] ?>
                            </p>
                        </div>

                        <?php
                    }
                } else {
                    ?>
                    <p>No out-of-stock products found</p>
                    <?php
                }
            } else {
                if ($result) {
                    foreach ($result as $row) {
                        ?>
                        <div class="product category-<?= $row['fk_idCat'] ?>">
                            <img src="data:image/jpg;base64,<?= base64_encode($row['image']) ?>" alt="Product Image" width="300"
                                height="300">
                            <p>Libelle:
                                <?= $row['libelle'] ?>
                            </p>
                            <p>Reference:
                                <?= $row['ref_prod'] ?>
                            </p>
                            <p>Prix unitaire:
                                <?= $row['pru'] ?>
                            </p>
                            <p>Quantité minimale:
                                <?= $row['qte_min'] ?>
                            </p>
                            <p>Quantité stock:
                                <?= $row['qte_stock'] ?>
                            </p>
                        </div>

                        <?php
                    }
                } else {
                    ?>
                    <p>no record found</p>
                    <?php
                }

            }





            ?>
        </div>
    </section>






    <footer style="color:white;background-color:rgb(3, 56, 26);text-align: center;
  padding: 10px;
  bottom: 0;
  width: 100%;">
        <p>copyright ElectroNAcer 2023</p>
    </footer>



    <script src="assets/js/main.js"></script>
</body>

</html>