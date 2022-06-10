window.onload = iniciar;

function iniciar() {
    document.getElementById("enviar").addEventListener('click', validar)
}

//Validar Nombre--------------------------------------------------------------------------------------------------------
function validarNombre() {
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
        } else {
            error2(element, "El correo no es valído")
        }
        return false
    }
}
function validarPassword() {
    var patternsPass = new RegExp(/^([a-zA-Z])+$/);
    var element = document.getElementById("user_contrasenya_first")
    if (patternsPass.test(element.value)) {
        return true
    } else {
        if (element.value === "") {
            error2(element, "Debes introducir una contraseña")
        }else {
            error2(element, "La contrasña no cumple los requisitos")
        }
        return false
    }
}

function validarPassword2() {
    var element = document.getElementById("user_contrasenya_first");
    var elementR = document.getElementById("user_contrasenya_second");

    if (element.value === "") {
        error2(element, "Debes repetir una contraseña")
        return false;
    }
    if (element.value !== elementR.value) {
        error2(element, "La contraseña no es la misma.");
        return false;
    }
    return true;
}

function validarCaptcha() {
    var element = document.getElementById("user_captcha")
    if (element.value === "") {
        error2(element, "Debes rellenar el captcha")
        return true
    } else {
        return false
    }
}

function validar(e) {
    e.preventDefault();
    esborrarError();
    if (validarNombre() && validarCorreo() && validarPassword && validarPassword2() && validarCaptcha()) {
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