<?php 
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../app/controllers/verifica_login.php");
        exit();
    }

    include_once '../app/controllers/filtro_contrato_aluguel.php';
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
    <link rel="icon" href="../public/assets/img/Logotipo.svg">
    <title>Contratos de Aluguel</title>
</head>
<body>
<?php include 'navbar.php';?>
    <section>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Contrato de Aluguel</h2>
                <div class="button_adicionarnovo">
                    <a class="button_adicionarnovo floating dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false" href="">
                        <span class="button_adicionarnovo">Adicionar novo +</span>
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li><a class="dropdown-item" href="../views/contrato_aluguel_fiador.php" tabindex="-1">Aluguel Fiador</a></li>
                        <li><a class="dropdown-item" href="../views/contrato_aluguel_caucao.php" tabindex="-1">Aluguel Caução</a></li>
                    </ul>
                </div>
            </div>
        </div>

    <div class="container">
        <form method="POST" action="">
            <div class="filtros-container">
                <div class="row g-12">
                    <div class="col-md-1">
                        <label for="id" class="form-label">ID</label>
                        <input type="text" id="id" class="form-control" name="id" value="<?= htmlspecialchars($_POST['id'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="cpf_cnpj_proprietario" class="form-label">Proprietário</label>
                            <input type="text" id="cpf_cnpj_proprietario" class="form-control" name="cpf_cnpj_proprietario" value="<?= htmlspecialchars($_POST['cpf_cnpj_proprietario'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="locatario" class="form-label">Locatário</label>
                        <input type="text" id="locatario" class="form-control" name="locatario" value="<?= htmlspecialchars($_POST['locatario'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" id="cidade" class="form-control" name="cidade" value="<?= htmlspecialchars($_POST['cidade'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="vigencia" class="form-label">Data Vigência</label>
                        <input type="date" id="vigencia" class="form-control" name="vigencia" value="<?= htmlspecialchars($_POST['vigencia'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="tipo_imovel" class="mb-2">Tipo do Imóvel</label>
                            <select class="form-control" name="tipo_imovel" id="tipo_imovel" onchange="checkSelection('tipo_imovel')">
                                <option value="" disabled <?= !isset($_POST['tipo_imovel']) ? 'selected' : '' ?>>Selecione um tipo</option>
                                <option value="apartamento" <?= ($_POST['tipo_imovel'] ?? '') == 'apartamento' ? 'selected' : '' ?>>Apartamento</option>
                                <option value="casa" <?= ($_POST['tipo_imovel'] ?? '') == 'casa' ? 'selected' : '' ?>>Casa</option>
                                <option value="comercial" <?= ($_POST['tipo_imovel'] ?? '') == 'comercial' ? 'selected' : '' ?>>Comercial</option>
                            </select>
                        <span class="position-absolute" style="right: 20px; top: 8px; cursor: pointer; color: red; display: <?= isset($_POST['tipo_imovel']) && $_POST['tipo_imovel'] != '' ? 'block' : 'none' ?>;" data-select="tipo_imovel" onclick="removeSelected('tipo_imovel')">x</span>
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-buscar" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div> 
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
                        <th>ID Contrato</th>
                        <th>Locatario</th>
                        <th>Proprietário</th>
                        <th>Cidade</th>
                        <th>Data Vigência</th>
                        <th>Tipo de Imóvel</th>
                        <th>Forma de Pagamento</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        if (isset($result) && count($result) > 0) {
                            foreach ($result as $row) {

                                echo "<tr>
                                    <td>" . htmlspecialchars($row['contrato_id'] ?? '-') . "</td>   
                                    <td>" . htmlspecialchars($row['locatario_nome']) . "</td>
                                    <td>" . htmlspecialchars($row['cpf_cnpj_proprietario'] ?? '-') . "</td>
                                    <td>" . htmlspecialchars($row['imovel_cidade'] ?? '-') . "</td>
                <td>" . htmlspecialchars(date("d/m/Y", strtotime($row['contrato_vigencia'] ?? ''))) . "</td>
                                    <td>" . htmlspecialchars($row['tipo_imovel'] ?? '-') . "</td>
                                    <td>" . htmlspecialchars($row['contrato_forma_pagamento'] ?? '-') . "</td>
                                    <td>
                                        <button class='btn' onclick='editRecord(" . htmlspecialchars($row['contrato_id']) . ")'>
                                            <i class='bi bi-pencil-square'></i>
                                        </button>
                                        <button class='btn' onclick='toggleSubMenu(this)'>
                                            <i class='bi bi-chevron-down'></i>
                                        </button>
                                        <div class='submenu' style='display: none;'>
                                            <div class='submenu-options'>
                                                <button class='imprimir' title='imprimirContrato' onclick='redirectToRelatorio(" . htmlspecialchars($row['contrato_id']) . ")'>
                                                <i class='bi bi-printer'></i> Imprimir Registro
                                                </button>
                                                <button class='imprimir' title='imprimirContrato' onclick='redirectToRelatorio2(" . htmlspecialchars($row['contrato_id']) . ")'>
                                                <i class='bi bi-printer'></i> Imprimir Contrato
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
<!-- 
<script>
        function redirectToRelatorio(id) {
            window.open('../reports/impressao_registro_aluguel.php?id=' + id, '_blank'); //tem que fazer a impressao do resgistro de aluguel
        }
    </script> -->

    <script>
            function redirectToRelatorio2(id) {
                window.open('../reports/impressao_contrato_aluguel.php?id=' + id, '_blank');
            }
        </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../public/assets/js/submenu.js"></script>

</body>
</html>
