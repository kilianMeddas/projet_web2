<?php
session_start(); // Démarre la session
require '../includes/db.php'; // Connexion à la base


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Requête pour trouver l'utilisateur dans la base
    $stmt = $pdo->prepare('SELECT * FROM users WHERE username = :username');
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    
    #var_dump($user); // Ajoute ceci pour déboguer
    #exit;



    echo $username;
    echo $password;

        if ($user && $password === $user['password']) {
            session_start(); // Démarre la session
            $_SESSION['username'] = $username; // Stocke le nom d'utilisateur
    
        // Redirige vers dashboard.php
            header('Location: dashboard.php');
            exit;
        } else {
            echo "Identifiants incorrects.";
        }
    
}
?>

<!DOCTYPE html>
<html lang="fr">    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Connexion</h1>
    <form method="POST" action="login.php">
    <label for="username">Nom d'utilisateur :</label>
    <input type="text" id="username" name="username" required>
    <br>
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>
    <br>
    <button type="submit">Se connecter</button>
</form>

</body>
</html>
