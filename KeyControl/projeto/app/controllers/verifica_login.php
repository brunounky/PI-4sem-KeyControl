<?php
require '../controllers/db_conexao.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = :email";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':email', $email);
    
    try {
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($senha, $user['senha'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_name'] = $user['nome'];
            $_SESSION['user_email'] = $user['email'];
            header("Location: ../views/testelogin.php");
            exit();
        } else {
            echo "E-mail ou senha incorretos.";
        }
    } catch (PDOException $e) {
        echo "Erro ao acessar o banco de dados: " . $e->getMessage();
    }
} else {
    header("Location: ../views/login_controllers.html");
    exit();
}
?>
