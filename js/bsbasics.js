/* PopUps */
function showThis(divId){
    var whatAd = document.getElementById(divId);
    whatAd.removeAttribute('hidden', 'hidden');
}
function hideThis(divId){
    var whatAd = document.getElementById(divId);
    whatAd.setAttribute('hidden', 'hidden');
}

function getfaviconJS(){
    alert('provando mkds jeje');
}
// cookies
// funcion para mostrar cookies en conasola
function showCookiesInConsol() {
    var misCookies = document.cookie;
    var listaCookies = misCookies.split(";");
    console.clear(); // limpia consola
    for (var i = 0; i < listaCookies.length; i++) {
        console.log(listaCookies[i]);
    }
}

function mouseOverlclder(id) {
    document.getElementById(id).style.color = "white";
    document.getElementById(id).style.backgroundColor = '#96a5a5';
}
function mouseOutlclder(id) {
    document.getElementById(id).style.color = "black";
    document.getElementById(id).style.backgroundColor = "white";
}    
function changetema(){
    if (document.documentElement.getAttribute('data-bs-theme') === 'dark') {
        document.documentElement.setAttribute('data-bs-theme', 'light'); // Cambia a modo claro
    } else if (document.documentElement.getAttribute('data-bs-theme') === 'light') {
        document.documentElement.setAttribute('data-bs-theme', 'blue'); // Cambia a modo oscuro
    } else {
        document.documentElement.setAttribute('data-bs-theme', 'dark'); // Cambia a modo oscuro
    }
    document.getElementById("mnizq").click();
    
}
function toglemnizq(){
    var mnder = document.getElementById('mnblock');
    var vismn = document.getElementById('mnblock').checkVisibility();
    if (vismn){
        mnder.hidden = true;
    } else {
        mnder.hidden = false;
    }
}
/* Funciones de db myprog - lista blanca log seltblactnauto 
    Usamos listas blancas para servir paginas, en incluso mucho mas.
*/
function seltblsactionauto(){
    listdbSel = document.getElementById("listdblcl");
    dbSel = listdbSel.options[listdbSel.selectedIndex].text;
    document.cookie = "dbSel=" + dbSel;
    location.href = "./seltblactnauto";
}

function showtblsactionauto(){
    listdbSel = document.getElementById('listdblcl');
    dbSel = listdbSel.options[listdbSel.selectedIndex].text;
    document.cookie = 'dbSel=' + dbSel;
    location.href = './shwtblactnauto';
}
function showtblsactionautonext(){
    var myCount = parseInt(leerCookie('mycount'),10);
    myCount = myCount + 1;
    document.cookie = 'mycount=' + myCount;
    location.href = './shwtblactnauto';
    console.log(myCount);
}
function leerCookie(nombre) {
    var lista = document.cookie.split(";");
    for (i in lista) {
        var busca = lista[i].search(nombre);
        if (busca > -1) {micookie=lista[i]}
        }
    var igual = micookie.indexOf("=");
    var valor = micookie.substring(igual+1);
    return valor;
}
function showtblsactionautoback(){
    var myCount = parseInt(leerCookie('mycount'),10);
    myCount = myCount - 1;
    document.cookie= `mycount=${myCount}`;
    location.href = './shwtblactnauto';
    console.log(myCount);
}
function editregjs(n){
    alert('Quiere editar el registro ' + n);
}
function delregjs(n){
    alert('Quiere eliminar el registro ' + n);
}