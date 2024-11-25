function formatarData(input) {
    let value = input.value.replace(/\D/g, '');
    if (value.length <= 2) {
        value = value.replace(/(\d{2})(\d{0,2})/, '$1/$2');
    } else if (value.length <= 4) {
        value = value.replace(/(\d{2})(\d{2})(\d{0,2})/, '$1/$2/$3');
    } else {
        value = value.replace(/(\d{2})(\d{2})(\d{4})/, '$1/$2/$3');
    }
    input.value = value;
};

function formatarCEP(input) {
    let value = input.value.replace(/\D/g, ''); 
    if (value.length <= 5) {
        value = value.replace(/(\d{5})(\d{0,3})/, '$1-$2'); 
    } else {
        value = value.replace(/(\d{5})(\d{3})/, '$1-$2');
    }
    input.value = value;
};