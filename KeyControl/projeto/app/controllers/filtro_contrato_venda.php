<?php 
include '../app/controllers/db_conexao.php';

$result = null; 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

function buildQuery($registro_imovel, $nome, $cpf_cnpj_proprietario, $vigencia, $dia_pagamento, $tipo_imovel, $forma_pagamento) {
    $sql = "
    SELECT 
        imovel.registro_imovel, 
        cliente.nome AS comprador, 
        contrato_venda.data_vigencia AS vigencia,
        contrato_venda.data_pagamento_compra AS dia_pagamento,
        imovel.tipo_imovel,
        contrato_venda.forma_pagamento
    FROM 
        contrato_venda 
    INNER JOIN 
        cadastro_cliente cliente 
        ON contrato_venda.id_locatario = cliente.id
    INNER JOIN 
        cadastro_imovel imovel 
        ON contrato_venda.id_imovel = imovel.id
    INNER JOIN cadastro_cliente cliente 
        ON imovel.cpf_cnpj_proprietario = cliente.cpf_cnpj";
    WHERE 1=1
    ";

    if (!empty($registro_imovel)) {
        $sql .= " AND imovel.registro_imovel = :registro_imovel";
    }
    if (!empty($nome)) {
        $sql .= " AND cliente.nome LIKE :nome";
    }
    if (!empty($cpf_cnpj_proprietario)) {
        $conditions[] = "imovel.cpf_cnpj_proprietario LIKE :cpf_cnpj_proprietario";
        $params['cpf_cnpj_proprietario'] = "%$cpf_cnpj_proprietario%";
    }
    if (!empty($vigencia)) {
        $sql .= " AND contrato_venda.data_vigencia = :vigencia";
    }
    if (!empty($dia_pagamento)) {
        $sql .= " AND contrato_venda.data_pagamento_compra = :dia_pagamento";
    }
    if (!empty($tipo_imovel)) {
        $sql .= " AND imovel.tipo_imovel = :tipo_imovel";
    }
    if (!empty($forma_pagamento)) {
        $sql .= " AND contrato_venda.forma_pagamento = :forma_pagamento";
    }

    return $sql;
}

$registro_imovel = $_POST['registro_imovel'] ?? '';
$nome = $_POST['nome'] ?? '';
$cpf_cnpj_proprietario = $_POST['cpf_cnpj_proprietario'] ?? '';
$vigencia = $_POST['vigencia'] ?? '';
$dia_pagamento = $_POST['dia_pagamento'] ?? '';
$tipo_imovel = $_POST['tipo_imovel'] ?? '';
$forma_pagamento = $_POST['forma_pagamento'] ?? '';

$sql = buildQuery($registro_imovel, $nome, $vigencia, $dia_pagamento, $tipo_imovel, $forma_pagamento);

try {
    $stmt = $pdo->prepare($sql);

    if (!empty($registro_imovel)) {
        $stmt->bindParam(':registro_imovel', $registro_imovel);
    }
    if (!empty($nome)) {
        $nome = "%$nome%";
        $stmt->bindParam(':nome', $nome);
    }
    if (!empty($cpf_cnpj_proprietario)) {
        $conditions[] = "imovel.cpf_cnpj_proprietario LIKE :cpf_cnpj_proprietario";
        $params['cpf_cnpj_proprietario'] = "%$cpf_cnpj_proprietario%";
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

    var_dump($result);
} catch (Exception $e) {
    echo "Erro na execução da consulta: " . htmlspecialchars($e->getMessage());
}
?>
