<?php 
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../app/controllers/verifica_login.php");
        exit();
    }
include '../app/controllers/filtros_pessoas.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/assets/js/menu.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/style2.css">
    <link rel="icon" href="../public/assets/img/Logotipo.png">
    <title>Clientes</title>
</head>
<body>
<?php include 'navbar.php';?>
<section>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Cadastro de Imóvel</h2>
            <a href="../views/cadastro_imovel.php" class="button_adicionarnovo">Adicionar Novo +</a>
        </div>
    </div>

    <div class="container">
        <form method="POST" action="">
            <div class="filtros-container">
                <div class="row g-2">
                    <div class="col-md-1">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" id="id" class="form-control" name="id" value="<?= htmlspecialchars($_POST['id'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="nome" class="form-label">Nome</label>
                        <input type="text" id="nome" class="form-control" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" id="cep" class="form-control" name="cep" value="<?= htmlspecialchars($_POST['cep'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="rua" class="form-label">Rua</label>
                        <input type="text" id="rua" class="form-control" name="rua" value="<?= htmlspecialchars($_POST['rua'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="bairro" class="form-label">Bairro</label>
                        <input type="text" id="bairro" class="form-control" name="bairro" value="<?= htmlspecialchars($_POST['bairro'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" id="cidade" class="form-control" name="cidade" value="<?= htmlspecialchars($_POST['cidade'] ?? '') ?>">
                    </div>
                </div>
                <div class="d-flex justify-content-end mt-2">
                    <button class="btn btn-buscar">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </div>
        </form>
    </div>
</section>

<section>
    <div class="container">
        <div class="card_relatório">
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
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                <?php
                if ($result && count($result) > 0) {
                    for ($i = 0; $i < count($result); $i++) {
                        $row = $result[$i];
                        echo "<tr>
                                <td>" . htmlspecialchars($row['id']) . "</td>
                                <td>" . htmlspecialchars($row['nome']) . "</td>
                                <td>" . htmlspecialchars($row['cep']) . "</td>
                                <td>" . htmlspecialchars($row['rua']) . "</td>
                                <td>" . htmlspecialchars($row['numero']) . "</td>
                                <td>" . htmlspecialchars(substr($row['bairro'], 0, 20) . (strlen($row['bairro']) > 20 ? '...' : '')) . "</td>
                                <td>" . htmlspecialchars($row['cidade']) . "</td>
                                <td>
                                     <button class='btn btn-link' onclick='toggleSubMenu(this)'>
                                        <i class='bi bi-chevron-down'></i>
                                    </button>
                                    <div class='submenu' style='display: none;'> 
                                        <div class='submenu-options'>
                                            <button class='imprimir' onclick='printInfo(" . htmlspecialchars($row['id']) . ")'>
                                                <i class='bi bi-printer'></i> Imprimir
                                            </button>
                                            <button class='email' onclick='sendEmail(\"" . htmlspecialchars($row['email'] ?? '') . "\")'>
                                                <i class='bi bi-envelope'></i>E-mail
                                            </button>
                                            <button class='excluir' onclick='deleteRecord(" . htmlspecialchars($row['id']) . ")'>
                                                <i class='bi bi-trash'></i> Excluir
                                            </button>
                                    </div>
                                </div>
                                </td>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../public/assets/js/consultacep.js"></script>
<script src="../public/assets/js/submenu.js"></script>

</body>
</html>
