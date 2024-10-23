<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

require '../controllers/db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'atualizar') {
    $nome = $_POST['nome'];
    $cpf = $_POST['cpf'];
    $telefone = $_POST['telefone'];
    $telefone_reserva = $_POST['telefone_reserva'];
    $email = $_POST['email'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $numero = $_POST['numero'];
    $rg = $_POST['rg'];
    $nacionalidade = $_POST['nacionalidade'];
    $estado_civil = $_POST['estado_civil'];
    $cargo = $_POST['cargo'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $pais = $_POST['pais'];
    $userId = $_SESSION['user_id'];

    try {
        $stmt = $pdo->prepare("
            UPDATE usuarios 
            SET nome = :nome,
                cpf = :cpf,
                telefone = :telefone,
                telefone_reserva = :telefone_reserva,
                email = :email,
                cep = :cep,
                rua = :rua,
                numero = :numero,
                rg = :rg,
                nacionalidade = :nacionalidade,
                estado_civil = :estado_civil,
                cargo = :cargo,
                bairro = :bairro,
                cidade = :cidade,
                estado = :estado,
                pais = :pais
            WHERE id = :id
        ");
        
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':telefone_reserva', $telefone_reserva);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':rg', $rg);
        $stmt->bindParam(':nacionalidade', $nacionalidade);
        $stmt->bindParam(':estado_civil', $estado_civil);
        $stmt->bindParam(':cargo', $cargo);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':pais', $pais);
        $stmt->bindParam(':id', $userId);

        $stmt->execute();

        header("Location: ../../views/perfil.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao atualizar os dados: " . $e->getMessage();
        exit();
    }
}
?>
