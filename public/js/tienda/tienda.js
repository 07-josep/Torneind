window.onload = main;

function main(){

    apunte();
    diarios();
    destacados();
    especiales();
}

function apunte() {
    fetch('https://fortnite-api.com/v2/shop/br')
        .then(response => response.json())
        .then(data =>  {

            console.log(data)

        });
};


function diarios() {


    fetch('https://fortnite-api.com/v2/shop/br')
        .then(response => response.json())
        .then(data => data.data.daily.entries.forEach(element => {

            var divPrincipal = document.getElementById("diarios-content");

            //Carta principal aqui todo
            var divCard = document.createElement("div");
            divCard.setAttribute("class", "card-tienda " + element.items[0].rarity.value);
            divCard.setAttribute("onclick", "comprar('" + element.items[0].name + "' , '" + element.regularPrice + "')");


            //Div con imagen y divInfo
            var divImagen = document.createElement("div");
            divImagen.setAttribute("class", "img-tienda");

            var imagenValue = element.items[0].images.featured;

            if(imagenValue === null){
                imagenValue = element.items[0].images.icon;
            }

            //imagen
            var imagen = document.createElement("img");
            imagen.setAttribute("src", imagenValue);

            //Div con titulo y descripcion del elemento
            var divInfo = document.createElement("div");
            divInfo.setAttribute("class", "card-tienda-info");

            //Titulo del elemento
            var h4Titulo = document.createElement("h4");
            h4Titulo.setAttribute("class", "card-tienda-name");

            var spanTitulo = document.createElement("span");

            var txtTitulo = document.createTextNode(element.items[0].name);

            //Descripcion del elemento
            var pDescripcion = document.createElement("p");
            pDescripcion.setAttribute("class", "card-tienda-type");

            var spanDescripcion = document.createElement("span");

            var txtDescripcion = document.createTextNode(element.items[0].description);

            //p con la imagen y el texto del precio
            var pPrecio = document.createElement("p");
            pPrecio.setAttribute("class", "card-tienda-price");

            var imgPrecio = document.createElement("img");
            imgPrecio.setAttribute("src", "https://image.fnbr.co/price/icon_vbucks.png");

            var spanPrecio = document.createElement("span");

            var txtPrecio = document.createTextNode(element.regularPrice);



            divPrincipal.appendChild(divCard);
            divCard.appendChild(divImagen);
            divImagen.appendChild(imagen);
            divImagen.appendChild(divInfo);
            divInfo.appendChild(h4Titulo);
            h4Titulo.appendChild(spanTitulo);
            spanTitulo.appendChild(txtTitulo);
            divInfo.appendChild(pDescripcion);
            pDescripcion.appendChild(spanDescripcion);
            spanDescripcion.appendChild(txtDescripcion);
            divCard.appendChild(pPrecio);
            pPrecio.appendChild(imgPrecio);
            pPrecio.appendChild(spanPrecio);
            spanPrecio.appendChild(txtPrecio);

        }));
}

function destacados() {


    fetch('https://fortnite-api.com/v2/shop/br')
        .then(response => response.json())
        .then(data => data.data.featured.entries.forEach(element => {

            var divPrincipal = document.getElementById("destacados-content");

            //Carta principal aqui todo
            var divCard = document.createElement("div");
            divCard.setAttribute("class", "card-tienda " + element.items[0].rarity.value);
            divCard.setAttribute("onclick", "comprar('" + element.items[0].name + "' , '" + element.regularPrice + "')");


            //Div con imagen y divInfo
            var divImagen = document.createElement("div");
            divImagen.setAttribute("class", "img-tienda");

            var imagenValue = element.items[0].images.featured;

            if(imagenValue === null){
                imagenValue = element.items[0].images.icon;
            }

            //imagen
            var imagen = document.createElement("img");
            imagen.setAttribute("src", imagenValue);

            //Div con titulo y descripcion del elemento
            var divInfo = document.createElement("div");
            divInfo.setAttribute("class", "card-tienda-info");

            //Titulo del elemento
            var h4Titulo = document.createElement("h4");
            h4Titulo.setAttribute("class", "card-tienda-name");

            var spanTitulo = document.createElement("span");

            var txtTitulo = document.createTextNode(element.items[0].name);

            //Descripcion del elemento
            var pDescripcion = document.createElement("p");
            pDescripcion.setAttribute("class", "card-tienda-type");

            var spanDescripcion = document.createElement("span");

            var txtDescripcion = document.createTextNode(element.items[0].description);

            //p con la imagen y el texto del precio
            var pPrecio = document.createElement("p");
            pPrecio.setAttribute("class", "card-tienda-price");

            var imgPrecio = document.createElement("img");
            imgPrecio.setAttribute("src", "https://image.fnbr.co/price/icon_vbucks.png");

            var spanPrecio = document.createElement("span");

            var txtPrecio = document.createTextNode(element.regularPrice);



            divPrincipal.appendChild(divCard);
            divCard.appendChild(divImagen);
            divImagen.appendChild(imagen);
            divImagen.appendChild(divInfo);
            divInfo.appendChild(h4Titulo);
            h4Titulo.appendChild(spanTitulo);
            spanTitulo.appendChild(txtTitulo);
            divInfo.appendChild(pDescripcion);
            pDescripcion.appendChild(spanDescripcion);
            spanDescripcion.appendChild(txtDescripcion);
            divCard.appendChild(pPrecio);
            pPrecio.appendChild(imgPrecio);
            pPrecio.appendChild(spanPrecio);
            spanPrecio.appendChild(txtPrecio);

        }));
}
function especiales() {


    fetch('https://fortnite-api.com/v2/shop/br')
        .then(response => response.json())
        .then(data => data.data.specialFeatured.entries.forEach(element => {


            var divPrincipal = document.getElementById("especiales-content");

            //Carta principal aqui todo
            var divCard = document.createElement("div");
            divCard.setAttribute("class", "card-tienda " + element.items[0].rarity.value);
            divCard.setAttribute("onclick", "comprar('" + element.items[0].name + "' , '" + element.regularPrice + "')");


            //Div con imagen y divInfo
            var divImagen = document.createElement("div");
            divImagen.setAttribute("class", "img-tienda");

            var imagenValue = element.items[0].images.featured;

            if(imagenValue === null){
                imagenValue = element.items[0].images.icon;
            }

            //imagen
            var imagen = document.createElement("img");
            imagen.setAttribute("src", imagenValue);

            //Div con titulo y descripcion del elemento
            var divInfo = document.createElement("div");
            divInfo.setAttribute("class", "card-tienda-info");

            //Titulo del elemento
            var h4Titulo = document.createElement("h4");
            h4Titulo.setAttribute("class", "card-tienda-name");

            var spanTitulo = document.createElement("span");

            var txtTitulo = document.createTextNode(element.items[0].name);

            //Descripcion del elemento
            var pDescripcion = document.createElement("p");
            pDescripcion.setAttribute("class", "card-tienda-type");

            var spanDescripcion = document.createElement("span");

            var txtDescripcion = document.createTextNode(element.items[0].description);

            //p con la imagen y el texto del precio
            var pPrecio = document.createElement("p");
            pPrecio.setAttribute("class", "card-tienda-price");

            var imgPrecio = document.createElement("img");
            imgPrecio.setAttribute("src", "https://image.fnbr.co/price/icon_vbucks.png");

            var spanPrecio = document.createElement("span");

            var txtPrecio = document.createTextNode(element.regularPrice);



            divPrincipal.appendChild(divCard);
            divCard.appendChild(divImagen);
            divImagen.appendChild(imagen);
            divImagen.appendChild(divInfo);
            divInfo.appendChild(h4Titulo);
            h4Titulo.appendChild(spanTitulo);
            spanTitulo.appendChild(txtTitulo);
            divInfo.appendChild(pDescripcion);
            pDescripcion.appendChild(spanDescripcion);
            spanDescripcion.appendChild(txtDescripcion);
            divCard.appendChild(pPrecio);
            pPrecio.appendChild(imgPrecio);
            pPrecio.appendChild(spanPrecio);
            spanPrecio.appendChild(txtPrecio);

        }));
}


function comprar(nombre, precio){
    localStorage.setItem('nombre', nombre);
    localStorage.setItem('precio', precio);
    window.location.href = "objeto";
}