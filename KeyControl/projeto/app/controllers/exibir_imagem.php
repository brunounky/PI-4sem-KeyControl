<?php
include '../app/controllers/db_conexao.php';

if (isset($_GET['cnpj'])) {
    $cnpj = $_GET['cnpj'];

    try {
        $stmt = $pdo->prepare("SELECT logo_imobiliaria FROM imobiliaria WHERE cnpj = :cnpj");
        $stmt->bindParam(':cnpj', $cnpj);
        $stmt->execute();

        $dados = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($dados) {
            header("Content-Type: image/png");
            echo $dados['logo_imobiliaria'];
        } else {
            echo "Imagem não encontrada.";
        }
    } catch (PDOException $e) {
        echo "Erro ao buscar a imagem: " . htmlspecialchars($e->getMessage());
    }
} else {
    echo "CNPJ não fornecido.";
}
