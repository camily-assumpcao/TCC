const btnGenerate = document.querySelector("#generate-pdf");

btnGenerate.addEventListener("click", () => {

  //conteudo do PDF
  const content = document.querySelector("#content")

  //Configurção do arquivo final de PDF
  const options = {
    margin: [10, 10, 10, 10],
    filename: "arquivo.pdf",
    html2canvas: {scale: 2},
    jsPDF: {unit: "mm", format: "a4", orientation: "portrait" }
  }

  //Gerar e baixar o pdf
  html2pdf().set(options).from(content).save();
});