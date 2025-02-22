const carrito = document.getElementById('carrito');
const elementos1 = document.getElementById('lista-1');
const lista = document.querySelector('#lista-carrito tbody');
const vaciarCarritoBtn = document.getElementById('vaciar-carrito');

cargarEventListeners();
function cargarEventListeners(){
    elementos1.addEventListener('click', comprarElemento);
    carrito.addEventListener('click', eliminarElemento);
    vaciarCarritoBtn.addEventListener('click', vaciarCarrito)
}

function comprarElemento(e){
    e.preventDefault();
    if(e.target.classList.contains('agregar-carrito')){
        const elemento = e.target.parentElement.parentElement;
        leerDatosElemento(elemento);
    }
}
function leerDatosElemento(elemento){
    const infoElemento = {
        imagen: elemento.querySelector('img').src,
        titulo: elemento.querySelector('h3').textContent,
        precio: elemento.querySelector('.precio').textContent,
        id: elemento.querySelector('a').getAttribute('data-id')
    }
    insertarCarrito(infoElemento);
}
function insertarCarrito(elemento){
    const row = document.createElement('tr');
    row.innerHTML = `
    <td><img src="${elemento.imagen}" width=100/></td>
    <td>${elemento.titulo}</td>
    <td>${elemento.precio}</td>
    <td><a href="#" class="borrar" data-id="${elemento.id}">x</a></td>
    `;
    lista.appendChild(row);
}
function eliminarElemento(e){
    e.preventDefault();
    let elemento,
        elementoId;
    if(e.target.classList.contains('borrar')){
        e.target.parentElement.parentElement.remove();
        elemento = e.target.parentElement.parentElement;
        elementoId = elemento.querySelector('a').getAttribute('data-id');
    }
}
function vaciarCarrito(){
    while(lista.firstChild){
        lista.removeChild(lista.firstChild);
    }
    return false;
} 
document.getElementById("closeSidebar").addEventListener("click", function() {
    document.getElementById("sidebar").style.display = "none";
});
document.addEventListener("DOMContentLoaded", function () {
    const productosBtn = document.getElementById("productos-btn");
    const dropdownMenu = document.querySelector(".dropdown-menu");

    productosBtn.addEventListener("click", function (event) {
        event.preventDefault(); // Evita que la página se recargue
        dropdownMenu.classList.toggle("show");
    });

    // Cierra el menú si se hace clic fuera de él
    document.addEventListener("click", function (event) {
        if (!productosBtn.contains(event.target) && !dropdownMenu.contains(event.target)) {
            dropdownMenu.classList.remove("show");
        }
    });
});

document.getElementById('closeSidebar').addEventListener('click', function() {
    document.getElementById('sidebar').classList.toggle('show');
});
const productos = [
    { nombre: "Vestido Rojo", categoria: "Mujeres", precio: 800 },
    { nombre: "Camisa Azul", categoria: "Hombres", precio: 600 },
    { nombre: "Zapatos Deportivos", categoria: "Niños", precio: 700 },
    { nombre: "Pantalón Negro", categoria: "Mujeres", precio: 900 }
];

function buscarProductos() {
    let input = document.getElementById("buscador").value.toLowerCase();
    let resultados = document.getElementById("resultados");
    resultados.innerHTML = "";

    let filtrados = productos.filter(p => p.nombre.toLowerCase().includes(input));

    filtrados.forEach(p => {
        let div = document.createElement("div");
        div.innerHTML = `<p>${p.nombre} - ${p.categoria} - $${p.precio}</p>`;
        resultados.appendChild(div);
    });

    if (filtrados.length === 0) {
        resultados.innerHTML = "<p>No se encontraron productos</p>";
    }
}
