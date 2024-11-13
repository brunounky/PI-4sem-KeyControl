<?php 
include '../app/controllers/db_conexao.php';

$result = null; 

function buildQuery($contrato_id, $locatario_nome, $contrato_vigencia, $tipo_imovel, $contrato_forma_pagamento) {
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
            cadastro_cliente c_cliente ON c_caucao.id_imobiliaria = c_cliente.id_imobiliaria
        JOIN 
            cadastro_imovel c_imovel ON c_caucao.id_imobiliaria = c_imovel.id_imobiliaria
        WHERE 1=1";

    $conditions = [];
    $params = [];

    if (!empty($contrato_id)) {
        $conditions[] = "c_caucao.id = :contrato_id_caucao";
        $params['contrato_id_caucao'] = $contrato_id;
    }
    if (!empty($locatario_nome)) {
        $conditions[] = "c_cliente.nome LIKE :locatario_nome_caucao";
        $params['locatario_nome_caucao'] = "%$locatario_nome%";
    }
    if (!empty($contrato_vigencia)) {
        $conditions[] = "c_caucao.contrato_vigencia = :contrato_vigencia_caucao";
        $params['contrato_vigencia_caucao'] = $contrato_vigencia;
    }
    if (!empty($tipo_imovel)) {
        $conditions[] = "c_imovel.tipo_imovel = :tipo_imovel_caucao";
        $params['tipo_imovel_caucao'] = $tipo_imovel;
    }
    if (!empty($contrato_forma_pagamento)) {
        $conditions[] = "c_caucao.contrato_forma_pagamento = :contrato_forma_pagamento_caucao";
        $params['contrato_forma_pagamento_caucao'] = $contrato_forma_pagamento;
    }

    if (count($conditions) > 0) {
        $sql .= " AND " . implode(" AND ", $conditions);
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
            cadastro_cliente c_cliente ON c_fiador.id_imobiliaria = c_cliente.id_imobiliaria
        JOIN 
            cadastro_imovel c_imovel ON c_fiador.id_imobiliaria = c_imovel.id_imobiliaria
        WHERE 1=1";

    $fiador_conditions = [];
    if (!empty($contrato_id)) {
        $fiador_conditions[] = "c_fiador.id = :contrato_id_fiador";
        $params['contrato_id_fiador'] = $contrato_id;
    }
    if (!empty($locatario_nome)) {
        $fiador_conditions[] = "c_cliente.nome LIKE :locatario_nome_fiador";
        $params['locatario_nome_fiador'] = "%$locatario_nome%";
    }
    if (!empty($contrato_vigencia)) {
        $fiador_conditions[] = "c_fiador.contrato_vigencia = :contrato_vigencia_fiador";
        $params['contrato_vigencia_fiador'] = $contrato_vigencia;
    }
    if (!empty($tipo_imovel)) {
        $fiador_conditions[] = "c_imovel.tipo_imovel = :tipo_imovel_fiador";
        $params['tipo_imovel_fiador'] = $tipo_imovel;
    }
    if (!empty($contrato_forma_pagamento)) {
        $fiador_conditions[] = "c_fiador.contrato_forma_pagamento = :contrato_forma_pagamento_fiador";
        $params['contrato_forma_pagamento_fiador'] = $contrato_forma_pagamento;
    }

    if (count($fiador_conditions) > 0) {
        $sql .= " AND " . implode(" AND ", $fiador_conditions);
    }

    return [$sql, $params];
}

$contrato_id = $_POST['id'] ?? '';
$locatario_nome = $_POST['locatario'] ?? '';
$contrato_vigencia = $_POST['vigencia'] ?? '';
$tipo_imovel = $_POST['tipo_imovel'] ?? '';
$contrato_forma_pagamento = $_POST['forma_pagamento'] ?? '';

list($sql, $params) = buildQuery($contrato_id, $locatario_nome, $contrato_vigencia, $tipo_imovel, $contrato_forma_pagamento);

try {
    if ($pdo) {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
    } else {
        throw new Exception("Erro na conexão com o banco de dados.");
    }
} catch (Exception $e) {
    echo "Erro na execução da consulta: " . htmlspecialchars($e->getMessage());
}
?>
