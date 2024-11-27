<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <!-- Bootstrap Icon -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <!-- Google fonts -->
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <!-- Estilo customizado -->
  <link rel="stylesheet" type="text/css" href="../public/assets/css/style2.css">
  <!-- ICONE -->
  <link rel="icon" href="../public/assets/img/Logotipo.svg">

  <title>Alterar Contrato de Venda</title>
</head>

<body>

  <?php
  session_start();

  if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
  }

  if (!isset($_GET['id'])) {
    echo "ID do cliente não fornecido.";
    exit();
  }

  $id = $_GET['id'];

  include '../app/controllers/db_conexao.php';


  try {
    $stmt = $pdo->prepare("
      SELECT *  FROM contrato_venda
      WHERE id = :id
    ");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $contrato = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$contrato) {
      echo "Contrato não encontrado.";
      exit();
    }
  } catch (PDOException $e) {
    echo "Erro ao buscar os dados: " . $e->getMessage();
    exit();
  }

  try {
    $stmt = $pdo->prepare("SELECT * FROM cadastro_imovel WHERE id = :id");
    $stmt->bindParam(':id', $id_imovel, PDO::PARAM_INT);
    $stmt->execute();
    $imovel = $stmt->fetch(PDO::FETCH_ASSOC);
  } catch (PDOException $e) {
    echo "Erro ao buscar os dados do imóvel: " . $e->getMessage();
    exit();
  }

  include 'navbar.php';

  ?>

  <section id="contrato_aluguel_caucao">
    <!-- inicio do form -->
    <form action="../app/controllers/altera_contrato_venda.php" method="post">
      <input type="hidden" name="id" value="<?= htmlspecialchars($contrato['id']) ?>">
      <input type="hidden" name="action" value="atualizar">
      <div class="container">
        <div class="row">
          <h2>Edita Contrato de Venda</h2>

          <div class="row">
            <!-- Comprador -->
            <div class="col-md-12">
              <h4>Dados do Comprador:</h4>
              <div class="card">
                <div class="row">
                  <div class="col-sm-4">
                    <label for="comprador_nome" class="mb-2">Nome</label>
                    <input class="form-control mb-3" type="text" name="comprador_nome" id="comprador_nome"
                      value="<?= htmlspecialchars($contrato['comprador_nome']) ?>" required>
                    <label for="comprador_data_nascimento" class="mb-2">Nascimento/Fundação</label>
                    <input class="form-control mb-3" type="date" name="comprador_data_nascimento"
                      id="comprador_data_nascimento" required
                      value="<?= htmlspecialchars($contrato['comprador_data_nascimento']) ?>">
                    <label for="comprador_nacionalidade" class="mb-2">Nacionalidade</label>
                    <input class="form-control mb-3" type="text" name="comprador_nacionalidade"
                      id="comprador_nacionalidade" required
                      value="<?= htmlspecialchars($contrato['comprador_nacionalidade']) ?>">
                    <label for="comprador_cep" class="mb-2">CEP</label>
                    <input class="form-control mb-3" type="text" name="comprador_cep" id="comprador_cep" required
                      value="<?= htmlspecialchars($contrato['comprador_cep']) ?>">
                    <label for="comprador_bairro" class="mb-2">Bairro</label>
                    <input class="form-control mb-3" type="text" name="comprador_bairro" id="comprador_bairro" required
                      value="<?= htmlspecialchars($contrato['comprador_bairro']) ?>">
                    <label for="comprador_estado" class="mb-2">Estado</label>
                    <input class="form-control mb-3" type="text" name="comprador_estado" id="comprador_estado" required
                      value="<?= htmlspecialchars($contrato['comprador_estado']) ?>">
                  </div>
                  <div class="col-sm-4">
                    <label for="comprador_cpf_cnpj" class="mb-2">CPF/CNPJ</label>
                    <input class="form-control mb-3" type="number" name="comprador_cpf_cnpj" id="comprador_cpf_cnpj"
                      required value="<?= htmlspecialchars($contrato['comprador_cpf_cnpj']) ?>">
                    <label for="comprador_telefone" class="mb-2">Telefone</label>
                    <input class="form-control mb-3" type="number" name="comprador_telefone" id="comprador_telefone"
                      required value="<?= htmlspecialchars($contrato['comprador_telefone']) ?>">
                    <label for="comprador_estado_civil" class="mb-2">Estado civil</label>
                    <input class="form-control mb-3" type="text" name="comprador_estado_civil"
                      id="comprador_estado_civil" required
                      value="<?= htmlspecialchars($contrato['comprador_estado_civil']) ?>">
                    <label for="comprador_rua" class="mb-2">Rua</label>
                    <input class="form-control mb-3" type="text" name="comprador_rua" id="comprador_rua" required
                      value="<?= htmlspecialchars($contrato['comprador_rua']) ?>">
                    <label for="comprador_complemento" class="mb-2">Complemento</label>
                    <input class="form-control mb-3" type="text" name="comprador_complemento" id="comprador_complemento"
                      required value="<?= htmlspecialchars($contrato['comprador_complemento']) ?>">
                    <label for="comprador_pais" class="mb-2">País</label>
                    <input class="form-control mb-3" type="text" name="comprador_pais" id="comprador_pais" required
                      value="<?= htmlspecialchars($contrato['comprador_pais']) ?>">
                  </div>
                  <div class="col-sm-4">
                    <label for="comprador_rg_ie" class="mb-2">RG/IE</label>
                    <input class="form-control mb-3" type="number" name="comprador_rg_ie" id="comprador_rg_ie" required
                      value="<?= htmlspecialchars($contrato['comprador_rg_ie']) ?>">
                    <label for="comprador_email" class="mb-2">E-mail</label>
                    <input class="form-control mb-3" type="text" name="comprador_email" id="comprador_email" required
                      value="<?= htmlspecialchars($contrato['comprador_email']) ?>">
                    <label for="comprador_profissao" class="mb-2">Profissão</label>
                    <input class="form-control mb-3" type="text" name="comprador_profissao" id="comprador_profissao"
                      required value="<?= htmlspecialchars($contrato['comprador_profissao']) ?>">
                    <label for="comprador_numero" class="mb-2">Número</label>
                    <input class="form-control mb-3" type="number" name="comprador_numero" id="comprador_numero"
                      required value="<?= htmlspecialchars($contrato['comprador_numero']) ?>">
                    <label for="comprador_cidade" class="mb-2">Cidade</label>
                    <input class="form-control mb-3" type="text" name="comprador_cidade" id="comprador_cidade" required
                      value="<?= isset($contrato['comprador_cidade']) ? htmlspecialchars($contrato['comprador_cidade']) : '' ?>">

                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <!-- imovel -->
            <div class="col-md-12">
              <h4>Dados do Imóvel:</h4>
              <div class="card">
                <div class="row">
                  <div class="col-sm-4">
                    <label for="imovel_proprietario_cpf_cnpj" class="mb-2">CPF/CNPJ Proprietário</label>
                    <input class="form-control mb-3" type="number" name="imovel_proprietario_cpf_cnpj"
                      id="imovel_proprietario_cpf_cnpj" required
                      value="<?= htmlspecialchars($contrato['imovel_proprietario_cpf_cnpj']) ?>">
                      <label for="imovel_tipo" class="mb-2">Tipo do Imóvel</label>
                      <select class="form-control mb-3" name="imovel_tipo" id="imovel_tipo" required>
                        <option value="" disabled>Selecione um tipo</option>
                        <option value="apartamento" <?= ($contrato['imovel_tipo'] == 'apartamento') ? 'selected' : '' ?>>Apartamento</option>
                        <option value="casa" <?= ($contrato['imovel_tipo'] == 'casa') ? 'selected' : '' ?>>Casa</option>
                        <option value="comercial" <?= ($contrato['imovel_tipo'] == 'comercial') ? 'selected' : '' ?>>Comercial</option>
                      </select>
                    <label for="imovel_numero" class="mb-2">Número</label>
                    <input class="form-control mb-3" type="number" name="imovel_numero" id="imovel_numero" required
                      value="<?= htmlspecialchars($contrato['imovel_numero']) ?>">
                    <label for="imovel_cidade" class="mb-2">Cidade</label>
                    <input class="form-control mb-3" type="text" name="imovel_cidade" id="imovel_cidade"
                      value="<?= htmlspecialchars($contrato['imovel_cidade']) ?>" required>
                    <label for="imovel_taxa_venda" class="mb-2">% Taxa administrativa</label>
                    <input class="form-control mb-3" type="text" name="imovel_taxa_venda" id="imovel_taxa_venda"
                      value="<?= htmlspecialchars($contrato['imovel_taxa_venda']) ?>" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="imovel_cep" class="mb-2">CEP</label>
                    <input class="form-control mb-3" type="text" name="imovel_cep" id="imovel_cep" required
                      value="<?= htmlspecialchars($contrato['imovel_cep']) ?>">
                    <label for="imovel_bairro" class="mb-2">Bairro</label>
                    <input class="form-control mb-3" type="text" name="imovel_bairro" id="imovel_bairro" required
                      value="<?= htmlspecialchars($contrato['imovel_bairro']) ?>">
                    <label for="imovel_estado" class="mb-2">Estado</label>
                    <input class="form-control mb-3" type="text" name="imovel_estado" id="imovel_estado" required
                      value="<?= htmlspecialchars($contrato['imovel_estado']) ?>">
                    <label for="imovel_valor" class="mb-2">Valor do imóvel</label>
                    <input class="form-control mb-3" type="text" name="imovel_valor" id="imovel_valor" required
                      value="<?= htmlspecialchars($contrato['imovel_valor']) ?>">
                  </div>
                  <div class="col-sm-4">
                    <label for="imovel_registro" class="mb-2">N° de registro do Imóvel</label>
                    <input class="form-control mb-3" type="number" name="imovel_registro" id="imovel_registro" required
                      value="<?= htmlspecialchars($contrato['imovel_registro']) ?>">
                    <label for="imovel_rua" class="mb-2">Rua</label>
                    <input class="form-control mb-3" type="text" name="imovel_rua" id="imovel_rua" required
                      value="<?= htmlspecialchars($contrato['imovel_rua']) ?>">
                    <label for="imovel_complemento" class="mb-2">Complemento</label>
                    <input class="form-control mb-3" type="text" name="imovel_complemento" id="imovel_complemento"
                      required value="<?= htmlspecialchars($contrato['imovel_complemento']) ?>">
                    <label for="imovel_pais" class="mb-2">País</label>
                    <input class="form-control mb-3" type="text" name="imovel_pais" id="imovel_pais"
                      requiredvalue="<?= htmlspecialchars($contrato['imovel_pais']) ?>">
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">
            <!-- contrato -->
            <div class="col-md-12">
              <h4>Dados do contrato:</h4>
              <div class="card">
                <div class="row">
                  <div class="col-sm-3">
                    <label for="data_emissao" class="mb-2">Data Emissão</label>
                    <input class="form-control mb-3" type="date" name="data_emissao" id="data_emissao" required
                      value="<?= htmlspecialchars(date("Y-m-d", strtotime($contrato['data_emissao'] ?? ''))) ?>">
                  </div>
                  <div class="col-sm-3">
                    <label for="data_vencimento" class="mb-2">Data de Vencimento</label>
                    <input class="form-control mb-3" type="date" name="data_vencimento" id="data_vencimento" required
                      value="<?= htmlspecialchars($contrato['data_vencimento'] ?? '') ?>">
                  </div>
                  <div class="col-sm-3">
                    <label for="forma_pagamento" class="mb-2">Forma de pagamento</label>
                    <select class="form-control mb-3" name="forma_pagamento" id="forma_pagamento" required>
                      <option value="" disabled <?= ($contrato['forma_pagamento'] == '' ? 'selected' : '') ?>>Selecionar
                      </option>
                      <option value="Boleto" <?= ($contrato['forma_pagamento'] == 'Boleto') ? 'selected' : '' ?>>Boleto
                      </option>
                      <option value="Dinheiro" <?= ($contrato['forma_pagamento'] == 'Dinheiro') ? 'selected' : '' ?>>
                        Dinheiro</option>
                      <option value="PIX" <?= ($contrato['forma_pagamento'] == 'PIX') ? 'selected' : '' ?>>PIX</option>
                      <option value="Transferência" <?= ($contrato['forma_pagamento'] == 'Transferência') ? 'selected' : '' ?>>Transferência</option>
                      <option value="Cartão de crédito" <?= ($contrato['forma_pagamento'] == 'Cartão de crédito') ? 'selected' : '' ?>>Cartão de crédito</option>
                      <option value="Cartão de débito" <?= ($contrato['forma_pagamento'] == 'Cartão de débito') ? 'selected' : '' ?>>Cartão de débito</option>
                    </select>

                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
      <!-- rodape -->
      <footer class="py-3">
        <div class="container">
          <button type="submit" class="btn btn_salvar">Alterar</button>
        </div>
      </footer>
      <!-- fim do form -->
    </form>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

</body>

</html>