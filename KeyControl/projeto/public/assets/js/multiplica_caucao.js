document.addEventListener("DOMContentLoaded", function () {
    const mesesCaucaoInput = document.getElementById("meses_caucao");
    const imovelValorInput = document.getElementById("imovel_valor");
    const totalCaucaoInput = document.getElementById("total_caucao");
  
    function calcularTotalCaucao() {
      const mesesCaucao = parseFloat(mesesCaucaoInput.value) || 0;
      const imovelValor = parseFloat(imovelValorInput.value) || 0;
      totalCaucaoInput.value = (mesesCaucao * imovelValor).toFixed(2); // Calcula e define o valor com 2 casas decimais
    }
  
    // Adiciona eventos de escuta nos campos de entrada
    mesesCaucaoInput.addEventListener("input", calcularTotalCaucao);
    imovelValorInput.addEventListener("input", calcularTotalCaucao);
  });