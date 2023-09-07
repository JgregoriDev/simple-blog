const contenido = document.getElementById("contenido");
const resultado = document.getElementById("resultado");
contenido.addEventListener("change", (evt) => {
  iframeDocument =
    resultado.contentDocument || resultado.contentWindow.document;
  iframeDocument.body.innerHTML = `<div>${evt.target.value}</div>`;
  console.log(evt.target.value);
});
contenido.addEventListener("selectionchange", (evt) => {
  console.log(Window.getSelection());
});
console.log(window.getSelection());
