<?php 
include '../app/controllers/db_conexao.php';

$result = null; 

function buildQuery($contrato_id, $nome, $imovel_taxa_venda, $data_emissao, $data_vencimento, $imovel_valor, $tipo_imovel, $forma_pagamento) {
    $sql = "
        SELECT DISTINCT 
            cv.id AS contrato_id,
            cv.comprador_nome,
            cv.imovel_taxa_venda,
            cv.data_emissao,
            cv.data_vencimento,
            cv.imovel_valor,
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
    if (!empty($imovel_taxa_venda)) {
        $sql .= " AND cv.imovel_taxa_venda = :imovel_taxa_venda"; 
    }
    if (!empty($data_emissao)) {
        $sql .= " AND cv.data_emissao = :data_emissao"; // Use "=" para comparação de datas
    }
    if (!empty($data_vencimento)) {
        $sql .= " AND cv.data_vencimento = :data_vencimento"; // Use "=" para comparação de datas
    }
    if (!empty($imovel_valor)) {
        $sql .= " AND cv.imovel_valor = :imovel_valor"; 
    }
    if (!empty($tipo_imovel)) {
        $sql .= " AND ci.tipo_imovel = :tipo_imovel"; 
    }
    if (!empty($forma_pagamento)) {
        $sql .= " AND cv.forma_pagamento = :forma_pagamento"; 
    }

    if (!empty($nome)) {
        $sql .= " AND (cc.nome LIKE :nome OR pc.nome LIKE :nome)";
    }

    return $sql;
}

$contrato_id = $_POST['contrato_id'] ?? '';
$nome = $_POST['nome'] ?? '';
$imovel_taxa_venda = $_POST['imovel_taxa_venda'] ?? '';
$data_emissao = $_POST['data_emissao'] ?? '';
$data_vencimento = $_POST['data_vencimento'] ?? '';
$imovel_valor = $_POST['imovel_valor'] ?? '';
$tipo_imovel = $_POST['tipo_imovel'] ?? '';
$forma_pagamento = $_POST['forma_pagamento'] ?? '';

$contrato_id = htmlspecialchars($contrato_id);
$nome = htmlspecialchars($nome);
$imovel_taxa_venda = htmlspecialchars($imovel_taxa_venda);
$data_emissao = htmlspecialchars($data_emissao);
$data_vencimento = htmlspecialchars($data_vencimento);
$imovel_valor = htmlspecialchars($imovel_valor);
$tipo_imovel = htmlspecialchars($tipo_imovel);
$forma_pagamento = htmlspecialchars($forma_pagamento);

if (!empty($data_emissao)) {
    $data_emissao = date('Y-m-d', strtotime(str_replace('/', '-', $data_emissao))); 
}

if (!empty($data_vencimento)) {
    $data_vencimento = date('Y-m-d', strtotime(str_replace('/', '-', $data_vencimento))); 
}

$sql = buildQuery($contrato_id, $nome, $imovel_taxa_venda, $data_emissao, $data_vencimento, $imovel_valor,  $tipo_imovel, $forma_pagamento);

try {
    $stmt = $pdo->prepare($sql);
    if (!empty($contrato_id)) {
        $stmt->bindParam(':contrato_id', $contrato_id);
    }
    if (!empty($nome)) {
        $nome = "%$nome%";
        $stmt->bindParam(':nome', $nome);
    }
    if (!empty($imovel_taxa_venda)) {
        $imovel_taxa_venda = "%$imovel_taxa_venda%";
        $stmt->bindParam(':imovel_taxa_venda', $imovel_taxa_venda);
    }
    if (!empty($data_emissao)) {
        $stmt->bindParam(':data_emissao', $data_emissao);
    }
    if (!empty($data_vencimento)) {
        $stmt->bindParam(':data_vencimento', $data_vencimento);
    }    
    if (!empty($imovel_valor)) {
        $imovel_valor = "%$imovel_valor%";
        $stmt->bindParam(':imovel_valor', $imovel_valor);
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
