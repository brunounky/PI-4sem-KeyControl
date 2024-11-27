<?php 
include '../app/controllers/db_conexao.php'; 
$result = null;

function buildQuery($id_lancamento, $data_inicial, $data_final) {
    $sql = "SELECT * FROM lancamento_financeiro";
    $conditions = [];
    $params = [];

    if (!empty($id_lancamento)) {
        $conditions[] = "id_lancamento = :id_lancamento";
        $params['id_lancamento'] = $id_lancamento;
    }

    if (!empty($data_inicial)) {
        $conditions[] = "data_emissao >= :data_inicial";
        $params['data_inicial'] = $data_inicial;
    }

    if (!empty($data_final)) {
        $conditions[] = "data_emissao <= :data_final";
        $params['data_final'] = $data_final;
    }

    $conditions[] = "liquidado = :liquidado";
    $params['liquidado'] = "Não liquidado";

    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    return [$sql, $params];
}

$id_lancamento = $_POST['id_lancamento'] ?? '';
$data_inicial = $_POST['data_inicial'] ?? '';
$data_final = $_POST['data_final'] ?? '';

list($sql, $params) = buildQuery($id_lancamento, $data_inicial, $data_final);

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
