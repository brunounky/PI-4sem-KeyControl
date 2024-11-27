<?php
include '../app/controllers/db_conexao.php'; 

$result = null; 

// Função para consulta de imóveis
function buildQueryImovel($registro_imovel, $cpf_cnpj_proprietario, $tipo_imovel, $cep, $rua, $bairro, $cidade) {
    $sql = "SELECT imovel.*, cliente.nome 
            FROM cadastro_imovel imovel
            INNER JOIN cadastro_cliente cliente 
                ON imovel.cpf_cnpj_proprietario = cliente.cpf_cnpj";
    
    $conditions = [];
    $params = [];

    if (!empty($registro_imovel)) {
        $conditions[] = "imovel.registro_imovel = :registro_imovel";
        $params['registro_imovel'] = $registro_imovel;
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

// Função para consulta de clientes
function buildQueryCliente($id, $nome, $cpf_cnpj, $telefone, $estado_civil, $cidade, $categoria) {
    $sql = "SELECT * FROM cadastro_cliente WHERE 1=1"; 
    $params = []; 

    if (!empty($id)) {
        $sql .= " AND id = :id";
        $params['id'] = $id;
    }

    if (!empty($nome)) {
        $sql .= " AND nome LIKE :nome";
        $params['nome'] = "%$nome%"; 
    }

    if (!empty($cpf_cnpj)) {
        $sql .= " AND cpf_cnpj = :cpf_cnpj";
        $params['cpf_cnpj'] = $cpf_cnpj;
    }

    if (!empty($telefone)) {
        $sql .= " AND telefone LIKE :telefone";
        $params['telefone'] = "%$telefone%";
    }

    if (!empty($estado_civil)) {
        $sql .= " AND estado_civil LIKE :estado_civil";
        $params['estado_civil'] = "%$estado_civil%";
    }

    if (!empty($cidade)) {
        $sql .= " AND cidade LIKE :cidade";
        $params['cidade'] = "%$cidade%";
    }

    if (!empty($categoria)) {
        $allowedCategories = ['locador', 'locatario', 'fiador','comprador'];
        if (in_array($categoria, $allowedCategories)) {
            $sql .= " AND $categoria = 1";
        } else {
            $categoria = '';
        }
    }

    return [$sql, $params];
}

// Captura de parâmetros de POST para imóveis
$registro_imovel = $_POST['registro_imovel'] ?? '';
$cpf_cnpj_proprietario = $_POST['cpf_cnpj_proprietario'] ?? '';
$tipo_imovel = $_POST['tipo_imovel'] ?? '';
$cep = $_POST['cep'] ?? '';
$rua = $_POST['rua'] ?? '';
$bairro = $_POST['bairro'] ?? '';
$cidade = $_POST['cidade'] ?? '';

// Captura de parâmetros de POST para clientes
$id = $_POST['id'] ?? '';
$nome = $_POST['nome'] ?? '';
$cpf_cnpj = $_POST['cpf_cnpj'] ?? '';
$telefone = $_POST['telefone'] ?? '';
$estado_civil = $_POST['estado_civil'] ?? '';
$categoria = $_POST['categoria'] ?? ''; 

// Executa consulta de imóveis
list($sqlImovel, $paramsImovel) = buildQueryImovel($registro_imovel, $cpf_cnpj_proprietario, $tipo_imovel, $cep, $rua, $bairro, $cidade);

// Executa consulta de clientes
list($sqlCliente, $paramsCliente) = buildQueryCliente($id, $nome, $cpf_cnpj, $telefone, $estado_civil, $cidade, $categoria);

// Variável para armazenar resultados
$resultImovel = $resultCliente = null;

try {
    if ($pdo) {
        // Executa consulta de imóveis
        $stmtImovel = $pdo->prepare($sqlImovel);
        $stmtImovel->execute($paramsImovel);
        $resultImovel = $stmtImovel->fetchAll(PDO::FETCH_ASSOC); 

        // Executa consulta de clientes
        $stmtCliente = $pdo->prepare($sqlCliente);
        $stmtCliente->execute($paramsCliente);
        $resultCliente = $stmtCliente->fetchAll(PDO::FETCH_ASSOC);
    } else {
        throw new Exception("Erro na conexão com o banco de dados.");
    }
} catch (Exception $e) {
    echo "Erro na execução da consulta: " . htmlspecialchars($e->getMessage());
}
?>
