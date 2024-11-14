<?php
session_start();

if (!isset($_SESSION['user_id'])) {
  header("Location: ../app/controllers/verifica_login.php");
  exit();
}

include '../app/controllers/db_conexao.php';

$user_id = $_SESSION['user_id'];

try {
  $stmt = $pdo->prepare("
    SELECT usuarios.*, imobiliaria.*
    FROM usuarios
    INNER JOIN imobiliaria ON usuarios.cnpj = imobiliaria.cnpj
    WHERE usuarios.id = :user_id
  ");
  $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
  $stmt->execute(); 
  $dados = $stmt->fetch(PDO::FETCH_ASSOC);

  if (!$dados) {
    echo "Dados da imobiliária ou do usuário não encontrados.";
    exit();
  }
} catch (PDOException $e) {
  echo "Erro ao buscar os dados: " . $e->getMessage();
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
    <div class="container">
      <h2>Perfil do Usuário</h2>

      <form action="../app/controllers/altera_usuario.php" method="post">
        <input type="hidden" name="action" value="atualizar">
        <div class="row">
          <div class="col-md-3">
            <div class="card">
              <div class="row">
                <div class="col-sm-12">
                  <img src="../app/controllers/exibir_imagem.php?cnpj=<?php echo htmlspecialchars($dados['cnpj']); ?>" alt="Logo da Imobiliária" class="img-fluid mb-2" />
                  <label for="idimobiliaria" class="mb-2">CNPJ da Imobiliária</label>
                  <input class="form-control mb-3" type="text" name="idimobiliaria" id="idimobiliaria" value="<?php echo htmlspecialchars($dados['cnpj']); ?>" required disabled>
                  <label for="nomefantasia" class="mb-2">Nome Fantasia</label>
                  <input class="form-control mb-3" type="text" name="nomefantasia" id="nomefantasia" value="<?php echo htmlspecialchars($dados['nome_fantasia']); ?>" required disabled>
                  <label for="telefoneimobiliaria" class="mb-2">Telefone</label>
                  <input class="form-control mb-3" type="text" name="telefoneimobiliaria" id="telefoneimobiliaria" value="<?php echo htmlspecialchars($dados['telefoneimobiliaria']); ?>" required disabled>
                  <label for="emailimobiliaria" class="mb-2">Email</label>
                  <input class="form-control mb-3" type="text" name="emailimobiliaria" id="emailimobiliaria" value="<?php echo htmlspecialchars($dados['emailimobiliaria']); ?>" required disabled>
                </div>
              </div>
            </div>
          </div>

          <div class="col-md-9">
            <div class="card">
              <div class="row">
                <div class="col-sm-6">
                  <label for="nome" class="mb-2">Nome Completo</label>
                  <input class="form-control mb-3" type="text" name="nome" id="nome" value="<?php echo htmlspecialchars($dados['nome']); ?>" required>
                  <label for="cpf" class="mb-2">CPF</label>
                  <input class="form-control mb-3" type="text" name="cpf" id="cpf" value="<?php echo htmlspecialchars($dados['cpf']); ?>" required>
                  <label for="telefone" class="mb-2">Telefone</label>
                  <input class="form-control mb-3" type="text" name="telefone" id="telefone" value="<?php echo htmlspecialchars($dados['telefone']); ?>">
                  <label for="telefone" class="mb-2">Telefone Reserva</label>
                  <input class="form-control mb-3" type="text" name="telefone_reserva" id="telefone_reserva" value="<?php echo htmlspecialchars($dados['telefone_reserva']); ?>">
                  <label for="email" class="mb-2">E-mail</label>
                  <input class="form-control mb-3" type="email" name="email" id="email" value="<?php echo htmlspecialchars($dados['email']); ?>" required>
                  <label for="cep" class="mb-2">CEP</label>
                  <input class="form-control mb-3" type="text" name="cep" id="cep" value="<?php echo htmlspecialchars($dados['cep']); ?>" required>
                  <label for="rua" class="mb-2">Rua</label>
                  <input class="form-control mb-3" type="text" name="rua" id="rua" value="<?php echo htmlspecialchars($dados['rua']); ?>" required>
                  <label for="numero" class="mb-2">Número</label>
                  <input class="form-control mb-3" type="text" name="numero" id="numero" value="<?php echo htmlspecialchars($dados['numero']); ?>" required>
                </div>
                <div class="col-sm-6">
                  <label for="rg" class="mb-2">RG</label>
                  <input class="form-control mb-3" type="text" name="rg" id="rg" value="<?php echo htmlspecialchars($dados['rg']); ?>" required>
                  <label for="nacionalidade" class="mb-2">Nacionalidade</label>
                  <input class="form-control mb-3" type="text" name="nacionalidade" id="nacionalidade" value="<?php echo htmlspecialchars($dados['nacionalidade']); ?>" required>
                  <label for="estado_civil" class="mb-2">Estado Civil</label>
                  <input class="form-control mb-3" type="text" name="estado_civil" id="estado_civil" value="<?php echo htmlspecialchars($dados['estado_civil']); ?>" required>
                  <label for="cargo" class="mb-2">Cargo</label>
                  <input class="form-control mb-3" type="text" name="cargo" id="cargo" value="<?php echo htmlspecialchars($dados['cargo']); ?>" required>
                  <label for="bairro" class="mb-2">Bairro</label>
                  <input class="form-control mb-3" type="text" name="bairro" id="bairro" value="<?php echo htmlspecialchars($dados['bairro']); ?>" required>
                  <label for="cidade" class="mb-2">Cidade</label>
                  <input class="form-control mb-3" type="text" name="cidade" id="cidade" value="<?php echo htmlspecialchars($dados['cidade']); ?>" required>
                  <label for="estado" class="mb-2">Estado</label>
                  <input class="form-control mb-3" type="text" name="estado" id="estado" value="<?php echo htmlspecialchars($dados['estado']); ?>" required>
                  <label for="pais" class="mb-2">País</label>
                  <input class="form-control mb-3" type="text" name="pais" id="pais" value="<?php echo htmlspecialchars($dados['pais']); ?>" required>
                </div>
                <div class="container">
                  <button type="submit" class="btn btn_salvar">Salvar Alterações</button>
                </div>
              </div>
            </div>
            <br>
          </div>
      </form>

      <form action="../app/controllers/altera_senha_usuario.php" method="post">
        <input type="hidden" name="action" value="alterar_senha">
        <div class="row">
          <div class="col-md-3"></div>
          <div class="col-md-9">
            <div class="card">
              <div class="row">
                <div class="col-sm-4">
                  <label for="senha_atual" class="mb-2">Senha Atual</label>
                  <input class="form-control mb-3" type="password" name="senha_atual" id="senha_atual" required>
                </div>
                <div class="col-sm-4">
                  <label for="nova_senha" class="mb-2">Nova Senha</label>
                  <input class="form-control mb-3" type="password" name="nova_senha" id="nova_senha" required>
                </div>
                <div class="col-sm-4">
                  <label for="confirmar_senha" class="mb-2">Confirmar Nova Senha</label>
                  <input class="form-control mb-3" type="password" name="confirmar_senha" id="confirmar_senha" required>
                </div>
                <div class="container">
                  <button type="submit" class="btn btn_salvar">Alterar Senha</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>

  <script src="../public/assets/js/consultacep.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-oBqDVmMz4fnFO9gyb5T5ggK+5l0VO4y7nVR+nQmvWn4U5jp6m3FQTVpM5VbcFz/m" crossorigin="anonymous"></script>
</body>
</html>
