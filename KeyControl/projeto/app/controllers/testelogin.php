<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login_controllers.html"); 
    exit();
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bem-vindo, <?php echo $_SESSION['user_name']; ?>!</title>
</head>
<body>
    <h2>Bem-vindo, <?php echo $_SESSION['user_name']; ?>!</h2>
    <p>E-mail: <?php echo $_SESSION['user_email']; ?></p>
    <p><a href="logout.php">Sair</a></p>
</body>
</html>
