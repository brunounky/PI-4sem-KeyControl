<?php
require '../controllers/db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cpf_cnpj = $_POST['cpf_cnpj'] ?? null;

    if (!$cpf_cnpj) {
        echo json_encode(['error' => 'CPF/CNPJ não fornecido']);
        exit();
    }
    $cpf_cnpj = preg_replace('/\D/', '', $cpf_cnpj);

    try {
        $stmt = $pdo->prepare("SELECT * FROM cadastro_cliente WHERE cpf_cnpj = :cpf_cnpj");
        $stmt->bindParam(':cpf_cnpj', $cpf_cnpj);
        $stmt->execute();

        $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($cliente) {
            echo json_encode($cliente);
        } else {
            echo json_encode(['error' => 'Cliente não encontrado']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erro no banco de dados: ' . $e->getMessage()]);
    }
}
