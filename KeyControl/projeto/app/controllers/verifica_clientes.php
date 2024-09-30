<?php
require '../controllers/db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cadastrar') {

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

    $tipo = [];
    if (isset($_POST['locador'])) {
        $tipo[] = 'Locador';
    }
    if (isset($_POST['locatario'])) {
        $tipo[] = 'Locatário';
    }
    $tipo = implode(',', $tipo);

    $stmt = $pdo->prepare("INSERT INTO cadastros (nome, rg_ie, telefone, cep, numero, complemento, rua, bairro, cidade, estado, pais, cpf_cnpj, data_nascimento, email, tipo) 
                            VALUES (:nome, :rg_ie, :telefone, :cep, :numero, :complemento, :rua, :bairro, :cidade, :estado, :pais, :cpf_cnpj, :data_nasc_fund, :email, :tipo)");
    
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':rg_ie', $rg_ie);
    $stmt->bindParam(':telefone', $telefone);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':complemento', $complemento);
    $stmt->bindParam(':rua', $rua);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':pais', $pais);
    $stmt->bindParam(':cpf_cnpj', $cpf_cnpj);
    $stmt->bindParam(':data_nasc_fund', $data_nasc_fund);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':tipo', $tipo);

    if ($stmt->execute()) {
        echo "Cadastro realizado com sucesso!";
    } else {
        echo "Erro ao cadastrar: " . $stmt->errorInfo()[2];
    }
}
?>
