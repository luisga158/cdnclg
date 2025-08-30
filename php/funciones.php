<?php
if (!defined("RAIZ")) define("RAIZ", dirname(dirname(dirname(__FILE__))));    #Definimos la raíz del directorio
include_once RAIZ . "/resources/php/class/Cobjdb.php"; // Incluyendo el objeto 
//include_once RAIZ . "../varsmyprog.php"; // Centralizando datos y variables incluidas listas blancas
/*function loadtema(){
    $databasein = 'myprog';
    $nametbl = 'logersmp';
    $objusers = new Cobjdb($nametbl, $databasein, $server, $db_user, $db_pass);
    $ardatauser = $objusers->getrowdata($_COOKIE['nameuserin','nombre'])
    $objusers->console_log($ardatauser);
}*/
function topruebas(){
    console_log('probando... 123...');
}
function sesion_esta_iniciada()
{
	return session_status() === PHP_SESSION_ACTIVE ? TRUE : FALSE;
}


function inicia_sesion_segura()
{
    if (sesion_esta_iniciada() === FALSE ) {
        session_start();
        session_regenerate_id(true);
    }
}

function cierra_sesion_segura()
{
	if (session_status() !== PHP_SESSION_ACTIVE) {
        session_start();
        session_destroy();
	}
}

function comprobar_datos($nombre, $palabra_secreta)
{
    global $base_de_datos;
    $nombre = strtolower($nombre);
    $sentencia = $base_de_datos->prepare("SELECT palabra_secreta, bin(1) AS administrador FROM logersmp WHERE nombre = ?;");
    $sentencia->execute([$nombre]);
    $fila = $sentencia->fetch();
    if(!$fila){
        return false;
    }
    $palabra_secreta_encriptada = $fila["palabra_secreta"];
    if (password_verify($palabra_secreta, $palabra_secreta_encriptada)) {
        $administrador = $fila["administrador"];
        setcookie('dbSel', '');
        propaga_datos_sesion($nombre, $administrador);
        setcookie('cookieagree', 'true', time() + (60*60*24*365));
        setcookie('nameuserin', $_SESSION["nombre_de_usuario"], time() + (60*60*24*365));
        setcookie('dbSel', '');
        if (isset($_COOKIE['tema'])){
            setcookie('tema', $_COOKIE['tema']);
        }
        return true;
    } else {
        return false;
    }

}

function propaga_datos_sesion($nombre_de_usuario, $administrador)
{
    inicia_sesion_segura();
    $_SESSION["sesion_iniciada"] = true;
    $_SESSION["nombre_de_usuario"] = $nombre_de_usuario;
    #$_SESSION["nombre_de_usuario"] = 'tienda';
    $_SESSION["administrador"] = intval($administrador);
    $_SESSION["hora_de_inicio"] = time();
}

function usuario_ruta($nombre_de_usuario)
{
    global $base_de_datos;
    $sentencia = $base_de_datos->prepare("SELECT Ruta FROM usuarios WHERE nombre = ?;");
    $sentencia->execute([$nombre_de_usuario]);
    $fila = $sentencia->fetch();
    return ($fila["Ruta"]);
}

// funcion para depurar en PHP
function console_log( $data ){
    echo '<script>';
    echo 'console.log('. json_encode( $data ) .')';
    echo '</script>';
}
// Funcion para mostrar cookies por consola, las definidas de momento
function showcookies(){
    echo '<script>showCookiesInConsol()</script>';
    setcookie('nameuserin',$_SESSION['nombre_de_usuario'], time() + (60*60*24*365));
    console_log("visita: ".$_COOKIE['visita']);
    console_log("tema: ".$_COOKIE['tema']);
    console_log("cantvisitas: ".$_COOKIE['cantvisitas']);
    console_log("pageactive: ".$_COOKIE['pageactive']);
    console_log("cookieagree: ".$_COOKIE['cookieagree']);
    console_log("nombre_de_usuario_sesion: ".$_SESSION['nombre_de_usuario']);
    console_log("nameuserin: ".$_COOKIE['nameuserin']);
    console_log("iduserin: ".$_COOKIE['iduserin']);   
}
// Proximo tema
function nexttema(){
    if ($_COOKIE['tema'] == 'softtema.css'){   setcookie('tema', 'midtema.css', time() + (60*60*24*365));    
    } elseif ($_COOKIE['tema'] == 'midtema.css'){   setcookie('tema', 'darktema.css', time() + (60*60*24*365));    
    } elseif ($_COOKIE['tema'] == 'darktema.css'){   setcookie('tema', '1.css', time() + (60*60*24*365));    
    } elseif ($_COOKIE['tema'] == '1.css'){   setcookie('tema', '1nb.css', time() + (60*60*24*365));
    } elseif ($_COOKIE['tema'] == '1nb.css'){   setcookie('tema', 'darktemanb.css', time() + (60*60*24*365));
    } elseif ($_COOKIE['tema'] == 'darktemanb.css'){   setcookie('tema', 'midtemanb.css', time() + (60*60*24*365));
    } elseif ($_COOKIE['tema'] == 'midtemanb.css'){   setcookie('tema', 'softtemanb.css', time() + (60*60*24*365));
    } elseif ($_COOKIE['tema'] == 'softtemanb.css'){   setcookie('tema', 'softtema.css', time() + (60*60*24*365));
    }
}
// reset de cookies visita, tema y cantvisitas
function resetcookies(){
    console_log('reset: ');
    showcookies();
    setcookie('visita','no', time() + (60*60*24*365));
    setcookie('tema', 'softtema.css', time() + (60*60*24*365));
    setcookie('cantvisitas', '0', time() + (60*60*24*365));
    setcookie('pageactive', '0', time() + (60*60*24*365));
    setcookie('cookieagree', 'false', time() + (60*60*24*365));
    setcookie('nameuserin', '', time() + (60*60*24*365));
    showcookies();
    console_log('reset end: ');
}
// iniciando cookies visita, tema y cantvisitas
function inicookies(){
    # cookie para saber si ha visitado duracion 1 año, se renueva en cada visita
    #showcookies();
    # Si no hay cookie de visita, la pone en si, el tema en 1.css, y la cantidad de visitas en 1
    # De lo contrario:
    # Actualiza x un año la cookie de visita, suma 1 a la cantidad de visitas, y carga el tema de haberlo elegido
    if (isset($_COOKIE['visita'])){
        /*if ($_COOKIE['visita'] != 'si'){
            setcookie('visita','si', time() + (60*60*24*365));
            setcookie('tema', "softtema.css", time() + (60*60*24*365));
            $visitadd = 1;
            setcookie('cantvisitas', $visitadd, time() + (60*60*24*365));
            if (isset($_SESSION["nombre_de_usuario"])){
                setcookie('nameuserin', $_SESSION["nombre_de_usuario"], time() + (60*60*24*365));
            }
        } else {*/
            setcookie('visita','si',time() + (60*60*24*365));
            $visitadd = $_COOKIE['cantvisitas'] + 1;
            setcookie('cantvisitas', $visitadd, time() + (60*60*24*365));
            if ($_COOKIE['tema'] != ''){
                setcookie('tema', $_COOKIE['tema'], time() + (60*60*24*365));
            } else {
                setcookie('tema', "softtema.css", time() + (60*60*24*365));            
            }
            if (isset($_SESSION["nombre_de_usuario"])){
                setcookie('nameuserin', $_SESSION["nombre_de_usuario"], time() + (60*60*24*365));
            }
        #}
    } else {
        setcookie('visita','si', time() + (60*60*24*365));
        setcookie('tema', "softtema.css", time() + (60*60*24*365));
        $visitadd = 1;
        setcookie('cantvisitas', $visitadd, time() + (60*60*24*365));
        if (isset($_SESSION["nombre_de_usuario"])){
            setcookie('nameuserin', $_SESSION["nombre_de_usuario"], time() + (60*60*24*365));
        }
    }
    //showcookies();
}

function prucookies(){
    if (isset($_COOKIE['tema'])) {
        echo "Variable tema definida!!!";
    } else {
        echo "Variables tema no definida!!!";
    }
}
/***************************************************************************************
* Para evitar el envío de datos invasores, scripts de ataque y otros:
* La funcion test_input realiza tres tareas:
* 1.- Con trim quita espacios innecesarios
* 2.- Con stripslashes quita barras invertidas (\)
* 3.- Con htmlspecialchars convierte caracteres usados en ataques en su código html
*       haciendolos inofensivos.
***************************************************************************************/
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }
?>