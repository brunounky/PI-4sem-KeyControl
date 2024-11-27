<?php
session_start();

if (!isset($_SESSION['user_id'])) {
   header("Location: ../app/controllers/verifica_login.php");
   exit();
}


include '../app/controllers/consulta_dashboard.php';
include '../app/controllers/financeiro_geral.php';
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- Bootstrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <!-- Grafico -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Google fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <!-- Estilo customizado -->
    <link rel="stylesheet" type="text/css" href="../public/assets/css/style2.css">
    <!-- ICONE -->
    <link rel="icon" href="../public/assets/img/Logotipo.svg">

    <title>Dashboard</title>
</head>

<?php
// Consultas ao banco
$query_imoveis = "SELECT COUNT(*) AS total_imoveis FROM cadastro_imovel";
$stmt_imoveis = $pdo->query($query_imoveis);
$total_imoveis = $stmt_imoveis->fetch(PDO::FETCH_ASSOC)['total_imoveis'];

$query_clientes = "SELECT COUNT(*) AS total_clientes FROM cadastro_cliente";
$stmt_clientes = $pdo->query($query_clientes);
$total_clientes = $stmt_clientes->fetch(PDO::FETCH_ASSOC)['total_clientes'];

$query_contas_a_receber = "SELECT SUM(valor_total) AS total_receber FROM lancamento_financeiro WHERE valor_total NOT LIKE '-%'";
$stmt_receber = $pdo->query($query_contas_a_receber);
$total_receber = $stmt_receber->fetch(PDO::FETCH_ASSOC)['total_receber'];

$query_contas_a_pagar = "SELECT SUM(valor_total) AS total_pagar FROM lancamento_financeiro WHERE valor_total LIKE '-%'";
$stmt_pagar = $pdo->query($query_contas_a_pagar);
$total_pagar = $stmt_pagar->fetch(PDO::FETCH_ASSOC)['total_pagar'];

// Gráfico de Tipos de Imóveis
$query_imoveis_tipo = "SELECT tipo_imovel, COUNT(*) AS quantidade FROM cadastro_imovel GROUP BY tipo_imovel";
$stmt_imoveis_tipo = $pdo->query($query_imoveis_tipo);
$imoveis = $stmt_imoveis_tipo->fetchAll(PDO::FETCH_ASSOC);
$property_types = json_encode(array_column($imoveis, 'tipo_imovel'));
$property_counts = json_encode(array_column($imoveis, 'quantidade'));

// Gráfico de Tipos de Clientes
$query_clientes_tipo = "SELECT CASE WHEN locador = 1 THEN 'Locador' 
                                    WHEN locatario = 1 THEN 'Locatario'
                                    WHEN fiador = 1 THEN 'Fiador'
                                    WHEN comprador = 1 THEN 'Comprador'
                                ELSE 'Outro'
                            END AS tipo_cliente, 
                        COUNT(*) AS quantidade 
                    FROM cadastro_cliente 
                GROUP BY tipo_cliente";

$stmt_clientes_tipo = $pdo->query($query_clientes_tipo);
$clientes = $stmt_clientes_tipo->fetchAll(PDO::FETCH_ASSOC);

$labels = json_encode(array_column($clientes, 'tipo_cliente'));
$data = json_encode(array_column($clientes, 'quantidade'));
?>

<body>
<?php include 'navbar.php'; ?>

    <section id="dashboard">
        <div class="container">
            <div class="row">
                <h2>Dashboard</h2>
                <div class="col-md-12">
                    <div class="card card-superior">
                        <h5>Visão Geral</h5>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="card card-branco">
                                    <h3><?php echo $total_imoveis; ?></h3>
                                    <p>Quantidade de Imóveis</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-azul-escuro">
                                    <h3><?php echo $total_clientes; ?></h3>
                                    <p>Quantidade de Clientes</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-azul">
                                    <h3><?php echo number_format($total_receber, 2, ',', '.'); ?></h3>
                                    <p>Total Contas a Receber</p>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="card card-verde">
                                    <h3><?php echo number_format($total_pagar, 2, ',', '.'); ?></h3>
                                    <p>Total Contas a Pagar</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-superior">
                        <div class="row">
                            <div class="col-md-12">
                                <h5>Tipos de Imóveis</h5>
                                <canvas id="grafico_imoveis"></canvas>
                            </div>
                        </div>
                    </div>
                    <div class="card card-superior">
                        <div class="col-md-12">
                            <h5>Tipos de Clientes</h5>
                            <canvas id="grafico_clientes"></canvas>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="card card-superior">
                        <h5>Lançamentos à Vencer</h5>
                        <table class="table table-hover mt-3">
                            <thead>
                                <tr>
                                    <th>Nº</th>
                                    <th>Tipo</th>
                                    <th>Emissão</th>
                                    <th>Vencimento</th>
                                    <th>Valor</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (isset($result) && count($result) > 0) {
                                    foreach ($result as $row) {

                                        echo "<tr>
                                       <td>" . htmlspecialchars($row['id_lancamento'] ?? '-') . "</td>
                                       <td>" . htmlspecialchars($row['tipo_lancamento'] ?? '-') . "</td>
                                       <td>" . htmlspecialchars(date("d/m/Y", strtotime($row['data_emissao'] ?? ''))) . "</td>
                                       <td>" . htmlspecialchars(date("d/m/Y", strtotime($row['data_vencimento'] ?? ''))) . "</td>
                                       <td>" . htmlspecialchars($row['valor_total'] ?? '-') . "</td>
                                       <td>
                                       </td>
                                    </tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='8'>Nenhum registro encontrado</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </section>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous">
    </script>
   <script>
    // Dados vindos do PHP
    const rawLabels = <?php echo isset($labels) ? $labels : '[]'; ?>; // Labels originais
    const rawData = <?php echo isset($data) ? $data : '[]'; ?>; // Dados originais

    // Função para agrupar dados duplicados (locador e locatário, etc.)
    const aggregateData = (labels, data) => {
        const aggregated = {};
        labels.forEach((label, index) => {
            if (aggregated[label]) {
                aggregated[label] += data[index]; // Soma os valores duplicados
            } else {
                aggregated[label] = data[index];
            }
        });
        return {
            labels: Object.keys(aggregated),
            data: Object.values(aggregated)
        };
    };

    // Processar dados de clientes
    const { labels, data } = aggregateData(rawLabels, rawData);

    // Processar dados de propriedades
    const propertyLabels = <?php echo isset($property_types) ? $property_types : '[]'; ?>;
    const propertyData = <?php echo isset($property_counts) ? $property_counts : '[]'; ?>;

    // Configuração do gráfico de Clientes
    if (labels.length > 0 && data.length > 0) {
        const ctxClientes = document.getElementById('grafico_clientes').getContext('2d');
        new Chart(ctxClientes, {
            type: 'pie',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Quantidade de Clientes',
                    data: data,
                    backgroundColor: [
                        '#28ADF7', // Azul Claro
                        '#C4DF16', // Verde Limão
                        '#93A60F', // Verde Musgo
                        '#0541FF'  // Azul Escuro
                    ],
                    borderColor: '#fff',
                    borderWidth: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            generateLabels: (chart) => {
                                return chart.data.labels.map((label, i) => {
                                    const value = chart.data.datasets[0].data[i];
                                    return {
                                        text: `${label} - ${value}`,
                                        fillStyle: chart.data.datasets[0].backgroundColor[i],
                                        index: i
                                    };
                                });
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: (tooltipItem) => {
                                const label = labels[tooltipItem.dataIndex];
                                const value = data[tooltipItem.dataIndex];
                                return `${label}: ${value}`;
                            }
                        }
                    }
                }
            }
        });
    }

    // Configuração do gráfico de Imóveis
    if (propertyLabels.length > 0 && propertyData.length > 0) {
        const ctxImoveis = document.getElementById('grafico_imoveis').getContext('2d');
        new Chart(ctxImoveis, {
            type: 'pie',
            data: {
                labels: propertyLabels,
                datasets: [{
                    label: 'Quantidade de Imóveis',
                    data: propertyData,
                    backgroundColor: [
                        '#F39C12', // Amarelo
                        '#3498DB', // Azul
                        '#2ECC71'  // Verde
                    ],
                    borderColor: '#fff',
                    borderWidth: 4
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: {
                            generateLabels: (chart) => {
                                return chart.data.labels.map((label, i) => {
                                    const value = chart.data.datasets[0].data[i];
                                    return {
                                        text: `${label} - ${value}`,
                                        fillStyle: chart.data.datasets[0].backgroundColor[i],
                                        index: i
                                    };
                                });
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: (tooltipItem) => {
                                const label = propertyLabels[tooltipItem.dataIndex];
                                const value = propertyData[tooltipItem.dataIndex];
                                return `${label}: ${value}`;
                            }
                        }
                    }
                }
            }
        });
    }
</script>



</body>
</html>