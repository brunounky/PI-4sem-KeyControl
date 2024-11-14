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
  <link rel="icon" href="../public/assets/img/Logotipo.png">

  <title>Novo contrato de Venda</title>
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

  <section id="contrato_aluguel_caucao">
    <!-- inicio do form -->
    <form action="../app/controllers/contrato_venda.php" method="post">
      <input type="hidden" name="id" value="<?= htmlspecialchars($cliente['id']) ?>">
      <input type="hidden" name="action" value="atualizar">
      <div class="container">
        <div class="row">
          <h2>Contrato de venda</h2>

          <div class="row">
            <!-- Comprador -->
            <div class="col-md-12">
            <h4>Dados do Comprador:</h4>
              <div class="card">
                <div class="row">
                <div class="col-sm-4">
                <label for="comprador_nome" class="mb-2">Nome</label>
                <input class="form-control mb-3" type="text" name="comprador_nome" id="comprador_nome" required>
                <label for="comprador_data_nascimento" class="mb-2">Nascimento/Fundação</label>
                <input class="form-control mb-3" type="date" name="comprador_data_nascimento" id="comprador_data_nascimento" required>
                <label for="comprador_nacionalidade" class="mb-2">Nacionalidade</label>
                <input class="form-control mb-3" type="text" name="comprador_nacionalidade" id="comprador_nacionalidade" required>
                <label for="comprador_cep" class="mb-2">CEP</label>
                <input class="form-control mb-3" type="text" name="comprador_cep" id="comprador_cep" required>
                <label for="comprador_bairro" class="mb-2">Bairro</label>
                <input class="form-control mb-3" type="text" name="comprador_bairro" id="comprador_bairro" required>
                <label for="comprador_estado" class="mb-2">Estado</label>
                <input class="form-control mb-3" type="text" name="comprador_estado" id="comprador_estado" required>
              </div>
                  <div class="col-sm-4">
                  <label for="comprador_cpf_cnpj" class="mb-2">CPF/CNPJ</label>
                <input class="form-control mb-3" type="number" name="comprador_cpf_cnpj" id="comprador_cpf_cnpj" required>
                <label for="comprador_telefone" class="mb-2">Telefone</label>
                <input class="form-control mb-3" type="number" name="comprador_telefone" id="comprador_telefone" required>
                <label for="comprador_estado_civil" class="mb-2">Estado civil</label>
                <input class="form-control mb-3" type="text" name="comprador_estado_civil" id="comprador_estado_civil" required>
                <label for="comprador_rua" class="mb-2">Rua</label>
                <input class="form-control mb-3" type="text" name="comprador_rua" id="comprador_rua" required>
                <label for="comprador_complemento" class="mb-2">Complemento</label>
                <input class="form-control mb-3" type="text" name="comprador_complemento" id="comprador_complemento" required>
                <label for="comprador_pais" class="mb-2">País</label>
                <input class="form-control mb-3" type="text" name="comprador_pais" id="comprador_pais" required>
              </div>
                  <div class="col-sm-4">
                  <label for="comprador_rg_ie" class="mb-2">RG/IE</label>
                <input class="form-control mb-3" type="number" name="comprador_rg_ie" id="comprador_rg_ie" required>
                <label for="comprador_email" class="mb-2">E-mail</label>
                <input class="form-control mb-3" type="text" name="comprador_email" id="comprador_email" required>
                <label for="comprador_profissao" class="mb-2">Profissão</label>
                <input class="form-control mb-3" type="text" name="comprador_profissao" id="comprador_profissao" required>
                <label for="comprador_numero" class="mb-2">Número</label>
                <input class="form-control mb-3" type="number" name="comprador_numero" id="comprador_numero" required>
                <label for="comprador_cidade" class="mb-2">Cidade</label>
                <input class="form-control mb-3" type="text" name="comprador_cidade" id="comprador_cidade" required>
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
                <input class="form-control mb-3" type="number" name="imovel_proprietario_cpf_cnpj" id="imovel_proprietario_cpf_cnpj" required>
                <label for="imovel_tipo" class="mb-2">Tipo do Imóvel</label>
                <select class="form-control mb-3" name="imovel_tipo" id="imovel_tipo" required>
                  <option value="" disabled selected>Selecione um tipo</option>
                  <option value="apartamento">Apartamento</option>
                  <option value="casa">Casa</option>
                  <option value="comercial">Comercial</option>
                </select>
                <label for="imovel_numero" class="mb-2">Número</label>
                <input class="form-control mb-3" type="number" name="imovel_numero" id="imovel_numero" required>
                <label for="imovel_cidade" class="mb-2">Cidade</label>
                <input class="form-control mb-3" type="text" name="imovel_cidade" id="imovel_cidade" required>
                <label for="imovel_taxa_venda" class="mb-2">% Taxa administrativa</label>
                <input class="form-control mb-3" type="text" name="imovel_taxa_venda" id="imovel_taxa_venda" required>
              </div>
                  <div class="col-sm-4">
                  <label for="imovel_cep" class="mb-2">CEP</label>
                <input class="form-control mb-3" type="text" name="imovel_cep" id="imovel_cep" required>
                <label for="imovel_bairro" class="mb-2">Bairro</label>
                <input class="form-control mb-3" type="text" name="imovel_bairro" id="imovel_bairro" required>
                <label for="imovel_estado" class="mb-2">Estado</label>
                <input class="form-control mb-3" type="text" name="imovel_estado" id="imovel_estado" required>
                <label for="imovel_valor" class="mb-2">Valor do imóvel</label>
                <input class="form-control mb-3" type="text" name="imovel_valor" id="imovel_valor" required>
              </div>
              <div class="col-sm-4">
                <label for="imovel_registro" class="mb-2">N° de registro do Imóvel</label>
                <input class="form-control mb-3" type="number" name="imovel_registro" id="imovel_registro" required>
                <label for="imovel_rua" class="mb-2">Rua</label>
                <input class="form-control mb-3" type="text" name="imovel_rua" id="imovel_rua" required>
                <label for="imovel_complemento" class="mb-2">Complemento</label>
                <input class="form-control mb-3" type="text" name="imovel_complemento" id="imovel_complemento" required>
                <label for="imovel_pais" class="mb-2">País</label>
                <input class="form-control mb-3" type="text" name="imovel_pais" id="imovel_pais" required>
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
                <label for="contrato_vigencia" class="mb-2">Data de Vigência</label>
                <input class="form-control mb-3" type="date" name="contrato_vigencia" id="contrato_vigencia" required>
              </div>
              <div class="col-sm-3">
                <label for="contrato_dia_vencimento" class="mb-2">Data de Pagamento</label>
                <input class="form-control mb-3" type="date" name="contrato_dia_vencimento" id="contrato_dia_vencimento" required>
              </div>
                  <div class="col-sm-3">
                  <label for="contrato_forma_pagamento" class="mb-2">Forma de pagamento</label>
                    <select class="form-control mb-3" name="contrato_forma_pagamento" id="contrato_forma_pagamento" required>
                      <option value="" disabled selected>Selecionar</option>
                      <option value="Boleto">Financiamento</option>
                      <option value="Dinheiro">Dinheiro</option>
                      <option value="Boleto">Boleto</option>
                      <option value="PIX">PIX</option> 
                      <option value="Transferência">Transferência</option> 
                      <option value="Cartão de crédito">Cartão de crédito</option>
                      <option value="Cartão de débito">Cartão de débito</option>
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
          <button type="submit" class="btn btn_salvar">Salvar</button>
          <button type="button" class="btn btn_salvar"><i class="bi bi-eye"></i> Pré visualizar</button>
        </div>
      </footer>
      <!-- fim do form -->
    </form>
  </section>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>