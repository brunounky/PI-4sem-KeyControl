<?php
session_start();

// Verificação de sessão
if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

// Função para formatar CNPJ
function formatarCNPJ($cnpj) {
    $cnpj = preg_replace('/\D/', '', $cnpj);
    if (strlen($cnpj) == 14) {
        $cnpj = substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
    }
    return $cnpj;
}

// Incluindo dependências
include '../app/controllers/db_conexao.php';
require '../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

// Configuração do Dompdf
$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);

// Obtendo o ID do lançamento via GET
$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);

// Consulta ao banco de dados
$query = "SELECT * 
          FROM lancamento_financeiro AS cv
          INNER JOIN imobiliaria i ON cv.id_imobiliaria = i.cnpj
          WHERE valor_total LIKE '-%' AND id_lancamento = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
$lanpagar = $stmt->fetch();

// Verifica se há resultados
if (!$lanpagar) {
    die('Nenhum registro encontrado para o lançamento especificado.');
}

// Gerar HTML do documento
$html = '
    <style>
        @page { margin: 40px; }
        body { font-family: Arial, sans-serif; color: #333; }
        .container { width: 100%; padding: 20px; }
        .header { text-align: left; margin-bottom: 20px; }
        .header h1 { font-size: 20px; color: #333; }
        .header p { font-size: 12px; margin: 5px 0; }
        .section { margin-top: 20px; }
        .section-title { font-size: 14px; font-weight: bold; border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-bottom: 10px; }
        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; font-size: 12px; text-align: left; }
        .table th { background-color: #f2f2f2; font-weight: bold; }
        .footer { margin-top: 30px; font-size: 10px; text-align: center; color: #888; }
    </style>

    <div class="container">
        <div class="header">
            <h1>' . htmlspecialchars($lanpagar['nome_fantasia']) . '</h1>
            <p>CNPJ: ' . htmlspecialchars(formatarCNPJ($lanpagar['id_imobiliaria'])) . '</p>
            <p>Telefone: ' . htmlspecialchars($lanpagar['telefoneimobiliaria']) . '</p>
            <p>E-mail: ' . htmlspecialchars($lanpagar['emailimobiliaria']) . '</p>
        </div>

        <div class="section">
            <h2 class="section-title">Dados Principais do Lançamento a Pagar</h2>
            <p><strong>Nº:</strong> ' . htmlspecialchars($lanpagar['id_lancamento']) . '</p>
            <p><strong>Tipo Lançamento:</strong> ' . htmlspecialchars($lanpagar['tipo_lancamento']) . '</p>
            <p><strong>Registro do Imóvel:</strong> ' . htmlspecialchars($lanpagar['registro_imovel']) . '</p>
        </div>

        <div class="section">
            <h2 class="section-title">Detalhes do Lançamento</h2>
            <table class="table">
                <tr>
                    <th>Data Emissão</th>
                    <th>Data Vencimento</th>
                    <th>Forma Pagamento</th>
                    <th>Valor Total</th>
                    <th>Data Vigência</th>
                </tr>
                <tr>
                    <td>' . htmlspecialchars(date("d/m/Y", strtotime($lanpagar['data_emissao']))) . '</td>
                    <td>' . htmlspecialchars(date("d/m/Y", strtotime($lanpagar['data_vencimento']))) . '</td>
                    <td>' . htmlspecialchars($lanpagar['forma_pagamento']) . '</td>
                    <td>' . htmlspecialchars(number_format($lanpagar['valor_total'], 2, ',', '.')) . '</td>
                    <td>' . htmlspecialchars(date("d/m/Y", strtotime($lanpagar['data_vigencia']))) . '</td>
                </tr>
            </table>
        </div>

        <div class="footer">
            <p>Documento gerado em ' . date("d/m/Y") . '</p>
        </div>
    </div>
';

// Carregar o HTML no Dompdf e gerar o PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("impressao_a_pagar.pdf", ["Attachment" => false]);
