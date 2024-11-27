<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

require '../controllers/db_conexao.php';

$registro_imovel = $_GET['registro_imovel'] ?? '';
$data_inicial = $_GET['data_inicial'] ?? '';
$data_final = $_GET['data_final'] ?? '';

if (empty($registro_imovel) || empty($data_inicial) || empty($data_final)) {
    header("Location: ../../views/lista_fechamento.php");
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

    header("Location: ../../views/lista_fechamento.php");
    exit();
} catch (PDOException $e) {
    header("Location: ../../views/lista_fechamento.php");
    exit();
}
