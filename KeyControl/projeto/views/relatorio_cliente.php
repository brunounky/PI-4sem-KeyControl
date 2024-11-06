<?php
// nao sei se esse arquivo pode ficar na pasta views
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

$query = "SELECT * FROM cadastro_cliente WHERE id = ?";
$stmt = $pdo->prepare($query);
$stmt->execute([$id]);

$cliente = $stmt->fetch();

if ($cliente) {
    $html = '
        <h1>Ficha Cadastral do Cliente</h1>

        <h2>Dados da Imobiliaria</h2>

        <p>________________________________________________________________________________</p>

        <h2>Dados do cliente</h2>
        <p><strong>ID:</strong> ' . htmlspecialchars($cliente['id']) . '</p>
        <p><strong>Nome:</strong> ' . htmlspecialchars($cliente['nome']) . '</p>
        <p><strong>RG/IE:</strong> ' . htmlspecialchars($cliente['rg_ie']) . '</p>
        <p><strong>Data de Nascimento/Fundação:</strong> ' . htmlspecialchars($cliente['data_nascimento_fundacao']) . '</p>
        <p><strong>Telefone:</strong> ' . htmlspecialchars($cliente['telefone']) . '</p>
        <p><strong>Email:</strong> ' . htmlspecialchars($cliente['email']) . '</p>
        <p><strong>Estado Civil:</strong> ' . htmlspecialchars($cliente['estado_civil']) . '</p>
        <p><strong>Nacionalidade:</strong> ' . htmlspecialchars($cliente['nacionalidade']) . '</p>
        <p><strong>Profissão:</strong> ' . htmlspecialchars($cliente['profissao']) . '</p>
        <p><strong>CEP:</strong> ' . htmlspecialchars($cliente['cep']) . '</p>
        <p><strong>Rua:</strong> ' . htmlspecialchars($cliente['rua']) . '</p>
        <p><strong>Numero:</strong> ' . htmlspecialchars($cliente['numero']) . '</p>
        <p><strong>Bairro:</strong> ' . htmlspecialchars($cliente['bairro']) . '</p>
        <p><strong>Cidade:</strong> ' . htmlspecialchars($cliente['cidade']) . '</p>
        <p><strong>Estado:</strong> ' . htmlspecialchars($cliente['estado']) . '</p>
        <p><strong>País:</strong> ' . htmlspecialchars($cliente['pais']) . '</p>
        <p><strong>Locador:</strong> ' . htmlspecialchars($cliente['locador']) . '</p>
        <p><strong>Locatário:</strong> ' . htmlspecialchars($cliente['locatario']) . '</p>
        <p><strong>Fiador:</strong> ' . htmlspecialchars($cliente['fiador']) . '</p>
        <p><strong>Comprador:</strong> ' . htmlspecialchars($cliente['comprador']) . '</p>
        <p><strong>Complemento:</strong> ' . htmlspecialchars($cliente['complemento']) . '</p>
        <p><strong>CPF/CNPJ:</strong> ' . htmlspecialchars($cliente['cpf_cnpj']) . '</p>
    ';
} else {
    $html = '<h1>Cliente não encontrado!</h1>';
}

$dompdf->loadHtml($html);

$dompdf->setPaper('A4', 'portrait');

$dompdf->render();

$dompdf->stream('ficha_cadastral_cliente.pdf', array('Attachment' => 0)); // 1 baixa e 0 exibe
?>
