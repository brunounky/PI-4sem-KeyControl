<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

include_once '../app/controllers/filtro_contrato_venda.php';
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
    <title>Contratos de Venda</title>
</head>

<body>
    <?php include 'navbar.php'; ?>
    <section>
        <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Contrato de Venda</h2>
                <a href="../views/contrato_venda_imovel.php" class="button_adicionarnovo">Adicionar Novo +</a>
            </div>
        </div>
        <div class="container">
            <form method="POST" action="">
                <div class="filtros-container">
                    <div class="row g-12">
                        <div class="col-md-1">
                            <label for="contrato_id" class="form-label">ID</label>
                            <input type="text" id="contrato_id" class="form-control" name="contrato_id"
                                value="<?= htmlspecialchars($_POST['contrato_id'] ?? '') ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="nome" class="form-label">Comprador</label>
                            <input type="text" id="nome" class="form-control" name="nome"
                                value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
                        </div>
                        <div class="col-md-2">
                            <label for="data_emissao" class="form-label">Emissão</label>
                            <input type="text" id="data_emissao" class="form-control" name="data_emissao"
                                value="<?= htmlspecialchars($_POST['data_emissao'] ?? '') ?>" oninput="formatarData(this)" />
                        </div>
                        <div class="col-md-2">
                            <label for="data_vencimento" class="form-label">Vencimento</label>
                            <input type="text" id="data_vencimento" class="form-control" name="data_vencimento"
                                value="<?= htmlspecialchars($_POST['data_vencimento'] ?? '') ?>" oninput="formatarData(this)" />
                        </div>
                        <div class="col-md-2">
                            <label for="tipo_imovel" class="mb-2">Tipo do Imóvel</label>
                            <div class="position-relative">
                                <select class="form-control" name="tipo_imovel" id="tipo_imovel"
                                    onchange="checkSelection('tipo_imovel')">
                                    <option value="" disabled <?= !isset($_POST['tipo_imovel']) ? 'selected' : '' ?>>
                                        Escolha um Tipo</option>
                                    <option value="apartamento" <?= ($_POST['tipo_imovel'] ?? '') == 'apartamento' ? 'selected' : '' ?>>Apartamento</option>
                                    <option value="casa" <?= ($_POST['tipo_imovel'] ?? '') == 'casa' ? 'selected' : '' ?>>
                                        Casa</option>
                                    <option value="comercial" <?= ($_POST['tipo_imovel'] ?? '') == 'comercial' ? 'selected' : '' ?>>Comercial</option>
                                </select>
                                <span class="position-absolute"
                                    style="right: 20px; top: 6px; cursor: pointer; color: red; display: <?= isset($_POST['tipo_imovel']) && $_POST['tipo_imovel'] != '' ? 'block' : 'none' ?>;"
                                    data-select="tipo_imovel" onclick="removeSelected('tipo_imovel')">x</span>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <label for="forma_pagamento" class="mb-2">Tipo Pagamento</label>
                            <div class="position-relative">
                                <select class="form-control mb-3" name="forma_pagamento" id="forma_pagamento"
                                    onchange="checkSelection('forma_pagamento')">
                                    <option value="" disabled <?= !isset($_POST['forma_pagamento']) ? 'selected' : '' ?>>Escolha um Pagamento</option>
                                    <option value="financiamento" <?= ($_POST['forma_pagamento'] ?? '') == 'financiamento' ? 'selected' : '' ?>>Financiamento</option>
                                    <option value="dinheiro" <?= ($_POST['forma_pagamento'] ?? '') == 'dinheiro' ? 'selected' : '' ?>>Dinheiro</option>
                                    <option value="boleto" <?= ($_POST['forma_pagamento'] ?? '') == 'boleto' ? 'selected' : '' ?>>Boleto</option>
                                    <option value="pix" <?= ($_POST['forma_pagamento'] ?? '') == 'pix' ? 'selected' : '' ?>>PIX</option>
                                    <option value="transferencia" <?= ($_POST['forma_pagamento'] ?? '') == 'transferencia' ? 'selected' : '' ?>>Transferência</option>
                                    <option value="cartao_credito" <?= ($_POST['forma_pagamento'] ?? '') == 'cartao_credito' ? 'selected' : '' ?>>Cartão de crédito</option>
                                    <option value="cartao_debito" <?= ($_POST['forma_pagamento'] ?? '') == 'cartao_debito' ? 'selected' : '' ?>>Cartão de débito</option>
                                </select>
                                <span class="position-absolute"
                                    style="right: 25px; top: 6px; cursor: pointer; color: red; display: <?= isset($_POST['forma_pagamento']) && $_POST['forma_pagamento'] != '' ? 'block' : 'none' ?>;"
                                    data-select="forma_pagamento" onclick="removeSelected('forma_pagamento')">x</span>
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
    <section>
        <div class="container">
            <div class="card_relatório">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID Contrato</th>
                            <th>Comprador</th>
                            <th>% Taxa Adm</th>
                            <th>Data Emissão</th>
                            <th>Data Vencimento</</th>
                            <th>Valor Imóvel</th>
                            <th>Forma Pagamento</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($result) && count($result) > 0) {
                        foreach ($result as $row) {
                            echo "<tr>
                                <td>" . htmlspecialchars($row['contrato_id'] ?? '-') . "</td>
                                <td>" . htmlspecialchars($row['comprador_nome'] ?? '-') . "</td>
                                <td>" . htmlspecialchars($row['imovel_taxa_venda'] ?? '-') . "</td>
                                <td>" . htmlspecialchars(date("d/m/Y", strtotime($row['data_emissao'] ?? ''))) . "</td>
                                <td>" . htmlspecialchars(date("d/m/Y", strtotime($row['data_vencimento'] ?? ''))) . "</td>
                                <td>" . htmlspecialchars($row['imovel_valor'] ?? '-') . "</td>
                                <td>" . htmlspecialchars($row['forma_pagamento'] ?? '-') . "</td>
                                <td>
                                    <button class='btn' onclick=\"window.location.href='../views/modifica_contrato_venda.php?id=" . htmlspecialchars($row['contrato_id']) . "'\">
                                        <i class='bi bi-pencil-square'></i>
                                    </button>
                                    <button class='btn' onclick='toggleSubMenu(this)'>
                                        <i class='bi bi-chevron-down'></i>
                                    </button>
                                    <div class='submenu' style='display: none;'>
                                        <div class='submenu-options'>
                                            <button class='imprimir' title='Imprimir' onclick='redirectToRelatorio(" . htmlspecialchars($row['contrato_id']) . ")'>
                                                <i class='bi bi-printer'></i> Imprimir
                                            </button>
                                        </div>
                                    </div>
                                </td>
                            </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>Nenhum registro encontrado</td></tr>";
                    }
                    ?>
                </tbody>
                </table>
            </div>
        </div>
    </section>
    <script src="../public/assets/js/menu.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../public/assets/js/submenu.js"></script>
    <script src="../public/assets/js/remover_filtro.js"></script>
    <script src="../public/assets/js/formatar_filtro.js"></script>



    <script>
        function redirectToRelatorio(id) {
            window.open('../reports/impressao_contrato_venda.php?id=' + id, '_blank');
        }
    </script>

</body>

</html>