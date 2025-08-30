<?php
class CobjTblcsv {
    public function __construct(){}
    public function dothis($fl,$do,$nmtbl){
        if ($do == 'crea'){
            if ($fp = fopen($fl, "w")){
                fwrite($fp, $nmtbl. PHP_EOL);
                fclose($fp);
                echo '<script>La tabla se creo exitosamente.</script>';
                $this->drawSimplFrm('Digite los encabezados para la tabla separados por comas','myapp.php?mn=5&accion=creatblgcsv&n=1','nmtbl','Enviar');
            }
        } // Solicita encabezados separados por comas
        if ($do == 'addyln'){
            if ($fp = fopen($fl, "a+")){
                fwrite($fp, $nmtbl. PHP_EOL);
                fclose($fp);
                echo '<script>Se agrego el dato correctamente</script>';
            }
        } // 
        if ($do == 'add'){
            if ($fp = fopen($fl, "a+")){
                fwrite($fp, $nmtbl);
                fclose($fp);
                echo '<script>Se agrego el dato correctamente</script>';
            }
        }
        if ($do == 'readhd'){
            $i=0;
            $ln='';
            if ($fp = fopen($fl, "r")){
                $original = ini_get("auto_detect_line_endings");
                ini_set("auto_detect_line_endings", true);
                $handle = fopen($fl, "r");
                ini_set("auto_detect_line_endings", $original);
                while (($line = fgets($handle)) !== false) { 
                    $i++;
                    if ($i==1){$ln=$line; fseek($fp, SEEK_END);}
                }
            }
            return $ln;
        }
    } /* Funcion usada en el $lnk para iniciar archivo 'crea', añadir encabezados 'addyln'; y en addInfo para: leer encabezados 'readhd', añadir un dato y coma 'add', y para el ultimo dato 'addyln' */
    public function drawSimplFrm($ttl,$lnk,$dat,$nmbtn){
        echo '<h5>'.$ttl.'</h5>';
        echo '<form class="form pure-group" action="'.$lnk.'" method="POST">';
        //echo '<form class="form" id="form" action="'.$lnk.'">';
        echo '<fieldset class="pure-group">';
        echo '<input type="text" maxlength="200" id="'.$dat.'" name="'.$dat.'" size="auto" " tabindex="1" autofocus />';
        //echo '<input name="'.$nmbtn.'" type="submit" value=" '.$nmbtn.' " tabindex="2"  />';
        echo '</fieldset>';
        echo '<br><input class="btn btn-success btn-sm" id="btnenviar" type="submit" value=" '.$nmbtn.' " tabindex="2" />';
        echo '</form>';
    } /* Usada por dothis, dibuja form simple con titulo $ttl, que envia $dat con metodo post a lnk, al presionar el boton $nmbtn.  */    
}
?>