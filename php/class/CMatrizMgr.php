<?php
/**
* ===================================================================================================
 * Resumen:
 * ===================================================================================================
 * Metodos : (Nota: no usa constructor, para mayor flexibilidad)
 * ---------------------------------------------------------------------------------------------------
 * -. Para inicializar los datos en vez de construct usamos:    $Obj->setdata
 *    Entregandole los parametros: 
 *                                      $arr,$hdarInarr,$tpdtarr,$hdar,$reqar,$unicoSNar
 *                                      Nota: descripciones en Variables
 * -. La funcion drawFormseek($n,$lnk)
 *                                      Dibuja form usando hdar para labels y arr para datos a mostrar
 *                                      Tiene boton siguiente y anterior
 *      $n      -> es la posicion del dato a mostrar
 *      $lnk    -> es la accion, ir a un archivo php, llevando el valor de $n como parametro 'mycount'
 *    En el form tenemos <- action="'.$lnk.'&mycount='.($n).'" ->
 *                      Ej: myapp.php?mycount=$n
 * ===================================================================================================
 * Variables: 
 * ---------------------------------------------------------------------------------------------------
 * -. De conexion y construccion:       arr -> contenido, 
 *                                      hdarInarr -> si tiene encabezados en arr, 
 *                                      tpdtarr -> para especificar tipos de datos
 *                                      hdar -> para dar encabezados
 * ---------------------------------------------------------------------------------------------------
 * -. De validacion:                    tpdtarr -> para evaluar el tipo de dato
 *                                      reqar -> define si un campo es requerido
 *                                      unicoSNar -> define si un campo es unico 
 *                                                  (no puede añadir otro igual)
 * ---------------------------------------------------------------------------------------------------
 * -. De informacion:                   cols -> numero de campos de registros
 *                                      filas -> numero de registros
 *                                      hdar -> encabezados o labels de campos
 * ---------------------------------------------------------------------------------------------------
**/
class CMatrizMgr{
    private $arr = array();
    private $ardet = array();
    private $cols;
    private $filas;
    private $hdarInarr;
    private $tpdtarr = array();
    private $hdar = array();
    private $reqar = array();
    private $unicoSNar = array();
    private $tpVarsel = array();
    private $auxArr = array();
    private $sqlTxt;
    // array de tipos de variables MySql, estos datos aun no estan en uso son para la creacion de tablas desde el programa
public $tiposVarsql = array('VARCHAR','INT','REAL','BOOLEAN','YEAR','DATE','TIME','DATETIME','DOUBLE','DECIMAL','BIT','SERIAL','TIMESTAMP','BINARY','VARBINARY','TINYBLOB','TINYTEXT','BLOB','TEXT','MEDIUMBLOB','MEDIUMTEXT','LONGBLOB','LONGTEXT','ENUM','SET');
    // Tipos de variables SQL e información relevante
public $arTpsVar = array('Numéricos', 'Numéricos decimales', 'Fecha y Hora', 'Cadenas', 'Conjuntos');
    // Tipos Numéricos
public $InfoTpsVar = array('M = 0_255, indica el ancho máximo de visualización para los tipos enteros, por defecto es 1.','M = 0_255, indica el ancho máximo de visualización para los tipos enteros, por defecto es 1; D = 0_30, numero de decimales, por defecto es 0.','fsp(fractional seconds storage= 0: 0 bytes; 1,2: 1 byte; 3-4: 2 bytes; 5-6: 3 bytes) = 0_6, la cantidad de números a mostrar en las fracciones de segundos.','M es el numero de caracteres máximo a almacenar. M + 1 = numero de bytes, para mas de 255, se añade otro byte.');
public $TpsVarNum = array('TINYINT(M)', 'SMALLINT(M)', 'MEDIUMINT(M)', 'INT(M)', 'BIGINT(M)');
    // Tipos Numéricos Negativos y Decimales
public $LongTpsVarNum = array('1 byte: 0_255, -128_127', '2 bytes: 0_65.535, -32.768_32.767', '3 bytes: 0_16.777.215, -8.388.608_8.388.607', '4 bytes: 0_4.294.967.295, -2.147.483.648_2.147.483.647');
public $TpsVarNumDec = array('DOUBLE(M:255max,D:30max)', 'DECIMAL(M:65max,D:30max)', 'BIT(M)');
public $LongTpsVarNumDec = array('8 bytes: -1.7976931348623157e+308_-2.2250738585072014e-308, 2.2250738585072014e-308_1.7976931348623157e+308','n bytes: Depende de el valor de M:1_65', '8 bytes: Depende de el valor de M: 1_64');
    // Tipos Hora y Fecha
public $TpsVarDateTime = array('YEAR(4)', 'DATE', 'TIME(fsp)', 'DATETIME(fsp)', 'TIMESTAMP(fsp)');
public $LongTpsVarDateTime = array('1 byte', '3 bytes: 1000-01-01_9999-12-31','3 bytes + fsp: -838:59:59.000000_838:59:59.000000',
    '5 bytes + fsp: 1000-01-01 00:00:00.000000_9999-12-31 23:59:59.999999', '4 bytes + fsp(: 1970-01-01 00:00:01.000000_2038-01-19 03:14:07.999999');
    // Tipos Cadenas
public $TpsVarCadenas = array('CHAR(M)', 'VARCHAR(M)', 'TINYTEXT', 'TEXT(M)', 'MEDIUMTEXT', 'LONGTEXT');
public $LongTpsVarCadenas = array('M bytes: 0_255. Por defecto es 1','M bytes: 0_21.844.','Máximo 255(2e8 − 1) caracteres',
        'M Máximo 65.535(2e16 − 1 caracteres, por defecto 255', 'Máximo 16.777.215(2e24 − 1)', 'Máximo  4.294.967.295(2e32 − 1)');
    // Tipos Conjuntos
public $TpsVarSets = array('ENUM("value1","value2",...)', 'SET("value1","value2",...)');
public $LongTpsVarSets = array('1 or 2 bytes: segun la cantidad de elementos enumerados, máximo 65.535 miembros', 
        '1, 2, 3, 4, or 8 bytes: segun la cantidad de elementos fijados, máximo 64 miembros');
    public function __construct(){}
    public function getfilas(){ return $this->filas; }    
    public function getcols(){ return $this->cols; }   
    public function setdatalist($arr,$ardet){
        if (is_array($arr)){
            $this->arr = $arr;
            $this->filas = count($arr);             // almacena el numero de filas de la matriz o numero de campos de un vector
            if (is_array($ardet)){
                $this->ardet = $ardet;
                $this->cols = count($ardet);             // almacena el numero de filas de la matriz o numero de campos de un vector
            }
        } else {
            $arr = null;
            $this->filas = 0;
        }        
    }
    public function drawlistsel($nt,$lnk,$act,$mn){
        echo '<form class="form" action="'.$lnk.'" method="GET">';
        echo '<fieldset class="pure-group">';
        echo '<select name="listsel" id"listsel">';
        for ($i=0; $i < $this->filas; $i++){
            echo '<option value="'.$i.'">'.$this->arr[$i].'</option>';
        }
        echo "</select><br /><br />";
        echo '<input id="btnenviar" type="submit" class="btn btn-primary" value=" Enviar " />';
        echo '<input type="text" size="auto" name="accion" value="'.$act.'" hidden />';
        echo '<input type="text" size="auto" name="nmtbl" value="'.$nt.'" hidden />';
        echo '<input type="text" size="auto" name="mn" value="'.$mn.'" hidden />';
        //echo '<input type="text" size="auto" name="mycount" value="1" hidden />';
        echo '</fieldset><br />';
        echo '</form>';
    }
    public function drawlistdet($par){
        /*for ($i=0; $i < $this->filas; $i++){
            if ($this->arr[$i] = $par){
                $sel = $this->ardet[$i];
            }
        }*/
        $sel = $this->ardet[$par];
        echo $sel;
    }
    public function setdata($arr,$hdarInarr,$tpdtarr,$hdar,$reqar,$unicoSNar){
        if (is_array($arr)){
            $this->arr = $arr;
            $this->filas = count($arr);             // almacena el numero de filas de la matriz o numero de campos de un vector
        } else {
            $arr = null;
            $this->filas = 0;
        }
        $this->hdarInarr = $hdarInarr;
        // Si trae tipos los carga en $tpdtarr else null
        if (is_array($tpdtarr)){
            $this->tpdtarr = $tpdtarr;
        } else {$tpdtarr = null;}
        // Si trae reqar los carga en $reqar else null
        if (is_array($reqar)){
            $this->reqar = $reqar;
        } else {$reqar = null;}
        // Si trae unicoSNar los carga en $reqar else null
        if (is_array($unicoSNar)){
            $this->unicoSNar = $unicoSNar;
        } else {$unicoSNar = null;}
        /** Si es una matriz almacena las columnas y filas, si es vector filas = 0 y solo colulmnas
        *   Si los encabezados estan en la matriz los almacena en $hdar, si no verifica si se entregaron y carga $hdar, else null
        **/
        $rawd = $arr[0];
        if (is_array($arr[0])){
            $this->cols = count($arr[0]);
            if ($hdarInarr){
                for ($i=0; $i < $this->cols; $i++){
                    $this->hdar[$i] = $rawd[$i];
                }
            } else {
                if (is_array($hdar)){
                    $this->hdar = $hdar;
                } else {$this->hdar = null;}
            }
        } else {
            $this->cols = $this->filas;
            $this->filas = 0;
        }
        $this->cols = count($this->hdar);
    }
    public function drawFormseek($n,$lnk){
        if ((0 >= $n) || ($n < $this->filas)){
            $lclarr = $this->arr[$n];
            echo '<form class="form" action="'.$lnk.'&mycount='.($n).'" method="POST">';
            echo '<fieldset class="pure-group">';
            if ($n == 0){echo '<input type="button" name="atras" value=" Atras " disabled />';}
            else {echo '<input type="submit" name="atras" value=" Atras " />';}
            if (($n+1) == $this->filas){echo '<input type="submit" name="next" value=" Siguiente " disabled />';}
            else {echo '<input type="submit" name="next" value=" Siguiente " />';}
            echo '</fieldset>';
            echo '<fieldset class="pure-group">';
            for ($i=0; $i < $this->cols; $i++){
                echo '<div class="frmhdar">'.str_replace("_"," ",$this->hdar[$i]).'</div>';
                if ($this->hdarInarr){ $lcldata = utf8_encode(strval($lclarr[$i+1])); }
                else { $lcldata = utf8_encode(strval($lclarr[$i])); }
                echo '<input type="text" size="auto" name="'.str_replace(" ","_",$this->hdar[$i]).'" value="'.$lcldata.'" />';
            }
            echo '</fieldset><br>';
            echo '</form>';
            /*echo '<br>'.$this->filas;
            echo '<br>'.$this->cols;
            echo '<br>'.$n;*/
        }
    }
    public function evaltoserver(){
        $cnt = count($this->auxArr);
        $nmtbl = '123';
        for ($i=0; $i < $cnt; $i++){
            if (isset($_POST[$this->auxArr[$i]])) { $nmtbl = $nmtbl.$_POST[$this->auxArr[$i]]; }
        }
        echo $nmtbl;
    }
    public function createTbl($datahd){//,$link,$cnt){
        //if ($cnt == 0){
            $this->sqlTxt = '';
            $this->hdar = explode(",", $datahd);
            $this->cols = count($this->hdar);
        //}
        echo '<h5>Seleccione las caracteristicas de los campos.</h5>';
        echo '<form class="form" method="POST">';// action="'.this->evaltoserver().'" method="GET"
        for ($i=0; $i < $this->cols; $i++){
        echo '<fieldset class="pure-group">';
        echo '<h5>'.$this->hdar[$i].'</h5>';
        $this->auxArr[$i]="seldt'.$i.'";
        echo '<select name="seldt'.$i.'" id"listsel">';
        //if ($cnt == 0){
            $contpar = count($this->tiposVarsql);
            for ($j=0; $j < $contpar; $j++){
                echo '<option value="'.$j.'">'.$this->tiposVarsql[$j].'</option>';
            }
        //}
        echo "</select>";
        echo '</fieldset>';
        }
        $nmtbl='';
        $cnt = count($this->auxArr);
        $nmtbl = '123';
        for ($i=0; $i < $cnt; $i++){
            if (isset($_POST[$this->auxArr[$i]])) { $nmtbl = $nmtbl.$_POST[$this->auxArr[$i]]; }
        }
        echo $nmtbl;
        echo '<br /><input id="btnenviar" onclick=".$this->evaltoserver()" type="button" class="btn btn-primary btn-sm" value=" Enviar " />';
        echo '</form>';
    }
}
?>