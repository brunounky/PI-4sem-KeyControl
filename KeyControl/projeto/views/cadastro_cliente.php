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
    <!-- inicio do form -->
    <form action="../app/controllers/verifica_cliente.php" method="post">
      <input type="hidden" name="action" value="cadastrar">
      <div class="container">
        <div class="row">
          <h2>Cadastro de Clientes</h2>

          <!-- Coluna principal + Coluna de Tipo -->
          <div class="row">
            <!-- Coluna principal -->
            <div class="col-md-9">
              <div class="card">
                <div class="row">
                  <div class="col-sm-6">
                    <label for="nome" class="mb-2">Nome</label>
                    <input class="form-control mb-3" type="text" name="nome" id="nome" required>
                    <label for="cpf_cnpj" class="mb-2">CPF/CNPJ</label>
                    <input class="form-control mb-3" type="number" name="cpf_cnpj" id="cpf_cnpj" required>
                    <label for="telefone" class="mb-2">Telefone</label>
                    <input class="form-control mb-3" type="number" name="telefone" id="telefone" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="data_nascimento_fundacao" class="mb-2">Nascimento/Fundação</label>
                    <input class="form-control mb-3" type="date" name="data_nascimento_fundacao" id="data_nascimento_fundacao">
                    <label for="rg_ie" class="mb-2">RG/IE</label>
                    <input class="form-control mb-3" type="number" name="rg_ie" id="rg_ie">
                    <label for="email" class="mb-2">E-mail</label>
                    <input class="form-control mb-3" type="text" name="email" id="email" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-4">
                    <label for="nacionalidade" class="mb-2">Nacionalidade</label>
                    <input class="form-control mb-3" type="text" name="nacionalidade" id="nacionalidade" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="estado_civil" class="mb-2">Estado civil</label>
                    <input class="form-control mb-3" type="text" name="estado_civil" id="estado_civil" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="profissao" class="mb-2">Profissão</label>
                    <input class="form-control mb-3" type="text" name="profissao" id="profissao" required>
                  </div>
                </div>
                <div class="row">
                  <div class="col-sm-6">
                    <label for="cep" class="mb-2">CEP</label>
                    <input class="form-control mb-3" type="text" name="cep" id="cep" required>
                    <label for="numero" class="mb-2">Número</label>
                    <input class="form-control mb-3" type="number" name="numero" id="numero" required>
                  </div>
                  <div class="col-sm-6">
                    <label for="rua" class="mb-2">Rua</label>
                    <input class="form-control mb-3" type="text" name="rua" id="rua" required>
                    <label for="bairro" class="mb-2">Bairro</label>
                    <input class="form-control mb-3" type="text" name="bairro" id="bairro" required>
                  </div>
                  <div class="col-sm-12">
                    <label for="complemento" class="mb-2">Complemento</label>
                    <input class="form-control mb-3" type="text" name="complemento" id="complemento" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="cidade" class="mb-2">Cidade</label>
                    <input class="form-control mb-3" type="text" name="cidade" id="cidade" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="estado" class="mb-2">Estado</label>
                    <input class="form-control mb-3" type="text" name="estado" id="estado" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="pais" class="mb-2">País</label>
                    <input class="form-control mb-3" type="text" name="pais" id="pais" required>
                  </div>
                </div>
              </div>
            </div>

            <!-- Coluna de tipo -->
            <div class="col-md-3">
              <div class="card">
                <label class="mb-2">Categoria</label>    
                <div class="form-check form-switch mb-3">
                  <input class="form-check-input mt-2" type="checkbox" id="locador" name="locador">
                  <a href="#" class="btn btn_custom form-check-label" onclick="toggleSwitch('locador')">Locador</a>
                </div>            
                <div class="form-check form-switch mb-3">
                  <input class="form-check-input mt-2" type="checkbox" id="locatario" name="locatario">
                  <a href="#" class="btn btn_custom form-check-label" onclick="toggleSwitch('locatario')">Locatário</a>
                </div>            
                <div class="form-check form-switch mb-3">
                  <input class="form-check-input mt-2" type="checkbox" id="fiador" name="fiador">
                  <a href="#" class="btn btn_custom form-check-label" onclick="toggleSwitch('fiador')">Fiador</a>
                </div>
                <div class="form-check form-switch">
                  <input class="form-check-input mt-2" type="checkbox" id="comprador" name="comprador">
                  <a href="#" class="btn btn_custom form-check-label" onclick="toggleSwitch('comprador')">Comprador</a>
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
  <script src="../public/assets/js/consultacep.js"></script>

  <script>
    // ativar o switch
    function toggleSwitch(id) {
      var checkbox = document.getElementById(id);
      checkbox.checked = !checkbox.checked;  
    }
  </script>

</body>

</html>