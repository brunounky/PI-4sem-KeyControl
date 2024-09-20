function mascaraCNPJ(cnpj) {
    let v = cnpj.value.replace(/\D/g, ''); 
    if (v.length > 14) v = v.slice(0, 14); 
    if (v.length >= 3) v = v.replace(/^(\d{2})(\d)/, "$1.$2");
    if (v.length >= 6) v = v.replace(/^(\d{2})\.(\d{3})(\d)/, "$1.$2.$3");
    if (v.length >= 9) v = v.replace(/\.(\d{3})(\d)/, ".$1/$2");
    if (v.length >= 13) v = v.replace(/(\d{4})(\d)/, "$1-$2");
    cnpj.value = v;
}


function removerMascara(cnpj) {
    return cnpj.replace(/[^\d]/g, '');
}

function verificarCNPJ() {
    let cnpjCampo = document.getElementById('cnpj');
    let cnpjSemMascara = removerMascara(cnpjCampo.value); 


    if (cnpjSemMascara.length !== 14 || !validaCNPJ(cnpjSemMascara)) {
        alert("CNPJ inválido.");
        return false;
    }


    cnpjCampo.value = cnpjSemMascara;
    return true; 
}

function validaCNPJ(cnpj) {
    if (cnpj.length !== 14) return false;

    let tamanho = cnpj.length - 2;
    let numeros = cnpj.substring(0, tamanho);
    let digitos = cnpj.substring(tamanho);
    let soma = 0;
    let pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }
    let resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);
    if (resultado != digitos.charAt(0)) return false;

    tamanho = tamanho + 1;
    numeros = cnpj.substring(0, tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (let i = tamanho; i >= 1; i--) {
        soma += numeros.charAt(tamanho - i) * pos--;
        if (pos < 2) pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - (soma % 11);
    if (resultado != digitos.charAt(1)) return false;

    return true;
}
