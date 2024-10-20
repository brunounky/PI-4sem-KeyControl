<?php 
include '../app/controllers/db_conexao.php'; 


if (isset($conn) && $conn) {
    $sql = "SELECT * FROM clientes";
    $result = $conn->query($sql);}
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
<?php include 'navbar.php'; ?> <!-- Incluindo a barra de navegação -->
<section id="">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2 class="mb-3">Cadastro de Clientes</h2>
            </div>
        </div>

        <!-- Filtros -->
        <div class="filtros-container">
            <div class="row g-2">
                <div class="col-md-2">
                    <label for="id" class="form-label">ID</label>
                    <input type="text" id="id" class="form-control" name="id">
                </div>
                <div class="col-md-3">
                    <label for="proprietario" class="form-label">Proprietário</label>
                    <input type="text" id="proprietario" class="form-control" name="proprietario">
                </div>
                <div class="col-md-3">
                    <label for="rua" class="form-label">Rua</label>
                    <input type="text" id="rua" class="form-control" name="rua">
                </div>
                <div class="col-md-2">
                    <label for="bairro" class="form-label">Bairro</label>
                    <input type="text" id="bairro" class="form-control" name="bairro">
                </div>
                <div class="col-md-2">
                    <label for="tipo_imovel" class="form-label">Tipo de Imóvel</label>
                    <input type="text" id="tipo_imovel" class="form-control" name="tipo_imovel">
                </div>
            </div>
            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-buscar">
                    <i class="bi bi-search"></i>
                </button>
            </div>
        </div>
    </div>
</section>

<!-- Card para a tabela -->
<section id="lista_cadastro_pessoa">
    <div class="container">
        <div class="card relatório">
 <table class="table table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Tipo</th>
                        <th>Área</th>
                        <th>CEP</th>
                        <th>Endereço</th>
                        <th>Número</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                                    <td>{$row['id']}</td>
                                    <td>{$row['tipo']}</td>
                                    <td>{$row['area']}</td>
                                    <td>{$row['cep']}</td>
                                    <td>{$row['endereco']}</td>
                                    <td>{$row['numero']}</td>
                                    <td>{$row['bairro']}</td>
                                    <td>{$row['cidade']}</td>
                                    <td>R$ " . number_format($row['valor'], 2, ',', '.') . "</td>
                                </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='9'>Nenhum registro encontrado</td></tr>";
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