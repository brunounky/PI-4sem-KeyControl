<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

require '../controllers/db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cadastrar') {

    $nome_locatario = $_POST['locatario_nome'];
    $data_nascimento_locatario = $_POST['locatario_data_nascimento'];
    $nacionalidade_locatario = $_POST['locatario_nacionalidade'];
    $cep_locatario = $_POST['locatario_cep'];
    $bairro_locatario = $_POST['locatario_bairro'];
    $estado_locatario = $_POST['locatario_estado'];
    $cpf_cnpj_locatario = $_POST['locatario_cpf_cnpj'];
    $telefone_locatario = $_POST['locatario_telefone'];
    $estado_civil_locatario = $_POST['locatario_estado_civil'];
    $rua_locatario = $_POST['locatario_rua'];
    $complemento_locatario = $_POST['locatario_complemento'];
    $pais_locatario = $_POST['locatario_pais'];
    $rg_ie_locatario = $_POST['locatario_rg_ie'];
    $email_locatario = $_POST['locatario_email'];
    $profissao_locatario = $_POST['locatario_profissao'];
    $numero_locatario = $_POST['locatario_numero'];
    $cidade_locatario = $_POST['locatario_cidade'];

    $nome_fiador = $_POST['fiador_nome'];
    $data_nascimento_fiador = $_POST['fiador_data_nascimento'];
    $nacionalidade_fiador = $_POST['fiador_nacionalidade'];
    $cep_fiador = $_POST['fiador_cep'];
    $bairro_fiador = $_POST['fiador_bairro'];
    $estado_fiador = $_POST['fiador_estado'];
    $cpf_cnpj_fiador = $_POST['fiador_cpf_cnpj'];
    $telefone_fiador = $_POST['fiador_telefone'];
    $estado_civil_fiador = $_POST['fiador_estado_civil'];
    $rua_fiador = $_POST['fiador_rua'];
    $complemento_fiador = $_POST['fiador_complemento'];
    $pais_fiador = $_POST['fiador_pais'];
    $rg_ie_fiador = $_POST['fiador_rg_ie'];
    $email_fiador = $_POST['fiador_email'];
    $profissao_fiador = $_POST['fiador_profissao'];
    $numero_fiador = $_POST['fiador_numero'];
    $cidade_fiador = $_POST['fiador_cidade'];

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
    $data_vencimento = $_POST['contrato_data_vencimento']; 

    try {
        $sql = "INSERT INTO contrato_fiador (locatario_nome, locatario_data_nascimento, locatario_nacionalidade, locatario_cep, locatario_bairro, locatario_estado, locatario_cpf_cnpj, locatario_telefone, locatario_estado_civil, locatario_rua, locatario_complemento, locatario_pais, locatario_rg_ie, locatario_email, locatario_profissao, locatario_numero, locatario_cidade, fiador_nome, fiador_data_nascimento, fiador_nacionalidade, fiador_cep, fiador_bairro, fiador_estado, fiador_cpf_cnpj, fiador_telefone, fiador_estado_civil, fiador_rua, fiador_complemento, fiador_pais, fiador_rg_ie, fiador_email, fiador_profissao, fiador_numero, fiador_cidade, imovel_proprietario_cpf_cnpj, imovel_tipo, imovel_numero, imovel_cidade, imovel_taxa_venda, imovel_cep, imovel_bairro, imovel_estado, imovel_valor, imovel_registro, imovel_rua, imovel_complemento, imovel_pais, contrato_vigencia, contrato_dia_vencimento, contrato_forma_pagamento, contrato_data_vencimento) 
                VALUES (:nome_locatario, :data_nascimento_locatario, :nacionalidade_locatario, :cep_locatario, :bairro_locatario, :estado_locatario, :cpf_cnpj_locatario, :telefone_locatario, :estado_civil_locatario, :rua_locatario, :complemento_locatario, :pais_locatario, :rg_ie_locatario, :email_locatario, :profissao_locatario, :numero_locatario, :cidade_locatario, :nome_fiador, :data_nascimento_fiador, :nacionalidade_fiador, :cep_fiador, :bairro_fiador, :estado_fiador, :cpf_cnpj_fiador, :telefone_fiador, :estado_civil_fiador, :rua_fiador, :complemento_fiador, :pais_fiador, :rg_ie_fiador, :email_fiador, :profissao_fiador, :numero_fiador, :cidade_fiador, :cpf_cnpj_proprietario, :tipo_imovel, :numero_imovel, :cidade_imovel, :taxa_venda, :cep_imovel, :bairro_imovel, :estado_imovel, :valor_imovel, :registro_imovel, :rua_imovel, :complemento_imovel, :pais_imovel, :vigencia, :dia_vencimento, :forma_pagamento, :data_vencimento)";

        $stmt = $pdo->prepare($sql);

        $stmt->bindParam(':nome_locatario', $nome_locatario);
        $stmt->bindParam(':data_nascimento_locatario', $data_nascimento_locatario);
        $stmt->bindParam(':nacionalidade_locatario', $nacionalidade_locatario);
        $stmt->bindParam(':cep_locatario', $cep_locatario);
        $stmt->bindParam(':bairro_locatario', $bairro_locatario);
        $stmt->bindParam(':estado_locatario', $estado_locatario);
        $stmt->bindParam(':cpf_cnpj_locatario', $cpf_cnpj_locatario);
        $stmt->bindParam(':telefone_locatario', $telefone_locatario);
        $stmt->bindParam(':estado_civil_locatario', $estado_civil_locatario);
        $stmt->bindParam(':rua_locatario', $rua_locatario);
        $stmt->bindParam(':complemento_locatario', $complemento_locatario);
        $stmt->bindParam(':pais_locatario', $pais_locatario);
        $stmt->bindParam(':rg_ie_locatario', $rg_ie_locatario);
        $stmt->bindParam(':email_locatario', $email_locatario);
        $stmt->bindParam(':profissao_locatario', $profissao_locatario);
        $stmt->bindParam(':numero_locatario', $numero_locatario);
        $stmt->bindParam(':cidade_locatario', $cidade_locatario);
        $stmt->bindParam(':nome_fiador', $nome_fiador);
        $stmt->bindParam(':data_nascimento_fiador', $data_nascimento_fiador);
        $stmt->bindParam(':nacionalidade_fiador', $nacionalidade_fiador);
        $stmt->bindParam(':cep_fiador', $cep_fiador);
        $stmt->bindParam(':bairro_fiador', $bairro_fiador);
        $stmt->bindParam(':estado_fiador', $estado_fiador);
        $stmt->bindParam(':cpf_cnpj_fiador', $cpf_cnpj_fiador);
        $stmt->bindParam(':telefone_fiador', $telefone_fiador);
        $stmt->bindParam(':estado_civil_fiador', $estado_civil_fiador);
        $stmt->bindParam(':rua_fiador', $rua_fiador);
        $stmt->bindParam(':complemento_fiador', $complemento_fiador);
        $stmt->bindParam(':pais_fiador', $pais_fiador);
        $stmt->bindParam(':rg_ie_fiador', $rg_ie_fiador);
        $stmt->bindParam(':email_fiador', $email_fiador);
        $stmt->bindParam(':profissao_fiador', $profissao_fiador);
        $stmt->bindParam(':numero_fiador', $numero_fiador);
        $stmt->bindParam(':cidade_fiador', $cidade_fiador);
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
        $stmt->bindParam(':data_vencimento', $data_vencimento);

        if ($stmt->execute()) {
            header("Location: ../../views/lista_contrato_aluguel.php");
            exit();
        } else {
            echo "Erro ao cadastrar contrato.";
        }
    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    }
}
?>
