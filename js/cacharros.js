// Funciones para carga de página carga 
/* Agrega las respuestas programadas con esta funciones */
/* Funcion que remplaza el toggle y esconde con el click outside */
function addLstnrTglClss(idp,cl1,cl2,idmnizq){
    window.addEventListener('click', function (e) {
        if (document.getElementById(idp).contains(e.target)) {
            // Funcion para recibir mensaje por consola
            // console.log('You clicked inside');
        } else {
            // Funcion para recibir mensaje por consola
            // console.log('You clicked outside');
            /* evalua el click en el mn izq creando el toggle y el else para cerrar out click */
            if (document.getElementById(idmnizq).contains(e.target)) {
                // Funcion para recibir mensaje por consola
                // console.log('You clicked outside 1');
                if (document.getElementById(idp).className == cl2){
                    document.getElementById(idp).className = cl1;
                } else {
                    // Funcion para recibir mensaje por consola
                    // console.log('You clicked outside 3');
                    document.getElementById(idp).className = cl2;
                }
            } else if (document.getElementById(idp).className == cl2){
                // Funcion para recibir mensaje por consola
                // console.log('You clicked outside 2');
                document.getElementById(idp).className = cl1;
            }
        }
    });
}
/* Mejora la anterior respondiendo a iconos pequeños y grande */
/* idp */
function addLstnrTglClssmn(idp,cl1,cl2,cl2m,idmn){
    window.addEventListener('click', function (e) {
        if (document.getElementById(idp).contains(e.target)) {
            // Funcion para recibir mensaje por consola
             console.log('You clicked inside');
        } else {
            // Funcion para recibir mensaje por consola
            // console.log('You clicked outside');
            /* evalua el click en el mn izq creando el toggle y el else para cerrar out click */
            if (document.getElementById(idmn).contains(e.target)) {
                // Funcion para recibir mensaje por consola
                // console.log('You clicked outside 1');
                if ((document.getElementById(idp).className == cl2) || (document.getElementById(idp).className == cl2m)){
                    document.getElementById(idp).className = cl1;
                } else {
                    // Funcion para recibir mensaje por consola
                    // console.log('You clicked outside 3');
                    document.getElementById(idp).className = cl2;
                }
            } else if ((document.getElementById(idp).className == cl2) || (document.getElementById(idp).className == cl2m)){
                // Funcion para recibir mensaje por consola
                // console.log('You clicked outside 2');
                document.getElementById(idp).className = cl1;
            }
        }
    });
}
/* funciones para imagenes */
function fulimage(idimgn){
    var getImgn = document.getElementById(idimgn);
    var getClnm = getImgn.className;
    if (getClnm == 'imgfullscreen') {
        getImgn.className = "";
    } else {
        getImgn.className = "imgfullscreen";
    }
}
/**********************************************************************************************************/
/* Funciones desarrolladas para pagina perderpeso */
/* Funcion para cerra un popup sobrepuesto 
    idp es el id del contenedor global. dentro del cual esta idpclose
    idpclose es el id del contenedor tipo boton para cerrar
    clhide es una clase previamente definida.
    La he definido para usar en cualquier parte así:
    .hidecont {    display: none;    width:0px;    height:0px;  }
*/
function addLstnrCloseClss(idp,idpclose,clhide){
    window.addEventListener('click', function (e) {
        if (document.getElementById(idpclose).contains(e.target)) {
            // Funcion para recibir mensaje por consola
            // console.log('You clicked inside');
            document.getElementById(idp).className = clhide;
            document.getElementById(idpclose).className = clhide;
        }
    });
}

/**********************************************************************************************************/
// Funcion de colapsar el contenido al presinar el encabezado
function ttltxtclps(idp, idbp, idcbp) {
    var getDiv = document.getElementById(idp);
    var getClnm = getDiv.className;
    var getDivbx = document.getElementById(idbp);
    var getDivcont = document.getElementById(idcbp);
    if (getClnm == 'linkscont') {
        getDiv.setAttribute('hidden', 'hidden');
        getDiv.className = "hdlblclkd";
        getDivbx.className = "boxtottltxtblck";
        getDivcont.className = "contblock";
    } else {
        getDiv.removeAttribute('hidden', 'hidden');
        getDiv.className = "linkscont";
        getDivbx.className = "boxtottltxtblck";
        getDivcont.className = "continlineflex";
    }
}
// Prueba JQuerry pagina indexjq
function jqttltxtclps(idp, idbp, idcbp) {
    if ($(idp).hasClass('linkscont')) {
        $(idp).hide(1500);
        $(idp).removeClass("linkscont");
        $(idp).addClass("hdlblclkd");
        $(idcbp).removeClass("continlineflex");
        $(idcbp).addClass("contblock");
        console.log("donehide");
    } else {
        $(idp).show(1500);
        $(idp).removeClass("hdlblclkd");
        $(idp).addClass("linkscont");
        $(idcbp).removeClass("contblock");
        $(idcbp).addClass("continlineflex");
        console.log("doneshow");
    }    
}
// Funcion de colapsar el contenido total de multi-parts con el primer encabezado
function ttltxtclpsonetomany(idp, idbp, idcbp) {
    var getDiv = document.getElementById(idp);
    var getClnm = getDiv.className;
    var getDivbx = document.getElementById(idbp);
    var getDivcont = document.getElementById(idcbp);
    if (getClnm == 'hdlblclkd') {
        getDiv.removeAttribute('hidden', 'hidden');
        getDiv.className = "";
        getDivbx.className = "boxtottltxtblck";
        getDivcont.className = "continlineflex";
    } else {
        getDiv.setAttribute('hidden', 'hidden');
        getDiv.className = "hdlblclkd";
        getDivbx.className = "boxtottltxtblck";
        getDivcont.className = "contblock";
    }
}

// Funcion para remplazar contenido con parciales en html
function changecontent(pgnm,contid){
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById(contid).innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", pgnm, true);
    xhttp.send();
    iniallclps();
}
// Funcion toogle al presinar el encabezado inciando contenido oculto
function ttltxtggl(idp) {
    var getDiv = document.getElementById(idp);
    var getClnm = getDiv.className;
    if (getClnm == 'hdlblclkd') {
        getDiv.removeAttribute('hidden', 'hidden');
        getDiv.className = "linkscont";
    } else {
        getDiv.setAttribute('hidden', 'hidden');
        getDiv.className = "hdlblclkd";
    }
}
// Funcion en pagina mypartials sobre el mouseover mostrr carret
function carretmouseOver(idp){
    var getDiv = document.getElementById(idp);
    getDiv.className = "menuslidshw";
}
function carretmouseOut(idp){
    var getDiv = document.getElementById(idp);
    getDiv.className = "menuslide";
}
/************************************************************************************/
/* Funciones en desuso */
/************************************************************************************/
/*
    Funciones de menu remplazadas con el codigo incial en mypartials
*/
// Funcion para mostrar el menu izq a partir de un icono fa fa-caret-down
function menuslidefshwizq(idp) {
    var getDiv = document.getElementById(idp);
    var getClnm = getDiv.className;
    if (getClnm == 'menuslideizq') {        
        console.log('You open izqmenu');
        getDiv.className = "menuslidshwizq";
    } else {
        console.log('You close izqmenu');
        getDiv.className = "menuslideizq";
    }
}
/* Funcion Elaborada para Toggle class, remplazando la anterior y mejorandola */
function tgglClas(idp,cl1,cl2){
    var getDiv = document.getElementById(idp);
    var getClnm = getDiv.className;
    if (getClnm == cl1) {        
        getDiv.className = cl2;
    } else {
        getDiv.className = cl1;
    }
}
/* */
function hidemenus(idp,idp2){
    var getDiv = document.getElementById(idp);
    var getClnm = getDiv.className;
    var getDiv2 = document.getElementById(idp2);
    var getClnm2 = getDiv2.className;
    var getBd = document.body;
    if (getClnm == 'menuslidshwizq') {
        getDiv.className = "menuslideizq";
    }
    if (getClnm2 == 'menuslidshwder') {
        getDiv2.className = "menuslidere";
    }
}
// Funcion para mostrar el menu a partir de un icono fa fa-bar
function menuslidefshwder(idp) {
    var getDiv = document.getElementById(idp);
    var getClnm = getDiv.className;
    if (getClnm == 'menuslidere') {
        getDiv.className = "menuslidshwder";
    } else {
        getDiv.className = "menuslidere";
    }
    /*console.log(getDiv.className);*/
}
/* Funcion usada para cargar la pagina index antigua */
// Funcion onload body para colapsar todo */
function iniallclps(){
    ttltxtclps('mislibforwebs','boxmislibforwebs','contmisitiosrecu');
    ttltxtclpsonetomany('misvarios','boxmisvarios','contmisitiosrecu');
    ttltxtclps('misitios','boxmisitios','contmisitios');
    ttltxtclps('hstdomfree','boxhstdomfree','contmisitios');
}
/* Previas al desarrollo de la funcion showinroll que remplazo y redujo el codigo */
function showhdnext(){
    var newDiv = document.getElementById('head1');
    var newDiv0 = document.getElementById('head0');
    var newDiv2 = document.getElementById('head2');
    var newDiv3 = document.getElementById('head3');
    if (newDiv0.getAttribute('hidden') == null) {
        console.log('is not hidden');
        newDiv0.setAttribute('hidden','hidden');
        newDiv3.removeAttribute('hidden','hidden');
    } else {
        if (newDiv3.getAttribute('hidden') == null) {
            newDiv3.setAttribute('hidden','hidden');
            newDiv2.removeAttribute('hidden','hidden');
        } else {
            if (newDiv2.getAttribute('hidden') == null) {
                changehdmyprtls();
                newDiv2.setAttribute('hidden','hidden');
                newDiv0.removeAttribute('hidden','hidden');
            } else {
                changehdmyprtls();
                newDiv0.setAttribute('hidden','hidden');
                newDiv.removeAttribute('hidden','hidden');
            }
        }
    }
}
function showhdprev(){
    var newDiv = document.getElementById('head1');
    var newDiv0 = document.getElementById('head0');
    var newDiv2 = document.getElementById('head2');
    var newDiv3 = document.getElementById('head3');
    if (newDiv0.getAttribute('hidden') == null) {
        changehdmyprtls();
        newDiv0.setAttribute('hidden','hidden');
        newDiv3.removeAttribute('hidden','hidden');
    } else {
        if (newDiv3.getAttribute('hidden') == null) {
            newDiv3.setAttribute('hidden','hidden');
            newDiv2.removeAttribute('hidden','hidden');
        } else {
            if (newDiv2.getAttribute('hidden') == null) {
                newDiv2.setAttribute('hidden','hidden');
                newDiv.removeAttribute('hidden','hidden');
            } else {
                changehdmyprtls();
                newDiv.setAttribute('hidden','hidden');
                newDiv0.removeAttribute('hidden','hidden');
            }
        }
    }
}
/************************************************************************************/
/* Fin Funciones en desuso me ayudaron a crear el codigo inicial y otras funciones */
/************************************************************************************/
/*********************************************************/
/* Funciones para cambio de caracteristicas con JS */
/*********************************************************/
// Funcion que ajusta el fontsize de una clase = clsp, a la size = sisizep
function sizeFontajstclass(clsp,sizep){
    elements = document.getElementsByClassName(clsp);
    for (var i = 0; i < elements.length; i++) {
        var element = elements[i];
        element.style.fontSize = sizep;
    }
    rnmClss('menusldizq','menuslideizq');
}
/* Funcion auxiliar rename class */
function rnmClss(idp,cl1){
    var getDiv = document.getElementById(idp);
    getDiv.className = cl1;
}
/* minimiza los iconos */
function mniconsize(cual){
    rnmClss('mnizq','contcarretsmizq');
    rnmClss('mnder','contcarretsmder');
    rnmClss('contcartizq','contcontcarretsmizq');
    rnmClss('contcartder','contcontcarretsmder');
    rnmClss('menusldizq','menuslideizq');
    rnmClss('menusldr','menuslidere');
    if (cual > 0) {
        rnmClss('contcartmidizq','contcontcarretmidizqsm');
        rnmClss('cartmidizq','contcarretmidizqsm');
        rnmClss('contcartmider','contcontcarretmiddersm');
        rnmClss('cartmider','contcarretmiddersm');
    }
    document.getElementById('wzrdmniconsize').setAttribute('hidden','hidden');
    document.getElementById('wzrdmniconsizerest').removeAttribute('hidden','hidden');
}
/* restaura los iconos */
function mniconsizerest(cual){
    rnmClss('mnizq','contcarretizq');
    rnmClss('mnder','contcarretder');
    rnmClss('contcartizq','contcontcarretizq');
    rnmClss('contcartder','contcontcarretder');
    rnmClss('menusldizq','menuslideizq');
    rnmClss('menusldr','menuslidere');
    if (cual > 0) {
        rnmClss('contcartmidizq','contcontcarretmidizq');
        rnmClss('cartmidizq','contcarretmidizq');
        rnmClss('contcartmider','contcontcarretmidder');
        rnmClss('cartmider','contcarretmidder');
    }
    document.getElementById('wzrdmniconsize').removeAttribute('hidden','hidden');
    document.getElementById('wzrdmniconsizerest').setAttribute('hidden','hidden');
}
/* A cambiar estios de la cabecera de mostrario */
function changehdmyprtls(){
    var divLg = document.getElementById('contlogomhid');
    var divHd = document.getElementById('myhdcl');
    if (divHd.className == 'myhd'){
        rnmClss('myhdcl','myhdbknone');
        divLg.setAttribute('hidden','hidden');
    } else {
        rnmClss('myhdcl','myhd');
        divLg.removeAttribute('hidden','hidden');
    }    
    rnmClss('menusldizq','menuslideizq');
}
// Pruebas animate javascript copiada la barra temporal moviendose
function animate({duration, draw, timing}) {
  let start = performance.now();
  requestAnimationFrame(function animate(time) {
    let timeFraction = (time - start) / duration;
    if (timeFraction > 1) timeFraction = 1;
    let progress = timing(timeFraction)
    draw(progress);
    if (timeFraction < 1) {
      requestAnimationFrame(animate);
    }
  });
}
function loadDocext(contid,fullpathfile) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            contid.innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", fullpathfile, true);
    xhttp.send();
}
function showhd01(){
    var newDiv = document.getElementById('head0');
    newDiv.removeAttribute('hidden','hidden');
    rnmClss('menusldizq','menuslideizq');
}
function tglhds(){
    var i;
    var seve = false;
    var cabeceras = document.getElementsByTagName("header");
    // recorre las header y si alguna es visible, seve = true, y las esconde.
    for (i = 0; i < cabeceras.length; i++) {
        if (cabeceras[i].getAttribute('hidden') == null) {
            seve = true;
        }
    }
    if (seve) {
        for (i = 0; i < cabeceras.length; i++) {
            cabeceras[i].setAttribute('hidden','hidden');
        }
        document.getElementById('contcartmidizq').setAttribute('hidden','hidden');
        document.getElementById('contcartmider').setAttribute('hidden','hidden');
    } else {
        cabeceras[0].removeAttribute('hidden','hidden');
        document.getElementById('contcartmidizqsect').setAttribute('hidden','hidden');
        document.getElementById('contcartmiddersect').setAttribute('hidden','hidden');
        document.getElementById('contcartmidizq').removeAttribute('hidden','hidden');
        document.getElementById('contcartmider').removeAttribute('hidden','hidden');
    }
    rnmClss('menusldizq','menuslideizq');
}
function hidesect(arsec){
    var i;
    for (var i = 0; i < arsec.length; i++){
        var newDiv = document.getElementById(arsec[i]);
        newDiv.setAttribute('hidden','hidden');
    }
}
function arrowshdsecttgl(){
    var newDiv = document.getElementById('contcartmidizq');
    var newDiv0 = document.getElementById('contcartmider');
    if (newDiv.getAttribute('hidden') == null) {
        newDiv.setAttribute('hidden','hidden');
        var newDiv2 = document.getElementById('contcartmidizqsect');
        newDiv2.removeAttribute('hidden','hidden');
    } else {
        var newDiv2 = document.getElementById('contcartmidizqsect');
        newDiv2.setAttribute('hidden','hidden');
        newDiv.removeAttribute('hidden','hidden');
    }
    if (newDiv0.getAttribute('hidden') == null) {
        newDiv0.setAttribute('hidden','hidden');
        var newDiv3 = document.getElementById('contcartmiddersect');
        newDiv3.removeAttribute('hidden','hidden');
    } else {
        var newDiv3 = document.getElementById('contcartmiddersect');
        newDiv3.setAttribute('hidden','hidden');
        newDiv0.removeAttribute('hidden','hidden');
    }
}
function tglsectns(arsec){
    hidesect(arsec);
    var newDiv = document.getElementById(arsec[0]);
    newDiv.removeAttribute('hidden','hidden');
    arrowshdsecttgl();
    rnmClss('menusldizq','menuslideizq');
}
function tgglidelmnt(id) {
    var newDiv = document.getElementById(id);
    if (newDiv.getAttribute('hidden') == null) {
        newDiv.setAttribute('hidden','hidden');
    } else {
        newDiv.removeAttribute('hidden','hidden');
    }
    rnmClss('menusldizq','menuslideizq');
}
function showinroll(arids,plus){
    for (var i = 0; i < arids.length; i++){
        var newDiv = document.getElementById(arids[i]);
        // Si es el que se muestra, lo esconde.
        if (newDiv.getAttribute('hidden') == null) {
            newDiv.setAttribute('hidden','hidden');
            // Para la cabecera 0 tenemos una barra adicional con animacion, la quitamos al cambiar.
            if (i == 0) { changehdmyprtls(); }
            i = i + plus;
            if (i < 0) {
                i = arids.length-1;
            } else {
                if (i == arids.length){
                    i = 0;
                }
            }
            var newDiv2 = document.getElementById(arids[i]);
            // Para la cabecera 0 tenemos una barra adicional con animacion, y la ponemos al volver
            if (i == 0) { changehdmyprtls(); }
            newDiv2.removeAttribute('hidden','hidden');
            i = arids.length;
        }
    }
}
/*********************************************************/
/* Inicio funciones jquerri */
/*********************************************************/
// Prueba JQuerry mide tiempo entre window y document en consola es lo que falta
function difwindocjq() {
    /* 
        document, esta listo al cargar el html
        window, hasta cargar todo el contenido multimedia
    */
    $(window).on("load", function () {
        console.log("winready!");
    });
    $(document).ready(function () {
        console.log("docready!");
    });
}
// Prueba JQuerry
function pjq1() {
    $(document).ready(function () {
        $(".linkscont").delay(1500).hide(1500);
        console.log("donelnks");
    });
}
function pjq0() {
    $(document).ready(function () {
        $(".linkscont").delay(1500).hide(1500);
        console.log("donelnks");
        $("#misvarios").delay(500).hide(1500);
        $("#mislibforwebs").removeClass("linkscont");
        $("#mislibforwebs").addClass("hdlblclkd");
        console.log("donemv");
    });
}
/*********************************************************/
/* Funciones para slider 1 */
/*********************************************************/
function showSlides() {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = "none";
    }
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1 }
    slides[slideIndex - 1].style.display = "block";
    t = setTimeout(showSlides, 3000);
}
function plusSlides(inc) {
    var i;
    var slides = document.getElementsByClassName("mySlides");
    for (i = 0; i < slides.length; i++) {
        if (slides[i].style.display != "none") {
            slides[i].style.display = "none";
            slideIndex = i + 1 + inc;
            if (slideIndex == 0) {
                slideIndex = slides.length;
                i = slides.length;
            } else if (slideIndex > slides.length) {
                slideIndex = 1;
                i = slides.length;
            }
        }
    }
    slides[slideIndex - 1].style.display = "block";
}
function stopSlide() {
    clearTimeout(t);
}