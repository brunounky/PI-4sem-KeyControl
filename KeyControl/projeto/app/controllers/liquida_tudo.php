<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: verifica_login.php");
    exit();
}

require '../controllers/db_conexao.php';

$registro_imovel = $_GET['registro_imovel'] ?? '';
$data_inicial = $_GET['data_inicial'] ?? '';
$data_final = $_GET['data_final'] ?? '';

if (empty($registro_imovel) || empty($data_inicial) || empty($data_final)) {
    echo "<script>alert('Todos os filtros devem ser preenchidos.'); window.history.back();</script>";
    exit();
}

try {
    $sql = "UPDATE lancamento_financeiro 
            SET liquidado = 'Liquidado' 
            WHERE registro_imovel = :registro_imovel 
              AND data_emissao BETWEEN :data_inicial AND :data_final";

    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':registro_imovel', $registro_imovel, PDO::PARAM_STR);
    $stmt->bindParam(':data_inicial', $data_inicial, PDO::PARAM_STR);
    $stmt->bindParam(':data_final', $data_final, PDO::PARAM_STR);

    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        echo "<script>alert('Lançamentos atualizados com sucesso!'); window.location.href='../views/lista_fechamento.php';</script>";
    } else {
        echo "<script>alert('Nenhum lançamento encontrado para os filtros aplicados.'); window.history.back();</script>";
    }
} catch (PDOException $e) {
    echo "<script>alert('Erro ao atualizar os lançamentos: " . $e->getMessage() . "'); window.history.back();</script>";
}
