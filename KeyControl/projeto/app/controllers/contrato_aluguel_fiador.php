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

    $nome_fiador = $_POST['fiador_nome'] ?? null;
    $data_nascimento_fiador = $_POST['fiador_data_nascimento'] ?? null;
    $nacionalidade_fiador = $_POST['fiador_nacionalidade'] ?? null;
    $cep_fiador = $_POST['fiador_cep'] ?? null;
    $bairro_fiador = $_POST['fiador_bairro'] ?? null;
    $estado_fiador = $_POST['fiador_estado'] ?? null;
    $cpf_cnpj_fiador = $_POST['fiador_cpf_cnpj'] ?? null;
    $telefone_fiador = $_POST['fiador_telefone'] ?? null;
    $estado_civil_fiador = $_POST['fiador_estado_civil'] ?? null;
    $rua_fiador = $_POST['fiador_rua'] ?? null;
    $complemento_fiador = $_POST['fiador_complemento'] ?? null;
    $pais_fiador = $_POST['fiador_pais'] ?? null;
    $rg_ie_fiador = $_POST['fiador_rg_ie'] ?? null;
    $email_fiador = $_POST['fiador_email'] ?? null;
    $profissao_fiador = $_POST['fiador_profissao'] ?? null;
    $numero_fiador = $_POST['fiador_numero'] ?? null;
    $cidade_fiador = $_POST['fiador_cidade'] ?? null;

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
    $forma_pagamento = $_POST['contrato_forma_pagamento'];
    $data_vencimento = $_POST['contrato_data_vencimento'];

    $meses_caucao = $_POST['meses_caucao'] ?? null;
    $vencimento_caucao = $_POST['vencimento_caucao'] ?? null;
    $total_caucao = $_POST['total_caucao'] ?? null;
    $forma_pagamento_caucao = $_POST['forma_pagamento_caucao'] ?? null;

    $id_imobiliaria = $_SESSION['user_cnpj'];

    $id_imobiliaria = $_SESSION['user_cnpj'];
    $data_emissao = date("Y-m-d");
    $tipo_lancamento = "aluguel fiador";

    try {
        $sql_lancamento = "INSERT INTO lancamento_financeiro (
            data_vigencia, data_vencimento, forma_pagamento, id_imobiliaria, registro_imovel, 
            data_emissao, tipo_lancamento, valor_total
        ) 
        VALUES (
            :vigencia, :data_vencimento, :forma_pagamento, :id_imobiliaria, :registro_imovel, :data_emissao, :tipo_lancamento, :valor_imovel
        )";

                $stmt_lancamento = $pdo->prepare($sql_lancamento);

                $stmt_lancamento->bindParam(':vigencia', $vigencia);
                $stmt_lancamento->bindParam(':data_vencimento', $data_vencimento);
                $stmt_lancamento->bindParam(':forma_pagamento', $forma_pagamento);
                $stmt_lancamento->bindParam(':id_imobiliaria', $id_imobiliaria);
                $stmt_lancamento->bindParam(':registro_imovel', $registro_imovel);
                $stmt_lancamento->bindParam(':data_emissao', $data_emissao);
                $stmt_lancamento->bindParam(':tipo_lancamento', $tipo_lancamento);
                $stmt_lancamento->bindParam(':valor_imovel', $valor_imovel);

                $stmt_lancamento->execute();

                $id_lancamento = $pdo->lastInsertId();

        $sql_contrato = "INSERT INTO contrato_aluguel (
                            locatario_nome, locatario_data_nascimento, locatario_nacionalidade, locatario_cep, locatario_bairro, locatario_estado, 
                            locatario_cpf_cnpj, locatario_telefone, locatario_estado_civil, locatario_rua, locatario_complemento, locatario_pais, 
                            locatario_rg_ie, locatario_email, locatario_profissao, locatario_numero, locatario_cidade, fiador_nome, fiador_data_nascimento, 
                            fiador_nacionalidade, fiador_cep, fiador_bairro, fiador_estado, fiador_cpf_cnpj, fiador_telefone, fiador_estado_civil, 
                            fiador_rua, fiador_complemento, fiador_pais, fiador_rg_ie, fiador_email, fiador_profissao, fiador_numero, fiador_cidade, 
                            imovel_proprietario_cpf_cnpj, imovel_tipo, imovel_numero, imovel_cidade, imovel_taxa_venda, imovel_cep, imovel_bairro, 
                            imovel_estado, imovel_valor, imovel_registro, imovel_rua, imovel_complemento, imovel_pais, contrato_vigencia, contrato_forma_pagamento, contrato_data_vencimento, id_imobiliaria, meses_caucao, vencimento_caucao, 
                            total_caucao, forma_pagamento_caucao, id_lancamento
                        ) 
                        VALUES (
                            :nome_locatario, :data_nascimento_locatario, :nacionalidade_locatario, :cep_locatario, :bairro_locatario, :estado_locatario, 
                            :cpf_cnpj_locatario, :telefone_locatario, :estado_civil_locatario, :rua_locatario, :complemento_locatario, :pais_locatario, 
                            :rg_ie_locatario, :email_locatario, :profissao_locatario, :numero_locatario, :cidade_locatario, :nome_fiador, :data_nascimento_fiador, 
                            :nacionalidade_fiador, :cep_fiador, :bairro_fiador, :estado_fiador, :cpf_cnpj_fiador, :telefone_fiador, :estado_civil_fiador, 
                            :rua_fiador, :complemento_fiador, :pais_fiador, :rg_ie_fiador, :email_fiador, :profissao_fiador, :numero_fiador, :cidade_fiador, 
                            :cpf_cnpj_proprietario, :tipo_imovel, :numero_imovel, :cidade_imovel, :taxa_venda, :cep_imovel, :bairro_imovel, :estado_imovel, 
                            :valor_imovel, :registro_imovel, :rua_imovel, :complemento_imovel, :pais_imovel, :vigencia, :forma_pagamento, 
                            :data_vencimento, :id_imobiliaria, :meses_caucao, :vencimento_caucao, :total_caucao, :forma_pagamento_caucao, :id_lancamento
                        )";

        $stmt_contrato = $pdo->prepare($sql_contrato);

        $stmt_contrato->bindParam(':nome_locatario', $nome_locatario);
        $stmt_contrato->bindParam(':data_nascimento_locatario', $data_nascimento_locatario);
        $stmt_contrato->bindParam(':nacionalidade_locatario', $nacionalidade_locatario);
        $stmt_contrato->bindParam(':cep_locatario', $cep_locatario);
        $stmt_contrato->bindParam(':bairro_locatario', $bairro_locatario);
        $stmt_contrato->bindParam(':estado_locatario', $estado_locatario);
        $stmt_contrato->bindParam(':cpf_cnpj_locatario', $cpf_cnpj_locatario);
        $stmt_contrato->bindParam(':telefone_locatario', $telefone_locatario);
        $stmt_contrato->bindParam(':estado_civil_locatario', $estado_civil_locatario);
        $stmt_contrato->bindParam(':rua_locatario', $rua_locatario);
        $stmt_contrato->bindParam(':complemento_locatario', $complemento_locatario);
        $stmt_contrato->bindParam(':pais_locatario', $pais_locatario);
        $stmt_contrato->bindParam(':rg_ie_locatario', $rg_ie_locatario);
        $stmt_contrato->bindParam(':email_locatario', $email_locatario);
        $stmt_contrato->bindParam(':profissao_locatario', $profissao_locatario);
        $stmt_contrato->bindParam(':numero_locatario', $numero_locatario);
        $stmt_contrato->bindParam(':cidade_locatario', $cidade_locatario);
        $stmt_contrato->bindParam(':nome_fiador', $nome_fiador);
        $stmt_contrato->bindParam(':data_nascimento_fiador', $data_nascimento_fiador);
        $stmt_contrato->bindParam(':nacionalidade_fiador', $nacionalidade_fiador);
        $stmt_contrato->bindParam(':cep_fiador', $cep_fiador);
        $stmt_contrato->bindParam(':bairro_fiador', $bairro_fiador);
        $stmt_contrato->bindParam(':estado_fiador', $estado_fiador);
        $stmt_contrato->bindParam(':cpf_cnpj_fiador', $cpf_cnpj_fiador);
        $stmt_contrato->bindParam(':telefone_fiador', $telefone_fiador);
        $stmt_contrato->bindParam(':estado_civil_fiador', $estado_civil_fiador);
        $stmt_contrato->bindParam(':rua_fiador', $rua_fiador);
        $stmt_contrato->bindParam(':complemento_fiador', $complemento_fiador);
        $stmt_contrato->bindParam(':pais_fiador', $pais_fiador);
        $stmt_contrato->bindParam(':rg_ie_fiador', $rg_ie_fiador);
        $stmt_contrato->bindParam(':email_fiador', $email_fiador);
        $stmt_contrato->bindParam(':profissao_fiador', $profissao_fiador);
        $stmt_contrato->bindParam(':numero_fiador', $numero_fiador);
        $stmt_contrato->bindParam(':cidade_fiador', $cidade_fiador);
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
        $stmt_contrato->bindParam(':vigencia', $vigencia);
        $stmt_contrato->bindParam(':forma_pagamento', $forma_pagamento);
        $stmt_contrato->bindParam(':data_vencimento', $data_vencimento);
        $stmt_contrato->bindParam(':id_imobiliaria', $id_imobiliaria);
        $stmt_contrato->bindParam(':meses_caucao', $meses_caucao);
        $stmt_contrato->bindParam(':vencimento_caucao', $vencimento_caucao);
        $stmt_contrato->bindParam(':total_caucao', $total_caucao);
        $stmt_contrato->bindParam(':forma_pagamento_caucao', $forma_pagamento_caucao);
        $stmt_contrato->bindParam(':id_lancamento', $id_lancamento);
        
        $stmt_contrato->execute();

        header("Location: ../../views/lista_contrato.php");
        exit();
    } catch (PDOException $e) {
        echo "Erro ao cadastrar contrato: " . $e->getMessage();
    }
}
?>