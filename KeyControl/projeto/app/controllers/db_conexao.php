<?php
// conexao com o banco
$host = 'localhost';
$dbname = 'keycontroldb';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   // echo "Conexão estabelecida com sucesso!"; 

} catch (PDOException $e) {
    die("Erro de conexão: " . $e->getMessage());
}
?>
