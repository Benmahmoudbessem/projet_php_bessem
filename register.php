<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "centre";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $uploadDir = __DIR__ . '/uploads/';
    $uploadFile = $uploadDir . basename($_FILES['profilePic']['name']);
    $imageURL = '';

    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
    if (in_array($_FILES['profilePic']['type'], $allowedTypes) && move_uploaded_file($_FILES['profilePic']['tmp_name'], $uploadFile)) {
        $imageURL = 'uploads/' . basename($_FILES['profilePic']['name']);
    } else {
        echo "Erreur lors du téléchargement de l'image.";
        exit;
    }

    $stmt = $conn->prepare("INSERT INTO user (username, password, profile_pic) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $password, $imageURL);

    if ($stmt->execute()) {
        echo "User registered successfully! welcome!!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Register</h2>
    <form method="post" action="register.php" enctype="multipart/form-data">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="profilePic">Profile Picture:</label>
        <input type="file" id="profilePic" name="profilePic" accept="image/*" required><br>
        <button type="submit">Register</button>
    </form>
</body>

</html>