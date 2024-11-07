<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: verifica_login.php");
    exit();
}

include '../controllers/db_conexao.php';

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $query = "DELETE FROM cadastro_imovel WHERE id = :id";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        if ($stmt->execute()) {
            header("Location: ../../views/lista_imovel.php?success=1");
            exit();
        } else {
            header("Location: ../../views/lista_imovel.php?error=1");
            exit();
        }
    } catch (PDOException $e) {
        header("Location: ../../views/lista_imovel.php?error=1");
        exit();
    }
} else {
    header("Location: ../../views/lista_imovel.php?error=1");
    exit();
}
?>
