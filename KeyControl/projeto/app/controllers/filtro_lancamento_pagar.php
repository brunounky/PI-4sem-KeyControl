<?php 
include '../app/controllers/db_conexao.php';
$result = null; 

function buildQuery($id_lancamento, $tipo_lancamento, $registro_imovel, $data_emissao, $data_vencimento, $valor_total, $forma_pagamento, $data_vigencia, $liquidado) {
    $sql = "SELECT * FROM lancamento_financeiro WHERE valor_total LIKE '-%'";
        $params = [];

        if (!empty($id_lancamento)) {
            $sql .= " AND id_lancamento = :id_lancamento";
            $params['id_lancamento'] = $id_lancamento;
        }
    
        if (!empty($tipo_lancamento)) {
            $sql .= " AND tipo_lancamento = :tipo_lancamento";
            $params[':tipo_lancamento'] = $tipo_lancamento;
        }
        if (!empty($registro_imovel)) {
            $sql .= " AND registro_imovel = :registro_imovel";
            $params['registro_imovel'] = $registro_imovel;
        }
        if (!empty($data_emissao)) {
            $sql .= " AND data_emissao = :data_emissao";
            $params['data_emissao'] = $data_emissao;
        }
        if (!empty($data_vencimento)) {
            $sql .= " AND data_vencimento = :data_vencimento";
            $params['data_vencimento'] = $data_vencimento;
        }
        if (!empty($valor_total)) {
            $sql .= " AND valor_total = :valor_total";
            $params['valor_total'] = $valor_total;
        }
        if (!empty($forma_pagamento)) {
            $sql .= " AND forma_pagamento = :forma_pagamento";
            $params['forma_pagamento'] = $forma_pagamento;
        }
        if (!empty($data_vigencia)) {
            $sql .= " AND data_vigencia = :data_vigencia";
            $params['data_vigencia'] = $data_vigencia;
        }
        if (!empty($liquidado)) {
            $sql .= " AND liquidado = :liquidado";
            $params['liquidado'] = $liquidado;
        }

        return[$sql, $params];
    }

    $id_lancamento = $_POST['id_lancamento'] ?? '';
    $tipo_lancamento = $_POST['tipo_lancamento'] ?? '';
    $registro_imovel = $_POST['registro_imovel'] ?? '';
    $data_emissao = $_POST['data_emissao'] ?? '';
    $data_vencimento = $_POST['data_vencimento'] ?? '';
    $valor_total = $_POST['valor_total'] ?? '';
    $forma_pagamento = $_POST['forma_pagamento'] ?? ''; 
    $data_vigencia = $_POST['data_vigencia'] ?? '';
    $liquidado = $_POST['liquidado'] ?? '';

    list($sql, $params) = buildQuery($id_lancamento, $tipo_lancamento, $registro_imovel, $data_emissao, $data_vencimento, $valor_total, $forma_pagamento, $data_vigencia, $liquidado);



    if (isset($pdo) && $pdo) {
        try {
            $stmt = $pdo->prepare($sql);
            $stmt->execute($params);
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } catch (Exception $e) {
            echo "Erro na execução da consulta: " . htmlspecialchars($e->getMessage());
        }
    } else {
        echo "Erro na conexão com o banco de dados.";
    }
   
?>