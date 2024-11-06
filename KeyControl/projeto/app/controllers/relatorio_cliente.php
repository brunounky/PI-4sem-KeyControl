<?php
require('./KeyControl/projeto/');

// Inclua a conexão com o banco de dados
require('../controllers/db_conexao.php');

// Cria uma classe personalizada para o PDF
class PDF extends FPDF {
    // Cabeçalho do PDF
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Ficha Cadastral do Cliente', 0, 1, 'C');
        $this->Ln(10);
    }

    // Rodapé do PDF
    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }

    // Função para exibir dados do cliente
    function DadosCliente($data) {
        $this->SetFont('Arial', '', 12);
        foreach ($data as $label => $value) {
            $this->Cell(50, 10, $label . ':', 0, 0);
            $this->Cell(0, 10, utf8_decode($value), 0, 1);
        }
    }
}

// Consulta SQL para obter dados do cliente
$id_cliente = 1; // Defina o ID do cliente desejado
$sql = "SELECT * FROM cadastro_clientes WHERE id = $id_cliente";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = $result->fetch_assoc();

    // Cria uma nova instância de PDF
    $pdf = new PDF();
    $pdf->AddPage();

    // Define os dados para o PDF
    $dados_cliente = [
        'ID' => $data['id'],
        'Nome' => $data['nome'],
        'RG/IE' => $data['rg_ie'],
        'Data de Nascimento/Fundação' => $data['data_nascimento_fundacao'],
        'Telefone' => $data['telefone'],
        'Email' => $data['email'],
        'Estado Civil' => $data['estado_civil'],
        'Nacionalidade' => $data['nacionalidade'],
        'Profissão' => $data['profissao'],
        'CEP' => $data['cep'],
        'Rua' => $data['rua'],
        'Número' => $data['numero'],
        'Bairro' => $data['bairro'],
        'Cidade' => $data['cidade'],
        'Estado' => $data['estado'],
        'País' => $data['pais'],
        'Locador' => $data['locador'],
        'Locatário' => $data['locatario'],
        'Fiador' => $data['fiador'],
        'Comprador' => $data['comprador'],
        'Complemento' => $data['complemento'],
        'CPF/CNPJ' => $data['cpf_cnpj']
    ];

    // Adiciona os dados ao PDF
    $pdf->DadosCliente($dados_cliente);

    // Fecha a conexão
    $conn->close();

    // Gera o PDF e envia para o navegador
    $pdf->Output('D', 'ficha_cadastral_cliente.pdf'); // 'D' força o download
} else {
    echo "Nenhum cliente encontrado com o ID especificado.";
}
?>
