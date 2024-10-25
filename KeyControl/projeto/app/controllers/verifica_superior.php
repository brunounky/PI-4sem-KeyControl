<?php
require '../controllers/db_conexao.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;

    if (!empty($email) && !empty($senha)) {
        $sql = "SELECT * FROM superior WHERE email = :email";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':email', $email);
        
        try {
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($senha, $user['senha'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['nome'];
                $_SESSION['user_email'] = $user['email'];

                header('Location: ../../views/home_superior.php');
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
    header('Location: ../../views/login.html');
    exit();
}
?>
