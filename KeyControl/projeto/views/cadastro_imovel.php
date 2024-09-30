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

    <title>Cadastro de imóveis</title>
</head>
<body>

<?php include 'navbar.php'; ?>

  <section id="cadastro_imovel">
    <!-- inicio do form -->
    <form action="#" method="post">
        <input type="hidden" name="action" value="cadastrar">
        <div class="container">
          <div class="row">
            <h2>Cadastro de imóveis</h2>          
              <!-- Coluna principal + Coluna de Tipo -->
              <div class="row">
                <!-- Coluna principal -->
                <div class="col-md-9">
                  <div class="card">
                    <div class="row">
                      <div class="col-sm-6"> 
                        <label for="proprietario" class="mb-2">Proprietário</label>                    
                        <select class="form-control mb-3" name="proprietario" id="proprietario" required>
                            <option value="" disabled selected>Selecione um proprietário</option>
                            <option value="proprietario1">Ana</option>
                            <option value="proprietario3">João</option>
                            <option value="proprietario3">Lúcia</option>
                        </select>
                        <label for="registro_agua" class="mb-2">N° de registro de aguá</label>                  
                        <input class="form-control mb-3" type="number" name="registro_agua" id="registro_agua" required>
                        <label for="quartos" class="mb-2">Quartos</label>                  
                        <input class="form-control mb-3" type="number" name="quartos" id="quartos" required>
                        <label for="vagas" class="mb-2">Vagas</label> 
                        <input class="form-control mb-3" type="number" name="vagas" id="vagas" required>
                        <label for="cep" class="mb-2">CEP</label>  
                        <input class="form-control mb-3" type="text" name="cep" id="cep" required>
                        <label for="numero" class="mb-2">Número</label>                       
                        <input class="form-control mb-3" type="number" name="numero" id="numero" required>                 
                      </div>
                      <div class="col-sm-6">
                        <label for="tipo_imovel" class="mb-2">Tipo do imóvel</label>
                        <select class="form-control mb-3" name="tipo_imovel" id="tipo_imovel" required>
                            <option value="" disabled selected>Selecione um tipo</option>
                            <option value="apartamento">Apartamento</option>
                            <option value="casa">Casa</option>
                            <option value="comercial">Comercial</option>
                        </select>
                        <label for="registro_energia" class="mb-2">N° de registro de energia</label>                  
                        <input class="form-control mb-3" type="number" name="registro_energia" id="registro_energia" required>
                        <label for="banheiros" class="mb-2">Banheiros</label> 
                        <input class="form-control mb-3" type="number" name="banheiros" id="banheiros" required>
                        <label for="area" class="mb-2">Área Total:</label>  
                        <input class="form-control mb-3" type="text" name="area" id="area" required>
                        <label for="rua" class="mb-2">Rua</label>     
                        <input class="form-control mb-3" type="text" name="rua" id="rua" required disabled> 
                        <label for="bairro" class="mb-2">Bairro</label> 
                        <input class="form-control mb-3" type="text" name="bairro" id="bairro" required disabled>    
                      </div>                      
                      <div class="col-sm-12">
                        <label for="complemento" class="mb-2">Complemento</label>
                        <input class="form-control mb-3" type="text" name="complemento" id="complemento" required>                   
                      </div>
                      <div class="col-sm-4">
                        <label for="cidade" class="mb-2">Cidade</label> 
                        <input class="form-control mb-3" type="text" name="cidade" id="cidade" required disabled>  
                      </div>
                      <div class="col-sm-4">  
                        <label for="estado" class="mb-2">Estado</label>                   
                        <input class="form-control mb-3" type="text" name="estado" id="estado" required disabled>  
                      </div>
                      <div class="col-sm-4">
                        <label for="pais" class="mb-2">País</label>
                        <input class="form-control mb-3" type="text" name="pais" id="pais" required disabled>                   
                      </div>
                    </div>
                  </div>
                </div>

                <!-- Coluna de tipo -->
                <div class="col-md-3">
                  <div class="card">
                    <label class="mb-2">Valores</label>
                    <div class="form-check form-switch mb-3">
                      <input class="form-check-input mt-2" type="checkbox" id="aluguel" required>
                      <button type="button" class="btn btn_custom">Aluguél</button>
                    </div>

                    <div class="form-check form-switch mb-3">
                      <input class="form-check-input mt-2" type="checkbox" id="venda" required>
                      <button type="button" class="btn btn_custom form-check-label">Venda</button>                   
                    </div>
                    

                  </div>
                </div>
              </div>        
          </div>
        </div>

        <!-- rodapé -->          
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

</body>
</html>     