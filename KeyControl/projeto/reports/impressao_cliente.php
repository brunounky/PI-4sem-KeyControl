<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}
//formatar cnpj na impressão 
function formatarCNPJ($cnpj) {$cnpj = preg_replace('/\D/', '', $cnpj);if (strlen($cnpj) == 14) {$cnpj = substr($cnpj, 0, 2) . '.' . substr($cnpj, 2, 3) . '.' . substr($cnpj, 5, 3) . '/' . substr($cnpj, 8, 4) . '-' . substr($cnpj, 12, 2);}return $cnpj;}

include '../app/controllers/db_conexao.php';
require '../../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);

$dompdf = new Dompdf($options);

$id = $_GET['id'];

$query = "SELECT * 
          FROM cadastro_cliente c
          INNER JOIN imobiliaria i ON c.id_imobiliaria = i.cnpj
          WHERE c.id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

$cliente = $stmt->fetch();

if ($cliente) {
    function displayYesNo($value) {
        return $value ? 'Sim' : 'Não';
    }

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
            .col-6 { width: 48%; }
            .col-4 { width: 23%; }

            .footer { margin-top: 30px; font-size: 10px; text-align: center; color: #888; }
        </style>
        

            <div class="container">
                <div class="header">
                    <p class="cabecalho"><strong>' . htmlspecialchars($cliente['nome_fantasia']) . '</strong></p>
                    <p class="cabecalho2">CNPJ: ' . htmlspecialchars(formatarCNPJ($cliente['id_imobiliaria'])) . '</p>
                    <p class="cabecalho2">Telefone: ' . htmlspecialchars($cliente['telefoneimobiliaria']) . '</p>
                    <p class="cabecalho2">E-mail: ' . htmlspecialchars($cliente['emailimobiliaria']) . '</p>
            </div>

            <div class="section">
                <h2 class="section-title">Dados do Cliente</h2>
                <div class="row">
                    <div class="col-3"><strong>Nome:</strong> ' . htmlspecialchars($cliente['nome']) . '</div>
                    <div class="col-3"><strong>RG/IE:</strong> ' . htmlspecialchars($cliente['rg_ie']) . '</div>
                </div>
                <div class="row">
                    <div class="col-3"><strong>Data de Nascimento:</strong> ' . htmlspecialchars($cliente['data_nascimento_fundacao']) . '</div>
                    <div class="col-3"><strong>Telefone:</strong> ' . htmlspecialchars($cliente['telefone']) . '</div>
                </div>
                <div class="row">
                    <div class="col-3"><strong>Email:</strong> ' . htmlspecialchars($cliente['email']) . '</div>
                    <div class="col-3"><strong>Estado Civil:</strong> ' . htmlspecialchars($cliente['estado_civil']) . '</div>
                </div>
                <div class="row">
                    <div class="col-3"><strong>Nacionalidade:</strong> ' . htmlspecialchars($cliente['nacionalidade']) . '</div>
                    <div class="col-3"><strong>Profissão:</strong> ' . htmlspecialchars($cliente['profissao']) . '</div>
                </div>
            </div>

            <div class="section">
                <h2 class="section-title">Endereço do Cliente</h2>
                <table class="table">
                    <tr>
                        <th>CEP</th>
                        <th>Rua</th>
                        <th>Número</th>
                        <th>Bairro</th>
                    </tr>
                    <tr>
                        <td>' . htmlspecialchars($cliente['cep']) . '</td>
                        <td>' . htmlspecialchars($cliente['rua']) . '</td>
                        <td>' . htmlspecialchars($cliente['numero']) . '</td>
                        <td>' . htmlspecialchars($cliente['bairro']) . '</td>
                    </tr>
                    <tr>
                        <th>Cidade</th>
                        <th>Estado</th>
                        <th>País</th>
                        <th>Complemento</th>
                    </tr>
                    <tr>
                        <td>' . htmlspecialchars($cliente['cidade']) . '</td>
                        <td>' . htmlspecialchars($cliente['estado']) . '</td>
                        <td>' . htmlspecialchars($cliente['pais']) . '</td>
                        <td>' . htmlspecialchars($cliente['complemento']) . '</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <h2 class="section-title">Categoria Cliente</h2>
                <table class="table">
                    <tr>
                        <th>Locador</th>
                        <th>Locatário</th>
                        <th>Fiador</th>
                        <th>Comprador</th>
                    </tr>
                    <tr>
                        <td>' . displayYesNo($cliente['locador']) . '</td>
                        <td>' . displayYesNo($cliente['locatario']) . '</td>
                        <td>' . displayYesNo($cliente['fiador']) . '</td>
                        <td>' . displayYesNo($cliente['comprador']) . '</td>
                    </tr>
                </table>
            </div>

            <div class="footer">
                <p>Documento gerado em ' . date("d/m/Y") . '</p>
            </div>
        </div>
    ';
} else {
    $html = '<h1>Cliente não encontrado!</h1>';
}

$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream('ficha_cadastral_cliente.pdf', array('Attachment' => 0));
?>
