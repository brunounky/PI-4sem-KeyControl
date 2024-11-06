<?php
include 'db_conexao.php';

if (isset($_GET['token'])) {
    $token = $_GET['token'];

    // Verifica se o token é válido e não expirou
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE reset_token = :token AND token_expiry > NOW()");
    $stmt->execute(['token' => $token]);
    $user = $stmt->fetch();

    if ($user) {
        // Exibe o formulário de redefinição de senha
        echo '<form action="redefinir_senha.php" method="POST">
                <input type="hidden" name="token" value="' . htmlspecialchars($token) . '">
                <label for="nova_senha">Nova senha:</label>
                <input type="password" name="nova_senha" id="nova_senha" required>
                <button type="submit">Redefinir senha</button>
              </form>';
    } else {
        echo "Token inválido ou expirado.";
    }
}
?>
