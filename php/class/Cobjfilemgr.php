<?php
/*   Vars:  */
/* ===============================================================================================================================================
            $name:  nombre y ruta de archivo, si no existe el contructor crea el archivo, mejorar, en caso de que el directorio no exista
            $cont:  guarda el contenido del archivo de tenerlo
            $lines: numero de lineas del archivo
=============================================================================================================================================== */
/* Construct:*/
/* ===============================================================================================================================================
                Recibe el nombre del archivo con la ruta
                    $obj->name:     Guarda este dato
                    $obj->cont:     Guardael contenido del archivo si lo tiene
                    $obj->lines:    Guarda el numero de lineas del archivo si las tiene
                Si el archivo no existe lo crea.
=============================================================================================================================================== */
/* Sub del obj:*/
/* ===============================================================================================================================================
                    $obj->getlines():               Almacena el numero de lineas del archivo en $obj->lines
                    $obj->getcont():                Almacena el contenido del archivo en $obj->cont
                    $obj->getln($nln):              Retorna el contenido de la linea $nln del archivo base.
                -------------------------------------------------------------------------------------------------------------------------------
                    $obj->wrttxtini($txt,$eolSN):   Escribe $txt al inicio del archivo, sobreescribe si hay algo.                                                    Pero si la linea existente es más larga que $txt, conserva el resto de la linea.
                                                    Si $eolSN = true añade salto de linea al final del $txt
                                                    Si $eolSN = false, solo añade $txt, sin eol (salto de linea o enter)
                -------------------------------------------------------------------------------------------------------------------------------
                    $obj->addemptylineini():        Añade linea vacia al inicio sin borrar la existente
                    $obj->adtxtend($txt):           Añade linea al final del archivo
                    $obj->instxtini($txt,$eolSN)    Inserta $txt en la primera linea
                -------------------------------------------------------------------------------------------------------------------------------
                    $obj->copytotmp()               Copia el archivo del objeto al archivo temporal 'tmpfl.txt'
                    $obj->deltmpfl()                Borra el archivo temporal usado por el objeto 'tmpfl.txt'
                    $obj->delthisfl()               Borra el archivo base del objeto $fl en el contructor = $this->name en el objeto
                    $obj->replacetxtln($txt,$nln)   Esperamos que remplace una linea n
===============================================================================================================================================
*/
class Cobjfilemgr {
    private $name;
    private $cont;
    private $lines;
    public function __construct($fl){
        $this->name = $fl;
        if (!$fp = fopen($this->name, "c")){ 
            $fp = fopen($this->name, "c");
        } else { 
            $fp = fopen($this->name, "r");
        }
        fclose($fp);
        $this->getlines();
        $this->getcont();
    }
    public function reini(){
        $this->delthisfl();
        $fp = fopen($this->name, "c");
        fclose($fp);
    }  // blankear archivo
    public function getlines(){
        //contando lineas
        if ($fp = fopen($this->name, "r")){
            $i = 0;
            $original = ini_get("auto_detect_line_endings");
            ini_set("auto_detect_line_endings", true);
            $handle = fopen($this->name, "r");
            ini_set("auto_detect_line_endings", $original);
            while (($line = fgets($handle)) !== false) { $i++;}
            $this->lines = $i;
            fclose($fp);
        }
    }
    public function getcont(){
        if ($this->lines > 0){
            if ($fp = fopen($this->name, "r")) {
                $this->cont = fread($fp, filesize($this->name));
                fclose($fp);
            } else {$this->cont = '';}
        }
    }
    public function actualiza(){
        $this->getlines();
        $this->getcont();
    }
    public function getln($nln){
        $fp = fopen($this->name, "r");
        $dtrtr = '';
        if ($this->lines <= $nln){
            $original = ini_get("auto_detect_line_endings");
            ini_set("auto_detect_line_endings", true);
            //$handle = fopen($fp, "r");
            ini_set("auto_detect_line_endings", $original);
            $ni = 1;
            while (($line = fgets($fp)) !== false) {
                if ($ni == $nln) { 
                    $dtrtr = $line;
                    fseek($fp, SEEK_END);
                } else {$ni++;}                
            }
        }
        fclose($fp);
        return $dtrtr;
    }
    /* Escribe o sobreescribe al inicio, sin borrar lo que hay en la linea 1 
    (Si la linea nueva es mas corta que la nueva, conservara el texto existente).
    Y add enter o add eof (fin de linea) si $eolSN = true */
    public function wrttxtini($txt,$eofb){
        $fp = fopen($this->name, 'r+');
        if ($eofb){fwrite($fp, $txt. PHP_EOL);}
        else {fwrite($fp, $txt);}        
        fclose($fp);
    } // Escribe o sobreescribe al inicio, ver nota antes de declaracion
    public function adtxtend($eofini,$txt,$eofend){
        $fp = fopen($this->name, 'a+');
        if ($eofini){fwrite($fp, PHP_EOL);}
        if ($eofend){fwrite($fp, $txt. PHP_EOL);}
        else {fwrite($fp, $txt);}
        fclose($fp);
    } //esperamos que escriba al final
    public function addemptylineini(){ 
        $this->delthisfl();
        $fp = fopen($this->name, "c");
        $this->wrttxtini('',true);
        $this->adtxtend(false,$this->cont,false);
        fclose($fp);
    } // Adiciona una linea vacia al inicio
    public function instxtini($txt){
        $this->delthisfl();
        $fp = fopen($this->name, "c");
        $this->wrttxtini($txt,true);
        $this->adtxtend(false,$this->cont,false);
        fclose($fp);
    } // Inserta linea vacia en la primera linea y escribe $txt
    public function delthisfl(){
        unlink($this->name);
    } // Borra el archivo base del objeto
    
    public function copytotmp(){
        copy($this->name, 'tmpfl.txt');
    } // copia el archivo del objeto al archivo temporal
    public function deltmpfl(){
        unlink('tmpfl.txt');
    } // Borra el archivo temporal usado por el objeto
    public function replacetxtln($txt,$nln){
        if ($nln > 0){
            if ($this->lines <= $nln){
                $fp = fopen($this->name, "a+");
                $endi = $nln - $this->lines - 1;
                for ($i=0; $i < $endi; $i++){
                    fwrite($fp, ''. PHP_EOL);
                }
            }    // si nln es mayor que las lineas del archivo inserta las lineas
            $this->copytotmp();                 // copia a temp 
            $this->delthisfl();                 // borra archivo de objeto
            $fp = fopen($this->name, "x+");      // recrea el archivo en blanco
            $i=0;
            $original = ini_get("auto_detect_line_endings");
            ini_set("auto_detect_line_endings", true);
            $handle = fopen('tmpfl.txt', "r");
            ini_set("auto_detect_line_endings", $original);     // Se inicia i en 0, se abre el temporal para copiar lineas
            while (($line = fgets($handle)) !== false) {
                $i++;
                if ($i == $nln){
                    fwrite($fp, $txt. PHP_EOL);
                } else {
                    fwrite($fp, $line. PHP_EOL);
                }
            }  // escribe las lineas del archivo temp nuevamente al original y en la linea $nln escribe el texto entregado
            $this->deltmpfl();
            fclose($fp);    // borra
        }
    } /*esperamos que remplace una linea n    */
    public function getconttoend($nln){
        $conrtrn = '';
        if ($this->lines >= $nln){
            if ($fp = fopen($this->name, "r")) {
                $i = 0;
                $original = ini_get("auto_detect_line_endings");
                ini_set("auto_detect_line_endings", true);
                //$fp = fopen('codmundane.csv', "r");
                ini_set("auto_detect_line_endings", $original);
                while((($line = fgets($fp)) !== false)){
                    $i++;
                    if ($i == $nln) {
                        $contents = fread($fp, filesize($fp));
                        fseek($fp, SEEK_END);
                    }                    
                }
                return $contents;
                fclose($fp);
            }
        }
    } // tomar contenido desde la linea n hasta el final
    /* 
    
    */
}
?>