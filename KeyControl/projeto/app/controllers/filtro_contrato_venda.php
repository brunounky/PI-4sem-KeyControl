<?php 
include '../app/controllers/db_conexao.php'; 
$result = null; 

function buildQuery($id, $nome, $cep, $rua, $bairro, $cidade, $categoria) {
    $sql = "SELECT * FROM contrato_venda WHERE 1=1"; 
    $params = []; 

    if (!empty($id)) {
        $sql .= " AND id = :id";
        $params['id'] = $id;
    }

    if (!empty($nome)) {
        $sql .= " AND nome LIKE :nome";
        $params['nome'] = "%$nome%"; 
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

    if (!empty($cidade)) {
        $sql .= " AND cidade LIKE :cidade";
        $params['cidade'] = "%$cidade%";
    }

    if (!empty($categoria)) {
        $allowedCategories = ['locador', 'locatario', 'fiador'];
        if (in_array($categoria, $allowedCategories)) {
            $sql .= " AND $categoria = 1";
        } else {
            $categoria = '';
        }
    }

    return [$sql, $params];
}

$id = $_POST['id'] ?? '';
$nome = $_POST['nome'] ?? '';
$cep = $_POST['cep'] ?? '';
$rua = $_POST['rua'] ?? '';
$bairro = $_POST['bairro'] ?? '';
$cidade = $_POST['cidade'] ?? '';
$categoria = $_POST['categoria'] ?? ''; 

list($sql, $params) = buildQuery($id, $nome, $cep, $rua, $bairro, $cidade, $categoria);

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
