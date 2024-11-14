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

    <title>Editar Imóvel</title>
</head>

<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

include '../app/controllers/db_conexao.php';

// Verifica se o ID do imovel foi passado pela URL
if (!isset($_GET['id'])) {
    echo "ID do imovel não fornecido.";
    exit();
}

$id = $_GET['id'];

try {
    $stmt = $pdo->prepare("
    SELECT *  FROM cadastro_imovel
    WHERE id = :id
  ");
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt->execute();
    $imovel = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$imovel) {
        echo "Imóvel não encontrado.";
        exit();
    }
} catch (PDOException $e) {
    echo "Erro ao buscar os dados: " . $e->getMessage();
    exit();
}

include 'navbar.php';

?>

<body>

    <section id="cadastro_imovel">
        <!-- inicio do form -->
        <form action="../app/controllers/altera_imovel.php" method="post">
        <input type="hidden" name="id" value="<?= htmlspecialchars($imovel['id']) ?>">
        <input type="hidden" name="action" value="atualizar">
            <div class="container">
                <div class="row">
                    <h2>Editar Cadastro de Imóveis</h2>
                    <!-- Coluna principal + Coluna de Tipo -->
                    <div class="row">
                        <!-- Coluna principal -->
                        <div class="col-md-9">
                            <div class="card">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="proprietario" class="mb-2">CPF/CNPJ Proprietário</label>
                                        <input class="form-control mb-3" type="number" name="cpf_cnpj_proprietario" id="cpf_cnpj_proprietario" required value="<?= htmlspecialchars($imovel['cpf_cnpj_proprietario']) ?>">
                                        <label for="registro_agua" class="mb-2">N° de registro de água</label>
                                        <input class="form-control mb-3" type="number" name="registro_agua" id="registro_agua" required value="<?= htmlspecialchars($imovel['registro_agua']) ?>">
                                        <label for="quartos" class="mb-2">Quartos</label>
                                        <input class="form-control mb-3" type="number" name="quantidade_quartos" id="quantidade_quartos" required value="<?= htmlspecialchars($imovel['quantidade_quartos']) ?>">
                                        <label for="vagas" class="mb-2">Vagas</label>
                                        <input class="form-control mb-3" type="number" name="quantidade_vagas" id="quantidade_vagas" required value="<?= htmlspecialchars($imovel['quantidade_vagas']) ?>">
                                        <label for="cep" class="mb-2">CEP</label>
                                        <input class="form-control mb-3" type="text" name="cep" id="cep" required value="<?= htmlspecialchars($imovel['cep']) ?>">
                                        <label for="numero" class="mb-2">Número</label>
                                        <input class="form-control mb-3" type="number" name="numero" id="numero" required value="<?= htmlspecialchars($imovel['numero']) ?>">
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="tipo_imovel" class="mb-2">Tipo do Imóvel</label>
                                        <select class="form-control mb-3" name="tipo_imovel" id="tipo_imovel" required>
                                            <option value="" disabled>Selecione um tipo</option>
                                            <option value="apartamento" <?= ($imovel['tipo_imovel'] == 'apartamento') ? 'selected' : '' ?>>Apartamento</option>
                                            <option value="casa" <?= ($imovel['tipo_imovel'] == 'casa') ? 'selected' : '' ?>>Casa</option>
                                            <option value="comercial" <?= ($imovel['tipo_imovel'] == 'comercial') ? 'selected' : '' ?>>Comercial</option>
                                        </select>
                                        <label for="registro_imovel" class="mb-2">N° de registro do Imóvel</label>
                                        <input class="form-control mb-3" type="number" name="registro_imovel" id="registro_imovel" required value="<?= htmlspecialchars($imovel['registro_imovel']) ?>">
                                        <label for="banheiros" class="mb-2">Banheiros</label>
                                        <input class="form-control mb-3" type="number" name="quantidade_banheiros" id="quantidade_banheiros" required value="<?= htmlspecialchars($imovel['quantidade_banheiros']) ?>">
                                        <label for="area_total" class="mb-2">Área Total:</label>
                                        <input class="form-control mb-3" type="text" name="area_total" id="area_total" required value="<?= htmlspecialchars($imovel['area_total']) ?>">
                                        <label for="rua" class="mb-2">Rua</label>
                                        <input class="form-control mb-3" type="text" name="rua" id="rua" required value="<?= htmlspecialchars($imovel['rua']) ?>">
                                        <label for="bairro" class="mb-2">Bairro</label>
                                        <input class="form-control mb-3" type="text" name="bairro" id="bairro" required value="<?= htmlspecialchars($imovel['bairro']) ?>">
                                    </div>

                                    <div class="col-sm-12">
                                        <label for="complemento" class="mb-2">Complemento</label>
                                        <input class="form-control mb-3" type="text" name="complemento" id="complemento" value="<?= htmlspecialchars($imovel['complemento']) ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="cidade" class="mb-2">Cidade</label>
                                        <input class="form-control mb-3" type="text" name="cidade" id="cidade" required value="<?= htmlspecialchars($imovel['cidade']) ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="estado" class="mb-2">Estado</label>
                                        <input class="form-control mb-3" type="text" name="estado" id="estado" required value="<?= htmlspecialchars($imovel['estado']) ?>">
                                    </div>
                                    <div class="col-sm-4">
                                        <label for="pais" class="mb-2">País</label>
                                        <input class="form-control mb-3" type="text" name="pais" id="pais" required value="<?= htmlspecialchars($imovel['pais']) ?>">
                                    </div>

                                </div>
                            </div>
                        </div>
                        <!-- Coluna de tipo -->
                        <div class="col-md-3">
                            <div class="card">
                                <label class="mb-2">Valores</label>
                                <div class="form-check form-switch mb-3">
                                    <input class="form-check-input mt-2" type="checkbox" id="aluguelCheckbox" onchange="openModal(this, '#aluguel_modal')">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn_custom" onclick="openModal(document.getElementById('aluguelCheckbox'), '#aluguel_modal', this)">
                                        Aluguel
                                    </button>
                                    <!-- Modal -->
                                    <div class="modal fade" id="aluguel_modal" tabindex="-1" aria-labelledby="aluguel_modal" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="aluguel_modal">Valores</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Valor do aluguel</p>
                                                    <input type="text" placeholder="Digite o valor do aluguel" name="valor_aluguel" class="form-control mb-3" id="valor_aluguel" value="<?= htmlspecialchars($imovel['valor_aluguel']) ?>">
                                                    <p>Taxa administrativa</p>
                                                    <input type="float" placeholder="Digite a porcentagem da taxa" name="taxa_aluguel" class="form-control" id="taxa_aluguel" value="<?= htmlspecialchars($imovel['taxa_aluguel']) ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                    <button type="button" class="btn btn_salvar" data-bs-dismiss="modal">Salvar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-check form-switch mb-3">
                                    <!-- Checkbox para ativar a obrigatoriedade -->
                                    <input class="form-check-input mt-2" type="checkbox" id="vendaCheckbox" onchange="openModal(this, '#venda_modal')">

                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn_custom" onclick="openModal(document.getElementById('vendaCheckbox'), '#venda_modal', this)">
                                        Venda
                                    </button>

                                    <!-- Modal -->
                                    <div class="modal fade" id="venda_modal" tabindex="-1" aria-labelledby="venda_modal" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h1 class="modal-title fs-5" id="venda_modal">Valores</h1>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Valor do imóvel</p>
                                                    <input type="text" placeholder="Digite o valor do imóvel" name="valor_venda" class="form-control mb-3" id="valor_venda" value="<?= htmlspecialchars($imovel['valor_venda']) ?>">
                                                    <p>Taxa administrativa</p>
                                                    <input type="number" placeholder="Digite a porcentagem da taxa" name="taxa_venda" class="form-control" id="taxa_venda" value="<?= htmlspecialchars($imovel['taxa_venda']) ?>">
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                                                    <button type="button" class="btn btn_salvar" data-bs-dismiss="modal">Salvar</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- rodapé -->
            <footer class="py-3">
                <div class="container">
                    <button type="submit" class="btn btn_salvar">Alterar</button>
                </div>
            </footer>

        </form>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../public/assets/js/consultacep.js"></script>
    <script>
    function openModal(checkbox, modalId) {
    checkbox.checked = true;

    if (checkbox.checked) {
        const modal = new bootstrap.Modal(document.querySelector(modalId));
        modal.show();

        // nao limpar os dados ao fechar o modal
        document.querySelector(modalId).addEventListener('hidden.bs.modal', function() {
            let valorImovel = '';
            let taxaAdm = '';

            if (modalId === '#venda_modal') {
                valorImovel = document.getElementById('valor_venda').value;
                taxaAdm = document.getElementById('taxa_venda').value;
            } else if (modalId === '#aluguel_modal') {
                valorImovel = document.getElementById('valor_aluguel').value;
                taxaAdm = document.getElementById('taxa_aluguel').value;
            }

            if (!valorImovel || valorImovel == '0' && (!taxaAdm || taxaAdm == '0')) {
                checkbox.checked = false;
            }
        });
    }
}

function resetModal(modalId, checkboxId) {
    if (modalId === '#venda_modal') {
        document.getElementById('valor_venda').value = '';
        document.getElementById('taxa_venda').value = '';
    } else if (modalId === '#aluguel_modal') {
        document.getElementById('valor_aluguel').value = '';
        document.getElementById('taxa_aluguel').value = '';
    }

    document.getElementById(checkboxId).checked = false;
}

document.addEventListener('DOMContentLoaded', function() {
    // confere se os valores ja foram preenchidos ao carregar a página
    const valorVenda = document.getElementById('valor_venda').value;
    const taxaVenda = document.getElementById('taxa_venda').value;
    const valorAluguel = document.getElementById('valor_aluguel').value;
    const taxaAluguel = document.getElementById('taxa_aluguel').value;

    // mantem o checkbox se tiver dados preenchidos
    if (valorVenda && valorVenda != '0' || taxaVenda && taxaVenda != '0') {
        document.getElementById('vendaCheckbox').checked = true;
    }

    if (valorAluguel && valorAluguel != '0' || taxaAluguel && taxaAluguel != '0') {
        document.getElementById('aluguelCheckbox').checked = true;
    }
});

</script>

</body>

</html>