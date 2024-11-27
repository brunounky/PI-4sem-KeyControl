<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

include '../app/controllers/db_conexao.php';
require '../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

function formatarValor($valor) {
    return number_format($valor, 2, ',', '.');
}

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);

$id_lancamento = $_POST['id_lancamento'] ?? '';
$data_inicial = $_POST['data_inicial'] ?? '';
$data_final = $_POST['data_final'] ?? '';

$sql = "SELECT * FROM lancamento_financeiro";
$conditions = [];
$params = [];

if (!empty($id_lancamento)) {
    $conditions[] = "id_lancamento = :id_lancamento";
    $params[':id_lancamento'] = $id_lancamento;
}
if (!empty($data_inicial) && !empty($data_final)) {
    $conditions[] = "data_emissao BETWEEN :data_inicial AND :data_final";
    $params[':data_inicial'] = $data_inicial;
    $params[':data_final'] = $data_final;
}

if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(" AND ", $conditions);
}

$stmt = $pdo->prepare($sql);
$stmt->execute($params);
$lancamentos = $stmt->fetchAll(PDO::FETCH_ASSOC);

$totalPagar = 0;

$html = '
    <style>
        @page { margin: 40px; }
        body { font-family: Arial, sans-serif; color: #333; }
        .container { width: 100%; padding: 20px; }
        .header { text-align: center; margin-bottom: 20px; }
        .header h1 { font-size: 20px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; font-size: 12px; text-align: left; }
        .table th { background-color: #f2f2f2; font-weight: bold; }
        .footer { margin-top: 30px; font-size: 10px; text-align: center; color: #888; }
        .total { font-weight: bold; font-size: 14px; text-align: right; margin-top: 20px; }
    </style>
    <div class="container">
        <div class="header">
            <h1>Relatório de Lançamentos</h1>
            <p>Gerado em: ' . date("d/m/Y") . '</p>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th>Id Lançamento</th>
                    <th>Tipo de Lançamento</th>
                    <th>Data Emissão</th>
                    <th>Liquidado</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody>';

if (count($lancamentos) > 0) {
    foreach ($lancamentos as $lancamento) {
        $totalPagar += $lancamento['valor_total'];

        $html .= '
            <tr>
                <td>' . htmlspecialchars($lancamento['id_lancamento']) . '</td>
                <td>' . htmlspecialchars($lancamento['tipo_lancamento']) . '</td>
                <td>' . date("d/m/Y", strtotime($lancamento['data_emissao'])) . '</td>
                <td>' . htmlspecialchars($lancamento['liquidado']) . '</td>
                <td>' . formatarValor($lancamento['valor_total']) . '</td>
            </tr>';
    }
    $html .= '
            <tr>
                <td colspan="4" class="total"><strong>TOTAL A PAGAR:</strong></td>
                <td class="total">' . formatarValor($totalPagar) . '</td>
            </tr>';

} else {
    $html .= '
            <tr>
                <td colspan="6" style="text-align: center;">Nenhum lançamento encontrado para os filtros aplicados.</td>
            </tr>';
}

$html .= '
            </tbody>
        </table>
    </div>
    <div class="footer">
        <p>Documento gerado automaticamente pelo sistema.</p>
    </div>';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('relatorio_lancamentos.pdf', array('Attachment' => 0));
?>
