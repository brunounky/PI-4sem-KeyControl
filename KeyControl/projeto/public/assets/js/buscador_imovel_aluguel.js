document.getElementById("imovel_registro").addEventListener("blur", function() {
    const registroImovel = this.value.trim();

    if (registroImovel) {
        fetch("../app/controllers/busca_imovel.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `imovel_registro=${encodeURIComponent(registroImovel)}`
        })
        .then(response => response.json())
        .then(data => {
            console.log(data);

            if (data.error) {
                alert(data.error);
            } else {
                document.getElementById("imovel_proprietario_cpf_cnpj").value = data.cpf_cnpj || '';
                document.getElementById("imovel_tipo").value = data.tipo_imovel || '';
                document.getElementById("imovel_numero").value = data.numero || '';
                document.getElementById("imovel_cidade").value = data.cidade || '';
                document.getElementById("imovel_taxa_venda").value = data.taxa_aluguel || '';
                document.getElementById("imovel_cep").value = data.cep || '';
                document.getElementById("imovel_bairro").value = data.bairro || '';
                document.getElementById("imovel_estado").value = data.estado || '';
                document.getElementById("imovel_valor").value = data.valor_aluguel || '';
                document.getElementById("imovel_registro").value = data.registro_imovel || '';
                document.getElementById("imovel_rua").value = data.rua || '';
                document.getElementById("imovel_complemento").value = data.complemento || '';
                document.getElementById("imovel_pais").value = data.pais || '';
            }
        })
        .catch(error => {
            console.error("Erro ao buscar dados do imóvel:", error);
            alert("Erro ao buscar os dados do imóvel. Tente novamente.");
        });
    }
});
