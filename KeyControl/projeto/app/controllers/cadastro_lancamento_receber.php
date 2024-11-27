<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

require '../controllers/db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cadastrar') {
    try {
        $valor_total = $_POST['valor_total'];

        $tipo_lancamento = $_POST['tipo_lancamento'];
        $data_emissao = $_POST['data_emissao'];
        $forma_pagamento = $_POST['forma_pagamento'];
        $registro_imovel = $_POST['registro_imovel'];
        $data_vencimento = $_POST['data_vencimento'];
        $observacoes = $_POST['observacoes'] ?? null;

        $id_imobiliaria = $_SESSION['user_cnpj'];

        $stmt = $pdo->prepare("
            INSERT INTO lancamento_financeiro 
            (valor_total, tipo_lancamento, data_emissao, forma_pagamento, registro_imovel, data_vencimento, observacoes, id_imobiliaria) 
            VALUES (:valor_total, :tipo_lancamento, :data_emissao, :forma_pagamento, :registro_imovel, :data_vencimento, :observacoes, :id_imobiliaria)
        ");

        $stmt->bindParam(':valor_total', $valor_total);
        $stmt->bindParam(':tipo_lancamento', $tipo_lancamento);
        $stmt->bindParam(':data_emissao', $data_emissao);
        $stmt->bindParam(':forma_pagamento', $forma_pagamento);
        $stmt->bindParam(':registro_imovel', $registro_imovel);
        $stmt->bindParam(':data_vencimento', $data_vencimento);
        $stmt->bindParam(':observacoes', $observacoes);
        $stmt->bindParam(':id_imobiliaria', $id_imobiliaria);

        if ($stmt->execute()) {
            header("Location: ../../views/lista_lancamento_receber.php");
            exit();
        } else {
            throw new Exception("Erro ao cadastrar lançamento. Verifique os dados e tente novamente.");
        }
    } catch (PDOException $e) {
        echo "Erro no banco de dados: " . $e->getMessage();
        exit();
    } catch (Exception $e) {
        echo "Erro: " . $e->getMessage();
        exit();
    }
} else {
    header("Location: ../../views/lista_lancamento_receber.php");
    exit();
}
?>
