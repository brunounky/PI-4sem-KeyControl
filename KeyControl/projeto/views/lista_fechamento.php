<?php 
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

include_once '../app/controllers/filtro_fechamento.php';

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../public/assets/js/menu.js">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../public/assets/css/style2.css">
    <link rel="icon" href="../public/assets/img/Logotipo.svg">
    <title>Fechamentos</title>
</head>
<body>
<?php include 'navbar.php';?>
<section>
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h2 class="mb-0">Fechamentos</h2>
        </div>
    </div>

    <div class="container">
        <form method="POST" action="">
            <div class="filtros-container">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label for="registro_imovel" class="form-label">N° Registro Imóvel</label>
                        <input type="text" id="registro_imovel" class="form-control" name="registro_imovel" value="<?= htmlspecialchars($_POST['registro_imovel'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="data_inicial" class="form-label">Data Inicial</label>
                        <input type="date" id="data_inicial" class="form-control" name="data_inicial" value="<?= htmlspecialchars($_POST['data_inicial'] ?? '') ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="data_final" class="form-label">Data Final</label>
                        <input type="date" id="data_final" class="form-control" name="data_final" value="<?= htmlspecialchars($_POST['data_final'] ?? '') ?>">
                    </div>
                    <div class="col-md-1">
                        <button class="btn btn-buscar" type="submit">
                            <i class="bi bi-search"></i>
                        </button>
                    </div> 
                </div>
            </div>
        </form>
    </div>
</section>

<div class="col-md-12 mt-4 text-center">
    <button class="btn btn_salvar" onclick="redirectToRelatorio('<?php echo htmlspecialchars($registro_imovel); ?>', '<?php echo htmlspecialchars($data_inicial); ?>', '<?php echo htmlspecialchars($data_final); ?>')">
        Imprimir Débitos
    </button>
    <button class="btn btn_salvar" onclick="redirectToRelatorio2('<?php echo htmlspecialchars($registro_imovel); ?>', '<?php echo htmlspecialchars($data_inicial); ?>', '<?php echo htmlspecialchars($data_final); ?>')">
        Liquida Tudo
    </button>
</div>

<section id="fechamento">
    <div class="container">
        <div class="card_relatório">
            <?php if (!isset($_POST['registro_imovel']) || empty($_POST['registro_imovel']) || !isset($result) || count($result) == 0) : ?>
                <p class="text-center">Informe um Registro de Imóvel para liquidar lançamentos</p>
            <?php else : ?>
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID do lançamento</th>
                            <th>Tipo de Lançamento</th>
                            <th>Data Emissão</th>
                            <th>Valor</th>
                            <th>Forma de Pagamento</th>
                            <th>Liquidado</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php
                        foreach ($result as $row) {
                            // Formatação do valor do imóvel
                            $valor = $row['valor_total'] ?? '-';
                            $formatted_valor = ($valor !== '-') ? 'R$ ' . number_format($valor, 2, ',', '.') : '-';
                            echo "<tr>
                                <td>" . htmlspecialchars($row['id_lancamento']) . "</td>
                                <td>" . htmlspecialchars($row['tipo_lancamento']) . "</td>
                                <td>" . htmlspecialchars(date("d/m/Y", strtotime($row['data_emissao'] ?? ''))) . "</td>
                                <td>" . $formatted_valor . "</td>
                                <td>" . htmlspecialchars($row['forma_pagamento'] ?? '-') . "</td>
                                <td>" . htmlspecialchars($row['liquidado'] ?? '-') . "</td>
                                <td>
                                <button class='btn' onclick=\"window.location.href='../app/controllers/liquida_individual.php?id=" . htmlspecialchars($row['id_lancamento']) . "'\">
                                          <i class='bi bi-cash-stack'></i>
                                          </button>
                                         </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="../public/assets/js/submenu.js"></script>
<script>
    function redirectToRelatorio(registro_imovel, data_inicial, data_final) {
        var url = '../reports/impressao_fechamento.php?registro_imovel=' + registro_imovel + '&data_inicial=' + data_inicial + '&data_final=' + data_final;
        window.open(url, '_blank');
    }
</script>
<script>
    function redirectToRelatorio2(registro_imovel, data_inicial, data_final) {
        var url = '../app/controllers/liquida_tudo.php?registro_imovel=' + registro_imovel + '&data_inicial=' + data_inicial + '&data_final=' + data_final;
        window.location.href = url; 
    }
</script>


</body>
</html>
