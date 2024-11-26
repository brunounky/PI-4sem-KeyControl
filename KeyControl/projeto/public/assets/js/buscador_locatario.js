document.getElementById('locatario_cpf_cnpj').addEventListener('blur', function() {
    const cpfCnpj = this.value.trim();

    if (cpfCnpj) {
        fetch('../app/controllers/busca_clientes.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `cpf_cnpj=${encodeURIComponent(cpfCnpj)}`,
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if (data.error) {
                alert(data.error);
            } else {
                document.getElementById('locatario_nome').value = data.nome || '';
                document.getElementById('locatario_data_nascimento').value = data.data_nascimento_fundacao || '';
                document.getElementById('locatario_nacionalidade').value = data.nacionalidade || '';
                document.getElementById('locatario_cep').value = data.cep || '';
                document.getElementById('locatario_bairro').value = data.bairro || '';
                document.getElementById('locatario_estado').value = data.estado || '';
                document.getElementById('locatario_telefone').value = data.telefone || '';
                document.getElementById('locatario_estado_civil').value = data.estado_civil || '';
                document.getElementById('locatario_rua').value = data.rua || '';
                document.getElementById('locatario_complemento').value = data.complemento || '';
                document.getElementById('locatario_pais').value = data.pais || '';
                document.getElementById('locatario_rg_ie').value = data.rg_ie || '';
                document.getElementById('locatario_email').value = data.email || '';
                document.getElementById('locatario_profissao').value = data.profissao || '';
                document.getElementById('locatario_numero').value = data.numero || '';
                document.getElementById('locatario_cidade').value = data.cidade || '';
            }
        })
        .catch(error => {
            console.error('Erro ao buscar dados:', error);
            alert('Erro ao buscar os dados do cliente. Tente novamente.');
        });
    }
});
