document.addEventListener("DOMContentLoaded", function () {
    const params = new URLSearchParams(window.location.search);
    if (params.has("erro")) {
        let mensagem = "";
        switch (params.get("erro")) {
            case "confirmacao":
                mensagem = "A nova senha e a confirmação não coincidem.";
                break;
            case "senha_incorreta":
                mensagem = "A senha atual está incorreta.";
                break;
            case "bd":
                mensagem = "Erro ao alterar a senha. Tente novamente.";
                break;
        }
        if (mensagem) {
            mostrarModal(mensagem);
        }
    } else if (params.has("sucesso")) {
        if (params.get("sucesso") === "senha_alterada") {
            mostrarModal("Senha alterada com sucesso!");
        }
    }
});

function mostrarModal(mensagem) {
    const modal = document.getElementById("modal");
    const modalMessage = document.getElementById("modal-message");
    modalMessage.textContent = mensagem;
    modal.style.display = "flex"; // Exibe o modal
}

function fecharModal() {
    const modal = document.getElementById("modal");
    modal.style.display = "none"; // Oculta o modal
}