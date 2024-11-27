<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: verifica_login.php");
    exit();
}

require '../controllers/db_conexao.php';

$id_lancamento = $_GET['id'] ?? '';

if (empty($id_lancamento)) {
    header("Location: ../../views/lista_fechamento.php");
    exit();
}

try {
    $sql = "UPDATE lancamento_financeiro 
            SET liquidado = 'Liquidado' 
            WHERE id_lancamento = :id_lancamento";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id_lancamento', $id_lancamento, PDO::PARAM_INT);
    $stmt->execute();

    header("Location: ../../views/lista_fechamento.php");
    exit();
} catch (PDOException $e) {
    echo "<script>alert('Erro ao atualizar o lançamento: " . $e->getMessage() . "'); window.history.back();</script>";
}
