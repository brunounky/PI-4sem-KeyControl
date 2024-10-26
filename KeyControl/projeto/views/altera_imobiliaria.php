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

  <title>Cadastro de Imobiliária</title>
</head>

<body>

  <?php
  session_start();

  if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_superior.php");
    exit();
  }

  include 'navbar_superior.php';
  ?>

  <section id="cadastro_imobiliaria">
    <!-- início do formulário -->
    <form action="../app/controllers/cadastro_imobiliaria.php" method="post" enctype="multipart/form-data">
      <input type="hidden" name="action" value="cadastrar">
      <div class="container">
        <div class="row">
          <h2>Cadastro de Imobiliária</h2>

          <div class="col-md-9">
            <div class="card">
              <div class="row">
                <div class="col-sm-6">
                  <label for="cnpj" class="mb-2">CNPJ</label>
                  <input class="form-control mb-3" type="text" name="cnpj" id="cnpj" required>
                </div>
                <div class="col-sm-6">
                  <label for="nome_fantasia" class="mb-2">Nome Fantasia</label>
                  <input class="form-control mb-3" type="text" name="nome_fantasia" id="nome_fantasia" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <label for="endereco" class="mb-2">Endereço</label>
                  <input class="form-control mb-3" type="text" name="endereco" id="endereco" required>
                </div>
                <div class="col-sm-6">
                  <label for="numeroimobiliaria" class="mb-2">Número</label>
                  <input class="form-control mb-3" type="text" name="numeroimobiliaria" id="numeroimobiliaria" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <label for="cepimobiliaria" class="mb-2">CEP</label>
                  <input class="form-control mb-3" type="text" name="cepimobiliaria" id="cepimobiliaria" required>
                </div>
                <div class="col-sm-6">
                  <label for="cidadeimobiliaria" class="mb-2">Cidade</label>
                  <input class="form-control mb-3" type="text" name="cidadeimobiliaria" id="cidadeimobiliaria" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-6">
                  <label for="telefoneimobiliaria" class="mb-2">Telefone</label>
                  <input class="form-control mb-3" type="text" name="telefoneimobiliaria" id="telefoneimobiliaria" required>
                </div>
                <div class="col-sm-6">
                  <label for="emailimobiliaria" class="mb-2">E-mail</label>
                  <input class="form-control mb-3" type="email" name="emailimobiliaria" id="emailimobiliaria" required>
                </div>
              </div>
              <div class="row">
                <div class="col-sm-12">
                  <label for="logo_imobiliaria" class="mb-2">Logotipo</label>
                  <input class="form-control mb-3" type="file" name="logo_imobiliaria" id="logo_imobiliaria" accept="image/*" required>
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
