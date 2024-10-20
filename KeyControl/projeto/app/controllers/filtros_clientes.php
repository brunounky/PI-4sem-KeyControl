<?php 
include '../app/controllers/db_conexao.php'; 
$result = null; // Inicialize a variável $result para evitar erros

if (isset($pdo) && $pdo) {
    // Inicie a consulta base
    $sql = "SELECT * FROM cadastro_cliente WHERE 1=1"; // 1=1 para facilitar a concatenação de condições

    // Adicione condições com base nos filtros
    if (!empty($_POST['id'])) {
        $id = $_POST['id'];
        $sql .= " AND id = :id"; // Use um placeholder para segurança
    }
    if (!empty($_POST['Nome'])) {
        $nome = $_POST['Nome'];
        $sql .= " AND nome LIKE :nome"; // Filtra por nome
    }
    if (!empty($_POST['CEP'])) {
        $cep = $_POST['CEP'];
        $sql .= " AND cep = :cep"; // Filtra por CEP
    }
    if (!empty($_POST['rua'])) {
        $rua = $_POST['rua'];
        $sql .= " AND rua LIKE :rua"; // Filtra por rua
    }
    if (!empty($_POST['bairro'])) {
        $bairro = $_POST['bairro'];
        $sql .= " AND bairro LIKE :bairro"; // Filtra por bairro
    }

    // Categoria: Checar quais opções foram selecionadas
    $locador = isset($_POST['locador']) ? 1 : 0;
    $locatario = isset($_POST['locatario']) ? 1 : 0;
    $fiador = isset($_POST['fiador']) ? 1 : 0;

    // Se alguma categoria foi selecionada, adicione a condição à consulta
    if ($locador || $locatario || $fiador) {
        $sql .= " AND (locador = :locador OR locatario = :locatario OR fiador = :fiador)";
    }

    // Prepare a consulta
    $stmt = $pdo->prepare($sql); 

    // Vincule os parâmetros apenas se existirem
    if (!empty($id)) {
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    }
    if (!empty($nome)) {
        $nome = "%" . $nome . "%"; // Adicione porcentagem para LIKE
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    }
    if (!empty($cep)) {
        $stmt->bindParam(':cep', $cep, PDO::PARAM_STR);
    }
    if (!empty($rua)) {
        $rua = "%" . $rua . "%"; // Adicione porcentagem para LIKE
        $stmt->bindParam(':rua', $rua, PDO::PARAM_STR);
    }
    if (!empty($bairro)) {
        $bairro = "%" . $bairro . "%"; // Adicione porcentagem para LIKE
        $stmt->bindParam(':bairro', $bairro, PDO::PARAM_STR);
    }

    // Vincule as categorias se existirem
    if ($locador || $locatario || $fiador) {
        $stmt->bindValue(':locador', $locador, PDO::PARAM_INT);
        $stmt->bindValue(':locatario', $locatario, PDO::PARAM_INT);
        $stmt->bindValue(':fiador', $fiador, PDO::PARAM_INT);
    }

    // Execute a consulta
    $stmt->execute(); 
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtenha os resultados
} else {
    echo "Erro na conexão com o banco de dados.";
}

// Abaixo está a lógica para exibir os resultados na tabela, como antes
?>
