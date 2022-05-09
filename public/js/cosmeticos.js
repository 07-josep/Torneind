const content = document.getElementById("content");
//Functions
mostrarTienda();


//Mostrado cosmeticos
function mostrarTienda() {
    fetch("https://fortnite-api.com/v2/shop/br", {
        method: "GET",
        headers: {
            "Content-Type": "application/json",
            "auth-token": "edb20975-a1faad4a-e0cefb82-0a2b52a9" // KEY DE DAVEIND YOUTUBE
        }
    })
        .then(response => response.json())
        .then(data => data.data.daily.entries.forEach(element => {
            console.log(element);



        }));
}