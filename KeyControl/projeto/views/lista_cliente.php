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
   <?php include 'navbar.php'; ?>

   <section>
      <div class="container">
         <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Cadastro de Clientes</h2>
            <a href="../views/cadastro_cliente.php" class="button_adicionarnovo">Adicionar Novo +</a>
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
                     <label for="nome" class="form-label">Pessoa</label>
                     <input type="text" id="nome" class="form-control" name="nome" value="<?= htmlspecialchars($_POST['nome'] ?? '') ?>">
                  </div>
                  <div class="col-md-2">
                     <label for="telefone" class="form-label">Telefone</label>
                     <input type="text" id="telefone" class="form-control" name="telefone" value="<?= htmlspecialchars($_POST['telefone'] ?? '') ?>">
                  </div>
                  <div class="col-md-2">
                     <label for="email" class="form-label">E-mail</label>
                     <input type="text" id="email" class="form-control" name="email" value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
                  </div>
                  <div class="col-md-2">
                     <label for="estado_civil" class="form-label">Estado Civil</label>
                     <input type="text" id="estado_civil" class="form-control" name="estado_civil" value="<?= htmlspecialchars($_POST['estado_civil'] ?? '') ?>">
                  </div>
                  <div class="col-md-2 position-relative">
                     <label for="categoria" class="mb-2">Categoria</label>
                     <select class="form-control" name="categoria" id="categoria" onchange="checkSelection('categoria')">
                        <option value="" disabled <?= !isset($_POST['categoria']) ? 'selected' : '' ?>>Selecione a Categoria</option>
                        <option value="locador" <?= ($_POST['categoria'] ?? '') == 'locador' ? 'selected' : '' ?>>Locador</option>
                        <option value="locatario" <?= ($_POST['categoria'] ?? '') == 'locatario' ? 'selected' : '' ?>>Locatário</option>
                        <option value="fiador" <?= ($_POST['categoria'] ?? '') == 'fiador' ? 'selected' : '' ?>>Fiador</option>
                        <option value="comprador" <?= ($_POST['categoria'] ?? '') == 'comprador' ? 'selected' : '' ?>>Comprador</option>
                     </select>
                     <span class="position-absolute" style="right: 25px; top: 40px; cursor: pointer; color: red; display: <?= isset($_POST['categoria']) && $_POST['categoria'] != '' ? 'block' : 'none' ?>;" data-select="categoria" onclick="removeSelected('categoria')">x</span>
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
                     <th>ID</th>
                     <th>Pessoa</th>
                     <th>Telefone</th>
                     <th>E-mail</th>
                     <th>Bairro</th>
                     <th>Cidade</th>
                     <th>Categoria</th>
                     <th></th>
                  </tr>
               </thead>
               <tbody>
                  <?php
                  if ($result && count($result) > 0) {
                     foreach ($result as $row) {
                        $categorias = [];
                        if ($row['locador']) {
                           $categorias[] = 'Locador';
                        }
                        if ($row['locatario']) {
                           $categorias[] = 'Locatário';
                        }
                        if ($row['fiador']) {
                           $categorias[] = 'Fiador';
                        }
                        if ($row['comprador']) {
                           $categorias[] = 'Comprador';
                        }
                        $categoriaTexto = implode(', ', $categorias);

                        echo "<tr>
                                     <td>" . htmlspecialchars($row['id']) . "</td>
                                     <td>" . htmlspecialchars($row['nome']) . "</td>
                                     <td>" . htmlspecialchars($row['telefone']) . "</td>
                                     <td>" . htmlspecialchars($row['email']) . "</td>
                                     <td>" . htmlspecialchars(substr($row['bairro'], 0, 10) . (strlen($row['bairro']) > 10 ? '...' : '')) . "</td>
                                     <td>" . htmlspecialchars($row['cidade']) . "</td>
                                     <td>" . htmlspecialchars($categoriaTexto) . "</td>
                                     <td>
                                         <button class='btn' onclick=\"window.location.href='../views/modifica_cliente.php?id=" . htmlspecialchars($row['id']) . "'\">
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
                                                 <button class='email' onclick='sendEmail(\"" . htmlspecialchars($row['email'] ?? '') . "\")'>
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
                     echo "<tr><td colspan='9'>Nenhum registro encontrado</td></tr>";
                  }
                  ?>
               </tbody>
            </table>
         </div>
      </div>
   </section>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="../public/assets/js/submenu.js"></script>
</body>

</html>