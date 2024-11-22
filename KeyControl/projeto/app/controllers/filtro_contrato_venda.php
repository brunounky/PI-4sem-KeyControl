<?php 
include '../app/controllers/db_conexao.php';

$result = null; 

function buildQuery($contrato_id, $nome, $tipo_imovel, $forma_pagamento) {
    $sql = "
        SELECT DISTINCT 
            cv.id AS contrato_id,
            cv.comprador_nome,
            cc.nome AS comprador_nome_completo,
            cc.cpf_cnpj AS comprador_cpf_cnpj,
            ci.cpf_cnpj_proprietario AS cpf_cnpj_proprietario,
            pc.nome AS nome_proprietario,
            cv.forma_pagamento
        FROM 
            contrato_venda cv
        JOIN 
            cadastro_cliente cc ON cv.comprador_cpf_cnpj = cc.cpf_cnpj 
        JOIN 
            cadastro_imovel ci ON cv.imovel_proprietario_cpf_cnpj = ci.cpf_cnpj_proprietario 
        JOIN 
            cadastro_cliente pc ON ci.cpf_cnpj_proprietario = pc.cpf_cnpj
        WHERE 
            1=1";

    if (!empty($contrato_id)) {
        $sql .= " AND cv.id = :contrato_id"; 
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
$tipo_imovel = $_POST['tipo_imovel'] ?? '';
$forma_pagamento = $_POST['forma_pagamento'] ?? '';

$contrato_id = htmlspecialchars($contrato_id);
$nome = htmlspecialchars($nome);
$tipo_imovel = htmlspecialchars($tipo_imovel);
$forma_pagamento = htmlspecialchars($forma_pagamento);

$sql = buildQuery($contrato_id, $nome, $tipo_imovel, $forma_pagamento);

try {
    $stmt = $pdo->prepare($sql);
    if (!empty($contrato_id)) {
        $stmt->bindParam(':contrato_id', $contrato_id);
    }
    if (!empty($nome)) {
        $nome = "%$nome%";
        $stmt->bindParam(':nome', $nome);
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
