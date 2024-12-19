<?php
session_start(); // Démarrer la session

// Inclusion de la connexion à la base de données
require '../includes/db.php'; // Connexion à la base

// Vérifier si l'utilisateur est administrateur
$isAdmin = isset($_SESSION['role']) && $_SESSION['role'] === 'administrateur';

// Récupération des informations de Laurent Astoul
$stmt = $pdo->prepare('SELECT * FROM users WHERE nom = :nom AND role = :role');
$stmt->execute(['nom' => 'Astoul', 'role' => 'directeur']);
$laurent = $stmt->fetch(PDO::FETCH_ASSOC);

// Mise à jour des informations si un administrateur soumet le formulaire
if ($isAdmin && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $fieldToUpdate = $_POST['field'] ?? null;
    $updatedValue = $_POST['value'] ?? null;

    if ($fieldToUpdate && $updatedValue) {
        $stmtUpdate = $pdo->prepare("UPDATE users SET $fieldToUpdate = :value WHERE id = :id");
        $stmtUpdate->execute(['value' => $updatedValue, 'id' => $laurent['id']]);

        // Rafraîchir les données après la mise à jour
        $laurent[$fieldToUpdate] = $updatedValue;
    }
}
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&display=block">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .container {
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 400px;
            text-align: center;
        }

        h2 {
            color: #333;
            font-size: 22px;
            margin-bottom: 15px;
        }

        p {
            font-size: 16px;
            color: #555;
            margin: 10px 0;
        }

        form {
            margin-top: 20px;
        }

        input[type="text"], input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }

        input[type="submit"] {
            background: #007bff;
            color: white;
            border: none;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background: #0056b3;
        }

        a {
            text-decoration: none;
            color: #007bff;
            margin-top: 10px;
            display: inline-block;
        }

        a:hover {
            color: #0056b3;
        }
    </style>
    <title>Contact - Laurent Astoul</title>
</head>

<body>
    <div class="container">
        <h2>Contact - Laurent Astoul</h2>

        <!-- Affichage et modification du Nom -->
        <p><strong>Nom :</strong> 
            <?php if ($isAdmin && isset($_POST['edit']) && $_POST['edit'] === 'nom'): ?>
                <form method="post">
                    <input type="text" name="value" value="<?php echo htmlspecialchars($laurent['nom']); ?>">
                    <input type="hidden" name="field" value="nom">
                    <input type="submit" value="Enregistrer">
                </form>
            <?php else: ?>
                <?php echo htmlspecialchars($laurent['nom']); ?>
                <?php if ($isAdmin): ?>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="edit" value="nom">
                        <input type="submit" value="Modifier">
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </p>

        <!-- Affichage et modification du Rôle -->
        <p><strong>Rôle :</strong> 
            <?php if ($isAdmin && isset($_POST['edit']) && $_POST['edit'] === 'role'): ?>
                <form method="post">
                    <input type="text" name="value" value="<?php echo htmlspecialchars($laurent['role']); ?>">
                    <input type="hidden" name="field" value="role">
                    <input type="submit" value="Enregistrer">
                </form>
            <?php else: ?>
                <?php echo htmlspecialchars($laurent['role']); ?>
                <?php if ($isAdmin): ?>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="edit" value="role">
                        <input type="submit" value="Modifier">
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </p>

        <!-- Affichage et modification de l'Email -->
        <p><strong>Email :</strong> 
            <?php if ($isAdmin && isset($_POST['edit']) && $_POST['edit'] === 'mail'): ?>
                <form method="post">
                    <input type="text" name="value" value="<?php echo htmlspecialchars($laurent['mail']); ?>">
                    <input type="hidden" name="field" value="mail">
                    <input type="submit" value="Enregistrer">
                </form>
            <?php else: ?>
                <?php echo htmlspecialchars($laurent['mail']); ?>
                <?php if ($isAdmin): ?>
                    <form method="post" style="display:inline;">
                        <input type="hidden" name="edit" value="mail">
                        <input type="submit" value="Modifier">
                    </form>
                <?php endif; ?>
            <?php endif; ?>
        </p>

        <a href="page_accueil.php">Retour à l'accueil</a>
    </div>
</body>

</html>
