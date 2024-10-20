<?php 
include '../app/controllers/db_conexao.php'; 
$result = null; 

function buildQuery($id, $cpf_cnpj_proprietario, $tipo_imovel, $cep, $rua, $bairro) {
    $sql = "SELECT * FROM cadastro_imovel WHERE 1=1"; 
    $params = []; 

    if (!empty($id)) {
        $sql .= " AND id = :id";
        $params['id'] = $id;
    }

    if (!empty($cpf_cnpj_proprietario)) {
        $sql .= " AND cpf_cnpj_proprietario LIKE :cpf_cnpj_proprietario";
        $params['cpf_cnpj_proprietario'] = "%$cpf_cnpj_proprietario%";
    }

    if (!empty($tipo_imovel)) {
        $sql .= " AND tipo_imovel LIKE :tipo_imovel";
        $params['tipo_imovel'] = "%$tipo_imovel%";
    }

    if (!empty($cep)) {
        $sql .= " AND cep = :cep";
        $params['cep'] = $cep;
    }

    if (!empty($rua)) {
        $sql .= " AND rua LIKE :rua";
        $params['rua'] = "%$rua%";
    }

    if (!empty($bairro)) {
        $sql .= " AND bairro LIKE :bairro";
        $params['bairro'] = "%$bairro%";
    }

    return [$sql, $params];
}

// Inicializando as variáveis de formulário com valores padrão
$id = $_POST['id'] ?? '';
$cpf_cnpj_proprietario = $_POST['cpf_cnpj_proprietario'] ?? '';
$tipo_imovel = $_POST['tipo_imovel'] ?? '';
$cep = $_POST['cep'] ?? '';
$rua = $_POST['rua'] ?? '';
$bairro = $_POST['bairro'] ?? '';
$cidade = $_POST['cidade'] ?? '';


// Construir a query com os filtros recebidos
list($sql, $params) = buildQuery($id, $cpf_cnpj_proprietario, $tipo_imovel, $cep, $rua, $bairro);

if (isset($pdo) && $pdo) {
    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute($params);
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); 
    } catch (Exception $e) {
        echo "Erro na execução da consulta: " . $e->getMessage();
    }
} else {
    echo "Erro na conexão com o banco de dados.";
}
?>
