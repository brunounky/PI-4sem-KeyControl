<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

//formatar cnpj na impressão 
function formatarCNPJ($cnpj) {
    $cnpj = preg_replace('/\D/', '', $cnpj);
    if (strlen($cnpj) == 14) {
        $cnpj = substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);
    }
    return $cnpj;
}

include '../app/controllers/db_conexao.php';
require '../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);

$id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT);
    
$query = "SELECT * 
          FROM contrato_aluguel cv
          INNER JOIN imobiliaria i ON cv.id_imobiliaria = i.cnpj
          WHERE cv.id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);
$aluguel = $stmt->fetch();

$html = '
    <style>
        @page { margin: 40px; }
        body { font-family: Arial, sans-serif; color: #333; }
        .container { width: 100%; padding: 20px; }
        .header { font-size: 42px; text-align: left; margin-bottom: 0px; }
        .header h1 { font-size: 35px; color: #333; }
        .header p { font-size: 10px; color: #333; }
        .header .cabecalho { font-size: 25px; color: #333; margin: 7px; }
        .header .cabecalho2 { font-size: 15px; color: #333; margin: 7px; }
        .header .logo { width: 100px; margin-bottom: 10px; }

        .section { margin-top: 20px; }
        .section-title { font-size: 14px; color: #333; font-weight: bold; border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-bottom: 10px; }

        .table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table th, .table td { border: 1px solid #ddd; padding: 8px; font-size: 12px; text-align: left; }
        .table th { background-color: #f2f2f2; font-weight: bold; }

        .row { display: flex; justify-content: space-between; }
        .col-3 { width: 30%; }
        .col-6 { width: 48%; }
        .footer { margin-top: 30px; font-size: 10px; text-align: center; color: #888; }
    </style>

     <div class="container">
            <div class="header">
                    <p class="cabecalho"><strong>' . htmlspecialchars($aluguel['nome_fantasia']) . '</strong></p>
                    <p class="cabecalho2">CNPJ: ' . htmlspecialchars(formatarCNPJ($aluguel['id_imobiliaria'])) . '</p>
                    <p class="cabecalho2">Telefone: ' . htmlspecialchars($aluguel['telefoneimobiliaria']) . '</p>
                    <p class="cabecalho2">E-mail: ' . htmlspecialchars($aluguel['emailimobiliaria']) . '</p>
            </div>
            <div class="section">
                <h2 class="section-title">Dados Principais do Locatario</h2>
                    <div class="row">
                    <div class="col-4"><strong>Comprador:</strong> ' . htmlspecialchars($aluguel['locatario_nome']) . '</div>
                    <div class="col-3"><strong>CPF/CNPJ:</strong> ' . htmlspecialchars($aluguel['locatario_cpf_cnpj']) . '</div>
                    <div class="col-3"><strong>Telefone:</strong> ' . htmlspecialchars($aluguel['locatario_telefone']) . '</div>
                </div>
        </div>

        <div class="section">
                <h2 class="section-title">Detalhes do Imóvel</h2>
                <table class="table">
                    <tr>
                        <th>Proprietário</th>
                        <th>Endereço</th>
                        <th>Bairro</th>
                        <th>CEP</th>
                        <th>Cidade</th>
                    </tr>
                    <tr>
                        <td>' . htmlspecialchars($aluguel['imovel_proprietario_cpf_cnpj']) . '</td>
                        <td>' . htmlspecialchars($aluguel['imovel_rua']) . '</td>
                        <td>' . htmlspecialchars($aluguel['imovel_bairro']) . '</td>
                        <td>' . htmlspecialchars($aluguel['imovel_cep']) . '</td>
                        <td>' . htmlspecialchars($aluguel['imovel_cidade']) . '</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <h2 class="section-title">Detalhes do Contrato</h2>
                <table class="table">
                    <tr>
                        <th>% Taxa administrativa</th>
                        <th>Data da Emissão</th>
                        <th>Data de Pagamento</th>
                        <th>Forma de pagamento</th>
                    </tr>
                    <tr>
                        <td>' . htmlspecialchars(string: $aluguel['total_caucao']) . '</td>
                        <td>' . htmlspecialchars(date("d/m/Y", strtotime($aluguel['vencimento_caucao']))) . '</td>
                        <td>' . htmlspecialchars(date("d/m/Y", strtotime($aluguel['forma_pagamento_caucao']))) . '</td>
                        <td>' . htmlspecialchars(string: $aluguel['forma_pagamento']) . '</td>

                    </tr>
                </table>
            </div>
            <div class="footer">
                <p>Documento gerado em ' . date("d/m/Y") . '</p>
            </div>
        </div>
';

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("contrato_venda.pdf", ["Attachment" => false]);
