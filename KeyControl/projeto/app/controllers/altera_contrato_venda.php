<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

require '../controllers/db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'atualizar') {

    $nome = $_POST['comprador_nome'] ?? null;
    $data_nascimento_fundacao = $_POST['comprador_data_nascimento'] ?? null;
    $nacionalidade = $_POST['comprador_nacionalidade'] ?? null;
    $cep = $_POST['comprador_cep'] ?? null;
    $bairro = $_POST['comprador_bairro'] ?? null;
    $estado = $_POST['comprador_estado'] ?? null;
    $cpf_cnpj = $_POST['comprador_cpf_cnpj'] ?? null;
    $telefone = $_POST['comprador_telefone'] ?? null;
    $estado_civil = $_POST['comprador_estado_civil'] ?? null;
    $rua = $_POST['comprador_rua'] ?? null;
    $complemento = $_POST['comprador_complemento'] ?? null;
    $pais = $_POST['comprador_pais'] ?? null;
    $rg_ie = $_POST['comprador_rg_ie'] ?? null;
    $email = $_POST['comprador_email'] ?? null;
    $profissao = $_POST['comprador_profissao'] ?? null;
    $numero = $_POST['comprador_numero'] ?? null;
    $cidade = $_POST['comprador_cidade'] ?? null;

    $cpf_cnpj_proprietario = $_POST['imovel_proprietario_cpf_cnpj'] ?? null;
    $tipo_imovel = $_POST['imovel_tipo'] ?? null;
    $numero_imovel = $_POST['imovel_numero'] ?? null;
    $cidade_imovel = $_POST['imovel_cidade'] ?? null;
    $taxa_venda = $_POST['imovel_taxa_venda'] ?? null;
    $cep_imovel = $_POST['imovel_cep'] ?? null;
    $bairro_imovel = $_POST['imovel_bairro'] ?? null;
    $estado_imovel = $_POST['imovel_estado'] ?? null;
    $valor_imovel = $_POST['imovel_valor'] ?? null;
    $registro_imovel = $_POST['imovel_registro'] ?? null;
    $rua_imovel = $_POST['imovel_rua'] ?? null;
    $complemento_imovel = $_POST['imovel_complemento'] ?? null;
    $pais_imovel = $_POST['imovel_pais'] ?? null;

    $data_emissao = $_POST['data_emissao'] ?? null;
    $data_vencimento = $_POST['data_vencimento'] ?? null;
    $forma_pagamento = $_POST['forma_pagamento'] ?? null;
    $id = $_POST['id'] ?? null;

    $sql_contrato = "UPDATE contrato_venda SET 
        comprador_nome = :nome,
        comprador_data_nascimento = :data_nascimento_fundacao,
        comprador_nacionalidade = :nacionalidade,
        comprador_cep = :cep,
        comprador_bairro = :bairro,
        comprador_estado = :estado,
        comprador_cpf_cnpj = :cpf_cnpj,
        comprador_telefone = :telefone,
        comprador_estado_civil = :estado_civil,
        comprador_rua = :rua,
        comprador_complemento = :complemento,
        comprador_pais = :pais,
        comprador_rg_ie = :rg_ie,
        comprador_email = :email,
        comprador_profissao = :profissao,
        comprador_numero = :numero,
        comprador_cidade = :cidade,
        imovel_proprietario_cpf_cnpj = :cpf_cnpj_proprietario,
        imovel_tipo = :tipo_imovel,
        imovel_numero = :numero_imovel,
        imovel_cidade = :cidade_imovel,
        imovel_taxa_venda = :taxa_venda,
        imovel_cep = :cep_imovel,
        imovel_bairro = :bairro_imovel,
        imovel_estado = :estado_imovel,
        imovel_valor = :valor_imovel,
        imovel_registro = :registro_imovel,
        imovel_rua = :rua_imovel,
        imovel_complemento = :complemento_imovel,
        imovel_pais = :pais_imovel,
        data_emissao = :data_emissao,
        data_vencimento = :data_vencimento,
        forma_pagamento = :forma_pagamento
    WHERE id = :id";

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
    $stmt_contrato->bindParam(':cep_imovel', $cep_imovel)   ;
    $stmt_contrato->bindParam(':bairro_imovel', $bairro_imovel);
    $stmt_contrato->bindParam(':estado_imovel', $estado_imovel);
    $stmt_contrato->bindParam(':valor_imovel', $valor_imovel);
    $stmt_contrato->bindParam(':registro_imovel', $registro_imovel);
    $stmt_contrato->bindParam(':rua_imovel', $rua_imovel);
    $stmt_contrato->bindParam(':complemento_imovel', $complemento_imovel);
    $stmt_contrato->bindParam(':pais_imovel', $pais_imovel);
    $stmt_contrato->bindParam(':data_emissao', $data_emissao);
    $stmt_contrato->bindParam(':data_vencimento', $data_vencimento);
    $stmt_contrato->bindParam(':forma_pagamento', $forma_pagamento);
    $stmt_contrato->bindParam(':id', $id);

    if ($stmt_contrato->execute()) {
        $sql_lancamento = "UPDATE lancamento_financeiro SET 
            valor_total = :valor_imovel,
            registro_imovel = :registro_imovel,
            data_emissao = :data_emissao,
            data_vencimento = :data_vencimento,
            forma_pagamento = :forma_pagamento
        WHERE id_lancamento = :id";
    
        $stmt_lancamento = $pdo->prepare($sql_lancamento);
    
        if ($stmt_lancamento->execute([
            ':valor_imovel' => $valor_imovel,
            ':registro_imovel' => $registro_imovel,
            ':data_emissao' => $data_emissao,
            ':data_vencimento' => $data_vencimento,
            ':forma_pagamento' => $forma_pagamento,
            ':id' => $id
        ])) {
            // Redireciona se ambas as queries forem bem-sucedidas
            header("Location: ../../views/lista_contrato_venda.php");
            exit();
        } else {
            // Exibe o erro específico da tabela lancamento_financeiro
            echo "Erro ao atualizar lancamento_financeiro: " . $stmt_lancamento->errorInfo()[2];
        }
    } else {
        // Exibe o erro específico da tabela contrato_venda
        echo "Erro ao atualizar contrato_venda: " . $stmt_contrato->errorInfo()[2];
    }
    
}
?>
