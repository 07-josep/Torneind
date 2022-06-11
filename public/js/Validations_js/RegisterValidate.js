window.onload = iniciar;

function iniciar() {
    document.getElementById("enviar").addEventListener('click', validar)
}

//Validar Nombre--------------------------------------------------------------------------------------------------------
function validarNombre() {
    debugger;
    var patternNombre = new RegExp(/^([a-zA-Z ])+$/);
    var element = document.getElementById("user_nombre")
    if (patternNombre.test(element.value)) {
        return true
    } else {
        if (element.value === "") {
            error2(element, "Debes introducir un nombre")
        }
        return false
    }
}

//Validar Correo--------------------------------------------------------------------------------------------------------
function validarCorreo() {
    var patternEmail = new RegExp(/^[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{2,4}$/);
    var element = document.getElementById("user_correo")
    if (patternEmail.test(element.value)) {
        return true
    } else {
        if (element.value === "") {
            error2(element, "Debes introducir un correo")
        }
        return false
    }
}

//Validar Contraseña----------------------------------------------------------------------------------------------------
function validarContrasena() {
    var patternPass1 = new RegExp(/^[A-Za-z0-9]{8,18}$/);
    var element = document.getElementById("user_contrasenya_first");
    if (patternPass1.test(element.value)) {
        return true;
    } else {
        if (element.value === '') {
            error2(element, "Error: Debes introducir una contraseña.");
        } else {
            error2(element, "Error: La contraseña introducida no es válida.");
        }
        return false;
    }
}


//Validar Contraseña----------------------------------------------------------------------------------------------------
function validarContrasena2() {
    var patternPass2 = new RegExp(/^[A-Za-z0-9]{8,18}$/);
    var element = document.getElementById("user_contrasenya_second");
    if (patternPass2.test(element.value)) {
        return true;
    } else {
        if (element.value === '') {
            error2(element, "Error: Debes introducir una contraseña.");
        } else {
            error2(element, "Error: La contraseña introducida no es válida.");
        }
        return false;
    }
}




function validar(e) {
    esborrarError();
    if (validarNombre() && validarCorreo() && validarContrasena() && validarContrasena2()) {
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