<?php 
   session_start();
   
   if (!isset($_SESSION['user_id'])) {
       header("Location: ../app/controllers/verifica_login.php");
       exit();
   }
   
   include_once '../app/controllers/filtros_imovel.php';
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
      <title>Imóveis</title>
   </head>
   <body>
      <?php include 'navbar.php';?>
      <section>
         <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
               <h2 class="mb-0">Cadastro de Imóveis</h2>
               <a href="../views/cadastro_imovel.php" class="button_adicionarnovo">Adicionar Novo +</a>
            </div>
         </div>
         <div class="container">
            <form method="POST" action="">
               <div class="filtros-container">
                  <div class="row g-12">
                     <div class="col-md-1">
                        <label for="registro_imovel" class="form-label">Registro</label>
                        <input type="text" id="registro_imovel" class="form-control" name="registro_imovel" value="<?= htmlspecialchars($_POST['registro_imovel'] ?? '') ?>">
                     </div>
                     <div class="col-md-2">
                        <label for="cpf_cnpj_proprietario" class="form-label">Proprietário</label>
                        <input type="text" id="cpf_cnpj_proprietario" class="form-control" name="cpf_cnpj_proprietario" value="<?= htmlspecialchars($_POST['cpf_cnpj_proprietario'] ?? '') ?>">
                     </div>
                     <div class="col-md-2">
                        <label for="numero" class="form-label">Número</label>
                        <input type="text" id="numero" class="form-control" name="numero" value="<?= htmlspecialchars($_POST['numero'] ?? '') ?>">
                     </div>
                     <div class="col-md-2">
                        <label for="cep" class="form-label">CEP</label>
                        <input type="text" id="cep" class="form-control" name="cep" value="<?= htmlspecialchars($_POST['cep'] ?? '') ?>" pattern="\d{5}-\d{3}" placeholder="00000-000" title="Formato: 12345-678" maxlength="9">
                     </div>
                     <div class="col-md-2">
                        <label for="cidade" class="form-label">Cidade</label>
                        <input type="text" id="cidade" class="form-control" name="cidade" value="<?= htmlspecialchars($_POST['cidade'] ?? '') ?>">
                     </div>
                     <div class="col-md-2">
                        <label for="tipo_imovel" class="mb-2">Tipo do Imóvel</label>
                        <div class="position-relative">
                           <select class="form-control" name="tipo_imovel" id="tipo_imovel" onchange="checkSelection('tipo_imovel')">
                              <option value="" disabled <?= !isset($_POST['tipo_imovel']) ? 'selected' : '' ?>>Escolha um Tipo</option>
                              <option value="apartamento" <?= ($_POST['tipo_imovel'] ?? '') == 'apartamento' ? 'selected' : '' ?>>Apartamento</option>
                              <option value="casa" <?= ($_POST['tipo_imovel'] ?? '') == 'casa' ? 'selected' : '' ?>>Casa</option>
                              <option value="comercial" <?= ($_POST['tipo_imovel'] ?? '') == 'comercial' ? 'selected' : '' ?>>Comercial</option>
                           </select>
                           <span class="position-absolute" style="right: 20px; top: 6px; cursor: pointer; color: red; display: <?= isset($_POST['tipo_imovel']) && $_POST['tipo_imovel'] != '' ? 'block' : 'none' ?>;" data-select="tipo_imovel" onclick="removeSelected('tipo_imovel')">x</span>
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
                        <th>Registro Imóvel</th>
                        <th>Proprietário</th>
                        <th>CEP</th>
                        <th>Rua</th>
                        <th>Número</th>
                        <th>Bairro</th>
                        <th>Cidade</th>
                        <th>Tipo de Imóvel</th>
                        <th></th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                        if (isset($result) && count($result) > 0) {
                            foreach ($result as $row) {
                                $bairro = htmlspecialchars($row['bairro'] ?? '-');
                                $bairro_resumido = htmlspecialchars(substr($bairro, 0, 10) . (strlen($bairro) > 10 ? '...' : ''));
                        
                                echo "<tr>
                                        <td>" . htmlspecialchars($row['registro_imovel'] ?? '-') . "</td>
                                        <td>" . htmlspecialchars($row['nome'] ?? '-') . "</td>
                                        <td>" . htmlspecialchars($row['cep'] ?? '-') . "</td>
                                        <td>" . htmlspecialchars($row['rua'] ?? '-') . "</td>
                                        <td>" . htmlspecialchars($row['numero'] ?? '-') . "</td>
                                        <td title='$bairro'>$bairro_resumido</td>
                                        <td>" . htmlspecialchars($row['cidade'] ?? '-') . "</td>
                                        <td>" . htmlspecialchars($row['tipo_imovel'] ?? '-') . "</td>
                                        <td>
                                          <button class='btn' onclick=\"window.location.href='../views/modifica_imovel.php?id=" . htmlspecialchars($row['id']) . "'\">
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
         </div>
      </section>
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
      <script src="../public/assets/js/consultacep.js"></script>
      <script src="../public/assets/js/submenu.js"></script>
   </body>
</html>