// Funcion para ver y ocultar menus w3, listeners
function addLstnrTglClssmenus(idpl, idpr, idbl, idbr) {
    window.addEventListener('click', function (e) {
        var xl = document.getElementById(idbl);
        var xr = document.getElementById(idbr);
        if (document.getElementById(idpl).contains(e.target)) {
            if (xl.className.indexOf("w3-show") == -1) {
                xl.className += " w3-show";
                if (xr.className.indexOf("w3-show") != -1) {
                   xr.className = xr.className.replace(" w3-show", "");
                }
            } else {
                xl.className = xl.className.replace(" w3-show", "");
            }
        } else if (document.getElementById(idpr).contains(e.target)) {
            if (xr.className.indexOf("w3-show") == -1) {
                xr.className += " w3-show";
                if (xl.className.indexOf("w3-show") != -1) {
                    xl.className = xl.className.replace(" w3-show", "");
                }
            } else {
                xr.className = xr.className.replace(" w3-show", "");
            }
        } else {
            if (xr.className.indexOf("w3-show") != -1) {
                xr.className = xr.className.replace(" w3-show", "");
            }
            if (xl.className.indexOf("w3-show") != -1) {
                xl.className = xl.className.replace(" w3-show", "");
            }
        }
    });
}

// Funciones Para el cambio de Tema
// Funcion Auxiliares Para el cambio de Tema
function nameFileinPath(cadenaADividir, separador) {
    var arrayDeCadenas = cadenaADividir.split(separador);
    var nameFile = arrayDeCadenas[arrayDeCadenas.length - 1];
    return nameFile
}
// Funcion Auxiliares Para el cambio de Tema
function rutaFileinPath(cadenaADividir, separador) {
    var arrayDeCadenas = cadenaADividir.split(separador);
    var rutaFile = "";
    for (var i = 0; i < arrayDeCadenas.length - 1; i++) {
        rutaFile = rutaFile + arrayDeCadenas[i] + "/"
    }
    return rutaFile;
}
// Funcion Que cambia los temas con clicks
function changeTemew3js(id) {
    var temeJS = document.getElementById(id);
    console.log('tema href: ' + temeJS.href);
    console.log('name href: ' && nameFileinPath(temeJS.href, '/'));
    var nameStyleSel = nameFileinPath(temeJS.href, '/');    
    var rutaStyleSel = rutaFileinPath(temeJS.href, '/');
    if (nameStyleSel == 'w3-theme-red.css') {
        temeNext = 'w3-theme-pink.css';
        temeJS.href = rutaStyleSel + temeNext;
    } else if (nameStyleSel == 'w3-theme-pink.css') {
        temeNext = 'w3-theme-primary.css';
        temeJS.href = rutaStyleSel + temeNext;
    } else if (nameStyleSel == 'w3-theme-primary.css') {
        temeNext = 'w3-theme-purple.css';
        temeJS.href = rutaStyleSel + temeNext;
    } else if (nameStyleSel == 'w3-theme-purple.css') {
        temeNext = 'w3-theme-deep-purple.css';
        temeJS.href = rutaStyleSel + temeNext;
    } else if (nameStyleSel == 'w3-theme-deep-purple.css') {
        temeNext = 'w3-theme-indigo.css';
        temeJS.href = rutaStyleSel + temeNext;
    } else if (nameStyleSel == 'w3-theme-indigo.css') {
        temeNext = 'w3-theme-blue.css';
        temeJS.href = rutaStyleSel + temeNext;
    } else if (nameStyleSel == 'w3-theme-blue.css') {
        temeNext = 'w3-theme-light-blue.css';
        temeJS.href = rutaStyleSel + temeNext;
    } else if (nameStyleSel == 'w3-theme-light-blue.css') {
        temeNext = 'w3-theme-cyan.css';
        temeJS.href = rutaStyleSel + temeNext;
    } else if (nameStyleSel == 'w3-theme-cyan.css') {
        temeNext = 'w3-theme-teal.css';
        temeJS.href = rutaStyleSel + temeNext;
    } else if (nameStyleSel == 'w3-theme-teal.css') {
        temeNext = 'w3-theme-green.css';
        temeJS.href = rutaStyleSel + temeNext;
    } else if (nameStyleSel == 'w3-theme-green.css') {
        temeNext = 'w3-theme-light-green.css';
        temeJS.href = rutaStyleSel + temeNext;
    } else if (nameStyleSel == 'w3-theme-light-green.css') {
        temeNext = 'w3-theme-lime.css';
        temeJS.href = rutaStyleSel + temeNext;
   } else if (nameStyleSel == 'w3-theme-lime.css') {
        temeNext = 'w3-theme-khaki.css';
        temeJS.href = rutaStyleSel + temeNext;
   } else if (nameStyleSel == 'w3-theme-khaki.css') {
        temeNext = 'w3-theme-yellow.css';
        temeJS.href = rutaStyleSel + temeNext;
   } else if (nameStyleSel == 'w3-theme-yellow.css') {
        temeNext = 'w3-theme-amber.css';
        temeJS.href = rutaStyleSel + temeNext;
   } else if (nameStyleSel == 'w3-theme-amber.css') {
        temeNext = 'w3-theme-orange.css';
        temeJS.href = rutaStyleSel + temeNext;
   } else if (nameStyleSel == 'w3-theme-orange.css') {
        temeNext = 'w3-theme-deep-orange.css';
        temeJS.href = rutaStyleSel + temeNext;
   } else if (nameStyleSel == 'w3-theme-deep-orange.css') {
        temeNext = 'w3-theme-blue-grey.css';
        temeJS.href = rutaStyleSel + temeNext;
   } else if (nameStyleSel == 'w3-theme-blue-grey.css') {
        temeNext = 'w3-theme-brown.css';
        temeJS.href = rutaStyleSel + temeNext;
   } else if (nameStyleSel == 'w3-theme-brown.css') {
        temeNext = 'w3-theme-grey.css';
        temeJS.href = rutaStyleSel + temeNext;
   } else if (nameStyleSel == 'w3-theme-grey.css') {
        temeNext = 'w3-theme-dark-grey.css';
        temeJS.href = rutaStyleSel + temeNext;
   } else if (nameStyleSel == 'w3-theme-dark-grey.css') {
        temeNext = 'w3-theme-black.css';
        temeJS.href = rutaStyleSel + temeNext;
   } else if (nameStyleSel == 'w3-theme-black.css') {
        temeNext = 'w3-theme-w3schools.css';
        temeJS.href = rutaStyleSel + temeNext;
   } else if (nameStyleSel == 'w3-theme-w3schools.css') {
        temeNext = 'w3-theme-red.css';
        temeJS.href = rutaStyleSel + temeNext;
   }
   //console.log('Aki toy: ' );
    console.log('qki tema: ' + temeJS.href);
    document.cookie = 'tema=' + temeJS.href;
}
