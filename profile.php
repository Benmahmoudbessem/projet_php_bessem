<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$profile_pic = $_SESSION['profile_pic'];
?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Profile</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <h2>Profile</h2>
    <img src="<?php echo htmlspecialchars($profile_pic); ?>" alt="Profile Picture" style="width:150px;height:150px;"><br>
    <p>Bienvenue sur votre profil cliquer sur retourner a la page d'acceil pour continuer votre inscription ou logout pour déconnécté merci ! </p>
    <a href="index.html">Retour à la page d'accueil</a><br>
    <form method="post" action="logout.php">
        <br> <button type="submit">Logout</button>
    </form>
</body>

</html>