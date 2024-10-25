<?php
require '../controllers/db_conexao.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email_admin = $_POST['email_admin'] ?? null;
    $senha_admin = $_POST['senha_admin'] ?? null;

    if (!empty($email_admin) && !empty($senha_admin)) {
        $sql = "SELECT * FROM usuarios_admin WHERE email_admin = :email_admin";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email_admin', $email_admin);
        
        try {
            $stmt->execute();
            $usuarios_admin = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($usuarios_admin && password_verify($senha_admin, $admin['senha_admin'])) {
                $_SESSION['admin_id'] = $admin['id_admin'];
                $_SESSION['admin_name'] = $admin['nome_admin'];
                $_SESSION['admin_email'] = $admin['email_admin'];

                header('Location: ../../views/home_admin.php');
                exit();
            } else {
                echo "E-mail ou senha incorretos.";
            }
        } catch (PDOException $e) {
            error_log("Erro ao acessar o banco de dados: " . $e->getMessage());
            echo "Erro ao acessar o banco de dados.";
        }
    } else {
        echo "Por favor, preencha todos os campos.";
    }
} else {
    header('Location: ../../views/login_admin.html');
    exit();
}
