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

$queryImovel = "SELECT * FROM cadastro_imovel c
                INNER JOIN imobiliaria i ON c.id_imobiliaria = i.cnpj
                INNER JOIN cadastro_cliente cc ON c.cpf_cnpj_proprietario = cc.cpf_cnpj
                WHERE c.id = ?";
$stmtImovel = $pdo->prepare($queryImovel);
$stmtImovel->execute([$id]);
$imovel = $stmtImovel->fetch();

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
                <p class="cabecalho"><strong>' . htmlspecialchars($imovel['nome_fantasia']) . '</strong></p>
                <p class="cabecalho2">CNPJ: ' . htmlspecialchars(formatarCNPJ($imovel['id_imobiliaria'])) . '</p>
                <p class="cabecalho2">Telefone: ' . htmlspecialchars($imovel['telefoneimobiliaria']) . '</p>
                <p class="cabecalho2">E-mail: ' . htmlspecialchars($imovel['emailimobiliaria']) . '</p>
            </div>

            <div class="section">
                <h2 class="section-title">Dados Principais do Imóvel</h2>
                    <div class="row">
                    <div class="col-3"><strong>CPF/CNPJ:</strong> ' . htmlspecialchars($imovel['cpf_cnpj_proprietario']) . '</div>
                    <div class="col-3"><strong>Proprietário:</strong> ' . htmlspecialchars($imovel['nome']) . '</div>
                    <div class="col-3"><strong>Tipo de Imóvel:</strong> ' . htmlspecialchars($imovel['tipo_imovel']) . '</div>
                </div>
        </div>

        <div class="section">
                <h2 class="section-title">Detalhes do Imóvel</h2>
                <table class="table">
                    <tr>
                        <th>Endereço</th>
                        <th>Bairro</th>
                        <th>CEP</th>
                        <th>Cidade</th>
                    </tr>
                    <tr>
                        <td>' . htmlspecialchars($imovel['rua']) . '</td>
                        <td>' . htmlspecialchars($imovel['bairro']) . '</td>
                        <td>' . htmlspecialchars($imovel['cep']) . '</td>
                        <td>' . htmlspecialchars($imovel['cidade']) . '</td>
                    </tr>
                    <tr>
                        <th>Banheiros</th>
                        <th>Vagas</th>
                        <th>Área Total</th>
                        <th>Complemento</th>
                    </tr>
                    <tr>
                        <td>' . htmlspecialchars($imovel['quantidade_banheiros']) . '</td>
                        <td>' . htmlspecialchars($imovel['quantidade_vagas']) . '</td>
                        <td>' . htmlspecialchars($imovel['area_total']) . '</td>
                        <td>' . htmlspecialchars($imovel['complemento']) . '</td>
                    </tr>
                </table>
            </div>

            <div class="section">
                <h2 class="section-title">Registros do Imóvel</h2>
                <table class="table">
                    <tr>
                        <th>Registro Imóvel</th>
                        <th>Registro Água</th>
                        <th>Valor Aluguel</th>
                        <th>Taxa Aluguel</th>
                        <th>Valor Venda</th>
                        <th>Taxa Venda</th>
                    </tr>
                    <tr>
                        <td>' . htmlspecialchars($imovel['registro_imovel']) . '</td>
                        <td>' . htmlspecialchars($imovel['registro_agua']) . '</td>
                        <td>' . htmlspecialchars($imovel['valor_aluguel']) . '</td>
                        <td>' . htmlspecialchars($imovel['taxa_aluguel']) . '</td>
                        <td>' . htmlspecialchars($imovel['valor_venda']) . '</td>
                        <td>' . htmlspecialchars($imovel['taxa_venda']) . '</td>
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
$dompdf->stream('ficha_cadastral_imovel.pdf', array('Attachment' => 0));
?>
