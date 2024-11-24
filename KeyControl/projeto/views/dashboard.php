<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Bootstrap Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Google fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <!-- Estilo customizado -->
  <link rel="stylesheet" type="text/css" href="../public/assets/css/style2.css">
  <!-- ICONE -->
  <link rel="icon" href="../public/assets/img/Logotipo.svg">

  <title>Dashboard</title>
</head>

<?php
  session_start();

  if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
  }

  include 'navbar.php';

?>

<body>

<section id="dashboard">
    <div class="container">
        <div class="row">
            <h2>Dashboard</h2>
            <div class="col-md-12">
                <div class="card card-superior">
                    <h5>Visão Geral</h5>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="card card-branco">
                                <h1>560</h1>
                                <p>Quantidade de Imóveis</p>
                            </div>    
                        </div>
                        <div class="col-md-3">
                            <div class="card card-azul-escuro">
                                <h1>890</h1>
                                <p>Quantidade de Clientes</p>
                            </div>    
                        </div>
                        <div class="col-md-3">
                            <div class="card card-azul">
                                <h1>150,36</h1>
                                <p>Total Contas a Receber</p>
                            </div>    
                        </div>
                        <div class="col-md-3">
                            <div class="card card-verde">
                                <h1>1380,45</h1>
                                <p>Total Contas a Pagar</p>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="card card-superior">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Tipos de Imóveis</h5>
                            <img src="../public/assets/img/teste.png">                            
                        </div>
                        <div class="col-md-6 mt-5">
                            <h6>150 - Apartamento</h6>
                            <h6>386 - Casa</h6>
                            <h6>247 - Comercial</h6>
                        </div>
                    </div>
                </div>
                <div class="card card-superior">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Tipos de Clientes</h5>
                            <img src="../public/assets/img/teste.png">  
                        </div>
                        <div class="col-md-6 mt-5">                            
                            <h6>100 - Locador</h6>
                            <h6>354 - Locatário</h6>
                            <h6>231 - Fiador</h6>
                            <h6>120 - Comprador</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card card-superior">
                    <h5>Lançamentos à Vencer</h5>
                    <table class="table table-hover mt-3">
                        <thead>
                           <tr>
                             <th></th>
                              <th>N°</th>
                              <th>Beneficiário</th>
                              <th>Emissão</th>
                              <th>Vencimento</th>
                              <th>Tipo</th>
                              <th>Valor</th>
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
            </div>
        </div>

    </div>
</section>


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>