<?php
session_start();
include 'db.php';




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        $query = "SELECT * FROM utilisateur WHERE username = :username AND psword = :password";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            header("Location: index.php");
            exit();//Arrête l'exécution du script.
        } 
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $pdo = null;// Ferme la connexion PDO à la base de données.
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>ElectroNacer-login</title>
</head>

<body class="body-login">
    <div>

        <form class="login-form" action="" method="post">
            <h2>Login</h2>
            <p>Please fill out this form to log into your account!</p>
            <hr>

            <label for="username">Username:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            <!-- Error Message Section -->
            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                if ($stmt->rowCount() !== 1) {
                    echo '<span style="color: #d9534f; font-size: 14px;">Invalid username or password.</span>';
                }
            }
            ?>
            <button type="submit" name="login">Login</button>
        </form>
    </div>






</body>

</html>