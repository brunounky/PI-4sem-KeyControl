<?php 
include '../app/controllers/db_conexao.php';

$result = null; 

function buildQuery($contrato_id, $locatario_nome, $contrato_vigencia, $contrato_dia_vencimento, $tipo_imovel, $contrato_forma_pagamento) {
    $sql = "
        SELECT 
            'Caução' AS tipo_contrato,
            c_caucao.id AS contrato_id,
            c_cliente.nome AS locatario_nome,
            c_cliente.cpf_cnpj AS locatario_cpf_cnpj,
            c_imovel.tipo_imovel AS tipo_imovel,
            c_imovel.valor_aluguel AS valor_aluguel,
            c_caucao.total_caucao AS valor_garantia,
            c_caucao.contrato_vigencia AS vigencia,
            c_caucao.contrato_forma_pagamento AS forma_pagamento
        FROM 
            contrato_caucao c_caucao
        JOIN 
            cadastro_cliente c_cliente ON c_caucao.locatario_cpf_cnpj = c_cliente.cpf_cnpj
        JOIN 
            cadastro_imovel c_imovel ON c_caucao.imovel_proprietario_cpf_cnpj = c_imovel.cpf_cnpj_proprietario
        WHERE 1=1";

    if (!empty($contrato_id)) {
        $sql .= " AND c_caucao.id = :contrato_id"; 
    }
    if (!empty($locatario_nome)) {
        $sql .= " AND c_cliente.nome LIKE :locatario_nome"; 
    }
    if (!empty($contrato_vigencia)) {
        $sql .= " AND c_caucao.contrato_vigencia = :contrato_vigencia"; 
    }
    if (!empty($tipo_imovel)) {
        $sql .= " AND c_imovel.tipo_imovel = :tipo_imovel"; 
    }
    if (!empty($contrato_forma_pagamento)) {
        $sql .= " AND c_caucao.contrato_forma_pagamento = :contrato_forma_pagamento"; 
    }

    $sql .= "
        UNION ALL
        SELECT 
            'Fiador' AS tipo_contrato,
            c_fiador.id AS contrato_id,
            c_cliente.nome AS locatario_nome,
            c_cliente.cpf_cnpj AS locatario_cpf_cnpj,
            c_imovel.tipo_imovel AS tipo_imovel,
            c_imovel.valor_aluguel AS valor_aluguel,
            NULL AS valor_garantia,
            c_fiador.contrato_vigencia AS vigencia,
            c_fiador.contrato_forma_pagamento AS forma_pagamento
        FROM 
            contrato_fiador c_fiador
        JOIN 
            cadastro_cliente c_cliente ON c_fiador.locatario_cpf_cnpj = c_cliente.cpf_cnpj
        JOIN 
            cadastro_imovel c_imovel ON c_fiador.imovel_proprietario_cpf_cnpj = c_imovel.cpf_cnpj_proprietario
        WHERE 1=1";

    if (!empty($contrato_id)) {
        $sql .= " AND c_fiador.id = :contrato_id"; 
    }
    if (!empty($locatario_nome)) {
        $sql .= " AND c_cliente.nome LIKE :locatario_nome"; 
    }
    if (!empty($contrato_vigencia)) {
        $sql .= " AND c_fiador.contrato_vigencia = :contrato_vigencia"; 
    }
    if (!empty($tipo_imovel)) {
        $sql .= " AND c_imovel.tipo_imovel = :tipo_imovel"; 
    }
    if (!empty($contrato_forma_pagamento)) {
        $sql .= " AND c_fiador.contrato_forma_pagamento = :contrato_forma_pagamento"; 
    }

    return $sql;
}
$contrato_id = $_POST['contrato_id'] ?? '';
$locatario_nome = $_POST['nome'] ?? '';
$contrato_vigencia = $_POST['contrato_vigencia'] ?? '';
$contrato_dia_vencimento = $_POST['contrato_dia_vencimento'] ?? '';
$tipo_imovel = $_POST['tipo_imovel'] ?? '';
$contrato_forma_pagamento = $_POST['contrato_forma_pagamento'] ?? '';

$contrato_id = htmlspecialchars($contrato_id);
$locatario_nome = htmlspecialchars($locatario_nome);
$contrato_vigencia = htmlspecialchars($contrato_vigencia);
$contrato_dia_vencimento = htmlspecialchars($contrato_dia_vencimento);
$tipo_imovel = htmlspecialchars($tipo_imovel);
$contrato_forma_pagamento = htmlspecialchars($contrato_forma_pagamento);

$sql = buildQuery($contrato_id, $locatario_nome, $contrato_vigencia, $contrato_dia_vencimento, $tipo_imovel, $contrato_forma_pagamento);

try {
    $stmt = $pdo->prepare($sql);

    if (!empty($contrato_id)) {
        $stmt->bindParam(':contrato_id', $contrato_id);
    }
    if (!empty($locatario_nome)) {
        $locatario_nome = "%$locatario_nome%";  // Para pesquisa parcial, adicionando wildcards
        $stmt->bindParam(':locatario_nome', $locatario_nome);
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

    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

} catch (Exception $e) {
    echo "Erro na execução da consulta: " . htmlspecialchars($e->getMessage());
}

?>
