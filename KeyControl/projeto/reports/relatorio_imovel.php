<?php
// nao sei se esse arquivo pode ficar na pasta reports
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
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

$query = "SELECT * 
          FROM cadastro_imovel c
          INNER JOIN imobiliaria i ON c.id_imobiliaria = i.cnpj
          WHERE c.id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

$imovel = $stmt->fetch();

if ($imovel) {
    $html = '
        <h1>Ficha Cadastral do Cliente</h1>

        <h2>Dados da Imobiliaria</h2>
        <p><strong>CNPJ da Imobiliaria:</strong> ' . htmlspecialchars($imovel['id_imobiliaria']) . '</p>
        <p><strong>Nome Fantasia:</strong> ' . htmlspecialchars($imovel['nome_fantasia']) . '</p>
        <p><strong>Endereço:</strong> ' . htmlspecialchars($imovel['telefoneimobiliaria']) . '</p>
        <p><strong>Email:</strong> ' . htmlspecialchars($imovel['emailimobiliaria']) . '</p>


        <p>________________________________________________________________________</p>

        <h2>Dados do imovel</h2>
        
                <p><strong>Proprietario:</strong> ' . htmlspecialchars($imovel['cpf_cnpj_proprietario']) . '</p>
                <p><strong>Tipo de Imovel:</strong> ' . htmlspecialchars($imovel['tipo_imovel']) . '</p>
                <p><strong>Quartos:</strong> ' . htmlspecialchars($imovel['quantidade_quartos']) . '</p>
                <p><strong>Banheiros:</strong> ' . htmlspecialchars($imovel['quantidade_banheiros']) . '</p>
                <p><strong>Vagas:</strong> ' . htmlspecialchars($imovel['quantidade_vagas']) . '</p>
                <p><strong>Area Total:</strong> ' . htmlspecialchars($imovel['area_total']) . '</p>
                <p><strong>CEP:</strong> ' . htmlspecialchars($imovel['cep']) . '</p>
                <p><strong>Rua:</strong> ' . htmlspecialchars($imovel['rua']) . '</p>
                <p><strong>Numero:</strong> ' . htmlspecialchars($imovel['numero']) . '</p>
                <p><strong>Bairro:</strong> ' . htmlspecialchars($imovel['bairro']) . '</p>
                <p><strong>Cidade:</strong> ' . htmlspecialchars($imovel['cidade']) . '</p>
                <p><strong>Estado:</strong> ' . htmlspecialchars($imovel['estado']) . '</p>
                <p><strong>País:</strong> ' . htmlspecialchars($imovel['pais']) . '</p>
                <p><strong>N Registro do Imovel:</strong> ' . htmlspecialchars($imovel['registro_imovel']) . '</p>
                <p><strong>N Registro da Agua:</strong> ' . htmlspecialchars($imovel['registro_agua']) . '</p>
                <p><strong>Valor do Aluguel:</strong> ' . htmlspecialchars($imovel['valor_aluguel']) . '</p>
                <p><strong>Taxa do Aluguel:</strong> ' . htmlspecialchars($imovel['taxa_aluguel']) . '</p>
                <p><strong>Valor de Venda:</strong> ' . htmlspecialchars($imovel['valor_venda']) . '</p>
                <p><strong>Taxa da Venda:</strong> ' . htmlspecialchars($imovel['taxa_venda']) . '</p>
                <p><strong>Complemento:</strong> ' . htmlspecialchars($imovel['complemento']) . '</p>
    ';
} else {
    $html = '<h1>Cliente não encontrado!</h1>';
}

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream('ficha_cadastral_cliente.pdf', array('Attachment' => 0)); // 1 baixa e 0 exibe
?>
