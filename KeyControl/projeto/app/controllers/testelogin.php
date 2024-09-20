<?php

echo "sw";

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resultado do Login</title>
    <link rel="stylesheet" href="styles.css"> <!-- Link para CSS, se necessário -->
</head>
<body>
    <h1><?php echo htmlspecialchars($mensagem); ?></h1>
    <p>Bem-vindo, <?php echo htmlspecialchars($_SESSION['user_name']); ?>!</p>
    
    <h2>Links para outras páginas:</h2>
    <ul>
        <li><a href="views/pagina1.php">Página 1</a></li>
        <li><a href="views/pagina2.php">Página 2</a></li>
        <li><a href="views/pagina3.php">Página 3</a></li>
    </ul>

    <p><a href="logout.php">Sair</a></p> <!-- Link para sair -->
</body>
</html>
