<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

include 'navbar.php';
?>

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

  <title>Perfil do Usuário</title>
</head>

<body>

  <section id="perfil">
    <!-- inicio do form -->
    <form action="../app/controllers/verifica_cliente.php" method="post">
      <input type="hidden" name="action" value="atualizar">
      <div class="container">
        <div class="row">
          <h2>Perfil do Usuário</h2>

          <div class="row">
            <div class="col-md-9">
              <div class="card">
                <div class="row">
                  <div class="col-sm-6">
                    <label for="nome" class="mb-2">Nome Completo</label>
                    <input class="form-control mb-3" type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($_SESSION['user_name']); ?>" required>
                    <label for="cpf" class="mb-2">CPF</label>
                    <input class="form-control mb-3" type="text" name="cpf" id="cpf" value="<?php echo htmlspecialchars($_SESSION['user_cpf']); ?>" required>
                    <label for="telefone" class="mb-2">Telefone</label>
                    <input class="form-control mb-3" type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($_SESSION['user_telefone']); ?>" required>
                    <label for="email" class="mb-2">E-mail</label>
                    <input class="form-control mb-3" type="email" name="email" id="email" value="<?php echo htmlspecialchars($_SESSION['user_email']); ?>" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="rg" class="mb-2">RG</label>
                    <input class="form-control mb-3" type="text" name="rg" id="rg" value="<?php echo htmlspecialchars($_SESSION['user_rg']); ?>" required>
                    <label for="nacionalidade" class="mb-2">Nacionalidade</label>
                    <input class="form-control mb-3" type="text" name="nacionalidade" id="nacionalidade" value="<?php echo htmlspecialchars($_SESSION['user_nacionalidade']); ?>" required>
                    <label for="estado_civil" class="mb-2">Estado Civil</label>
                    <input class="form-control mb-3" type="text" name="estado_civil" id="estado_civil" value="<?php echo htmlspecialchars($_SESSION['user_estadocivil']); ?>" required>
                    <label for="cargo" class="mb-2">Cargo</label>
                    <input class="form-control mb-3" type="text" name="cargo" id="cargo" value="<?php echo htmlspecialchars($_SESSION['user_cargo']); ?>" required>
                  </div>
                </div>
                
                <div class="row">
                  <div class="col-sm-6">
                    <label for="cep" class="mb-2">CEP</label>
                    <input class="form-control mb-3" type="text" name="cep" id="cep" value="<?php echo htmlspecialchars($_SESSION['user_cep']); ?>" required>
                    <label for="rua" class="mb-2">Rua</label>
                    <input class="form-control mb-3" type="text" name="rua" id="rua" value="<?php echo htmlspecialchars($_SESSION['user_rua']); ?>" required>
                    <label for="numero" class="mb-2">Número</label>
                    <input class="form-control mb-3" type="text" name="numero" id="numero" value="<?php echo htmlspecialchars($_SESSION['user_numero']); ?>" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="bairro" class="mb-2">Bairro</label>
                    <input class="form-control mb-3" type="text" name="bairro" id="bairro" value="<?php echo htmlspecialchars($_SESSION['user_bairro']); ?>" required>
                    <label for="cidade" class="mb-2">Cidade</label>
                    <input class="form-control mb-3" type="text" name="cidade" id="cidade" value="<?php echo htmlspecialchars($_SESSION['user_cidade']); ?>" required>
                    <label for="estado" class="mb-2">Estado</label>
                    <input class="form-control mb-3" type="text" name="estado" id="estado" value="<?php echo htmlspecialchars($_SESSION['user_estado']); ?>" required>
                    <label for="pais" class="mb-2">País</label>
                    <input class="form-control mb-3" type="text" name="pais" id="pais" value="<?php echo htmlspecialchars($_SESSION['user_pais']); ?>" required>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <footer class="py-3">
        <div class="container">
          <button type="submit" class="btn btn_salvar">Salvar</button>
        </div>
      </footer>
    </form>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="../public/assets/js/consultacep.js"></script>

</body>

</html>
