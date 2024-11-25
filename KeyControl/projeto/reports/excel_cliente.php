<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ../app/controllers/verifica_login.php");
    exit();
}
require '../../vendor/autoload.php';  

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class ExportarRelatorio
{
    public function exportar()
    {
        // Conectar ao banco de dados (exemplo)
        $conn = new PDO("mysql:host=localhost;dbname=seu_banco", "usuario", "senha");

        // Consulta SQL
        $sql = "SELECT id, nome, cpf_cnpj, telefone, bairro, cidade, 
                IF(locador = 1, 'Locador', '') AS locador,
                IF(locatario = 1, 'Locatário', '') AS locatario,
                IF(fiador = 1, 'Fiador', '') AS fiador,
                IF(comprador = 1, 'Comprador', '') AS comprador
                FROM cadastro_cliente";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Definindo os dados do Excel
        $dados = [
            ['ID', 'Pessoa', 'CPF/CNPJ', 'E-mail', 'Bairro', 'Cidade', 'Categoria'],
        ];

        if ($result && count($result) > 0) {
            foreach ($result as $row) {
                $categorias = [];
                if ($row['locador']) {
                    $categorias[] = 'Locador';
                }
                if ($row['locatario']) {
                    $categorias[] = 'Locatário';
                }
                if ($row['fiador']) {
                    $categorias[] = 'Fiador';
                }
                if ($row['comprador']) {
                    $categorias[] = 'Comprador';
                }
                $categoriaTexto = implode(', ', $categorias);

                $dados[] = [
                    $row['id'],
                    $row['nome'],
                    $row['cpf_cnpj'],
                    $row['telefone'], 
                    $row['bairro'],
                    $row['cidade'],
                    $categoriaTexto
                ];
            }
        }

        // Criar uma nova planilha
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Preencher a planilha com os dados
        foreach ($dados as $linhaIndex => $linha) {
            foreach ($linha as $colunaIndex => $valor) {
                $sheet->setCellValueByColumnAndRow($colunaIndex + 1, $linhaIndex + 1, $valor);
            }
        }

        // Criar o escritor Xlsx
        $writer = new Xlsx($spreadsheet);

        // Definir o nome do arquivo e o tipo de conteúdo para o download
        $arquivoNome = 'relatorio_clientes.xlsx';
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="' . $arquivoNome . '"');

        $writer->save('php://output');
        exit();
    }
}

// Verificar se o formulário foi enviado para exportação
if (isset($_POST['exportar']) && $_POST['exportar'] == '1') {
    $exportarRelatorio = new ExportarRelatorio();
    $exportarRelatorio->exportar();
}
?>
