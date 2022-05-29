window.onload = main;
//Functions

let arrPoke = [];

function main() {
    console.log("Conttol Scrool", document.body.scrollHeight - window.innerHeight, window.scrollY)
    // cridar al api
    fetch('https://fortnite-api.com/v2/cosmetics/br')
        .then(response => response.json())
        .then(data => {
            //console.log ( data.results);
            arrPoke = data;
            //console.log(arrPoke);
            cargarLista();
        });
    window.addEventListener('scroll', onScroll)
}


var contador = 0;

function cargarLista() {
    contador += 30;
    // recorrer Array

    console.log("CARGAR LISTA: OK");
    for (let i = 0; i < contador; i++) {
        cargarPagina(arrPoke.data[i + contador], i + contador);
    };

}
const onScroll = () => {
    console.log("document.body.scrollHeight: " + document.body.scrollHeight);
    console.log("window.innerHeight: " + window.innerHeight);
    console.log("document.body.scrollHeight - window.innerHeight : " + (document.body.scrollHeight - window.innerHeight));
    console.log("window.scrollY: " + window.scrollY);
    if (document.body.scrollHeight - window.innerHeight === window.scrollY) {
        cargarLista();
    }
}


function cargarPagina(element, ind) {

    fetch("https://fortnite-api.com/v2/cosmetics/br/" + element.id, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "auth-token": "edb20975-a1faad4a-e0cefb82-0a2b52a9" // KEY DE DAVEIND YOUTUBE
        }
    })
        .then(response => response.json())
        .then(data => {

            //elemento padre
            var divPadre = document.getElementById("content");

            //DIV cosmetico col
            var divCosmetico = document.createElement("div");
            divCosmetico.setAttribute("class", "col-2 cuadro text-center");

            //DIV card total del cosmetico
            var cardCosmetico = document.createElement("div");
            cardCosmetico.setAttribute("class", "card");
            cardCosmetico.setAttribute("onclick", "abrirCosmetico('" + data.data.id + "')");

            //DIV con la foto
            var divFoto = document.createElement("div");
            divFoto.setAttribute("class", "div-foto " + data.data.rarity.value);


            //IMG dentro divFoto
            var imagen = document.createElement("img");
            imagen.setAttribute("src", data.data.images.icon);

            //DIV con texto de nombre dentro de la foto
            var cardInfo = document.createElement("div");
            cardInfo.setAttribute("class", "card-info");

            //H4 con el nombre del cosmetico
            var nombreAnimadoH4 = document.createElement("h4");
            nombreAnimadoH4.setAttribute("class", "nombre animado");

            //SPAN dentro del h4
            var nombreSpan = document.createElement("span");

            //text con el nombre
            var text1 = document.createTextNode(data.data.name);

            //P con el text de descripcion
            var pQuees = document.createElement("p");
            pQuees.setAttribute("class", "que-es");

            //SPAN donde va el texto de descripcion
            var spanQuees = document.createElement("span");

            //texto de descripcion
            var text2 = document.createTextNode(data.data.type.displayValue);

            nombreSpan.appendChild(text1);
            nombreAnimadoH4.appendChild(nombreSpan);
            cardInfo.appendChild(nombreAnimadoH4);
            divFoto.appendChild(imagen);
            divFoto.appendChild(nombreAnimadoH4);
            cardCosmetico.appendChild(divFoto);
            spanQuees.appendChild(text2);
            pQuees.appendChild(spanQuees);
            cardCosmetico.appendChild(pQuees);
            divCosmetico.appendChild(cardCosmetico);
            divPadre.appendChild(divCosmetico);
        });
};

function abrirCosmetico(id) {
    localStorage.setItem("id", id);
    window.location.href = "cosmetico.html";
}


//Mostrado Cosmeticos
function mostrarCosmeticos() {

    fetch("https://fortnite-api.com/v2/cosmetics/br", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "auth-token": "edb20975-a1faad4a-e0cefb82-0a2b52a9" // KEY DE DAVEIND YOUTUBE
        }
    })
        .then(response => response.json())
        .then(data => data.data.forEach(element => {

            console.log(element);
            //elemento padre
            var divPadre = document.getElementById("content");

            //DIV cosmetico col
            var divCosmetico = document.createElement("div");
            divCosmetico.setAttribute("class", "col-2 cuadro text-center");

            //DIV card total del cosmetico
            var cardCosmetico = document.createElement("div");
            cardCosmetico.setAttribute("class", "card");
            cardCosmetico.setAttribute("onclick", "abrirCosmetico('" + element.id + "')");

            //DIV con la foto
            var divFoto = document.createElement("div");
            divFoto.setAttribute("class", "div-foto " + element.rarity.value);


            //IMG dentro divFoto
            var imagen = document.createElement("img");
            imagen.setAttribute("src", element.images.icon);

            //DIV con texto de nombre dentro de la foto
            var cardInfo = document.createElement("div");
            cardInfo.setAttribute("class", "card-info");

            //H4 con el nombre del cosmetico
            var nombreAnimadoH4 = document.createElement("h4");
            nombreAnimadoH4.setAttribute("class", "nombre animado");

            //SPAN dentro del h4
            var nombreSpan = document.createElement("span");

            //text con el nombre
            var text1 = document.createTextNode(element.name);

            //P con el text de descripcion
            var pQuees = document.createElement("p");
            pQuees.setAttribute("class", "que-es");

            //SPAN donde va el texto de descripcion
            var spanQuees = document.createElement("span");

            //texto de descripcion
            var text2 = document.createTextNode(element.type.displayValue);

            nombreSpan.appendChild(text1);
            nombreAnimadoH4.appendChild(nombreSpan);
            cardInfo.appendChild(nombreAnimadoH4);
            divFoto.appendChild(imagen);
            divFoto.appendChild(nombreAnimadoH4);
            cardCosmetico.appendChild(divFoto);
            spanQuees.appendChild(text2);
            pQuees.appendChild(spanQuees);
            cardCosmetico.appendChild(pQuees);
            divCosmetico.appendChild(cardCosmetico);
            divPadre.appendChild(divCosmetico);

        }))
        .catch((TorneindFatalError) => {
            console.log("Error de torneind => ", TorneindFatalError);
        })
}