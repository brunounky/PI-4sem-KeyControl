<?php 
include '../app/controllers/db_conexao.php'; 
$result = null; 

function buildQuery($id, $cpf_cnpj_proprietario, $tipo_imovel, $cep, $rua, $bairro, $cidade) {
    $sql = "SELECT imovel.*, cliente.nome 
            FROM cadastro_imovel imovel
            INNER JOIN cadastro_cliente cliente 
                ON imovel.cpf_cnpj_proprietario = cliente.cpf_cnpj";
    
    $conditions = [];
    $params = [];

    if (!empty($id)) {
        $conditions[] = "imovel.id = :id";
        $params['id'] = $id;
    }
    if (!empty($cpf_cnpj_proprietario)) {
        $conditions[] = "imovel.cpf_cnpj_proprietario LIKE :cpf_cnpj_proprietario";
        $params['cpf_cnpj_proprietario'] = "%$cpf_cnpj_proprietario%";
    }
    if (!empty($tipo_imovel)) {
        $conditions[] = "imovel.tipo_imovel LIKE :tipo_imovel";
        $params['tipo_imovel'] = "%$tipo_imovel%";
    }
    if (!empty($cep)) {
        $conditions[] = "imovel.cep = :cep";
        $params['cep'] = $cep;
    }
    if (!empty($rua)) {
        $conditions[] = "imovel.rua LIKE :rua";
        $params['rua'] = "%$rua%";
    }
    if (!empty($bairro)) {
        $conditions[] = "imovel.bairro LIKE :bairro";
        $params['bairro'] = "%$bairro%";
    }
    if (!empty($cidade)) {
        $conditions[] = "imovel.cidade LIKE :cidade";
        $params['cidade'] = "%$cidade%";
    }

    if (count($conditions) > 0) {
        $sql .= " WHERE " . implode(" AND ", $conditions);
    }

    return [$sql, $params];
}

$id = $_POST['id'] ?? '';
$cpf_cnpj_proprietario = $_POST['cpf_cnpj_proprietario'] ?? '';
$tipo_imovel = $_POST['tipo_imovel'] ?? '';
$cep = $_POST['cep'] ?? '';
$rua = $_POST['rua'] ?? '';
$bairro = $_POST['bairro'] ?? '';
$cidade = $_POST['cidade'] ?? '';

list($sql, $params) = buildQuery($id, $cpf_cnpj_proprietario, $tipo_imovel, $cep, $rua, $bairro, $cidade);

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
