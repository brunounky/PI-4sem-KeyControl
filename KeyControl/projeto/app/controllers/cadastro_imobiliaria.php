<?php
require '../controllers/db_conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cadastrar') {
    $cnpj = $_POST['cnpj'] ?? null;
    $nome_fantasia = $_POST['nome_fantasia'] ?? null;
    $endereco = $_POST['endereco'] ?? null;
    $numeroimobiliaria = $_POST['numeroimobiliaria'] ?? null;
    $cepimobiliaria = $_POST['cepimobiliaria'] ?? null;
    $cidadeimobiliaria = $_POST['cidadeimobiliaria'] ?? null;
    $telefoneimobiliaria = $_POST['telefoneimobiliaria'] ?? null;
    $emailimobiliaria = $_POST['emailimobiliaria'] ?? null;
    $logo_imobiliaria = null;

    // Tratamento do upload da imagem do logotipo
    if (isset($_FILES['logo_imobiliaria']) && $_FILES['logo_imobiliaria']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['logo_imobiliaria']['tmp_name'];
        $fileType = mime_content_type($fileTmpPath);

        // Verifica se o arquivo é uma imagem
        if (strpos($fileType, 'image') === 0) {
            // Lê o conteúdo do arquivo e converte para binário
            $logo_imobiliaria = file_get_contents($fileTmpPath);
        } else {
            echo "O arquivo enviado não é uma imagem válida.";
            exit();
        }
    }

    $stmt = $pdo->prepare("INSERT INTO imobiliaria (cnpj, nome_fantasia, endereco, numeroimobiliaria, cepimobiliaria, cidadeimobiliaria, telefoneimobiliaria, emailimobiliaria, logo_imobiliaria) 
                            VALUES (:cnpj, :nome_fantasia, :endereco, :numeroimobiliaria, :cepimobiliaria, :cidadeimobiliaria, :telefoneimobiliaria, :emailimobiliaria, :logo_imobiliaria)");

    $stmt->bindParam(':cnpj', $cnpj);
    $stmt->bindParam(':nome_fantasia', $nome_fantasia);
    $stmt->bindParam(':endereco', $endereco);
    $stmt->bindParam(':numeroimobiliaria', $numeroimobiliaria);
    $stmt->bindParam(':cepimobiliaria', $cepimobiliaria);
    $stmt->bindParam(':cidadeimobiliaria', $cidadeimobiliaria);
    $stmt->bindParam(':telefoneimobiliaria', $telefoneimobiliaria);
    $stmt->bindParam(':emailimobiliaria', $emailimobiliaria);
    $stmt->bindParam(':logo_imobiliaria', $logo_imobiliaria, PDO::PARAM_LOB);

    if ($stmt->execute()) {
        echo "Imobiliária cadastrada com sucesso!";
    } else {
        echo "Erro ao cadastrar imobiliária: " . $stmt->errorInfo()[2];
    }
} else {
    echo "Método de requisição inválido.";
}
?>
