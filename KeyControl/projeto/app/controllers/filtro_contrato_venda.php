<?php 
include '../app/controllers/db_conexao.php';

$result = null; 

function buildQuery($contrato_id, $nome, $vigencia, $dia_pagamento, $tipo_imovel, $forma_pagamento) {
    $sql = "
    SELECT 
        cv.id AS contrato_id,
        cc.nome AS locatario_nome,
        cc.cpf_cnpj,
        cv.data_vigencia,
        cv.data_pagamento_compra,
        cv.forma_pagamento
    FROM 
        contrato_venda cv
    JOIN 
        cadastro_cliente cc ON cv.id_locatario = cc.id
    JOIN 
        cadastro_imovel ci ON cv.id_imovel = ci.id
    WHERE 1=1"; 

    if (!empty($contrato_id)) {
        $sql .= " AND ci.contrato_id = :contrato_id"; 
    }
    if (!empty($nome)) {
        $sql .= " AND cc.nome LIKE :nome"; 
    }
    if (!empty($vigencia)) {
        $sql .= " AND cv.data_vigencia = :vigencia"; 
    }
    if (!empty($dia_pagamento)) {
        $sql .= " AND cv.data_pagamento_compra = :dia_pagamento"; 
    }
    if (!empty($tipo_imovel)) {
        $sql .= " AND ci.tipo_imovel = :tipo_imovel"; 
    }
    if (!empty($forma_pagamento)) {
        $sql .= " AND cv.forma_pagamento = :forma_pagamento"; 
    }

    return $sql;
}

$contrato_id = $_POST['contrato_id'] ?? '';
$nome = $_POST['nome'] ?? '';
$vigencia = $_POST['vigencia'] ?? '';
$dia_pagamento = $_POST['dia_pagamento'] ?? '';
$tipo_imovel = $_POST['tipo_imovel'] ?? '';
$forma_pagamento = $_POST['forma_pagamento'] ?? '';

$contrato_id = htmlspecialchars($contrato_id);
$nome = htmlspecialchars($nome);
$vigencia = htmlspecialchars($vigencia);
$dia_pagamento = htmlspecialchars($dia_pagamento);
$tipo_imovel = htmlspecialchars($tipo_imovel);
$forma_pagamento = htmlspecialchars($forma_pagamento);

$sql = buildQuery($contrato_id, $nome, $vigencia, $dia_pagamento, $tipo_imovel, $forma_pagamento);

try {
    $stmt = $pdo->prepare($sql);

    if (!empty($contrato_id)) {
        $stmt->bindParam(':contrato_id', $contrato_id);
    }
    if (!empty($nome)) {
        $nome = "%$nome%";
        $stmt->bindParam(':nome', $nome);
    }
    if (!empty($vigencia)) {
        $stmt->bindParam(':vigencia', $vigencia);
    }
    if (!empty($dia_pagamento)) {
        $stmt->bindParam(':dia_pagamento', $dia_pagamento);
    }
    if (!empty($tipo_imovel)) {
        $stmt->bindParam(':tipo_imovel', $tipo_imovel);
    }
    if (!empty($forma_pagamento)) {
        $stmt->bindParam(':forma_pagamento', $forma_pagamento);
    }

    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo "Erro na execução da consulta: " . htmlspecialchars($e->getMessage());
}
?>
