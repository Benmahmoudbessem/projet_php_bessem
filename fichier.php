<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "centre";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['name'];
    $email = $_POST['email'];
    $formation = $_POST['formation'];
    $user_id = $_SESSION['user_id'];

    $stmt = $conn->prepare("INSERT INTO inscription (nom, email, formation, user_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $nom, $email, $formation, $user_id);

    if ($stmt->execute()) {
        echo "Inscription réussie !";
    } else {
        echo "Erreur: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Inscription</h2>
    <form method="post" action="fichier.php">
        <label for="name">Nom:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="formation">Formation:</label>
        <select id="formation" name="formation" required>
            <option value="dev web">Développement Web</option>
            <option value="marketing">Marketing Digital</option>
            <option value="java">java</option>
            <option value="anglais">anglais</option>
            <option value="francais">francais/option>
        </select><br>
        <button type="submit">S'inscrire</button>
    </form>
</body>

</html>