<?php
require '../controllers/db_conexao.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'] ?? null;
    $senha = $_POST['senha'] ?? null;

    if (!empty($email) && !empty($senha)) {
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
                $_SESSION['user_datanasc'] = $user['data_nasc'];
                $_SESSION['user_estadocivil'] = $user['estado_civil']; 
                $_SESSION['user_cpf'] = $user['cpf']; 
                $_SESSION['user_rg'] = $user['rg']; 
                $_SESSION['user_cargo'] = $user['cargo']; 
                $_SESSION['user_nacionalidade'] = $user['nacionalidade']; 
                $_SESSION['user_telefone'] = $user['telefone']; 
                $_SESSION['user_telefonereserva'] = $user['telefone_reserva']; 
                $_SESSION['user_cep'] = $user['cep']; 
                $_SESSION['user_rua'] = $user['rua']; 
                $_SESSION['user_numero'] = $user['numero']; 
                $_SESSION['user_bairro'] = $user['bairro']; 
                $_SESSION['user_cidade'] = $user['cidade']; 
                $_SESSION['user_estado'] = $user['estado']; 
                $_SESSION['user_pais'] = $user['pais']; 
                $_SESSION['user_idimobiliaria'] = $user['id_imobiliaria'];

                header('Location: ../../views/home.php');
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
