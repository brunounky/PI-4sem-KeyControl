<?php
require '../controllers/db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['action'] === 'cadastrar') {
    $nome = $_POST['nome'];
    $rg_ie = $_POST['rg_ie'];
    $telefone = $_POST['telefone'];
    $cep = $_POST['cep'];
    $numero = $_POST['numero'];
    $complemento = $_POST['complemento'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];
    $pais = $_POST['pais'];
    $cpf_cnpj = $_POST['cpf_cnpj'];
    $data_nasc_fund = $_POST['data_nasc_fund'];
    $email = $_POST['email'];

    $tipo = '';
    if (isset($_POST['locador'])) {
        $tipo .= 'Locador,';
    }
    if (isset($_POST['locatario'])) {
        $tipo .= 'Locatário,';
    }

    $tipo = rtrim($tipo, ',');


    $stmt = $pdo->prepare("INSERT INTO cadastros (nome, rg_ie, telefone, cep, numero, complemento, rua, bairro, cidade, estado, pais, cpf_cnpj, data_nascimento, email, tipo) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    
    if ($stmt->execute([$nome, $rg_ie, $telefone, $cep, $numero, $complemento, $rua, $bairro, $cidade, $estado, $pais, $cpf_cnpj, $data_nasc_fund, $email, $tipo])) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $stmt->errorInfo()[2];
    }
}
?>
