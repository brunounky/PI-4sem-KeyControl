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

  <title>Novo Contrato de Aluguel</title>
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
    <form action="../app/controllers/contrato_aluguel_caucao.php" method="post">
      <input type="hidden" name="action" value="cadastrar">
      <div class="container">
        <div class="row">
          <h2>Contrato de Aluguel Caução</h2>

          <div class="row">
  <!-- locatário -->
  <div class="col-md-12">
    <h4>Dados do Locatário:</h4>
    <div class="card">
      <div class="row">
        <div class="col-sm-4">
          <label for="locatario_nome" class="mb-2">Nome</label>
          <input class="form-control mb-3" type="text" name="locatario_nome" id="locatario_nome" required>
          <label for="locatario_data_nascimento" class="mb-2">Nascimento/Fundação</label>
          <input class="form-control mb-3" type="date" name="locatario_data_nascimento" id="locatario_data_nascimento" required>
          <label for="locatario_nacionalidade" class="mb-2">Nacionalidade</label>
          <input class="form-control mb-3" type="text" name="locatario_nacionalidade" id="locatario_nacionalidade" required>
          <label for="locatario_cep" class="mb-2">CEP</label>
          <input class="form-control mb-3" type="text" name="locatario_cep" id="locatario_cep" required>
          <label for="locatario_bairro" class="mb-2">Bairro</label>
          <input class="form-control mb-3" type="text" name="locatario_bairro" id="locatario_bairro" required>
          <label for="locatario_estado" class="mb-2">Estado</label>
          <input class="form-control mb-3" type="text" name="locatario_estado" id="locatario_estado" required>
        </div>
        <div class="col-sm-4">
          <label for="locatario_cpf_cnpj" class="mb-2">CPF/CNPJ</label>
          <input class="form-control mb-3" type="text" name="locatario_cpf_cnpj" id="locatario_cpf_cnpj" required>
          <label for="locatario_telefone" class="mb-2">Telefone</label>
          <input class="form-control mb-3" type="text" name="locatario_telefone" id="locatario_telefone" required>
          <label for="locatario_estado_civil" class="mb-2">Estado civil</label>
          <input class="form-control mb-3" type="text" name="locatario_estado_civil" id="locatario_estado_civil" required>
          <label for="locatario_rua" class="mb-2">Rua</label>
          <input class="form-control mb-3" type="text" name="locatario_rua" id="locatario_rua" required>
          <label for="locatario_complemento" class="mb-2">Complemento</label>
          <input class="form-control mb-3" type="text" name="locatario_complemento" id="locatario_complemento" required>
          <label for="locatario_pais" class="mb-2">País</label>
          <input class="form-control mb-3" type="text" name="locatario_pais" id="locatario_pais" required>
        </div>
        <div class="col-sm-4">
          <label for="locatario_rg_ie" class="mb-2">RG/IE</label>
          <input class="form-control mb-3" type="text" name="locatario_rg_ie" id="locatario_rg_ie" required>
          <label for="locatario_email" class="mb-2">E-mail</label>
          <input class="form-control mb-3" type="email" name="locatario_email" id="locatario_email" required>
          <label for="locatario_profissao" class="mb-2">Profissão</label>
          <input class="form-control mb-3" type="text" name="locatario_profissao" id="locatario_profissao" required>
          <label for="locatario_numero" class="mb-2">Número</label>
          <input class="form-control mb-3" type="text" name="locatario_numero" id="locatario_numero" required>
          <label for="locatario_cidade" class="mb-2">Cidade</label>
          <input class="form-control mb-3" type="text" name="locatario_cidade" id="locatario_cidade" required>
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
                    <label for="imovel_proprietario_cpf_cnpj" class="mb-2">Proprietário</label>
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
            <!-- caução -->
            <div class="col-md-12">
              <h4>Dados do Caução:</h4>
              <div class="card">
                <div class="row">
                  <div class="col-sm-3">
                    <label for="meses_caucao" class="mb-2">Meses caução <span data-toggle="tooltip" title="Quantidade de meses do caução."><i class="bi bi-question-circle fs-9"></i></span>
                    </label>
                    <select class="form-control mb-3" type="number" name="meses_caucao" id="meses_caucao" required>
                      <option value="" disabled selected>Selecionar</option>
                      <option value="1">1</option>
                      <option value="2">2</option>
                      <option value="3">3</option>
                      <option value="4">4</option>
                      <option value="5">5</option>
                      <option value="6">6</option>
                      <option value="7">7</option>
                      <option value="8">8</option>
                      <option value="9">9</option>
                      <option value="10">10</option>
                      <option value="11">11</option>
                      <option value="12">12</option>
                    </select>
                  </div>
                  <div class="col-sm-3">
                    <label for="vencimento_caucao" class="mb-2">Data de Vencimento</label>
                    <input class="form-control mb-3" type="date" name="vencimento_caucao" id="vencimento_caucao" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="total_caucao" class="mb-2">Valor total</label>
                    <input class="form-control mb-3" type="number" name="total_caucao" id="total_caucao" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="forma_pagamento_caucao" class="mb-2">Forma de pagamento</label>
                    <select class="form-control mb-3" name="forma_pagamento_caucao" id="forma_pagamento_caucao" required>
                      <option value="" disabled selected>Selecionar</option>
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

          <div class="row">
            <!-- contrato -->
            <div class="col-md-12">
              <h4>Dados do contrato:</h4>
              <div class="card">
                <div class="row">
                  <div class="col-sm-3">
                    <label for="contrato_vigencia" class="mb-2">Data de Vigência</label>
                    <input class="form-control mb-3" type="date" name="contrato_vigencia" id="vigcontrato_vigenciaencia" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="contrato_data_vencimento" class="mb-2">Data de Vencimento</label>
                    <input class="form-control mb-3" type="date" name="contrato_data_vencimento" id="contrato_data_vencimento" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="contrato_forma_pagamento" class="mb-2">Forma de pagamento</label>
                    <select class="form-control mb-3" name="contrato_forma_pagamento" id="contrato_forma_pagamento" required>
                      <option value="" disabled selected>Selecionar</option>
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
  <script src="../public/assets/js/buscador_locatario.js"></script>
  <script src="../public/assets/js/buscador_imovel_aluguel.js"></script>

</body>

</html>