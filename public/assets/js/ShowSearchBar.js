const containerSearch = document.querySelector("#containerSearch");

console.log(containerSearch);
document.querySelector("#bBuscar").addEventListener("click", function () {
  containerSearch.classList.toggle("d-none");
});
