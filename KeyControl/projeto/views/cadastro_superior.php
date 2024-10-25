<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Bootstrap Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Google fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet">
  <!-- Estilo customizado -->
  <link rel="stylesheet" type="text/css" href="../public/assets/css/style2.css">
  <!-- ICONE -->
  <link rel="icon" href="../public/assets/img/Logotipo.png">

  <title>Novo cliente</title>
</head>

<body>

  <?php
  session_start();

  if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
  }

  include 'navbar.php';
  ?>

  <section id="cadastro_pessoa">
    <!-- início do formulário -->
    <form action="../app/controllers/cadastro_superior.php" method="post">
      <input type="hidden" name="action" value="cadastrar">
      <div class="container">
        <div class="row">
          <h2>Cadastro de administradores do sistema</h2>

          <div class="col-md-9">
            <div class="card">
              <div class="row">
                <div class="col-sm-6">
                  <label for="nome" class="mb-2">Nome</label>
                  <input class="form-control mb-3" type="text" name="nome" id="nome" required>
                </div>
                <div class="col-sm-6">
                  <label for="email" class="mb-2">E-mail</label>
                  <input class="form-control mb-3" type="email" name="email" id="email" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <label for="senha" class="mb-2">Senha</label>
                  <input class="form-control mb-3" type="password" name="senha" id="senha" required>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- rodape -->
      <footer class="py-3">
        <div class="container">
          <button type="submit" class="btn btn_salvar">Salvar</button>
        </div>
      </footer>
      <!-- fim do form -->
    </form>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>
