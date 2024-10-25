<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['admin_id'])) {
    header("Location: login_admin.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Página Inicial do Administrador</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Bem-vindo, <?php echo htmlspecialchars($_SESSION['admin_nome']); ?>!</h1>
        <p>Você está autenticado como administrador.</p>
        <a href="logout.php" class="btn btn-danger">Sair</a>
    </div>
</body>
</html>
