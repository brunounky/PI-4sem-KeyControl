<?php 
include '../app/controllers/db_conexao.php';

$result = null; 

function buildQuery($contrato_id, $locatario_nome, $contrato_vigencia, $tipo_imovel, $contrato_forma_pagamento) {
    $sql = "
        SELECT contrato_aluguel.id AS contrato_id,
            contrato_aluguel.locatario_nome,
            contrato_aluguel.contrato_vigencia,
            contrato_aluguel.imovel_cidade,
            contrato_aluguel.contrato_forma_pagamento,
            c_imovel.tipo_imovel,
            c_imovel.cpf_cnpj_proprietario
        FROM contrato_aluguel
        JOIN cadastro_imovel c_imovel 
            ON contrato_aluguel.id_imobiliaria = c_imovel.id_imobiliaria
        WHERE 1=1
        ";
        
    $conditions = [];
    $params = [];

    if (!empty($contrato_id)) {
        $conditions[] = "id = :id";
        $params['id'] = $contrato_id;
    }
    if (!empty($locatario_nome)) {
        $conditions[] = "c_cliente.nome LIKE :locatario_nome";
        $params['locatario_nome'] = "%$locatario_nome%";
    }
    if (!empty($contrato_vigencia)) {
        $conditions[] = "contrato_vigencia = :contrato_vigencia";
        $params['contrato_vigencia'] = $contrato_vigencia;
    }
    if (!empty($tipo_imovel)) {
        $conditions[] = "c_imovel.tipo_imovel = :tipo_imovel";
        $params['tipo_imovel'] = $tipo_imovel;
    }
    if (!empty($contrato_forma_pagamento)) {
        $conditions[] = "c_caucao.contrato_forma_pagamento = :contrato_forma_pagamento_caucao";
        $params['contrato_forma_pagamento_caucao'] = $contrato_forma_pagamento;
    }

    if (count($conditions) > 0) {
        $sql .= " AND " . implode(" AND ", $conditions);
    }

    return [$sql, $params];
}

$id = $_POST['contrato_id'] ?? '';
$locatario_nome = $_POST['locatario'] ?? '';
$contrato_vigencia = $_POST['vigencia'] ?? '';
$tipo_imovel = $_POST['tipo_imovel'] ?? '';
$contrato_forma_pagamento = $_POST['forma_pagamento'] ?? '';

list($sql, $params) = buildQuery($id, $locatario_nome, $contrato_vigencia, $tipo_imovel, $contrato_forma_pagamento);

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
