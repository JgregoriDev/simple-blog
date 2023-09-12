const fileInput = document.getElementById("fileToUpload");
const formPost = document.getElementById("formPost");
console.log(formPost);
const filePreview = document.getElementById("preview");
const errorsPreview = document.getElementById("preview");
const errorInputs = [];
fileInput.addEventListener("change", function () {
  const selectedFiles = fileInput.files;

  if (selectedFiles.length > 0) {
    // Se ha seleccionado un archivo
    console.log("Archivo seleccionado:", selectedFiles[0].name);
    const fullPath = fileInput.value;
    filePreview.setAttribute(
      "src",
      window.URL.createObjectURL(selectedFiles[0])
    );
    // Aquí puedes realizar la validación adicional que necesites
  }
});
const textarea = document.getElementById("contenido");

textarea.addEventListener("blur", function () {
  const value = textarea.value;

  if (value.trim() !== "") {
    // El textarea tiene contenido
    console.log("Texto ingresado:", value);
    // Aquí puedes realizar la validación adicional que necesites
  } else {
    // El textarea está vacío
    errorInputs.push("El campo no puede estar vacío");
    // Puedes mostrar un mensaje de error o realizar alguna acción
  }
});
const select = document.getElementById("selectId");

select.addEventListener("change", function () {
  const selectedOptions = Array.from(select.selectedOptions).map(
    (option) => option.value
  );

  if (selectedOptions.length > 0) {
    // Se han seleccionado una o más opciones
    console.log("Opciones seleccionadas:", selectedOptions);
    // Aquí puedes realizar la validación adicional que necesites
  } else {
    // No se ha seleccionado ninguna opción
    console.log("No se ha seleccionado ninguna opción");
    // Puedes mostrar un mensaje de error o realizar alguna acción
  }
});
console.log(formPost);
formPost.addEventListener("submit", (e) => {
  e.preventDefault();
  if (validarArchivo() && validarTextArea()) {
    mostrarErrores();
  }

  if (errorInputs.length === 0) {
    submit();
  }
});
function validarArchivo() {
  if (selectedOptions.length < 0) {
    // Se han seleccionado una o más opciones
    errorInputs.push("El campo de archivo no puede estar vacío");
    return false;
    // Aquí puedes realizar la validación adicional que necesites
  }
  return true;
}
function validarTextArea() {
  if (textarea.length === 0) {
    errorInputs.push("El campo de texto no puede estar vacio");
    return false;
  }
  if (textarea.length > 200) {
    errorInputs.push("El campo de texto no puede tener mas de 200 caracteres");
    return false;
  }
  return true;
}

function mostrarErrores() {
  const erroresCadena = ``;
  const listErrors = document.createElement("ul");
  errorInputs.forEach((error) => {
    erroresCadena += `<li class="text-danger">${error}</li>`;
  });
  listErrors.innerHTML = erroresCadena;
  errorsPreview.appendChild(listErrors);
}
