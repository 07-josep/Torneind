const content = document.getElementById("content");
//Functions
mostrarCosmeticos();
//Mostrado Cosmeticos
function mostrarCosmeticos() {
    var id = localStorage.getItem("id");
    fetch("https://fortnite-api.com/v2/cosmetics/br/" + id, {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "auth-token": "edb20975-a1faad4a-e0cefb82-0a2b52a9" // KEY DE DAVEIND YOUTUBE
        }
    })
        .then(response => response.json())
        .then(data => {
            //Foto
            var imagen = document.getElementById("imagen");
            imagen.setAttribute("src", data.data.images.icon)

            var imagen2 = document.getElementById("imagen2");
            imagen2.setAttribute("src", data.data.images.featured)

            var imagen3 = document.getElementById("imagen3");
            imagen3.setAttribute("src", data.data.images.smallIcon)

            //Nombre
            var nombre = document.getElementById("nombre");
            var textNombre = document.createTextNode(data.data.name);
            nombre.appendChild(textNombre);

            //Descr
            var descripcion = document.getElementById("descripcion");
            var textDescr = document.createTextNode(data.data.description);
            descripcion.appendChild(textDescr);

            //Rareza
            var rareza = document.getElementById("rareza");
            var textrareza = document.createTextNode(data.data.rarity.displayValue);
            rareza.appendChild(textrareza);

            //Added
            var added = document.getElementById("added");
            var textadded = document.createTextNode(data.data.added);
            added.appendChild(textadded);

            //text
            var text = document.getElementById("text");
            var texttext = document.createTextNode(data.data.introduction.text);
            text.appendChild(texttext);

            //set
            var set = document.getElementById("set");
            var textset = document.createTextNode(data.data.set.value);
            set.appendChild(textset);


        })
        .catch((TorneindFatalError) => {
            console.log("Error de torneind => ", TorneindFatalError);
        })
}