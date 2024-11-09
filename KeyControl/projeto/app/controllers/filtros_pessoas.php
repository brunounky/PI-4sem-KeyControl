<?php 
include '../app/controllers/db_conexao.php'; 
$result = null; 

function buildQuery($id, $nome, $cpf_cnpj, $telefone, $estado_civil, $cidade, $categoria) {
    $sql = "SELECT * FROM cadastro_cliente WHERE 1=1"; 
    $params = []; 

    if (!empty($id)) {
        $sql .= " AND id = :id";
        $params['id'] = $id;
    }

    if (!empty($nome)) {
        $sql .= " AND nome LIKE :nome";
        $params['nome'] = "%$nome%"; 
    }

    if (!empty($cpf_cnpj)) {
        $sql .= " AND cpf_cnpj = :cpf_cnpj";
        $params['cpf_cnpj'] = $cpf_cnpj;
    }

    if (!empty($telefone)) {
        $sql .= " AND telefone LIKE :telefone";
        $params['telefone'] = "%$telefone%";
    }

    if (!empty($estado_civil)) {
        $sql .= " AND estado_civil LIKE :estado_civil";
        $params['estado_civil'] = "%$estado_civil%";
    }

    if (!empty($cidade)) {
        $sql .= " AND cidade LIKE :cidade";
        $params['cidade'] = "%$cidade%";
    }

    if (!empty($categoria)) {
        $allowedCategories = ['locador', 'locatario', 'fiador','comprador'];
        if (in_array($categoria, $allowedCategories)) {
            $sql .= " AND $categoria = 1";
        } else {
            $categoria = '';
        }
    }

    return [$sql, $params];
}

$id = $_POST['id'] ?? '';
$nome = $_POST['nome'] ?? '';
$cpf_cnpj = $_POST['cpf_cnpj'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$estado_civil = $_POST['estado_civil'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$categoria = $_POST['categoria'] ?? ''; 

list($sql, $params) = buildQuery($id, $nome, $cpf_cnpj, $telefone, $estado_civil, $cidade, $categoria);

if (isset($pdo) && $pdo) {
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    } catch (Exception $e) {
        echo "Erro na execução da consulta: " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "Erro na conexão com o banco de dados.";
}
?>