<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

require '../controllers/db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cadastrar') {

    // comprador
    $nome = $_POST['comprador_nome'];
    $data_nascimento_fundacao = $_POST['comprador_data_nascimento'];
    $nacionalidade = $_POST['comprador_nacionalidade'];
    $cep = $_POST['comprador_cep'];
    $bairro = $_POST['comprador_bairro'];
    $estado = $_POST['comprador_estado'];
    $cpf_cnpj = $_POST['comprador_cpf_cnpj'];
    $telefone = $_POST['comprador_telefone'];
    $estado_civil = $_POST['comprador_estado_civil'];
    $rua = $_POST['comprador_rua'];
    $complemento = $_POST['comprador_complemento'];
    $pais = $_POST['comprador_pais'];
    $rg_ie = $_POST['comprador_rg_ie'];
    $email = $_POST['comprador_email'];
    $profissao = $_POST['comprador_profissao'];
    $numero = $_POST['comprador_numero'];
    $cidade = $_POST['comprador_cidade'];

    // imóvel
    $cpf_cnpj_proprietario = $_POST['imovel_proprietario_cpf_cnpj'];
    $tipo_imovel = $_POST['imovel_tipo'];
    $numero_imovel = $_POST['imovel_numero'];
    $cidade_imovel = $_POST['imovel_cidade'];
    $taxa_venda = $_POST['imovel_taxa_venda'];
    $cep_imovel = $_POST['imovel_cep'];
    $bairro_imovel = $_POST['imovel_bairro'];
    $estado_imovel = $_POST['imovel_estado'];
    $valor_imovel = $_POST['imovel_valor'];
    $registro_imovel = $_POST['imovel_registro'];
    $rua_imovel = $_POST['imovel_rua'];
    $complemento_imovel = $_POST['imovel_complemento'];
    $pais_imovel = $_POST['imovel_pais'];


    $vigencia = $_POST['contrato_vigencia'];
    $dia_vencimento = $_POST['contrato_dia_vencimento'];
    $forma_pagamento = $_POST['contrato_forma_pagamento'];

    try {
        $sql = "INSERT INTO contrato_venda (comprador_nome, comprador_data_nascimento, comprador_nacionalidade, comprador_cep, comprador_bairro, comprador_estado, comprador_cpf_cnpj, comprador_telefone, comprador_estado_civil, comprador_rua, comprador_complemento, comprador_pais, comprador_rg_ie, comprador_email, comprador_profissao, comprador_numero, comprador_cidade, imovel_proprietario_cpf_cnpj, imovel_tipo, imovel_numero, imovel_cidade, imovel_taxa_venda, imovel_cep, imovel_bairro, imovel_estado, imovel_valor, imovel_registro, imovel_rua, imovel_complemento, imovel_pais, contrato_vigencia, contrato_dia_vencimento, contrato_forma_pagamento) 
                VALUES (:nome, :data_nascimento_fundacao, :nacionalidade, :cep, :bairro, :estado, :cpf_cnpj, :telefone, :estado_civil, :rua, :complemento, :pais, :rg_ie, :email, :profissao, :numero, :cidade, :cpf_cnpj_proprietario, :tipo_imovel, :numero_imovel, :cidade_imovel, :taxa_venda, :cep_imovel, :bairro_imovel, :estado_imovel, :valor_imovel, :registro_imovel, :rua_imovel, :complemento_imovel, :pais_imovel, :vigencia, :dia_vencimento, :forma_pagamento)";


        $stmt = $pdo->prepare($sql);

    
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':data_nascimento_fundacao', $data_nascimento_fundacao);
        $stmt->bindParam(':nacionalidade', $nacionalidade);
        $stmt->bindParam(':cep', $cep);
        $stmt->bindParam(':bairro', $bairro);
        $stmt->bindParam(':estado', $estado);
        $stmt->bindParam(':cpf_cnpj', $cpf_cnpj);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->bindParam(':estado_civil', $estado_civil);
        $stmt->bindParam(':rua', $rua);
        $stmt->bindParam(':complemento', $complemento);
        $stmt->bindParam(':pais', $pais);
        $stmt->bindParam(':rg_ie', $rg_ie);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':profissao', $profissao);
        $stmt->bindParam(':numero', $numero);
        $stmt->bindParam(':cidade', $cidade);
        $stmt->bindParam(':cpf_cnpj_proprietario', $cpf_cnpj_proprietario);
        $stmt->bindParam(':tipo_imovel', $tipo_imovel);
        $stmt->bindParam(':numero_imovel', $numero_imovel);
        $stmt->bindParam(':cidade_imovel', $cidade_imovel);
        $stmt->bindParam(':taxa_venda', $taxa_venda);
        $stmt->bindParam(':cep_imovel', $cep_imovel);
        $stmt->bindParam(':bairro_imovel', $bairro_imovel);
        $stmt->bindParam(':estado_imovel', $estado_imovel);
        $stmt->bindParam(':valor_imovel', $valor_imovel);
        $stmt->bindParam(':registro_imovel', $registro_imovel);
        $stmt->bindParam(':rua_imovel', $rua_imovel);
        $stmt->bindParam(':complemento_imovel', $complemento_imovel);
        $stmt->bindParam(':pais_imovel', $pais_imovel);
        $stmt->bindParam(':vigencia', $vigencia);
        $stmt->bindParam(':dia_vencimento', $dia_vencimento);
        $stmt->bindParam(':forma_pagamento', $forma_pagamento);

        if ($stmt->execute()) {
            header("Location: ../../views/lista_contrato_venda.php");
        exit();
        } else {
            echo "Erro ao cadastrar contrato.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
