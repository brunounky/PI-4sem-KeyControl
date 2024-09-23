document.addEventListener('DOMContentLoaded', function() {
    var paisInput = document.getElementById('pais');
    if (!paisInput.value) {
        paisInput.value = 'Brasil';
    }

    function consultaCEP() {
        const cep = document.getElementById('cep').value.replace(/\D/g, '');
        if (cep.length === 8) {
            fetch(`https://viacep.com.br/ws/${cep}/json/`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('CEP não encontrado');
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.erro) {
                        alert('CEP não encontrado');
                    } else {
                        document.getElementById('rua').value = data.logradouro || '';
                        document.getElementById('bairro').value = data.bairro || '';
                        document.getElementById('cidade').value = data.localidade || '';
                        document.getElementById('estado').value = data.uf || '';
                    }
                })
                .catch(error => {
                    console.error('Erro ao buscar CEP:', error);
                    alert('Erro ao buscar o CEP. Verifique se o CEP está correto.');
                });
        } else {
            alert('CEP inválido. Inclua 8 dígitos.');
        }
    }

    document.getElementById('cep').addEventListener('blur', consultaCEP);
});
