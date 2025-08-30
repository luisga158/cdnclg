<?php
class CobjPhpWrt {
    public function __construct(){}
    public function inimenulatder($id, $link, $lnkimg, $ttl){
        if ($link != '') { $aref = '<a href="'.$link.'">'; }
        else if ($id != '') { $aref = '<a id="'.$id.'">'; }
        else { $aref = '<a href="#">'; }        
        echo '<div class="boton_share_contain">';
        echo $aref;
        echo '<img class="img_share" src="'.$lnkimg.'" alt=".$ttl." title="'.$ttl.'" /></a>';
    }/* funcion que dibuja el inicio del menu lateral derecho con su primer o unico boton */
    public function addiconmenulatderoc($id, $link, $lnkimg, $ttl, $onclk){
        if ($link != '') { $aref = '<a href="'.$link.'">'; }
        else { $aref = '<a href="#">'; }
        echo '<div style="position: relative; margin-top: 10px;">';
        echo $aref;
        if ($onclk != '') {echo '<img class="img_share" type="button" onclick ="'.$onclk.'" src="'.$lnkimg.'" alt="'.$ttl.'" title="'.$ttl.'" /></a><br/></div>';}
        else { echo '<img class="img_share" src="'.$lnkimg.'" alt="'.$ttl.'" title="'.$ttl.'" /></a><br/></div>';}
    } /* Ampliando la funcion anterior para usar onclik ademas de link */
    public function menusider($n,$arrmnlatderoc){
        $araux = $arrmnlatderoc[0];
        $this->inimenulatder($araux[0],$araux[1],$araux[2],$araux[3]);
        $araux = $arrmnlatderoc[1];
        $this->addiconmenulatderoc($araux[0],$araux[1],$araux[2],$araux[3],$araux[4]);
        if ($n == 0) {$araux = $arrmnlatderoc[2];}
        if (($n == 5) ||($n == 6)) {$araux = $arrmnlatderoc[3];}
        $this->addiconmenulatderoc($araux[0],$araux[1],$araux[2],$araux[3],$araux[4]);
        echo '</div>';
    } /* funcion que dibuja el menu lateral derecho segun el valor de $n */
    public function Inihtmlg($arhtmlI,$tiTle,$icoLnk){
        $lng = count($arhtmlI);
        $rtr = '';
        for ($i=0; $i < $lng; $i++){
            $rtr = $rtr.$arhtmlI[$i];
        }
        $rtr = $rtr.'<title>'.$tiTle.'</title>';
        $rtr = $rtr.'<link href='.$icoLnk.' rel="shortcut icon" />';
        return $rtr;
    } /* */
    //                                                      Funcion que retorna el codigo html de un metadato
    public function MetaDataWrt($tplbl,$lbl,$cont){
        $metaln = '<meta '.$tplbl.'="'.$lbl.'" content="'.$cont.'" />';
        return $metaln;
    }
    //                                                      Funcion que retorna el codigo html de una linea css o script de librerias js
    public function CssScrWrt($tp,$lnk){
        if ($tp == 'css') {$rtrnln = '<link rel="stylesheet" href="'.$lnk.'">'; }
        if ($tp == 'js') {$rtrnln = '<script src="'.$lnk.'"></script>'; }
        return $rtrnln;
    }
    public function RtrnArConthtmlI($ar,$op){
        $lng = count($ar);
        $rtr = '';
        if ($op == 1){ for ($i=0; $i < $lng; $i++){ $rtr = $rtr.$ar[$i]; } } /* para codigo completo */
        if ($op == 2){ for ($i=0; $i < $lng; $i++){ $rtr = $rtr.$this->CssScrWrt('js',$ar[$i]); } } /* para js */
        if ($op == 3){ for ($i=0; $i < $lng; $i++){ $rtr = $rtr.$this->CssScrWrt('css',$ar[$i]); } } /* para css */
        return $rtr;
    }
    // funcion que devuelve el contenido del array bidimensional unido, para el caso codigo html, segun la opcion
    public function RtrnArConthtmlII($ar,$op){
        $lng = count($ar);
        $rtr = '';
        if /* para metadatos */ ($op == 1){ 
            for ($i=0; $i < $lng; $i++){
                $araux = $ar[$i];
				$rtr = $rtr.$this->MetaDataWrt($araux[0],$araux[1],$araux[2]);
            } 
        }
        return $rtr;
    }
    public function IniPageNoBodyBgn($arhtml,$arMtDt){
        $arhtmlI = $arhtml[0];
        $ardtejI = $arhtml[1];
        $arLchS = $arhtml[2];
        $arCss = $arhtml[3];
        $arScr = $arhtml[4];
        echo $this->Inihtmlg($arhtmlI,$ardtejI[0],$ardtejI[1]);
        echo $this->RtrnArConthtmlI($arLchS,1);
        echo $this->RtrnArConthtmlII($arMtDt,1);
        echo $this->RtrnArConthtmlI($arScr,2);
        echo $this->RtrnArConthtmlI($arCss,3);
        echo '</head>';
    }
    public function IniPage($arhtml,$arMtDt){
        $arhtmlI = $arhtml[0];
        $ardtejI = $arhtml[1];
        $arLchS = $arhtml[2];
        $arCss = $arhtml[3];
        $arScr = $arhtml[4];
        echo $this->Inihtmlg($arhtmlI,$ardtejI[0],$ardtejI[1]);
        echo $this->RtrnArConthtmlI($arLchS,1);
        echo $this->RtrnArConthtmlII($arMtDt,1);
        echo $this->RtrnArConthtmlI($arScr,2);
        echo $this->RtrnArConthtmlI($arCss,3);
        echo '</head>';
        echo '<body id="bodyid">';
    }
    public function drawSimplFrm($ttl,$lnk,$dat,$nmbtn){
        echo '<h5>'.$ttl.'</h5>';
        echo '<form class="form pure-group" action="'.$lnk.'" method="POST">';
        //echo '<form class="form" id="form" action="'.$lnk.'">';
        echo '<fieldset class="pure-group">';
        echo '<input type="text" maxlength="200" id="'.$dat.'" name="'.$dat.'" size="auto" autofocus />';
        //echo '<input name="'.$nmbtn.'" type="submit" value=" '.$nmbtn.' " tabindex="2"  />';
        echo '</fieldset>';
        echo '<br><input class="btn btn-success btn-sm" id="btnenviar" type="submit" value=" '.$nmbtn.' " tabindex="2" />';
        echo '</form>';
    }
    public function drwWTxtBtnCerrarBtstrp($txt){
        echo '<head>';
        echo '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';
        echo '<script src="../lib/functions.js"></script>';
        echo '</head>';
        echo '<body>';
        echo '<div class="container-sm" style="padding: 1vh 10vw 1vh 3vw;" id="maincontainer">';
        echo '<div class="container p-3 my-3 bg-primary text-light border" id="capan">';
        echo '<b>'.$txt.'<b>';
        echo '</div>';
        echo '<a type="button" class="btn btn-danger btn-sm" href="javascript:window.close();">Cerrar Ventana</a>';
        echo '</div>';
        echo '</body>';
    }
    /* Para dibujar datos con formatos */
    public function showListobjdb($ardata,$artblsdb){
        echo '<select name="listdblcl">';    
        $i=0;
        foreach ($ardata as &$valor){
            echo '<option value="'.$i.'">'.$valor.'</option>';
            $i++;
        }
        echo "</select><br />";
        echo '<select name="listdblcl">';    
        $i=0;
        foreach ($artblsdb as &$valor){
            echo '<option value="'.$i.'">'.$valor.'</option>';
            $i++;
        }
        echo "</select><br />";
    } // Dibuja las listas para cuando no se da un nombre de tabla
    public function showTbl($arhd,$ardata,$cantrows){
        if ($cantrows > 0){
            echo "<table>
            <tr>";
            $longitud = count($arhd);
            for ($i=0; $i < $longitud; $i++){
                echo '<th>'.$arhd[$i].'</th>';
            }
            $rawr = $ardata;
            echo "</tr>";
            // datos de tabla
            for ($j=0; $j < $cantrows; $j++){
                $rawd = $rawr[$j];
                echo "<tr>";
                for ($i=0; $i < $longitud; $i++){
                    echo "<td>" .utf8_encode($rawd[$i]). "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
            echo "<br />";
        }
    } // Dibuja una tabla con los encabezados arhd, el contenido ardata y el numero de filas cantrows
    public function FormDosLsts($ttl,$nmbtn,$option,$action,$txtaction,$lnk){
        echo '<div class="container">';
        echo '<h5>'.$ttl.'</h5>';
        echo '<form class="form" action="'.$lnk.'" method="POST">';
        echo '<div class="form-group">';
        echo '<select name="nmtbl" tabindex="1" autofocus >';
        foreach ($option as &$valor){
            echo '<option value="'.$valor.'" name="tablesel">'.$valor.'</option>';
        }
        echo "</select>";
        echo '</div>';
        echo '<div class="form-group">';
        echo '<select name="accion" tabindex="2">';
        $i = 0;
        foreach ($txtaction as &$valor){
            echo '<option value="'.$action[$i].'" name="accionsel">'.$valor.'</option>';
            $i++;
        }
        echo "</select>";
        echo '</div>';
        echo '<input type="submit" class="btn btn-success btn-sm" tabindex="3" value=" '.$nmbtn.' " />';
        echo '</form>';
        echo '</div>';
    } // Dibuja formulario con titulo $ttl, nombre de boton $nmbtn, dos listas para seleccionar $option $action para enviar via post como nmtbl y accion, a $link
    /* Para dibujar formularios con tipos de campo */
    /** Para dibujar formularios:
        1.1.- Draw dataLst, es uno de los tipos de datos que se pueden dibujar en un form. Permite definir las opciones con $arlist.
        $nmlst define el nombre de la lista (header in table) y $txtin el placehlder o texto que se muestra en el campo
        $pos es el index del campo de ser 1 le atribuye autofocus.
    **/ // Dibuja lista
    public function dataLst($arlist,$nmlst,$txtin,$pos){
        $lnglst = count($arlist);
        if ($pos==1) {
            echo '<input list="'.$nmlst.'" name="'.$nmlst.'" tabindex="'.$pos.'" type="text" placeholder="'.$txtin.'" autofocus>';
        } else {
            echo '<input list="'.$nmlst.'" name="'.$nmlst.'" tabindex="'.$pos.'" type="text" placeholder="'.$txtin.'">';
        }
        echo '<datalist id="'.$nmlst.'">';
        for($i=0; $i<$lnglst; $i++){
            echo '<option value="'.$arlist[$i].'"></option>';
        }
        echo '</datalist>';
    }
    /* 1.2.- Draw field de frm con tipo, Funcion auxiliar para drawFormdtTypes, que dibuja un campo de tipo $tpdt, que llena con $dtfill,
        y según $atfill, dandole valor a tabindex segun $pos y con el nombre $nm. 
        Si $atfill es 'readonly' no permite modificar el dato del campo (No aplica para datalist) 
    Tipos definidos 'tpter','tpdocar','numero','texto','tels','mail','dir','pais','city','verify' */ // Dibuja segun tipo
    public function darwTpField($tpdt,$dtfill,$atfill,$pos,$nm){
        switch ($tpdt){
            case 'tpter': 
                $this->dataLst($this->tpper,$nm,$dtfill,$pos);
                break;
            case 'tpdocar': 
                $tpdocarin = array();
                $auxrow = array();
                $lng = count($this->tpdocar);
                for ($i=0; $i<$lng; $i++) {
                    $auxrow = $this->tpdocar[$i]; 
                    $tpdocarin[$i] = $auxrow[0];
                }
                $this->dataLst($tpdocarin,$nm,$dtfill,$pos);
                break;                
            case 'numero': 
                echo '<input type="text" size="auto" name="'.$nm.'" value="'.utf8_encode($dtfill).'" tabindex="'.$pos.'" />';
                break;
            case 'texto': 
                echo '<input type="text" size="auto" name="'.$nm.'" value="'.utf8_encode($dtfill).'" tabindex="'.$pos.'" />';
                break;
            case 'mail': 
                echo '<input type="text" size="auto" name="'.$nm.'" value="'.utf8_encode($dtfill).'" tabindex="'.$pos.'" />';
                break;
            case 'city':
                if (is_numeric($dtfill)){$dtfill=$this->cityNm[array_search($dtfill, $this->cityCd)];}
                $this->dataLst($this->cityNm,$nm,$dtfill,$pos);
                break;
            case 'verify': 
                echo '<input type="checkbox" size="auto" name="'.$nm.'" value="1" tabindex="'.$pos.'" />';
                break;  
        }        
    }    
    /* $tblfill array con datos para autofill y $tblfillat array con atributos para los datos
    ***** usando los datos de $tbldet puede identificar los tipos de datos almacenados en $arcoldttipe
    **
    *   IMPORTANTE: $tblfill y $tblfillat, deben tener tantos datos como la tabla actual
    *       $tbldet, debe contener todos los encabezados de la tabla actual en la primera columna
    *       y una fila inicial con encabezados, usada para relacionar con otras tablas.
    **
    **** 1.- Para dibujar formulario con campos segun tipos             */ // Dibuja formulario con tipos de datos
    public function drawFormdtTypes($tblfill,$tblfillat,$tbldet){
        $rowdet = array();
        $tipodato = '';
        $auxhd = '';
        echo '<p><span class="error">* campo requerido</span></p>';
        echo '<form class="form" action="php/enviar.php" method="POST">';
        echo '<fieldset class="pure-group">';
        $setautofocus = false;
        $longitud = count($this->hddata);
        for ($i=0; $i < $longitud; $i++){
            if (!(in_array($this->hddata[$i], $this->arcolno))) {  // si el encabezado no esta en arcolno dibuja campo                <---
                $rowdet = $tbldet[$i+1];   // rowdet toma de tbldet menos el titulo, y si esta en arcolno salta, ya que no entra por if > |
                $tipodato = $rowdet[2];     // tipodato, la columna 2 debe contener el tipo de dato, segun $arcoldttipe
                $nullsn = $rowdet[1];     // si es requerido, la columna 1 'null' debe contener no
                if ($nullsn == 'no') { echo '<h5>'.str_replace("_"," ",$this->hddata[$i]).' <span class="error">* campo requerido</span></h5>'; }
                else { echo '<h5>'.str_replace("_"," ",$this->hddata[$i]).'</h5>'; }// encabezado segun tbl
                $auxhd = $this->hddata[$i]; // Nombre del encabezado actual
                /* En la siguiente funcion se entrega $tipodato de $tbldet, $tblfill[$i] = Cont.p/fill field con atributo en $tblfillat[i] 
                    y $auxhd que es el encabezado actual y unica variable local, ademas de determinar el $i max. y dependiente de tblnm.
                ** Las otras tres son dependientes de los parametros entregados. Con los cuales hay que ser muy cuidadoso o fallará 
                ***** Ver ej. de $tbldet en los comentarios para formularios */
                $this->darwTpField($tipodato,$tblfill[$i],$tblfillat[$i],$i,$auxhd);    // darwTpField($tpdt,$dtfill,$atfill,$pos,$nm) funcion proces data type
            }
        }
        echo '</fieldset>';
        echo '<input type="text" size="auto" name="tablenm" value="'.$this->tablenm.'" hidden />';
        echo '<input type="text" size="auto" name="action" value="grabar" hidden />';
        echo '<br><input type="submit" value=" Enviar " tabindex="'.$i.'"  />';
        echo '</form>';
    }
}
?>