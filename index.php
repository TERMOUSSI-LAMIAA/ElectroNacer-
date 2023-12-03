<?php
session_start();
include 'db.php';

// Handle different views based on the 'view' parameter
if (isset($_GET['view'])) {
    $view = $_GET['view'];

    switch ($view) {
        case 'all_products':
            // Fetch all products from the database
            $sql = "SELECT * FROM produit";
            break;
        case 'out_of_stock':
            // Fetch products with qte_stock less than 3
            $sql = "SELECT * FROM produit WHERE qte_stock <= qte_min";
            break;
        default:
            // Fetch products based on the selected category
            $category = $pdo->quote($view);
            $sql = "SELECT * FROM produit WHERE fk_idCat = (SELECT idCat FROM categorie WHERE nomCat = $category)";
            break;
    }

    $result = $pdo->query($sql);

    // Display the products
    if ($result->rowCount() > 0) {
        while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
            echo '<div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" class="card-img-top" alt="image">      
                        <div class="card-body">
                            <h5 class="card-title">' . $row["libelle"] . '</h5>
                            <p class="card-text">Ref prod: ' . $row["ref_prod"] . '</p>
                            <p class="card-text">PRIX UNITAIRE: ' . $row["pru"] . ' DH</p>
                            <p class="card-text">qte stock: ' . $row["qte_stock"] . '</p>
                        </div>
                    </div>
                </div>';
        }
    } else {
        echo '<div class="alert alert-info" role="alert" style=margin:60px ;>
        <strong>No electronic products found!</strong> 
      </div>';
    }
    // Stop further execution to prevent rendering the rest of the page
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Dashboard</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/css/style.css">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

</head>

<body>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
            <img src="assets/imgs/logo1.png" alt="Logo" height="40">
            ElectroNacer
        </a>
        <!-- Toggle Button -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Navigation Links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </nav>


    <div class="container-fluid">
        <div class="row">

            <!-- Sidebar -->
            <nav class="col-md-2 d-none d-md-block bg-dark sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link " href="#" data-view="all_products">
                                <i class="fas fa-home"></i> Tout les produits
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" data-view="out_of_stock">
                                <i class="fas fa-shopping-cart"></i> Rupture de stock
                            </a>
                        </li>
                        <?php
                        // Fetch categories from the database
                        $sql = "SELECT idCat,nomCat FROM categorie";
                        $result = $pdo->query($sql);

                        // Display categories in the sidebar
                        if ($result->rowCount() > 0) {
                            while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
                                echo '<li class="nav-item">
                                    <a class="nav-link" href="#" data-view="' . $row["nomCat"] . '">
                                        <i class="fas fa-users"></i> ' . $row["nomCat"] . '
                                    </a>
                                </li>';
                            }
                        }
                        ?>
                        <!-- Add more sidebar items as needed -->
                    </ul>
                </div>
            </nav>

            <!-- Main Content -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4" id="main-content">

            </main>

        </div>
    </div>

    <footer class="footer mt-auto py-3">
        <div class="container text-center">
            <p>&copy; 2023 ElectroNacer</p>
            <p><a href="#">Privacy Policy</a> | <a href="#">Terms of Service</a></p>
        </div>
    </footer>





    <!-- Font Awesome for icons -->
    <script src="https://kit.fontawesome.com/your-fontawesome-kit-id.js" crossorigin="anonymous"></script>
    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>



    <!-- Your custom JavaScript -->
    <script src="assets/js/main.js"></script>
</body>

</html>