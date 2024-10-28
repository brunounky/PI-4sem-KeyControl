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
      <title>Lançamentos a Pagar</title>
   </head>
   <body>
      <?php include 'navbar.php';?>

   <section id="lancamentos">

      <div class="container">

         <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Lançamentos a Pagar</h2>
            <a class="button_adicionarnovo floating dropdown-toggle hide-arrow" data-bs-toggle="dropdown" aria-expanded="false" href="#">
               <span class="button_adicionarnovo">Adicionar novo +</span>
            </a>
            <ul class="dropdown-menu pull-right">
               <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalFormulario" data-tipo="Aluguel">Aluguel</a></li>
               <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalFormulario" data-tipo="IPTU">IPTU</a></li>
               <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalFormulario" data-tipo="Água">Água</a></li>
               <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#modalFormulario" data-tipo="Reparos">Reparos</a></li>
            </ul>
         </div>

         <!-- Modal -->
         <div class="modal fade" id="modalFormulario" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
            <div class="modal-dialog">
               <div class="modal-content">
                  <div class="modal-header">
                     <h5 class="modal-title" id="modalLabel">Novo Lançamento Manual</h5>
                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                     <form id="formLançamento">
                        <div class="row">
                           <div class="col-md-4">
                              <label for="idimobiliaria" class="form-label">Imobiliária</label>
                              <input class="form-control" type="text" name="idimobiliaria" id="idimobiliaria" value="<?php echo htmlspecialchars($dados['cnpj']); ?>" required disabled>
                              <label for="id_lancamento_pagar" class="form-label">N°</label>
                              <input type="text" id="id_lancamento_pagar" class="form-control" name="id_lancamento_pagar">
                              <label for="valor" class="form-label">Valor</label>
                              <input type="text" id="valor" class="form-control" name="valor">
                           </div>
                           <div class="col-md-4">
                              <label for="tipoLançamento" class="form-label">Tipo</label>
                              <select class="form-select" id="tipoLançamento" required disabled>
                                 <option value="Aluguel">Aluguel</option>
                                 <option value="IPTU">IPTU</option>
                                 <option value="Água">Água</option>
                                 <option value="Reparos">Reparos</option>
                              </select>
                              <label for="data_emissao" class="form-label">Emissão</label>
                              <input type="date" class="form-control " id="data_emissao" required>
                              <label for="forma_pagamento" class="form-label">Forma de pagamento</label>
                              <select class="form-control" name="forma_pagamento" id="forma_pagamento" required>
                                 <option value="" disabled selected>Selecionar</option>
                                 <option value="Boleto">Financiamento</option>
                                 <option value="Dinheiro">Dinheiro</option>
                                 <option value="Boleto">Boleto</option>
                                 <option value="PIX">PIX</option> 
                                 <option value="Transferência">Transferência</option> 
                                 <option value="Cartão de crédito">Cartão de crédito</option>
                                 <option value="Cartão de débito">Cartão de débito</option>
                              </select>
                           </div>
                           <div class="col-md-4">
                              <label for="beneficiario" class="form-label">Beneficiário</label>
                              <input type="text" id="cpf_cnpj_proprietario" class="form-control" name="beneficiario">
                              <label for="data_vencimento" class="form-label">Vencimento</label>
                              <input type="date" class="form-control" id="data_vencimento" required>
                              <label for="observacao" class="form-label">Observações</label>
                              <input type="text" class="form-control" id="observacao" required>
                           </div>
                           <button type="submit" class="btn btn_salvar mt-5">Salvar</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>         

         <form method="POST" action="">
            <div class="filtros-container">
               <div class="row g-12">
                  <div class="col-md-1">
                     <label for="id_lancamento_pagar" class="form-label">N°</label>
                     <input type="text" id="id_lancamento_pagar" class="form-control" name="id_lancamento_pagar" value="<?= htmlspecialchars($_POST['id_lancamento_pagar'] ?? '') ?>">
                  </div>
                  <div class="col-md-2">
                     <label for="beneficiario" class="form-label">Beneficiário</label>
                     <input type="text" id="cpf_cnpj_proprietario" class="form-control" name="beneficiario" value="<?= htmlspecialchars($_POST['beneficiario'] ?? '') ?>">
                  </div>
                  <div class="col-md-2">
                     <label for="emissao" class="form-label">Emissão</label>
                     <input type="text" id="emissao" class="form-control" name="emissao" value="<?= htmlspecialchars($_POST['emissao'] ?? '') ?>">
                  </div>
                  <div class="col-md-2">
                     <label for="vencimento" class="form-label">Vencimento</label>
                     <input type="text" id="vencimento" class="form-control" name="vencimento" value="<?= htmlspecialchars($_POST['vencimento'] ?? '') ?>">
                  </div>
                  <div class="col-md-2">
                     <label for="liquidacao" class="form-label">Liquidação</label>
                     <input type="text" id="liquidacao" class="form-control" name="liquidacao" value="<?= htmlspecialchars($_POST['liquidacao'] ?? '') ?>">
                  </div>
                  <div class="col-md-2">
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
            </form>
         </div>
         <div class="card_relatório">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th>N°</th>
                     <th>Beneficiário</th>
                     <th>Emissão</th>
                     <th>Vencimento</th>
                     <th>Liquidação</th>
                     <th>Tipo de Lançamento</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                     if (isset($result) && count($result) > 0) {
                        foreach ($result as $row) {
                     
                           echo "<tr>
                              <td>" . htmlspecialchars($row['registro_imovel'] ?? '-') . "</td>
                              <td>" . htmlspecialchars($row['nome'] ?? '-') . "</td>
                              <td>" . htmlspecialchars($row['cep'] ?? '-') . "</td>
                              <td>" . htmlspecialchars($row['rua'] ?? '-') . "</td>
                              <td>" . htmlspecialchars($row['numero'] ?? '-') . "</td>
                              <td>" . htmlspecialchars($row['cidade'] ?? '-') . "</td>
                              <td>" . htmlspecialchars($row['tipo_imovel'] ?? '-') . "</td>
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
                  ?>
               </tbody>
            </table>
         </div>
      </section>

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="../public/assets/js/submenu.js"></script>
      <script>
         const tipoLinks = document.querySelectorAll('.dropdown-item');

         tipoLinks.forEach(link => {
            link.addEventListener('click', function() {
               const tipo = this.getAttribute('data-tipo');
               document.getElementById('tipoLançamento').value = tipo;
            });
         });
      </script>


   </body>
</html>