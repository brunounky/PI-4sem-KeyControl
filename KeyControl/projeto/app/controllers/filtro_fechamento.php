<?php 
include '../app/controllers/db_conexao.php'; 
$result = null;

function buildQuery($registro_imovel, $data_inicial, $data_final) {
    $sql = "SELECT * FROM lancamento_financeiro";
    $conditions = [];
    $params = [];

    if (!empty($registro_imovel)) {
        $conditions[] = "registro_imovel = :registro_imovel";
        $params['registro_imovel'] = $registro_imovel;
    }

    if (!empty($data_inicial)) {
        $conditions[] = "data_emissao >= :data_inicial";
        $params['data_inicial'] = $data_inicial;
    }

    if (!empty($data_final)) {
        $conditions[] = "data_emissao <= :data_final";
        $params['data_final'] = $data_final;
    }

    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    return [$sql, $params];
}

$registro_imovel = $_POST['registro_imovel'] ?? '';
$data_inicial = $_POST['data_inicial'] ?? '';
$data_final = $_POST['data_final'] ?? '';

list($sql, $params) = buildQuery($registro_imovel, $data_inicial, $data_final);

try {
    if ($pdo) {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    } else {
        throw new Exception("Erro na conexão com o banco de dados.");
    }
} catch (Exception $e) {
    echo "Erro na execução da consulta: " . $e->getMessage();
}
?>
