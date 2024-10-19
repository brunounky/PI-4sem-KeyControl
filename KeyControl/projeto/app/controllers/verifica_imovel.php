<?php
require '../controllers/db_conexao.php';


if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cadastro_imovel') {
    $cnpj_proprietario = $_POST['cnpj_proprietario'] ?? null;
    $tipo_imovel = $_POST['tipo_imovel'] ?? null;
    $quantidade_quartos = $_POST['quantidade_quartos'] ?? null;
    $quantidade_banheiros = $_POST['quantidade_banheiros'] ?? null;
    $quantidade_vagas = $_POST['quantidade_vagas'] ?? null;
    $area_total = $_POST['area_total'] ?? null;
    $cep = $_POST['cep'] ?? null;
    $rua = $_POST['rua'] ?? null;
    $numero = $_POST['numero'] ?? null;
    $bairro = $_POST['bairro'] ?? null;
    $cidade = $_POST['cidade'] ?? null;
    $estado = $_POST['estado'] ?? null;
    $pais = $_POST['pais'] ?? null;
    $numero_registro_imovel = $_POST['numero_registro_imovel'] ?? null;
    $numero_registro_agua = $_POST['numero_registro_agua'] ?? null;
    $valor_aluguel = $_POST['valor_aluguel'] ?? null;
    $taxa_aluguel = $_POST['taxa_aluguel'] ?? null;
    $valor_venda = $_POST['valor_venda'] ?? null;
    $taxa_venda = $_POST['taxa_venda'] ?? null;
    $complemento = $_POST['complemento'] ?? null;

    if (empty($cnpj_proprietario) || empty($tipo_imovel) || empty($quantidade_quartos) || empty($cep) || empty($rua) || empty($bairro) || empty($cidade) || empty($estado) || empty($pais)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
        exit;
    }

    $stmt = $pdo->prepare("INSERT INTO cadastro_imovel (cnpj_proprietario, tipo_imovel, quantidade_quartos, quantidade_banheiros, quantidade_vagas, area_total, cep, rua, numero, bairro, cidade, estado, pais, numero_registro_imovel, numero_registro_agua, valor_aluguel, taxa_aluguel, valor_venda, taxa_venda, complemento) 
                            VALUES (:cnpj_proprietario, :tipo_imovel, :quantidade_quartos, :quantidade_banheiros, :quantidade_vagas, :area_total, :cep, :rua, :numero, :bairro, :cidade, :estado, :pais, :numero_registro_imovel, :numero_registro_agua, :valor_aluguel, :taxa_aluguel, :valor_venda, :taxa_venda, :complemento)");

    $stmt->bindParam(':cnpj_proprietario', $cnpj_proprietario);
    $stmt->bindParam(':tipo_imovel', $tipo_imovel);
    $stmt->bindParam(':quantidade_quartos', $quantidade_quartos);
    $stmt->bindParam(':quantidade_banheiros', $quantidade_banheiros);
    $stmt->bindParam(':quantidade_vagas', $quantidade_vagas);
    $stmt->bindParam(':area_total', $area_total);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':rua', $rua);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':pais', $pais);
    $stmt->bindParam(':numero_registro_imovel', $numero_registro_imovel);
    $stmt->bindParam(':numero_registro_agua', $numero_registro_agua);
    $stmt->bindParam(':valor_aluguel', $valor_aluguel);
    $stmt->bindParam(':taxa_aluguel', $taxa_aluguel);
    $stmt->bindParam(':valor_venda', $valor_venda);
    $stmt->bindParam(':taxa_venda', $taxa_venda);
    $stmt->bindParam(':complemento', $complemento);

    if ($stmt->execute()) {
        echo "Imóvel cadastrado com sucesso!";
    } else {
        echo "Erro ao cadastrar imóvel: " . $stmt->errorInfo()[2];
    }
}
?>