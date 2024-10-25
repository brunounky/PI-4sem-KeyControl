<?php 
include '../app/controllers/db_conexao.php'; 
$result = null; 

function buildQuery($cnpj, $nome_fantasia, $endereco, $numeroimobiliaria, $cepimobiliaria, $cidadeimobiliaria, $telefoneimobiliaria, $emailimobiliaria) {
    $sql = "SELECT * FROM imobiliaria WHERE 1=1"; 
    $params = []; 

    if (!empty($cnpj)) {
        $sql .= " AND cnpj = :cnpj";
        $params['cnpj'] = $cnpj;
    }

    if (!empty($nome_fantasia)) {
        $sql .= " AND nome_fantasia LIKE :nome_fantasia";
        $params['nome_fantasia'] = "%$nome_fantasia%"; 
    }

    if (!empty($endereco)) {
        $sql .= " AND endereco LIKE :endereco";
        $params['endereco'] = "%$endereco%";
    }

    if (!empty($numeroimobiliaria)) {
        $sql .= " AND numeroimobiliaria = :numeroimobiliaria";
        $params['numeroimobiliaria'] = $numeroimobiliaria;
    }

    if (!empty($cepimobiliaria)) {
        $sql .= " AND cepimobiliaria LIKE :cepimobiliaria";
        $params['cepimobiliaria'] = "%$cepimobiliaria%";
    }

    if (!empty($cidadeimobiliaria)) {
        $sql .= " AND cidadeimobiliaria LIKE :cidadeimobiliaria";
        $params['cidadeimobiliaria'] = "%$cidadeimobiliaria%";
    }

    if (!empty($telefoneimobiliaria)) {
        $sql .= " AND telefoneimobiliaria = :telefoneimobiliaria";
        $params['telefoneimobiliaria'] = $telefoneimobiliaria;
    }

    if (!empty($emailimobiliaria)) {
        $sql .= " AND emailimobiliaria LIKE :emailimobiliaria";
        $params['emailimobiliaria'] = "%$emailimobiliaria%";
    }

    return [$sql, $params];
}

$cnpj = $_POST['cnpj'] ?? '';
$nome_fantasia = $_POST['nome_fantasia'] ?? '';
$endereco = $_POST['endereco'] ?? '';
$numeroimobiliaria = $_POST['numeroimobiliaria'] ?? '';
$cepimobiliaria = $_POST['cepimobiliaria'] ?? '';
$cidadeimobiliaria = $_POST['cidadeimobiliaria'] ?? '';
$telefoneimobiliaria = $_POST['telefoneimobiliaria'] ?? '';
$emailimobiliaria = $_POST['emailimobiliaria'] ?? ''; 

list($sql, $params) = buildQuery($cnpj, $nome_fantasia, $endereco, $numeroimobiliaria, $cepimobiliaria, $cidadeimobiliaria, $telefoneimobiliaria, $emailimobiliaria);

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
