<?php
class CobjSQL {
    // array de tipos de variables MySql, estos datos aun no estan en uso son para la creacion de tablas desde el programa
public $tiposVarsql = array('VARCHAR','INT','REAL','BOOLEAN','YEAR','DATE','TIME','DATETIME','DOUBLE','DECIMAL','BIT','SERIAL','TIMESTAMP','BINARY','VARBINARY','TINYBLOB','TINYTEXT','BLOB','TEXT','MEDIUMBLOB','MEDIUMTEXT','LONGBLOB','LONGTEXT','ENUM','SET');    
    // Grupos tipos de variables SQL e información relevante
public $arTpsVar = array('Numericos', 'Numericos decimales', 'Fecha y Hora', 'Cadenas', 'Conjuntos');    
public $InfoTpsVar = array('M = 0_255, indica el ancho máximo de visualización para los tipos enteros, por defecto es 1.','D = 0_30, numero de decimales, por defecto es 0.','fsp(fractional seconds storage= 0: 0 bytes; 1,2: 1 byte; 3-4: 2 bytes; 5-6: 3 bytes) = 0_6, la cantidad de números a mostrar en las fracciones de segundos.','M es el numero de caracteres máximo a almacenar. M + 1 = numero de bytes, para mas de 255, se añade otro byte.','');    
    // Tipos Numericos e información relevante
public $TpsVarNum = array('TINYINT(M)', 'SMALLINT(M)', 'MEDIUMINT(M)', 'INT(M)', 'BIGINT(M)');
public $LongTpsVarNum = array('1 byte: 0_255, -128_127', '2 bytes: 0_65.535, -32.768_32.767', '3 bytes: 0_16.777.215, -8.388.608_8.388.607', '4 bytes: 0_4.294.967.295, -2.147.483.648_2.147.483.647', '-9223372036854775808 hasta 9223372036854775807, 0 hasta 18446744073709551615');
    // Tipos Numericos decimales e información relevante
public $TpsVarNumDec = array('DOUBLE(M:255max,D:30max)', 'DECIMAL(M:65max,D:30max)', 'BIT(M)');
public $LongTpsVarNumDec = array('8 bytes: -1.7976931348623157e+308_-2.2250738585072014e-308, 2.2250738585072014e-308_1.7976931348623157e+308','n bytes: Depende de el valor de M:1_65', '8 bytes: Depende de el valor de M: 1_64');
    // Tipos Fecha y Hora e información relevante
public $TpsVarDateTime = array('YEAR(4)', 'DATE', 'TIME(fsp)', 'DATETIME(fsp)', 'TIMESTAMP(fsp)');
public $LongTpsVarDateTime = array('1 byte', '3 bytes: 1000-01-01_9999-12-31','3 bytes + fsp: -838:59:59.000000_838:59:59.000000',
    '5 bytes + fsp: 1000-01-01 00:00:00.000000_9999-12-31 23:59:59.999999', '4 bytes + fsp(: 1970-01-01 00:00:01.000000_2038-01-19 03:14:07.999999');
    // Tipos Cadenas e información relevante
public $TpsVarCadenas = array('CHAR(M)', 'VARCHAR(M)', 'TINYTEXT', 'TEXT(M)', 'MEDIUMTEXT', 'LONGTEXT');
public $LongTpsVarCadenas = array('M bytes: 0_255. Por defecto es 1','M bytes: 0_21.844.','Máximo 255(2e8 − 1) caracteres',
        'M Máximo 65.535(2e16 − 1 caracteres, por defecto 255', 'Máximo 16.777.215(2e24 − 1)', 'Máximo  4.294.967.295(2e32 − 1)');
    // Tipos Conjuntos e información relevante
public $TpsVarSets = array('ENUM("value1","value2",...)', 'SET("value1","value2",...)');
public $LongTpsVarSets = array('1 or 2 bytes: segun la cantidad de elementos enumerados, máximo 65.535 miembros', 
        '1, 2, 3, 4, or 8 bytes: segun la cantidad de elementos fijados, máximo 64 miembros');
    public function __construct(){}
    public function dothis($fl,$do,$nmtbl){
        if ($do == 'crea'){
            if ($fp = fopen($fl, "w")){
                fwrite($fp, $nmtbl. PHP_EOL);
                fclose($fp);
                echo '<script>La tabla se creo exitosamente.</script>';
                $this->drawSimplFrm('Digite los encabezados para la tabla separados por comas','myapp.php?mn=5&accion=creatbllgway&n=1','nmtbl','Enviar');
            }
        }
        if ($do == 'addyln'){
            if ($fp = fopen($fl, "a+")){
                fwrite($fp, $nmtbl. PHP_EOL);
                fclose($fp);
                echo '<script>Se agrego el dato correctamente</script>';
            }
        }
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
                    if ($i==2){$ln=$line; fseek($fp, SEEK_END);}
                }
            }
            return $ln;
        }
    }
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
    } // Funcion auxiliar que muestra formulario Simple con
    public function drawFrmAttr($fl,$n,$lnk){
        $ar = $this->arTpsVar;
        $hdst = $this->dothis($fl,'readhd','');
        $hdar = explode(",",$hdst);
        $cols = count($hdar);
        echo '<h5>Seleccione las caracteristicas de los campos.</h5>';
        echo '<form class="form pure-group" action="'.$lnk.'" method="POST">';// action="'.this->evaltoserver().'" method="GET"
        echo '<fieldset class="pure-group">';
        echo '<h5>'.$hdar[$n].'</h5>';
        echo '<select name="listsel" id"listsel">';
        //if ($cnt == 0){
        $contpar = count($ar);
        for ($j=0; $j < $contpar; $j++){
            echo '<option value="'.$ar[$j].'">'.$ar[$j].'</option>';
        }
        //}
        echo "</select>";
        echo '<br><b>Admite nulo:  </b><input type="checkbox" name="sn" value="NOT NULL">';
        echo '<br /><input input type="button" id="btnsgt" onclick="'."shwelmntbyid('at2')".'"  class="btn btn-primary btn-sm" value=" Siguiente " />';
        echo '</fieldset>';
        echo '<fieldset class="pure-group">';
        echo '<div class="container p-3 my-3 bg-primary border text-light" id="at1">';
        echo $this->drwnextinfo();
        echo '</div>';
        echo '</fieldset>';
        echo '<br /><input id="btnenviar" type="submit"  class="btn btn-primary btn-sm" value=" Enviar " hidden/>';
        echo '</form><br />';
        echo '<div class="container p-3 my-3 bg-primary border text-light" id="at2" hidden>';
        echo $this->drwnextsel();
        echo $this->drwnextinfo();
        echo '</div><br />';
    }
    public function drwnextsel(){
        echo 'work';
    }
    public function drwnextinfo(){
        $cols = count($this->InfoTpsVar);
        echo '<div class="container p-3 my-3 bg-primary border text-light">';
        for ($i=0; $i < $cols; $i++){
            echo '<div class="row">';
            echo '<div class="col-sm-3">'.$this->arTpsVar[$i].'<br>'.$this->InfoTpsVar[$i].'</div><div class="col-sm-3">';
            if ($i==0){
                $lng = count($this->TpsVarNum);
                for ($j=0; $j < $lng; $j++){
                    echo $this->TpsVarNum[$j].'<br>';
                }
            }
            if ($i==1){
                $lng = count($this->TpsVarNumDec);
                for ($j=0; $j < $lng; $j++){
                    echo $this->TpsVarNumDec[$j].'<br>';
                }
            }
            if ($i==2){
                $lng = count($this->TpsVarDateTime);
                for ($j=0; $j < $lng; $j++){
                    echo $this->TpsVarDateTime[$j].'<br>';
                }
            }
            if ($i==3){
                $lng = count($this->TpsVarCadenas);
                for ($j=0; $j < $lng; $j++){
                    echo $this->TpsVarCadenas[$j].'<br>';
                }
            }
            if ($i==4){
                $lng = count($this->TpsVarSets);
                for ($j=0; $j < $lng; $j++){
                    echo $this->TpsVarSets[$j].'<br>';
                }
            }
            echo '</div><div class="col-sm-6">';
            if ($i==0){
                $lng = count($this->LongTpsVarNum);
                for ($j=0; $j < $lng; $j++){
                    echo $this->LongTpsVarNum[$j].'<br>';
                }
            }
            if ($i==1){
                $lng = count($this->LongTpsVarNumDec);
                for ($j=0; $j < $lng; $j++){
                    echo $this->LongTpsVarNumDec[$j].'<br>';
                }
            }
            if ($i==2){
                $lng = count($this->LongTpsVarDateTime);
                for ($j=0; $j < $lng; $j++){
                    echo $this->LongTpsVarDateTime[$j].'<br>';
                }
            }
            if ($i==3){
                $lng = count($this->LongTpsVarCadenas);
                for ($j=0; $j < $lng; $j++){
                    echo $this->LongTpsVarCadenas[$j].'<br>';
                }
            }
            if ($i==4){
                $lng = count($this->LongTpsVarSets);
                for ($j=0; $j < $lng; $j++){
                    echo $this->LongTpsVarSets[$j].'<br>';
                }
            }
            echo '</div>';
            echo '</div><hr>';
        }
        echo '</div><br />';
    }
    public function readfilenln($file,$nln){
        $i=0;
        $ln='';
        if ($fp = fopen($file, "r")){
            $original = ini_get("auto_detect_line_endings");
            ini_set("auto_detect_line_endings", true);
            $handle = fopen($file, "r");
            ini_set("auto_detect_line_endings", $original);
            while (($line = fgets($handle)) !== false) { 
                $i++;
                if ($i==$nln){
                    $ln=$line;
                    fseek($fp, SEEK_END);
                }
            }
        }
        return $ln;
    }
    public function formSel($ar,$nt,$n,$lnk){
        $hdar = explode(",",$nt);
        $cols = count($hdar);
        echo '<h5>Seleccione las caracteristicas de los campos.</h5>';
        echo '<form class="form pure-group" action="'.$lnk.'" method="POST">';// action="'.this->evaltoserver().'" method="GET"
        echo '<fieldset class="pure-group">';
        echo '<h5>'.$hdar[$n].'</h5>';
        echo '<select name="listsel" id"listsel">';
        //if ($cnt == 0){
        $contpar = count($ar);
        for ($j=0; $j < $contpar; $j++){
            echo '<option value="'.$ar[$j].'">'.$ar[$j].'</option>';
        }
        //}
        echo "</select>";
        echo '</fieldset>';
        echo '<br /><input id="btnenviar" type="submit"  class="btn btn-primary btn-sm" value=" Enviar " />';
        echo '</form>';
    }

    public function rtrArbySel($sel){
        echo $sel;
        $arrRtrn = array('LG','wtf');
        if (utf8_encode($sel) == utf8_encode('Numericos')){ $arrRtrn = $this->TpsVarNum;}
        if (trim(utf8_encode($sel)) == trim(utf8_encode('Fecha y Hora'))){ $arrRtrn = $this->TpsVarDateTime;}
        if (utf8_encode($sel) == 'Cadenas'){ $arrRtrn = $this->TpsVarCadenas;}
        if (utf8_encode($sel) == 'Conjuntos'){ $arrRtrn = $this->TpsVarSets; }
        echo $sel.implode($arrRtrn);
        return $arrRtrn;
    } // Procedimiento auxiliar para adinfo retorna array segun $sel

    public function addInfo($fl,$n,$coln,$nmtbl){
        $hdst = $this->dothis($fl,'readhd','');
        $hdarlcl = explode(',',$hdst);
        $cols = count($hdarlcl);
        if ($n == 1){
            if ($cols-1 >= $coln){
                if ($cols-1 > $coln){
                    if ($coln > 1){$this->dothis($fl,'add',$nmtbl.',');}
                    $this->formSel($this->arTpsVar,$hdst,($coln-1),"myapp.php?mn=5&mycount=0&accion=creatbllgway&n=2&coln=".$coln++);
                } else {
                    if ($coln > 1){$this->dothis($fl,'addyln',$nmtbl);}
                    $this->formSel($this->arTpsVar,$hdst,($coln-1),"myapp.php?mn=5&mycount=1&accion=creatbllgway&n=2&coln=0");
                }
                $this->drwnextinfo();
            }
            echo $cols.'beguin step coln  '.$coln.' cols '.$cols;
        }
        if ($n == 2){
            if ($coln == ($cols+1)){
                $this->dothis($fl,'addyln',$nmtbl);
                $coln++;
            }
            $DtVar = $this->readfilenln($fl,3);
            $tpVarrI = explode(',',$DtVar);
            if ($cols-1 >= $coln){$sel = $tpVarrI[$coln-1];}
            //else {$sel = $tpVarrI[$coln-2];}
            // Asigna array segun tipo
            $arSel = $this->rtrArbySel($sel);
            if ($cols >= $coln){
                if ($cols-1 < $coln){
                    $arSel = $this->arTpsVar;
                    if ($coln > 1){$this->dothis($fl,'add',$nmtbl.',');}
                    $this->formSel($arSel,$hdst,($coln-1),"myapp.php?mn=5&mycount=1&accion=creatbllgway&n=2&coln=".$coln++);
                } else {
                    $arSel = $this->arTpsVar;
                    if ($coln > 1){$this->dothis($fl,'addyln',$nmtbl);}
                    $this->formSel($arSel,$hdst,($coln-1),"myapp.php?mn=5&mycount=2&accion=creatbllgway&n=2&coln=0");
                }
            }
            echo implode($arSel).'  beguin the second step  -'.$sel.'-  coln  '.$coln.' cols '.$cols.'-'.$DtVar;
        }
        if ($n == 3){
             if ($coln == ($cols+1)){
                $this->dothis($fl,'addyln',$nmtbl);
                $coln++;
            }
            $tpVarrI = $this->readfilenln($fl,3);
            $tpDtVar = $tpVarrI[$coln];
            $arSel = $this->rtrArbySel($tpDtVar);
            $coln++;
            echo 'beguin the third step  ';
        }
    }
    // Funcion para depurar en php 
    public function console_log( $data ){
        echo '<script>';
        echo 'console.log('. json_encode( $data ) .')';
        echo '</script>';
    }
}
?>