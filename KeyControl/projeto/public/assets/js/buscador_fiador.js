document.getElementById('fiador_cpf_cnpj').addEventListener('blur', function() {
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
                document.getElementById('fiador_nome').value = data.nome || '';
                document.getElementById('fiador_data_nascimento').value = data.data_nascimento_fundacao || '';
                document.getElementById('fiador_nacionalidade').value = data.nacionalidade || '';
                document.getElementById('fiador_cep').value = data.cep || '';
                document.getElementById('fiador_bairro').value = data.bairro || '';
                document.getElementById('fiador_estado').value = data.estado || '';
                document.getElementById('fiador_telefone').value = data.telefone || '';
                document.getElementById('fiador_estado_civil').value = data.estado_civil || '';
                document.getElementById('fiador_rua').value = data.rua || '';
                document.getElementById('fiador_complemento').value = data.complemento || '';
                document.getElementById('fiador_pais').value = data.pais || '';
                document.getElementById('fiador_rg_ie').value = data.rg_ie || '';
                document.getElementById('fiador_email').value = data.email || '';
                document.getElementById('fiador_profissao').value = data.profissao || '';
                document.getElementById('fiador_numero').value = data.numero || '';
                document.getElementById('fiador_cidade').value = data.cidade || '';
            }
        })
        .catch(error => {
            console.error('Erro ao buscar dados:', error);
            alert('Erro ao buscar os dados do cliente. Tente novamente.');
        });
    }
});
