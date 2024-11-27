<?php
session_start();

if (!isset($_SESSION['user_id'])) {
   header("Location: ../app/controllers/verifica_login.php");
   exit();
}

include_once '../app/controllers/filtro_lancamento_pagar.php';
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
   <title>Lançamentos a Pagar</title>
</head>

<body>
   <?php include 'navbar.php'; ?>

   <section id="lancamentos">

      <div class="container">

         <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Contas a Pagar</h2>
         </div>

         <form method="POST" action="">
            <div class="filtros-container">
               <div class="row g-12">
                  <div class="col-md-1">
                     <label for="id_lancamento" class="form-label">N°</label>
                     <input type="text" id="id_lancamento" class="form-control" name="id_lancamento"
                        value="<?= htmlspecialchars($_POST['id_lancamento'] ?? '') ?>">
                  </div>
                  <div class="col-md-2">
                     <label for="emissao" class="form-label">Emissão</label>
                     <input type="date" id="emissao" class="form-control" name="emissao"
                        value="<?= htmlspecialchars($_POST['emissao'] ?? '') ?>">
                  </div>
                  <div class="col-md-2">
                     <label for="vencimento" class="form-label">Vencimento</label>
                     <input type="date" id="vencimento" class="form-control" name="vencimento"
                        value="<?= htmlspecialchars($_POST['vencimento'] ?? '') ?>">
                  </div>
                  <div class="col-md-2">
                     <label for="liquidacao" class="form-label">Liquidação</label>
                     <input type="text" id="liquidacao" class="form-control" name="liquidacao"
                        value="<?= htmlspecialchars($_POST['liquidacao'] ?? '') ?>">
                  </div>


                  <div class="col-md-2">
                     <label for="tipo_lancamento" class="mb-2">Tipo</label>
                     <div class="position-relative">
                        <select class="form-control" name="tipo_lancamento" id="tipo_lancamento"
                           onchange="checkSelection('tipo_lancamento')">
                           <option value="" disabled <?= !isset($_POST['tipo_lancamento']) ? 'selected' : '' ?>>Selecione
                              um Tipo</option>
                           <option value="aluguel" <?= ($_POST['tipo_lancamento'] ?? '') == 'aluguel' ? 'selected' : '' ?>>
                              Aluguel</option>
                           <option value="iptu" <?= ($_POST['tipo_lancamento'] ?? '') == 'iptu' ? 'selected' : '' ?>>IPTU
                           </option>
                           <option value="agua" <?= ($_POST['tipo_lancamento'] ?? '') == 'agua' ? 'agua' : '' ?>>Água
                           </option>
                           <option value="reparos" <?= ($_POST['tipo_lancamento'] ?? '') == 'reparos' ? 'reparos' : '' ?>>
                              Reparos</option>
                           <option value="caucao" <?= ($_POST['tipo_lancamento'] ?? '') == 'caucao' ? 'caucao' : '' ?>>
                              Caução</option>
                        </select>
                        <span class="position-absolute"
                           style="right: 20px; top: 6px; cursor: pointer; color: red; display: <?= isset($_POST['tipo_lancamento']) && $_POST['tipo_lancamento'] != '' ? 'block' : 'none' ?>;"
                           data-select="tipo_lancamento" onclick="removeSelected('tipo_lancamento')">x</span>
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


         <div class="card_relatório">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th>Nº</th>
                     <th>Tipo</th>
                     <th>Emissão</th>
                     <th>Vencimento</th>
                     <th>Forma pagamento</th>
                     <th>Liquidação</th>
                     <th>Valor</th>
                     <th>
                        <form method="POST" action="../../projeto/reports/excel_cliente.php">
                           <button class="btn btn-success btn-sm" type="submit" name="exportar" value="1">
                              <i class="bi bi-file-earmark-excel"></i>
                           </button>
                        </form>
                    </th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  if (isset($result) && count($result) > 0) {
                     foreach ($result as $row) {
                        echo "<tr>
                             <td>" . htmlspecialchars($row['id_lancamento'] ?? '-') . "</td>
                             <td>" . htmlspecialchars($row['tipo_lancamento'] ?? '-') . "</td>
                             <td>" . htmlspecialchars(date("d/m/Y", strtotime($row['data_emissao'] ?? ''))) . "</td>
                             <td>" . htmlspecialchars(date("d/m/Y", strtotime($row['data_vencimento'] ?? ''))) . "</td>
                             <td>" . htmlspecialchars($row['forma_pagamento'] ?? '-') . "</td>
                             <td>" . htmlspecialchars($row['liquidado'] ?? '-') . "</td>
                             <td>" . htmlspecialchars($row['valor_total'] ?? '-') . "</td>
                             <td>
                             </td>
                         </tr>";
                     }
                  } else {
                     echo "<tr><td colspan='9'>Nenhum registro encontrado</td></tr>";
                  }

                  ?>
               </tbody>
            </table>
         </div>
   </section>

   <script>
        function redirectToRelatorio(id) {
            window.open('../reports/impressao_registro_aluguel.php?id=' + id, '_blank');
        }
    </script>

    <script>
            function redirectToRelatorio2(id) {
                window.open('../reports/impressao_contrato_aluguel.php?id=' + id, '_blank');
            }
</script>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="../public/assets/js/submenu.js"></script>
   <script src="../public/assets/js/remover_filtro.js"></script>
   <script src="../public/assets/js/formatar_filtro.js"></script>
   <script>
      const tipoLinks = document.querySelectorAll('.dropdown-item');

      tipoLinks.forEach(link => {
         link.addEventListener('click', function () {
            const tipo = this.getAttribute('data-tipo');
            document.getElementById('tipo_lancamento').value = tipo;
         });
      });
   </script>

</body>
</html>