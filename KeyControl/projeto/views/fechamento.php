<?php 
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../app/controllers/verifica_login.php");
        exit();
    }

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
    <title>Fechamentos</title>
</head>
<body>
<?php include 'navbar.php';?>
    <section>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Fechamentos</h2>
                
            </div>
        </div>

    <div class="container">
        <form method="POST" action="">
            <div class="filtros-container">
                <div class="row g-12">
                    <div class="col-md-2">
                        <label for="beneficiario" class="form-label">Beneficiário</label>
                        <input type="text" id="beneficiario" class="form-control" name="beneficiario" value="<?= htmlspecialchars($_POST['beneficiario'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="emissao" class="form-label">Data Emissão</label>
                        <input type="text" id="emissao" class="form-control" name="emissao" value="<?= htmlspecialchars($_POST['emissao'] ?? '') ?>">
                    </div>                    
                    <div class="col-md-2">
                        <label for="vencimento" class="form-label">Data Vencimento</label>
                        <input type="text" id="vencimento" class="form-control" name="vencimento" value="<?= htmlspecialchars($_POST['vencimento'] ?? '') ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="tipo_lancamento" class="mb-2">Lançamento</label>
                            <select class="form-control" name="tipo_lancamento" id="tipo_lancamento" onchange="checkSelection('tipo_lancamento')">
                                <option value="" disabled <?= !isset($_POST['tipo_lancamento']) ? 'selected' : '' ?>>Selecione</option>
                                <option value="apartamento" <?= ($_POST['tipo_lancamento'] ?? '') == 'apartamento' ? 'selected' : '' ?>>Lançamento a Pagar</option>
                                <option value="casa" <?= ($_POST['tipo_lancamento'] ?? '') == 'casa' ? 'selected' : '' ?>>Lançamento a Receber</option>
                            </select>
                        <span class="position-absolute" style="right: 20px; top: 8px; cursor: pointer; color: red; display: <?= isset($_POST['tipo_lancamento']) && $_POST['tipo_lancamento'] != '' ? 'block' : 'none' ?>;" data-select="tipo_lancamento" onclick="removeSelected('tipo_lancamento')">x</span>
                    </div>
                    <div class="col-md-2">
                    <label for="categoria" class="mb-2">Categoria Cliente</label>
                        <select class="form-control" name="categoria" id="categoria" onchange="checkSelection('categoria')">
                            <option value="" disabled <?= !isset($_POST['categoria']) ? 'selected' : '' ?>>Selecione</option>
                            <option value="locador" <?= ($_POST['categoria'] ?? '') == 'apartamento' ? 'selected' : '' ?>>Locador</option>
                            <option value="locatario" <?= ($_POST['categoria'] ?? '') == 'apartamento' ? 'selected' : '' ?>>Locatário</option>
                            <option value="fiador" <?= ($_POST['categoria'] ?? '') == 'apartamento' ? 'selected' : '' ?>>Fiador</option>
                        </select>
                        <span class="position-absolute" style="right: 25px; top: 40px; cursor: pointer; color: red; display: <?= isset($_POST['categoria']) && $_POST['categoria'] != '' ? 'block' : 'none' ?>;" data-select="categoria" onclick="removeSelected('categoria')">x</span>
                    </div>
                    <div class="col-md-1">
                     <label for="tipo_lancamento" class="mb-2">Tipo</label>
                     <div class="position-relative">
                        <select class="form-control" name="tipo_lancamento" id="tipo_lancamento" onchange="checkSelection('tipo_lancamento')">
                           <option value="" disabled <?= !isset($_POST['tipo_lancamento']) ? 'selected' : '' ?>>Selecione um Tipo</option>
                           <option value="aluguel" <?= ($_POST['tipo_lancamento'] ?? '') == 'aluguel' ? 'selected' : '' ?>>Aluguel</option>
                           <option value="iptu" <?= ($_POST['tipo_lancamento'] ?? '') == 'iptu' ? 'selected' : '' ?>>IPTU</option>
                           <option value="agua" <?= ($_POST['tipo_lancamento'] ?? '') == 'agua' ? 'agua' : '' ?>>Água</option>
                           <option value="reparos" <?= ($_POST['tipo_lancamento'] ?? '') == 'reparos' ? 'reparos' : '' ?>>Reparos</option>
                           <option value="caucao" <?= ($_POST['tipo_lancamento'] ?? '') == 'caucao' ? 'caucao' : '' ?>>Caução</option>
                        </select>
                        <span class="position-absolute" style="right: 20px; top: 6px; cursor: pointer; color: red; display: <?= isset($_POST['tipo_lancamento']) && $_POST['tipo_imovel'] != '' ? 'block' : 'none' ?>;" data-select="tipo_imovel" onclick="removeSelected('tipo_imovel')">x</span>
                     </div>
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

<section id="fechamento">
    <div class="container">
        <div class="card_relatório">
        <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Beneficiário</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Cidade</th>
                        <th>Categoria</th>
                        <th>Lançamentos</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody> 
                    
                <tr>
                    <!-- <td>Beatriz Gata</td>
                    <td>(19) 99410-7835</td>
                    <td>Bia@gmail.com</td>
                    <td>Araras</td>
                    <td>Locatário</td>
                    <td>3</td> -->
                    <td> 
                        <button type="button" class="btn icon-cash" data-bs-toggle="modal" data-bs-target="#exampleModal">
                            <i class="bi bi-cash-stack"></i>
                        </button> 

                        <!-- Modal -->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Lançamentos pendente</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                ...
                              </div>
                              <div class="modal-footer">
                                <button type="button" class="btn btn-secondary mt-5" data-bs-dismiss="modal">Fechar</button>
                                <button type="submit" class="btn btn_salvar mt-5">Salvar</button>
                              </div>
                            </div>
                          </div>
                        </div>
                    </td>
                </tr>
                
                <!--
                    <?php
                        if (isset($result) && count($result) > 0) {
                            foreach ($result as $row) {

                                echo "<tr>
                                    <td>" . htmlspecialchars($row['beneficiário']) . "</td>
                                    <td>" . htmlspecialchars($row['telefone']) . "</td>
                                    <td>" . htmlspecialchars($row['email'] ?? '-') . "</td>
                                    <td>" . htmlspecialchars($row['cidade'] ?? '-') . "</td>
                                    <td>" . htmlspecialchars($row['categoria'] ?? '-') . "</td>
                                    <td>" . htmlspecialchars($row['qtd_lancamentos'] ?? '-') . "</td>
                                    <td>
                                        <button class='btn' onclick='editRecord(" . htmlspecialchars($row['id']) . ")'>
                                            <i class='bi bi-pencil-square'></i>
                                        </button>
                                        <button class='btn' onclick='toggleSubMenu(this)'>
                                            <i class='bi bi-chevron-down'></i>
                                        </button>
                                        <div class='submenu' style='display: none;'>
                                            <div class='submenu-options'>
                                                <button class='imprimir' onclick='printInfo(" . htmlspecialchars($row['id']) . ")'>
                                                    <i class='bi bi-printer'></i> Imprimir
                                                </button>
                                                <button class='email' onclick='sendEmail(\"" . addslashes(htmlspecialchars($row["email"] ?? '')) . "\")'>
                                                    <i class='bi bi-envelope'></i> E-mail
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
                    ?> -->
                </tbody>
            </table>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../public/assets/js/submenu.js"></script>

</body>
</html>
