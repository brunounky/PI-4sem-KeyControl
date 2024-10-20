<?php 
include '../app/controllers/db_conexao.php'; 
$result = null; // Inicialize a variável $result para evitar erros

if (isset($pdo) && $pdo) {
    $sql = "SELECT * FROM cadastro_cliente";
    $stmt = $pdo->query($sql); // Execute a consulta

    if ($stmt === false) {
        echo "Erro na consulta: " . $pdo->errorInfo()[2]; 
    } else {
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC); // Obtenha todos os resultados como um array associativo
    }
} else {
    echo "Erro na conexão com o banco de dados.";
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../public/assets/js/menu.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/style2.css">
    <link rel="icon" href="../public/assets/img/Logotipo.png">
    <title>Clientes</title>
</head>
<body>
<?php include 'navbar.php';?>
<section id="">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-3">Cadastro de Clientes</h2>
            </div>
        </div>
        
<div class="mt-12">
    <a href="../views/cadastro_cliente.php" class="btn btn-primary btn-lg">Adicionar Novo</a>
</div>
<form method="POST" action="filtros_clientes.php">
        <div class="filtros-container">
            <div class="row g-2">
                <div class="col-md-2">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" id="id" class="form-control" name="id">
                </div>
                <div class="col-md-2">
                    <label for="nome" class="form-label">Proprietário</label>
                    <input type="text" id="nome" class="form-control" name="Nome">
                </div>
                <div class="col-md-2">
                    <label for="cep" class="form-label">CEP</label>
                    <input type="text" id="cep" class="form-control" name="CEP">
                </div>
                <div class="col-md-2">
                    <label for="rua" class="form-label">Rua</label>
                    <input type="text" id="rua" class="form-control" name="rua">
                </div>
                <div class="col-md-2">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" id="bairro" class="form-control" name="bairro">
                </div>
                <div class="col-md-2">
                    <label class="form-label">Categoria</label><br>
                    <input type="checkbox" name="locador" value="1"> Locador<br>
                    <input type="checkbox" name="locatario" value="1"> Locatário<br>
                    <input type="checkbox" name="fiador" value="1"> Fiador<br>
                </div>
            </div>
            <div class="d-flex justify-content-end mt-2">
                <button class="btn btn-buscar">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </div>
</section>
</form>

<section id="lista_cadastro_pessoa">
    <div class="container">
        <div class="card relatório">
 <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>CEP</th>
                        <th>Rua</th>
                        <th>Número</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($result && count($result) > 0) { // Agora $result é um array
                    foreach ($result as $row) {
                        echo "<tr>
                                <td>" . ($row['id'] ?? '') . "</td>
                                <td>" . ($row['nome'] ?? '') . "</td>
                                <td>" . ($row['cep'] ?? '') . "</td>
                                <td>" . ($row['rua'] ?? '') . "</td>
                                <td>" . ($row['numero'] ?? '') . "</td>
                                <td>" . ($row['bairro'] ?? '') . "</td>
                                <td>" . ($row['cidade'] ?? '') . "</td>
                            </tr>";
                    }
                } else {
                    echo "<tr><td colspan='8'>Nenhum registro encontrado</td></tr>";
                }
                ?>
            </tbody>
            </table>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="../public/assets/js/consultacep.js"></script>
</body>
</html>