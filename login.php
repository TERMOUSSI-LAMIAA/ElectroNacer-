<?php
session_start();
include 'db.php';




if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        // Update column names in the query
        $query = "SELECT * FROM utilisateur WHERE username = :username AND psword = :password";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $password);
        $stmt->execute();

        if ($stmt->rowCount() == 1) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $username;

            header("Location: index.php");
            exit();
        } else {
            echo "Invalid username or password.";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

    $pdo = null;
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
        <h2>Login</h2>
        <form class="login-form" action="" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="username">

            <label for="password">Password:</label>
            <input type="password" id="password" name="password">

            <button type="submit" name="login">Login</button>
        </form>
    </div>






</body>

</html>