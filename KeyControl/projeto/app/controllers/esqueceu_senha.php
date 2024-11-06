<?php
include 'db_conexao.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email = $_POST['email'];

    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE email = :email");
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch();

    if ($user) {
        $token = bin2hex(random_bytes(16));
        $expiry = date("Y-m-d H:i:s", strtotime("+1 hour"));

        $stmt = $pdo->prepare("UPDATE usuarios SET reset_token = :token, token_expiry = :expiry WHERE email = :email");
        $stmt->execute(['token' => $token, 'expiry' => $expiry, 'email' => $email]);

        $resetLink = "https://seusite.com/redefinir_senha.php?token=" . $token;
        $mensagem = "Clique no link para redefinir sua senha: $resetLink";
        mail($email, "Redefinição de Senha", $mensagem);

        echo "Um link de redefinição de senha foi enviado para o seu e-mail.";
    } else {
        echo "E-mail não encontrado.";
    }
}
?>
