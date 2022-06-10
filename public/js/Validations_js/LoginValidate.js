window.onload = iniciar;

function iniciar() {
    document.getElementById("enviar").addEventListener('click', validar)
}

//Validar Usuario--------------------------------------------------------------------------------------------------------
function validarUser() {
    var element = document.getElementById("username ")
        if (element.value === "") {
            error2(element, "Debes introducir un nombre")
            return false
        }
        return true
}

//Validar Contraseña--------------------------------------------------------------------------------------------------------
function validarContra() {
    var element = document.getElementById("password")
    if (element.value === "") {
        error2(element, "Debes introducir la contraseña")
        return false
    }
    return true
}


function validar(e) {
    e.preventDefault();
    esborrarError();
    if (validarUser() && validarContra()) {
        return true;
    } else {
        e.preventDefault();
        return false;
    }
}

function error2(element, missatge) {
    document.getElementById("missatgeError").innerHTML = missatge;
    element.className = "error";
    element.focus();
}

function esborrarError() {
    var formulari = document.forms[0];
    for (var i = 0; i < formulari.elements.length - 1; i++) {
        formulari.elements[i].className = "form-control";
    }
}