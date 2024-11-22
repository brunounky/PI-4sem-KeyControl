<?php
require '../controllers/db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $imovel_registro = $_POST['imovel_registro'] ?? null;

    if (!$imovel_registro) {
        echo json_encode(['error' => 'Número de registro do imóvel não fornecido']);
        exit();
    }

    try {
        $stmt = $pdo->prepare("SELECT * FROM `cadastro_imovel` WHERE registro_imovel = :registro_imovel");
        
        $stmt->bindParam(':registro_imovel', $imovel_registro);
        $stmt->execute();

        $imovel = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($imovel) {
            echo json_encode($imovel);
        } else {
            echo json_encode(['error' => 'Imóvel não encontrado']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Erro no banco de dados: ' . $e->getMessage()]);
    }
}
?>
