<?php
session_start();

// Verifica se o usuário está logado
if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

include '../app/controllers/db_conexao.php'; 


$query = "SELECT * FROM usuarios WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

// Verifica se o usuário foi encontrado
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
} else {
    echo "Usuário não encontrado.";
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
          <h2>Perfil do Usuario</h2>

          <!-- Coluna principal + Coluna de Tipo -->
          <div class="row">
            <!-- Coluna principal -->
            <div class="col-md-9">
              <div class="card">
                <div class="row">
                  <div class="col-sm-6">
                    <label for="nome_completo" class="mb-2">Nome Completo</label>
                    <input class="form-control mb-3" type="text" name="nome_completo" id="nome_completo" value="<?php echo htmlspecialchars($user['nome_completo']); ?>" required>
                    <label for="cpf" class="mb-2">CPF</label>
                    <input class="form-control mb-3" type="text" name="cpf" id="cpf" value="<?php echo htmlspecialchars($user['cpf']); ?>" required>
                    <label for="telefone" class="mb-2">Telefone</label>
                    <input class="form-control mb-3" type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($user['telefone']); ?>" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="rg" class="mb-2">RG</label>
                    <input class="form-control mb-3" type="text" name="rg" id="rg" value="<?php echo htmlspecialchars($user['rg']); ?>" required>
                    <label for="email" class="mb-2">E-mail</label>
                    <input class="form-control mb-3" type="email" name="email" id="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                  </div>
                </div>
                <!-- Continue preenchendo os outros campos do formulário com os dados do banco -->
                <div class="row">
                  <div class="col-sm-4">
                    <label for="nacionalidade" class="mb-2">Nacionalidade</label>
                    <input class="form-control mb-3" type="text" name="nacionalidade" id="nacionalidade" value="<?php echo htmlspecialchars($user['nacionalidade']); ?>" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="estado_civil" class="mb-2">Estado Civil</label>
                    <input class="form-control mb-3" type="text" name="estado_civil" id="estado_civil" value="<?php echo htmlspecialchars($user['estado_civil']); ?>" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="cargo" class="mb-2">Cargo</label>
                    <input class="form-control mb-3" type="text" name="cargo" id="cargo" value="<?php echo htmlspecialchars($user['cargo']); ?>" required>
                  </div>
                </div>
                <!-- Outros campos do formulário -->
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
    </form>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="../public/assets/js/consultacep.js"></script>

</body>

</html>
