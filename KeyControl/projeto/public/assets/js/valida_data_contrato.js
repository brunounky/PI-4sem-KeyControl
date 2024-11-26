document.addEventListener("DOMContentLoaded", function () {
  const dataEmissaoInput = document.getElementById("data_emissao");
  const dataVencimentoInput = document.getElementById("data_vencimento");

  function validarDatas() {
    const dataEmissao = new Date(dataEmissaoInput.value);
    const dataVencimento = new Date(dataVencimentoInput.value);

    if (dataVencimento < dataEmissao) {
      alert("A data de pagamento não pode ser menor que a data de emissão.");
      dataVencimentoInput.value = "";
    }
  }

  dataVencimentoInput.addEventListener("change", validarDatas);

  dataEmissaoInput.addEventListener("change", function () {
    const dataEmissao = dataEmissaoInput.value;
    dataVencimentoInput.min = dataEmissao;
  });
});