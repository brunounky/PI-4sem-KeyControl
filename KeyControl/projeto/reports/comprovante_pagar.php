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
        @page { margin: 20px; }
        body { font-family: Arial, sans-serif; font-size: 12px; color: #333; }
        .container { width: 100%; padding: 10px; }
        .header { text-align: center; margin-bottom: 10px; }
        .header h1 { font-size: 16px; font-weight: bold; margin: 5px 0; }
        .header p { margin: 3px 0; }
        .content { margin-top: 10px; }
        .content table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .content th, .content td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        .content th { background-color: #f2f2f2; font-weight: bold; }
        .footer { margin-top: 20px; text-align: center; }
        .signature { margin-top: 40px; text-align: center; }
        .signature-line { margin-top: 30px; border-top: 1px solid #000; width: 40%; margin-left: auto; margin-right: auto; }
        .signature-text { margin-top: 5px; font-size: 10px; }
    </style>

    <div class="container">
        <!-- Cabeçalho -->
        <div class="header">
            <h1>Comprovante de Lançamento</h1>
            <p><strong>' . htmlspecialchars($lanpagar['nome_fantasia']) . '</strong></p>
            <p>CNPJ: ' . htmlspecialchars(formatarCNPJ($lanpagar['id_imobiliaria'])) . '</p>
            <p>Telefone: ' . htmlspecialchars($lanpagar['telefoneimobiliaria']) . '</p>
            <p>E-mail: ' . htmlspecialchars($lanpagar['emailimobiliaria']) . '</p>
        </div>

        <!-- Dados principais -->
        <div class="content">
            <table>
                <tr>
                    <th>Nº Lançamento</th>
                    <td>' . htmlspecialchars($lanpagar['id_lancamento']) . '</td>
                </tr>
                <tr>
                    <th>Tipo de Lançamento</th>
                    <td>' . htmlspecialchars($lanpagar['tipo_lancamento']) . '</td>
                </tr>
                <tr>
                    <th>Registro do Imóvel</th>
                    <td>' . htmlspecialchars($lanpagar['registro_imovel']) . '</td>
                </tr>
                <tr>
                    <th>Data Emissão</th>
                    <td>' . htmlspecialchars(date("d/m/Y", strtotime($lanpagar['data_emissao']))) . '</td>
                </tr>
                <tr>
                    <th>Data Vencimento</th>
                    <td>' . htmlspecialchars(date("d/m/Y", strtotime($lanpagar['data_vencimento']))) . '</td>
                </tr>
                <tr>
                    <th>Forma de Pagamento</th>
                    <td>' . htmlspecialchars($lanpagar['forma_pagamento']) . '</td>
                </tr>
                <tr>
                    <th>Valor Total</th>
                    <td>' . htmlspecialchars(number_format($lanpagar['valor_total'], 2, ',', '.')) . '</td>
                </tr>
                <tr>
                    <th>Data Vigência</th>
                    <td>' . htmlspecialchars(date("d/m/Y", strtotime($lanpagar['data_vigencia']))) . '</td>
                </tr>
            </table>
        </div>

        <!-- Rodapé e assinaturas -->
        <div class="footer">
            <p>Documento gerado em ' . date("d/m/Y") . '</p>
        </div>
        <div class="signature">
            <div class="signature-line"></div>
            <div class="signature-text">Assinatura do Emitente</div>
            <div class="signature-line"></div>
            <div class="signature-text">Assinatura do Responsável</div>
        </div>
    </div>
';

// Carregar o HTML no Dompdf e gerar o PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("comprovante_lancamento.pdf", ["Attachment" => false]);
