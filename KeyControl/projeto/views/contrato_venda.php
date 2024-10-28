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
    <form action="" method="post">
      <input type="hidden" name="action" value="cadastrar">
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
                    <label for="nome" class="mb-2">Nome</label>
                    <input class="form-control mb-3" type="text" name="nome" id="nome" required>
                    <label for="data_nascimento_fundacao" class="mb-2">Nascimento/Fundação</label>
                    <input class="form-control mb-3" type="date" name="data_nascimento_fundacao" id="data_nascimento_fundacao" required>
                    <label for="nacionalidade" class="mb-2">Nacionalidade</label>
                    <input class="form-control mb-3" type="text" name="nacionalidade" id="nacionalidade" required>
                    <label for="cep" class="mb-2">CEP</label>
                    <input class="form-control mb-3" type="text" name="cep" id="cep" required>
                    <label for="bairro" class="mb-2">Bairro</label>
                    <input class="form-control mb-3" type="text" name="bairro" id="bairro" required>
                    <label for="estado" class="mb-2">Estado</label>
                    <input class="form-control mb-3" type="text" name="estado" id="estado" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="cpf_cnpj" class="mb-2">CPF/CNPJ</label>
                    <input class="form-control mb-3" type="number" name="cpf_cnpj" id="cpf_cnpj" required>
                    <label for="telefone" class="mb-2">Telefone</label>
                    <input class="form-control mb-3" type="number" name="telefone" id="telefone" required>
                    <label for="estado_civil" class="mb-2">Estado civil</label>
                    <input class="form-control mb-3" type="text" name="estado_civil" id="estado_civil" required>
                    <label for="rua" class="mb-2">Rua</label>
                    <input class="form-control mb-3" type="text" name="rua" id="rua" required>
                    <label for="complemento" class="mb-2">Complemento</label>
                    <input class="form-control mb-3" type="text" name="complemento" id="complemento" required>
                    <label for="pais" class="mb-2">País</label>
                    <input class="form-control mb-3" type="text" name="pais" id="pais" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="rg_ie" class="mb-2">RG/IE</label>
                    <input class="form-control mb-3" type="number" name="rg_ie" id="rg_ie" required>
                    <label for="email" class="mb-2">E-mail</label>
                    <input class="form-control mb-3" type="text" name="email" id="email" required>
                    <label for="profissao" class="mb-2">Profissão</label>
                    <input class="form-control mb-3" type="text" name="profissao" id="profissao" required>
                    <label for="numero" class="mb-2">Número</label>
                    <input class="form-control mb-3" type="number" name="numero" id="numero" required>
                    <label for="cidade" class="mb-2">Cidade</label>
                    <input class="form-control mb-3" type="text" name="cidade" id="cidade" required>
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
                    <label for="proprietario" class="mb-2">Proprietário</label>
                    <input class="form-control mb-3" type="number" name="cpf_cnpj_proprietario" id="cpf_cnpj_proprietario" required>
                    <label for="tipo_imovel" class="mb-2">Tipo do Imóvel</label>
                    <select class="form-control mb-3" name="tipo_imovel" id="tipo_imovel" required>
                      <option value="" disabled selected>Selecione um tipo</option>
                      <option value="apartamento">Apartamento</option>
                      <option value="casa">Casa</option>
                      <option value="comercial">Comercial</option>
                    </select>
                    <label for="numero" class="mb-2">Número</label>
                    <input class="form-control mb-3" type="number" name="numero" id="numero" required>
                    <label for="cidade" class="mb-2">Cidade</label>
                    <input class="form-control mb-3" type="text" name="cidade" id="cidade" required>
                    <label for="taxa_venda" class="mb-2">% Taxa administrativa</label>
                    <input class="form-control mb-3" type="text" name="taxa_venda" id="taxa_venda" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="proprietario" class="mb-2">CPF/CNPJ Proprietário</label>
                    <input class="form-control mb-3" type="number" name="cpf_cnpj_proprietario" id="cpf_cnpj_proprietario" required>
                    <label for="cep" class="mb-2">CEP</label>
                    <input class="form-control mb-3" type="text" name="cep" id="cep" required>
                    <label for="bairro" class="mb-2">Bairro</label>
                    <input class="form-control mb-3" type="text" name="bairro" id="bairro" required>
                    <label for="estado" class="mb-2">Estado</label>
                    <input class="form-control mb-3" type="text" name="estado" id="estado" required>
                    <label for="valor_venda" class="mb-2">Valor do imóvel</label>
                    <input class="form-control mb-3" type="text" name="valor_venda" id="valor_venda" required>
                  </div>
                  <div class="col-sm-4">
                    <label for="registro_imovel" class="mb-2">N° de registro do Imóvel</label>
                    <input class="form-control mb-3" type="number" name="registro_imovel" id="registro_imovel" required>
                    <label for="rua" class="mb-2">Rua</label>
                    <input class="form-control mb-3" type="text" name="rua" id="rua" required>
                    <label for="complemento" class="mb-2">Complemento</label>
                    <input class="form-control mb-3" type="text" name="complemento" id="complemento" required>
                    <label for="pais" class="mb-2">País</label>
                    <input class="form-control mb-3" type="text" name="pais" id="pais" required>
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
                    <label for="vigencia" class="mb-2">Data de Vigência</label>
                    <input class="form-control mb-3" type="date" name="vigencia" id="vigencia" required>
                  </div>
                  <div class="col-sm-3">
                    <label for="dia_vencimento" class="mb-2">Dia de vencimento</label>
                    <input class="form-control mb-3" type="date" name="dia_vencimento" id="dia_vencimento" required>
                  </div>
                  <div class="col-sm-3">
                  <label for="forma_pagamento" class="mb-2">Forma de pagamento</label>
                    <select class="form-control mb-3" name="forma_pagamento" id="forma_pagamento" required>
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