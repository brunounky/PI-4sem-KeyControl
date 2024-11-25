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

    $emissao = $_POST['data_emissao'];
    $data_vencimento = $_POST['data_vencimento'];
    $forma_pagamento = $_POST['forma_pagamento'];

    $id_imobiliaria = $_SESSION['user_cnpj'];

    try {
        $pdo->beginTransaction();

        $sql_lancamento = "INSERT INTO lancamento_financeiro (id_imobiliaria, registro_imovel, data_emissao, valor_total, data_vencimento, forma_pagamento, tipo_lancamento) 
                VALUES (:id_imobiliaria, :registro_imovel, :data_emissao, :valor_imovel, :data_vencimento, :forma_pagamento, 'venda imovel')";

        $stmt_lancamento = $pdo->prepare($sql_lancamento);

        $stmt_lancamento->bindParam(':id_imobiliaria', $id_imobiliaria);
        $stmt_lancamento->bindParam(':registro_imovel', $registro_imovel);
        $stmt_lancamento->bindParam(':data_emissao', $emissao);
        $stmt_lancamento->bindParam(':valor_imovel', $valor_imovel);
        $stmt_lancamento->bindParam(':data_vencimento', $data_vencimento);
        $stmt_lancamento->bindParam(':forma_pagamento', $forma_pagamento);

        $stmt_lancamento->execute();


        $id_lancamento = $pdo->lastInsertId();

        $sql_contrato = "INSERT INTO contrato_venda (comprador_nome, comprador_data_nascimento, comprador_nacionalidade, comprador_cep, comprador_bairro, comprador_estado, comprador_cpf_cnpj, comprador_telefone, comprador_estado_civil, comprador_rua, comprador_complemento, comprador_pais, comprador_rg_ie, comprador_email, comprador_profissao, comprador_numero, comprador_cidade, imovel_proprietario_cpf_cnpj, imovel_tipo, imovel_numero, imovel_cidade, imovel_taxa_venda, imovel_cep, imovel_bairro, imovel_estado, imovel_valor, imovel_registro, imovel_rua, imovel_complemento, imovel_pais, data_emissao, data_vencimento, forma_pagamento, id_imobiliaria, id_lancamento) 
                VALUES (:nome, :data_nascimento_fundacao, :nacionalidade, :cep, :bairro, :estado, :cpf_cnpj, :telefone, :estado_civil, :rua, :complemento, :pais, :rg_ie, :email, :profissao, :numero, :cidade, :cpf_cnpj_proprietario, :tipo_imovel, :numero_imovel, :cidade_imovel, :taxa_venda, :cep_imovel, :bairro_imovel, :estado_imovel, :valor_imovel, :registro_imovel, :rua_imovel, :complemento_imovel, :pais_imovel, :emissao, :data_vencimento, :forma_pagamento, :id_imobiliaria, :id_lancamento)";

        $stmt_contrato = $pdo->prepare($sql_contrato);

        $stmt_contrato->bindParam(':nome', $nome);
        $stmt_contrato->bindParam(':data_nascimento_fundacao', $data_nascimento_fundacao);
        $stmt_contrato->bindParam(':nacionalidade', $nacionalidade);
        $stmt_contrato->bindParam(':cep', $cep);
        $stmt_contrato->bindParam(':bairro', $bairro);
        $stmt_contrato->bindParam(':estado', $estado);
        $stmt_contrato->bindParam(':cpf_cnpj', $cpf_cnpj);
        $stmt_contrato->bindParam(':telefone', $telefone);
        $stmt_contrato->bindParam(':estado_civil', $estado_civil);
        $stmt_contrato->bindParam(':rua', $rua);
        $stmt_contrato->bindParam(':complemento', $complemento);
        $stmt_contrato->bindParam(':pais', $pais);
        $stmt_contrato->bindParam(':rg_ie', $rg_ie);
        $stmt_contrato->bindParam(':email', $email);
        $stmt_contrato->bindParam(':profissao', $profissao);
        $stmt_contrato->bindParam(':numero', $numero);
        $stmt_contrato->bindParam(':cidade', $cidade);
        $stmt_contrato->bindParam(':cpf_cnpj_proprietario', $cpf_cnpj_proprietario);
        $stmt_contrato->bindParam(':tipo_imovel', $tipo_imovel);
        $stmt_contrato->bindParam(':numero_imovel', $numero_imovel);
        $stmt_contrato->bindParam(':cidade_imovel', $cidade_imovel);
        $stmt_contrato->bindParam(':taxa_venda', $taxa_venda);
        $stmt_contrato->bindParam(':cep_imovel', $cep_imovel);
        $stmt_contrato->bindParam(':bairro_imovel', $bairro_imovel);
        $stmt_contrato->bindParam(':estado_imovel', $estado_imovel);
        $stmt_contrato->bindParam(':valor_imovel', $valor_imovel);
        $stmt_contrato->bindParam(':registro_imovel', $registro_imovel);
        $stmt_contrato->bindParam(':rua_imovel', $rua_imovel);
        $stmt_contrato->bindParam(':complemento_imovel', $complemento_imovel);
        $stmt_contrato->bindParam(':pais_imovel', $pais_imovel);
        $stmt_contrato->bindParam(':emissao', $emissao);
        $stmt_contrato->bindParam(':data_vencimento', $data_vencimento);
        $stmt_contrato->bindParam(':forma_pagamento', $forma_pagamento);
        $stmt_contrato->bindParam(':id_imobiliaria', $id_imobiliaria);
        $stmt_contrato->bindParam(':id_lancamento', $id_lancamento);

        $stmt_contrato->execute();

        $pdo->commit();

        header("Location: ../../views/lista_contrato_venda.php");
        exit();
    } catch (PDOException $e) {
        $pdo->rollBack();
        echo "Erro ao cadastrar contrato: " . $e->getMessage();
    }
}
?>
