<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}

// Função para formatar o CNPJ na exibição
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

$id = $_GET['id'];

// Consulta para obter dados do imóvel e imobiliária associados
$queryImovel = "SELECT * FROM cadastro_imovel c
                INNER JOIN imobiliaria i ON c.id_imobiliaria = i.cnpj
                WHERE c.id = ?";
$stmtImovel = $pdo->prepare($queryImovel);
$stmtImovel->execute([$id]);
$imovel = $stmtImovel->fetch();

if ($imovel) {
    // Função para exibir 'Sim' ou 'Não' para valores booleanos
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
                <h2 class="section-title">Dados do Imóvel</h2>
                <p><strong>Proprietário:</strong> ' . htmlspecialchars($imovel['cpf_cnpj_proprietario']) . '</p>
                <p><strong>Tipo de Imóvel:</strong> ' . htmlspecialchars($imovel['tipo_imovel']) . '</p>
                <p><strong>Quartos:</strong> ' . htmlspecialchars($imovel['quantidade_quartos']) . '</p>
                <p><strong>Banheiros:</strong> ' . htmlspecialchars($imovel['quantidade_banheiros']) . '</p>
                <p><strong>Vagas:</strong> ' . htmlspecialchars($imovel['quantidade_vagas']) . '</p>
                <p><strong>Área Total:</strong> ' . htmlspecialchars($imovel['area_total']) . '</p>
                <p><strong>Endereço:</strong> ' . htmlspecialchars($imovel['rua']) . ', ' . htmlspecialchars($imovel['numero']) . ', ' . htmlspecialchars($imovel['bairro']) . ', ' . htmlspecialchars($imovel['cidade']) . ', ' . htmlspecialchars($imovel['estado']) . ', ' . htmlspecialchars($imovel['pais']) . '</p>
                <p><strong>CEP:</strong> ' . htmlspecialchars($imovel['cep']) . '</p>
                <p><strong>Registro do Imóvel:</strong> ' . htmlspecialchars($imovel['registro_imovel']) . '</p>
                <p><strong>Registro da Água:</strong> ' . htmlspecialchars($imovel['registro_agua']) . '</p>
                <p><strong>Valor do Aluguel:</strong> ' . htmlspecialchars($imovel['valor_aluguel']) . '</p>
                <p><strong>Taxa de Aluguel:</strong> ' . htmlspecialchars($imovel['taxa_aluguel']) . '</p>
                <p><strong>Valor de Venda:</strong> ' . htmlspecialchars($imovel['valor_venda']) . '</p>
                <p><strong>Taxa de Venda:</strong> ' . htmlspecialchars($imovel['taxa_venda']) . '</p>
                <p><strong>Complemento:</strong> ' . htmlspecialchars($imovel['complemento']) . '</p>
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
