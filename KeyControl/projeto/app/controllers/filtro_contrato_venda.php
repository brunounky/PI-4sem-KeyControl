<?php 
include '../app/controllers/db_conexao.php';

$result = null; 

function buildQuery($contrato_id, $nome, $contrato_vigencia, $contrato_dia_vencimento, $tipo_imovel, $contrato_forma_pagamento) {
    // Inicia a query com os JOINs
    $sql = "
   SELECT 
     cv.id AS contrato_id,
     cv.comprador_nome,
     cc.nome AS comprador_nome_completo,
     cc.cpf_cnpj AS comprador_cpf_cnpj,
     ci.cpf_cnpj_proprietario AS cpf_cnpj_proprietario,
     pc.nome AS nome_proprietario,
     cv.contrato_vigencia, 
     cv.contrato_dia_vencimento,
     cv.contrato_forma_pagamento 

    FROM 
        contrato_venda cv
    JOIN 
        cadastro_cliente cc ON cv.comprador_cpf_cnpj = cc.cpf_cnpj 
    JOIN 
        cadastro_imovel ci ON cv.imovel_proprietario_cpf_cnpj = ci.cpf_cnpj_proprietario 
    JOIN 
        cadastro_cliente pc ON ci.cpf_cnpj_proprietario = pc.cpf_cnpj  
    WHERE 
        1=1";  // 1=1 para facilitar a adição de ANDs dinamicamente

    // Condições dinâmicas
    if (!empty($contrato_id)) {
        $sql .= " AND cv.id = :contrato_id"; 
    }
    if (!empty($contrato_vigencia)) {
        $sql .= " AND cv.contrato_vigencia = :contrato_vigencia"; 
    }
    if (!empty($contrato_dia_vencimento)) {
        $sql .= " AND cv.contrato_dia_vencimento = :contrato_dia_vencimento"; 
    }
    if (!empty($tipo_imovel)) {
        $sql .= " AND ci.tipo_imovel = :tipo_imovel"; 
    }
    if (!empty($contrato_forma_pagamento)) {
        $sql .= " AND cv.contrato_forma_pagamento = :contrato_forma_pagamento"; 
    }

    return $sql;
}

// Coleta os dados do POST
$contrato_id = $_POST['contrato_id'] ?? '';
$nome = $_POST['nome'] ?? '';
$contrato_vigencia = $_POST['contrato_vigencia'] ?? '';
$contrato_dia_vencimento = $_POST['contrato_dia_vencimento'] ?? '';
$tipo_imovel = $_POST['tipo_imovel'] ?? '';
$contrato_forma_pagamento = $_POST['contrato_forma_pagamento'] ?? '';

// Escapando os dados de entrada
$contrato_id = htmlspecialchars($contrato_id);
$nome = htmlspecialchars($nome);
$contrato_vigencia = htmlspecialchars($contrato_vigencia);
$contrato_dia_vencimento = htmlspecialchars($contrato_dia_vencimento);
$tipo_imovel = htmlspecialchars($tipo_imovel);
$contrato_forma_pagamento = htmlspecialchars($contrato_forma_pagamento);

// Constrói a query
$sql = buildQuery($contrato_id, $nome, $contrato_vigencia,$contrato_dia_vencimento, $tipo_imovel, $contrato_forma_pagamento);

try {
    // Prepara a consulta SQL
    $stmt = $pdo->prepare($sql);

    // Associa os parâmetros dinamicamente
    if (!empty($contrato_id)) {
        $stmt->bindParam(':contrato_id', $contrato_id);
    }
    if (!empty($nome)) {
        $nome = "%$nome%"; // Adiciona o wildcard para busca parcial
        $stmt->bindParam(':nome', $nome);
    }
    if (!empty($contrato_vigencia)) {
        $stmt->bindParam(':contrato_vigencia', $contrato_vigencia);
    }
    if (!empty($contrato_dia_vencimento)) {
        $stmt->bindParam(':contrato_dia_vencimento', $contrato_dia_vencimento);
    }
    if (!empty($tipo_imovel)) {
        $stmt->bindParam(':tipo_imovel', $tipo_imovel);
    }
    if (!empty($contrato_forma_pagamento)) {
        $stmt->bindParam(':contrato_forma_pagamento', $contrato_forma_pagamento);
    }

    // Executa a consulta
    $stmt->execute();

    // Recupera os resultados
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    // Exibe erro caso haja falha na execução
    echo "Erro na execução da consulta: " . htmlspecialchars($e->getMessage());
}
?>
