<?php 
   session_start();
   
   if (!isset($_SESSION['user_id'])) {
       header("Location: ../app/controllers/verifica_superior.php");
       exit();
   }

   include '../app/controllers/filtro_imobiliaria.php';
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
      <title>Imobiliárias Parceiras</title>
   </head>
   <body>
      <?php include 'navbar_superior.php'; ?>
      
      <section>
         <div class="container">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h2 class="mb-0">Imobiliárias Parceiras</h2>
                <a href="../views/cadastro_imobiliaria.php" class="button_adicionarnovo">Adicionar Nova +</a>
            </div>
         </div>
         <div class="container">
            <form method="POST" action="">
               <div class="filtros-container">
                  <div class="row g-12">
                     <div class="col-md-2">
                        <label for="cnpj" class="form-label">CNPJ</label>
                        <input type="text" id="cnpj" class="form-control" name="cnpj" value="<?= htmlspecialchars($_POST['cnpj'] ?? '') ?>">
                     </div>
                     <div class="col-md-3">
                        <label for="nome_fantasia" class="form-label">Nome Fantasia</label>
                        <input type="text" id="nome_fantasia" class="form-control" name="nome_fantasia" value="<?= htmlspecialchars($_POST['nome_fantasia'] ?? '') ?>">
                     </div>
                     <div class="col-md-3">
                        <label for="cidadeimobiliaria" class="form-label">Cidade</label>
                        <input type="text" id="cidadeimobiliaria" class="form-control" name="cidadeimobiliaria" value="<?= htmlspecialchars($_POST['cidadeimobiliaria'] ?? '') ?>">
                     </div>
                     <div class="col-md-3">
                        <label for="telefoneimobiliaria" class="form-label">Telefone</label>
                        <input type="text" id="telefoneimobiliaria" class="form-control" name="telefoneimobiliaria" value="<?= htmlspecialchars($_POST['telefoneimobiliaria'] ?? '') ?>">
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
                        <th>CNPJ</th>
                        <th>Nome Fantasia</th>
                        <th>Endereço</th>
                        <th>CEP</th>
                        <th>Cidade</th>
                        <th>Telefone</th>
                        <th>E-mail</th>
                        <th>Ações</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     if ($result && count($result) > 0) {
                         foreach ($result as $row) {
                             echo "<tr>
                                     <td>" . htmlspecialchars($row['cnpj']) . "</td>
                                     <td>" . htmlspecialchars($row['nome_fantasia']) . "</td>
                                     <td>" . htmlspecialchars($row['endereco']) . "</td>
                                     <td>" . htmlspecialchars($row['cepimobiliaria']) . "</td>
                                     <td>" . htmlspecialchars($row['cidadeimobiliaria']) . "</td>
                                     <td>" . htmlspecialchars($row['telefoneimobiliaria']) . "</td>
                                     <td>" . htmlspecialchars($row['emailimobiliaria']) . "</td>
                                     <td>
                                         <button class='btn' onclick='editRecord(" . htmlspecialchars($row['cnpj']) . ")'>
                                             <i class='bi bi-pencil-square'></i>
                                         </button>
                                         <button class='btn' onclick='toggleSubMenu(this)'>
                                             <i class='bi bi-chevron-down'></i>
                                         </button>
                                         <div class='submenu' style='display: none;'>
                                             <div class='submenu-options'>
                                                 <button class='imprimir' onclick='printInfo(" . htmlspecialchars($row['cnpj']) . ")'>
                                                     <i class='bi bi-printer'></i> Imprimir
                                                 </button>
                                                 <button class='excluir' onclick='deleteRecord(" . htmlspecialchars($row['cnpj']) . ")'>
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
