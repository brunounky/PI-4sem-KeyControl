<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

require '../controllers/db_conexao.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'cadastrar') {
    $cpf_cnpj_proprietario = $_POST['cpf_cnpj_proprietario'] ?? null;
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
    $registro_imovel = $_POST['registro_imovel'] ?? null;
    $registro_agua = $_POST['registro_agua'] ?? null;
    $valor_aluguel = $_POST['valor_aluguel'] ?? null;
    $taxa_aluguel = $_POST['taxa_aluguel'] ?? null;
    $valor_venda = $_POST['valor_venda'] ?? null;
    $taxa_venda = $_POST['taxa_venda'] ?? null;
    $complemento = $_POST['complemento'] ?? null;

    $id_imobiliaria = $_SESSION['user_cnpj'];

    $stmt = $pdo->prepare("INSERT INTO cadastro_imovel (cpf_cnpj_proprietario, tipo_imovel, quantidade_quartos, quantidade_banheiros, quantidade_vagas, area_total, cep, rua, numero, bairro, cidade, estado, pais, registro_imovel, registro_agua, valor_aluguel, taxa_aluguel, valor_venda, taxa_venda, complemento, id_imobiliaria) 
                            VALUES (:cpf_cnpj_proprietario, :tipo_imovel, :quantidade_quartos, :quantidade_banheiros, :quantidade_vagas, :area_total, :cep, :rua, :numero, :bairro, :cidade, :estado, :pais, :registro_imovel, :registro_agua, :valor_aluguel, :taxa_aluguel, :valor_venda, :taxa_venda, :complemento, :id_imobiliaria)");

    $stmt->bindParam(':cpf_cnpj_proprietario', $cpf_cnpj_proprietario);
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
    $stmt->bindParam(':registro_imovel', $registro_imovel);
    $stmt->bindParam(':registro_agua', $registro_agua);
    $stmt->bindParam(':valor_aluguel', $valor_aluguel);
    $stmt->bindParam(':taxa_aluguel', $taxa_aluguel);
    $stmt->bindParam(':valor_venda', $valor_venda);
    $stmt->bindParam(':taxa_venda', $taxa_venda);
    $stmt->bindParam(':complemento', $complemento);
    $stmt->bindParam(':id_imobiliaria', $id_imobiliaria);

    if ($stmt->execute()) {
        header("Location: ../../views/lista_imovel.php");
        exit();
    } else {
        echo "Erro ao cadastrar imóvel: " . $stmt->errorInfo()[2];
    }
}
?>