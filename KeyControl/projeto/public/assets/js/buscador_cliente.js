document.getElementById('comprador_cpf_cnpj').addEventListener('blur', function() {
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
                document.getElementById('comprador_nome').value = data.nome || '';
                document.getElementById('comprador_data_nascimento').value = data.data_nascimento || '';
                document.getElementById('comprador_nacionalidade').value = data.nacionalidade || '';
                document.getElementById('comprador_cep').value = data.cep || '';
                document.getElementById('comprador_bairro').value = data.bairro || '';
                document.getElementById('comprador_estado').value = data.estado || '';
                document.getElementById('comprador_telefone').value = data.telefone || '';
                document.getElementById('comprador_estado_civil').value = data.estado_civil || '';
                document.getElementById('comprador_rua').value = data.rua || '';
                document.getElementById('comprador_complemento').value = data.complemento || '';
                document.getElementById('comprador_pais').value = data.pais || '';
                document.getElementById('comprador_rg_ie').value = data.rg_ie || '';
                document.getElementById('comprador_email').value = data.email || '';
                document.getElementById('comprador_profissao').value = data.profissao || '';
                document.getElementById('comprador_numero').value = data.numero || '';
                document.getElementById('comprador_cidade').value = data.cidade || '';
            }
        })
        .catch(error => {
            console.error('Erro ao buscar dados:', error);
            alert('Erro ao buscar os dados do cliente. Tente novamente.');
        });
    }
});
