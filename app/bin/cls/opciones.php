<?php
include_once("../clases/conexion.class.php");
$objClase=new DBManager;
//print_r   ($_POST);
if(isset($_POST["accion"])){
   $accion = $_POST["accion"];
   $condicion = $_POST["condicion"];
   
    if ($accion=='terceros'){
        if($objClase->conectar()==true){
            $sql = "SELECT terceroId, terceroNombre".
            " FROM contaterceros  WHERE " . $condicion .
            "  ORDER BY terceroNombre"; 
             $result = mysql_query($sql);
            $tercero = '<option value="0">Seleccione un registro</option>';
            while($row = mysql_fetch_array($result))
            {
                $tercero .= '<option value="' . $row['terceroId'] . '">' . $row['terceroNombre'] . '</option>';
            }
            echo $tercero;
            return $tercero;
        }else{echo 'no hay connexion a la BD';}
    }
    
    if ($accion=='centroAdmin'){
        if($objClase->conectar()==true){
            $sql = "'SELECT centroadmId, centroadmNombre ".
            " FROM contacentroadmin WHERE " . $condicion . " AND centroadmActivo = 'A'" .
            " ORDER BY centroadmNombre"; 
             $result = mysql_query($sql);
              $puc = "<SELECT name='selCadmin' id='selCadmin' class='tip' >";
            $puc .= '<option value="0">Seleccione un centro</option>';
                        while($row = mysql_fetch_array($result))
            {
                $puc .= '<option value="' . $row['centroadmId'] . '">' . $row['centroadmNombre'] . '</option>';
            }
             $puc .= "</SELECT>";
            return $centroadm;
        }else{echo 'no hay connexion a la BD';}
    }
    
        if ($accion=='puc'){
        if($objClase->conectar()==true){
            $sql = "SELECT pucCuenta As Cuenta, CONCAT(pucCuenta, ' - ', pucNombre) As Nombre ".
                   " FROM contaplancontable WHERE " . $condicion . " AND pucActivo ='A' AND pucTipo ='M' ORDER BY pucCuenta"; 
             $result = mysql_query($sql);
              $puc = "<SELECT name='selCuenta' id='selCuenta' class='tip' >";
            $puc .= '<option value="0">Seleccione una  cuenta</option>';
            while($row = mysql_fetch_array($result))
            {
                $puc .= '<option value="' . $row['Cuenta'] . '">' . $row['Nombre'] . '</option>';
            }
             $puc .= "</SELECT>";
            echo $puc;
            return $puc;
        }else{echo 'no hay connexion a la BD';}
    }
    
        if ($accion=='ccosto'){
        if($objClase->conectar()==true){
            $sql = "SELECT  centrocostoId,  centrocostoDetalle FROM contacentrocosto ".
                   " INNER JOIN contacadminccosto ON centrocostoId =  cadminccostocCosto ".
                    " WHERE " . $condicion . " AND centrocostoActivo = 'A'" . 
            " ORDER BY centrocostoDetalle"; 
       //   echo $sql;
             $result = mysql_query($sql);
            $puc = "<SELECT name='selCcosto' id='selCcosto' class='tip' >";
            $puc = '<option value="0">Seleccione un centro</option>';
            while($row = mysql_fetch_array($result))
            {
                $puc .= '<option value="' . $row['centrocostoId'] . '">' . $row['centrocostoDetalle'] . '</option>';
            }
            $puc .= "</SELECT>";
            echo $puc;
            return $puc;
        }else{echo 'no hay connexion a la BD';}
    }
    
    
    if ($accion == 'GrabarCabeza')
          {
        $clasesIncludes = "../clases/clscontamovicabeza.php";
        include_once ($clasesIncludes);
        $obj = new contamovicabeza();
           $data = explode('||', $condicion);
           $registro = Array("movicaEmpresaId" => $data[0], "movicaComprId" => $data[1], "movicaCompNro" => $data[2], "movicaTerceroId" => $data[3], "movicaDetalle" => $data[4],
                "movicaProcesado" => $data[5], "movicaFecha" => $data[6], "movicaPeriodo" => $data[7], "movicaId"=> $data[8], 
                 "movicaDocumPpal" => $data[9], "movicaDocumSec" => $data[10]);
          $result = $obj->actualizacontamovicabeza($registro);
          echo $result;
          return $result;
          }

    if ($accion == 'actualizacontaplancontable'){
        $clasesIncludes = "../clases/clscontaplancontable.php";
        include_once ($clasesIncludes);
        $obj = new contaplancontable();
           $data = explode('||', $condicion);
           $registro = Array("pucId" => $data[0], "pucEmpresaId" => $data[1], "pucCuenta" => $data[2], "pucMayor" => $data[3], "pucNombre" => $data[4],
                "pucNivel" => $data[5], "pucTipo" => $data[6], "pucActivo" => $data[7], "pucClase"=> $data[8], 
                 "pucValor" => $data[9]);
         $resultado= $obj->actualizacontaplancontable($registro);
           echo $resultado;
          }
    
        if($accion == 'recuperaCabeza'){
            $clasesIncludes = "../clases/clscontamovicabeza.php";
            include_once ($clasesIncludes);
            $obj = new contamovicabeza();
            $data = explode('||', $condicion);  
            $resultado=$obj->recuperaUnContamovicabeza($data[0], $data[1])  ;
            echo $resultado;
            return $resultado;
        }
          
      if ($accion == 'leeGrillaOperaciones')
          {
            $clasesIncludes = "../clases/clscontaoperacionesdef.php";
            include_once ($clasesIncludes);
            $obj = new contaoperacionesdef();
               $data = explode('||', $condicion);
            $resultado= $obj->recupera_contaoperaciones_rep($data[0], $data[1], $data[2], $data[3], $data[4]);
            return $resultado;
          }

    if ($accion == 'leeOperaciones')
          {
            $clasesIncludes = "../clases/clscontaoperacionesdef.php";
            include_once ($clasesIncludes);
            $obj = new contaoperacionesdef();
            $data = explode('||', $condicion);
            $resultado= $obj->leeOperacionesGrilla($data[0]);
            echo $resultado;
          }          
 
    if ($accion == 'capturaOperaciones')
          {
            $clasesIncludes = "../clases/clscontaoperacionesdef.php";
            include_once ($clasesIncludes);
            $obj = new contaoperacionesdef();
            $data = explode('||', $condicion);
            $resultado= $obj->capturaOperaciones($data[0],$data[1]);
            echo $resultado;
          } 
          
 
    if ($accion == 'capturaOperacionesCorto')
          {
            $clasesIncludes = "../clases/clscontaoperacionesdef.php";
            include_once ($clasesIncludes);
            $obj = new contaoperacionesdef();
            $data = explode('||', $condicion);
            $resultado= $obj->capturaOperacionesCorto($data[0],$data[1]);
            echo $resultado;
          }           
          
       if ($accion == 'borraRegOperaciones')
          {
            $clasesIncludes = "../clases/conexion.class.php";
            include_once ($clasesIncludes);
            $obj = new DBManager();
               $data = explode('||', $condicion);
            $resultado= $obj->eliminar('contaoperacionesdef', 'operDefId' ,  $data[0]);
            return $resultado;
          }       

        if ($accion == 'recuperaClave')
          {
            $clasesIncludes = "../clases/conexion.class.php";
            include_once ($clasesIncludes);
            $obj = new DBManager();
            $data = explode('||', $condicion);
            $resultado= $obj->actualizaClaveRapido($data[0],$data[1],$data[2]);
            return $resultado;
          }
          
       if ($accion == 'leeEmpresa')
          {
            $clasesIncludes = "../clases/conexion.class.php";
            include_once ($clasesIncludes);
            $obj = new DBManager();
            $data = explode('||', $condicion);
         
            $result= $obj->leeParametros($data[0]);
            while($row = mysql_fetch_assoc($result))
            {
                 $resultado=$row['empresaPeriodoActual']; 
            }
            echo $resultado;
          }           
          
          
       if ($accion == 'leePeriodo')
          {
            $clasesIncludes = "../clases/conexion.class.php";
            include_once ($clasesIncludes);
            $obj = new DBManager();
            $data = explode('||', $condicion);
            $result= $obj->leeParametros($data[0]);
            while($row = mysql_fetch_array($result))
            {
                 $resultado=$row['empresaPeriodoActual']; 
            }
            echo $resultado;
          }            
   if ($accion == 'GrillaCabezaMovi')
          {
        $clasesIncludes = "../clases/clscontamovicabeza.php";
        include_once ($clasesIncludes);
        $obj = new contamovicabeza();
           $data = explode('||', $condicion);
           $registro = Array("movicaEmpresaId" => $data[0], "movicaComprId" => $data[1], "movicaCompNro" => $data[2], "movicaTerceroId" => $data[3], "movicaDetalle" => $data[4],
                "movicaProcesado" => $data[5], "movicaFecha" => $data[6], "movicaPeriodo" => $data[7], "movicaId"=> $data[8]);
          $resultado = $obj->actualizacontamovicabeza($registro);
          return $resultado;
          }          
    
    if ($accion == 'Recuperacontamovicabeza')
          {
        $clasesIncludes = "../clases/clscontamovicabeza.php";
        include_once ($clasesIncludes);
        $obj = new contamovicabeza();
          $data = explode('||', $condicion);
          $resultado = $obj->Recuperacontamovicabeza($data[0], $data[1], $data[2],$data[3], $data[4], $data[5]);
          return $resultado;
          }               
     
          
    if ($accion == 'leeRegistroDetalle')
          {
            $clasesIncludes = "../clases/clscontamovicabeza.php";
            include_once ($clasesIncludes);
            $obj = new contamovicabeza();
            $data = explode('||', $condicion);
            $resultado = $obj->leeRegistroDetalle($data[0]);
            echo $resultado;
            return $resultado;
          } 
          
    if ($accion == 'actualizacontamovidetalle')
        {
        $clasesIncludes = "../clases/clscontamovicabeza.php";
        include_once ($clasesIncludes);
        $obj = new contamovicabeza();
        $data = explode('||', $condicion);
        $registro = Array("moviConId" => $data[0], "moviConCabezaId" => $data[1], "moviConDetalle" => $data[2], 
        "moviConCuenta" => $data[3], "moviConDebito" => $data[4], 
        "moviConCredito" => $data[5], "moviConBase" => $data[6], "moviConImpTipo" => $data[7],  "moviConImpPorc" => $data[8],  
        "moviConImpValor" => $data[9],  
        "moviConIdTercero" => $data[10],  "moviConIdCadmin" => $data[11],  "moviConIdCcosto" => $data[12],  
        "moviDocum1" => $data[13], "moviDocum2" => $data[14]); 
//print_r($registro); moviDocum1 moviDocum2
        $resultado = $obj->actualizacontamovidetalle($registro);
        echo $resultado;
        return $resultado;         
          }
        

  
    if ($accion=='leeMovimiento'){
        $data = explode('||', $condicion);      
        $clasesIncludes = "../clases/clscontamovicabeza.php";
        include_once ($clasesIncludes);
        $obj = new contamovicabeza();
        $nrColorFila=0;
        $i=0;
        $sumDb=0.0;
        $sumCr=0.0;
        $result = $obj->leeMovimiento($data[0], $data[1]);
   
        $resultado= '<table class="tablaGrid"><tr><th>CUENTA</th><th>DESCRIPCION</th><th>DETALLE</th><th>DEBITOS</th><th>CREDITOS</th><th>TERCERO'.
                '</th><th>C.ADMIN</th><th>C.COSTO</th><th colspan="2"></th></tr>';

            while($row = mysql_fetch_array($result))
            {
                $nrColorFila++;          
                $color="estiloFila-".($nrColorFila % 2);
                $resultado .=  '<tr class="' . $color .'" id="fila'. $row['moviConId'].'"><td style="text-align:left" size="12">'. $row['moviConCuenta'] . '</td>'  ;
                $resultado .=  '<td style="text-align:left" size="300">'. $row['pucNombre'] . '</td>'  ;
                $resultado .=  '<td style="text-align:left" size="300">'. $row['moviConDetalle'] . '</td>'  ;
                $resultado .=  '<td style="text-align:right" size="90">'. number_format($row['moviConDebito'], 2) . '</td>'  ;
                $resultado .=  '<td style="text-align:right" size="90">'. number_format($row['moviConCredito'], 2) . '</td>'  ;
                $resultado .=  '<td style="text-align:right" size="60">'. $row['moviConIdTercero'] . '</td>'  ;
                $resultado .=  '<td style="text-align:center" size="60">'. $row['moviConIdCadmin'] . '</td>'  ;
                $resultado .=  '<td style="text-align:center" size="60">'. $row['moviConIdCcosto'] . '</td>'  ;
                if  ($data[2]!='R'){
                $resultado .=  '<td><a onClick="EditaRegistroMov(' . $row['moviConId'] .');" >' .
                     ' <img src="img/database_edit.png" title="Edita registro" alt="Editar" /></a>&nbsp;&nbsp;';
                $resultado = $resultado . '<a onClick="EliminarRegistroMov(' . $row['moviConId'] .');" >' .
                     ' <img src="img/delete.png" title="Elimina registro" alt="Eliminar" /> </a></td>';
                }
               $resultado .=  '</tr>';
                
                
                $sumDb+=$row['moviConDebito'];
                $sumCr+=$row['moviConCredito']; 
            }
            $neto = $sumDb - $sumCr;
        $resultado = $resultado . '<tr class="totales"><td colspan="3">TOTALES:</td><td  style="text-align:right">'.number_format($sumDb, 2).'</td><td  style="text-align:right">'.number_format($sumCr, 2).'</td><td>NETO:</td><td colspan="2"  style="text-align:right">'.number_format($neto, 2).'</td></tr>'  ;
        $resultado = $resultado . '</table>';
         echo $resultado;
        return $resultado;
    }
    
    if ($accion== 'EliminarRegistroMov')
        {
            $data = explode('||', $condicion);
            $clasesIncludes = "../clases/conexion.class.php";
            include_once ($clasesIncludes);
            $obj = new DBManager();
            $result = $obj->eliminar($data[0], $data[1], $data[2]);
            return $result;
        }      
        
	if ($accion=='eliminarRegistro')
    {
            $data = explode('||', $condicion);
            $clasesIncludes = "../clases/conexion.class.php";
            include_once ($clasesIncludes);
            $obj = new DBManager();
            $result = $obj->eliminar($data[0], $data[1], $data[2]);
            echo $result;   
    }  
    
 
    if ($accion=='borracontaplancontable')
    {
    
            $data = explode('||', $condicion);
    $clasesIncludes = "../clases/clscontaplancontable.php";
            include_once ($clasesIncludes);
            $obj = new contaplancontable();
            $result = $obj->borracontaplancontable($data[0]);
            echo $result;   
    }  
    
   if ($accion=='leeGrillaPuc')
    {
    
            $data = explode('||', $condicion);		
            $clasesIncludes = "../clases/clscontaplancontable.php";
            include_once ($clasesIncludes);
            $obj = new contaplancontable();
            $result = $obj->leeGrillaPuc($data[0], $data[1], $data[2],$data[3], $data[4], $data[5]);
            echo $result;   
    } 
	
	if ($accion=='grabaRegistroTipo')
    {    
            $data = explode('||', $condicion);
            $clasesIncludes = "../clases/clscontalistados.php";
            include_once ($clasesIncludes);
            $obj = new contalistados(); 
           $registro = Array("tipoid"=>$data[0], "tipocodigo"=>$data[1], "tipoDetalle"=>$data[2], "tipoestado"=>$data[3], "tipoempresa"=>$data[4]);
             $result = $obj->actualizaTipoInforme($registro);
            echo $result;   
    }   
    
if ($accion=='dropDownTipoInforme')
    {    
            $data = explode('||', $condicion);
            $clasesIncludes = "../clases/clscontalistados.php";
            include_once ($clasesIncludes);
            $obj = new contalistados(); 
            $result = $obj->dropDownTipoInforme($data[0]);
            echo $result;   
    }   
        
   
if ($accion=='listaEstructura')
    {    
            $data = explode('||', $condicion);
            $clasesIncludes = "../clases/clscontalistados.php";
            include_once ($clasesIncludes);
            $obj = new contalistados(); 
            $result = $obj->listaEstructura($data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);
            echo $result;   
    }   
 
    if ($accion=='borraRegistroEstructura')
    {    
            $data = explode('||', $condicion);
            $clasesIncludes = "../clases/clscontalistados.php";
            include_once ($clasesIncludes);
            $obj = new contalistados(); 
            $result = $obj->borraRegistroEstructura($data[0]);
            echo $result;   
    }     
    
if ($accion=='renumeraEstructura')
    {    
            $data = explode('||', $condicion);
            $clasesIncludes = "../clases/clscontalistados.php";
            include_once ($clasesIncludes);
            $obj = new contalistados(); 
            $result = $obj->renumeraEstructura($data[0], $data[1], $data[2]);
            echo $result;   
    }     
    if ($accion == 'actualizaRegistroEstructura')
    {
            $data = explode('||', $condicion);
            $clasesIncludes = "../clases/clscontalistados.php";
            include_once ($clasesIncludes);
            $obj = new contalistados(); 
            $registro = Array("infoId"=>$data[0], "infoEmpresa"=>$data[1], "infoReporte"=>$data[2], "infoLinea"=>$data[3], "intoTipo"=>$data[4],
            "infoCodigo"=>$data[5], "infoNombre"=>$data[6], "infoCuentasIN"=>$data[7], "infoCuentasOUT"=>$data[8], "infoFormula"=>$data[9],  
            "infoNro"=>$data[10], "infoNotas"=>$data[11], "infoIndenta"=>$data[12], "infoNuevaPagina"=>$data[13] );
            $result = $obj->actualizaRegistroEstructura($registro);
            return; $result;    
    }

    
    if ($accion == 'autocompletaCuenta')
        {
            $data = explode('||', $condicion);
            $clasesIncludes = "../clases/clscontaplancontable.php";
            include_once ($clasesIncludes);
            $obj = new contaplancontable();
            $result = $obj->autocompletaCuenta($data[1], $data[0]);
            echo $result;
            return $result;
        }      

    
     if ($accion == 'GrabaOperacionesDef')
        {
            $data = explode('||', $condicion);
///  print_r($data);            
            $clasesIncludes = "../clases/clscontaoperacionesdef.php";
            include_once ($clasesIncludes);
            $obj = new contaoperacionesdef();
            for ($x = 1; $x <= 9; $x++) {
                $i = ($x + 1)* 3 + 2;
                $j = $i + 2;
                if ($data[$i] != '')
                {
                    $data[$j] = $obj->nombreCuenta($data[1], $data[$i]);
                }
            } 

            $registro = Array("operDefId"=>$data[2], "operDefEmpresaId"=>$data[1], "operDefCodigo"=>$data[4], 
            "operDefDetalle"=>$data[5], "operDefcomprId"=>$data[6],"operDefTerceroId"=>$data[7],
            "operDefCuenta1"=>$data[8], "operDefTipo1"=>$data[9],  "operDefNombre1"=>$data[10],
            "operDefCuenta2"=>$data[11], "operDefTipo2"=>$data[12], "operDefNombre2"=>$data[13],
            "operDefCuenta3"=>$data[14], "operDefTipo3"=>$data[15], "operDefNombre3"=>$data[16],
            "operDefCuenta4"=>$data[17], "operDefTipo4"=>$data[18], "operDefNombre4"=>$data[19],
            "operDefCuenta5"=>$data[20], "operDefTipo5"=>$data[21], "operDefNombre5"=>$data[22],
            "operDefCuenta6"=>$data[23], "operDefTipo6"=>$data[24], "operDefNombre6"=>$data[25], 
            "operDefCuenta7"=>$data[26], "operDefTipo7"=>$data[27],  "operDefNombre7"=>$data[28],
            "operDefCuenta8"=>$data[29], "operDefTipo8"=>$data[30],   "operDefNombre8"=>$data[31],
            "operDefCuenta9"=>$data[32], "operDefTipo9"=>$data[33],  "operDefNombre9"=>$data[34],			
            "operDefTerc1"=>$data[35], "operDefTerc2"=>$data[36],  "operDefTerc3"=>$data[37],
            "operDefTerc4"=>$data[38], "operDefTerc5"=>$data[39],  "operDefTerc6"=>$data[40],
            "operDefTerc7"=>$data[41], "operDefTerc8"=>$data[42],  "operDefTerc9"=>$data[43], "operDefActivo"=>$data[44]);
            $result = $obj->actualizacontaoperacionesdef($registro);
            echo $result;
            return $result;
        }           

    if ($accion == 'editaOperacionesDef')
        {
            $data = explode('||', $condicion);
            $clasesIncludes = "../clases/clscontaoperacionesdef.php";
            include_once ($clasesIncludes);
            $obj = new contaoperacionesdef();
            $registro= $obj->recupera_contaoperacionesdef($data[0],$data[1]);
            echo $registro;
            return $registro;
        }
        
    if ($accion=='unConsecutivoComprobante'){
        if($objClase->conectar()==true){
            $sql = "SELECT compConsecutivo + 1 as compConsecutivo FROM contacomprobantes WHERE " . $condicion . " AND compActivo = 'A' " ;
// echo $sql;            
            $result = mysql_query($sql);           
             while( $reg = mysql_fetch_array($result) )
            {
                 $resultado = $reg['compConsecutivo'];
            }
            echo $resultado;
            return $resultado;
        }else{echo 'no hay connexion a la BD';}
    }
    
         if ($accion == 'listaActualizaComprobante') 
        {
            $data = explode('||', $condicion);
            $clasesIncludes = "../clases/clscontamovicabeza.php";
            include_once ($clasesIncludes);
            $obj = new contamovicabeza();
            $result = $obj->ListaGrillaContamovicabeza($data[0], $data[1], $data[2], $data[3]);
            echo $result;
            return $result;
        } 
    
      if ($accion == 'listaComprobante')  //periInicial + '||' +   periFinal + '||' +   pendientes + '||' +   aplicados  empresa
        {
            $data = explode('||', $condicion);
            $clasesIncludes = "../clases/clscontamovicabeza.php";
            include_once ($clasesIncludes);
            $obj = new contamovicabeza();
            $result = $obj->ListaGrillaContamovicabeza($data[0], $data[1], $data[2], $data[3]);
            echo $result;
            return $result;
        }
     
    if ($accion == 'drpListComptobantes') 
    {
            $clasesIncludes = "../clases/clscontacomprobantes.php";
            include_once ($clasesIncludes);
            $data = explode('||', $condicion);
            $obj = new contacomprobantes();
            $resultado = $obj->listacontacomprobantes($data[0]);
            echo  $resultado;
    }   
 
    if ($accion == 'drpListTerceros') 
    {
            $clasesIncludes = "../clases/clscontaterceros.php";
            include_once ($clasesIncludes);
            $data = explode('||', $condicion);
            $obj = new contaterceros();
            $resultado = $obj->listacontaterceros($data[0],0);
            return $resultado;
    }    
 
    if ($accion == 'drpListCcostro') 
    {
            $clasesIncludes = "../clases/clscontacentrocosto.php";
            include_once ($clasesIncludes);
            $data = explode('||', $condicion);
            $obj = new contacentrocosto();
            $resultado = $obj->listacontacentrocosto($data[0]);
            return $resultado;
    } 
    
     if ($accion == 'drpListCadmin') 
    {
            $clasesIncludes = "../clases/clscontacentroadmin.php";
            include_once ($clasesIncludes);
            $data = explode('||', $condicion);
            $obj = new contacentroadmin();
            $resultado = $obj->listacontacentroadmin($data[0]);
            return $resultado;
    }    
  
    if ($accion == 'actualizaComprobante')
    {
        $clasesIncludes = "../clases/clscontamovicabeza.php";
        include_once ($clasesIncludes);
        $data = explode('||', $condicion);
        $resultado='';
        $obj = new contamovicabeza();
        $resultado= $obj->actualizaContabilidadGuia($data[0],$data[1],$data[2]);
        return $resultado;
    }            
  
        if ($accion == 'duplicaComprobante')
    {
        $clasesIncludes = "../clases/clscontamovicabeza.php";
        include_once ($clasesIncludes);
        $resultado='';
        $obj = new contamovicabeza();
        $resultado= $obj->duplicaComprobante($condicion);
        return $resultado;
    } 
    
    
        if ($accion == 'grabaTrabajaOperaciones')
    {
        $clasesIncludes = "../clases/clscontamovicabeza.php";
        include_once ($clasesIncludes);
        $resultado='';
        $obj = new contamovicabeza();
        $data = explode('||', $condicion);
        //empresa +'||'+ operDeffecha  +'||'+operDefperiodo +'||'+ movidocum1 +'||'+movidocum2 +'||'+ operDefDetalle +'||'+Terceros;
           $registro = Array("empresa" => $data[0], "operDeffecha" => $data[1], "operDefperiodo" => $data[2], "movidocum1" => $data[3], "movidocum2" => $data[4],
                "operDefDetalle" => $data[5], "Terceros" => $data[6], "ccosto" => $data[8], "cadmin" => $data[9], "operDefcomprobante" => $data[7]);
        for($i=1;$i<=9;$i++){
            $c='cuenta'.$i;
            $v='valor'.$i;
            $b='base'.$i;        
            $d='docum'.$i;
            $t='tipo'.$i;
            $e='terc'.$i;
            $j = ($i-1)*6+10;
            $registro [$c] = $data[$j];
            $registro [$v] = $data[$j+1];
            $registro [$b] = $data[$j+2];
            $registro [$d] = $data[$j+3]; 
            $registro [$t] = $data[$j+4]; 
            $registro [$e] = $data[$j+5];
        }
      
        $resultado= $obj->grabaTrabajaOperaciones($registro);
        //echo $resultado;
        return $resultado;
    }   

    if ($accion=='unaCuentaContable'){
        if($objClase->conectar()==true){
            $sql =  "SELECT  pucClase+'||'+pucValo".
                    "FROM contaplancontable  WHERE " . $condicion . " AND pucActivo = 'A' " ;
        //  echo $sql;
            $result = mysql_query($sql);
            echo $result;
            return $result;
        }else{echo 'no hay connexion a la BD';}
    }

    if ($accion=='recuperaTipoInforme')
        {
             $data = explode('||', $condicion);
            $clasesIncludes = "../clases/clscontalistados.php";
            include_once ($clasesIncludes);
            $obj = new contalistados();
            $result = $obj->recuperaTipoInforme($data[0], $data[1], $data[2], $data[3], $data[4], $data[5]);
            echo $result;
            return $result;   //pagina+'||20||'+usuariotipo+'||'+ empresa +'||'+  navega+'||'+buscar;  
        }

        function drpdwnCentroCosto($condicion){
       $sql = "SELECT centrocostoId, centrocostoCodigo".
       " FROM contacentrocosto WHERE " . $condicion .
       " ORDER BY centrocostoCodigo"; 
    return mysql_query($sql);
 }    
    
    function drpdwnPlanContable($condicion){
       $sql = "SELECT pucId, pucNombre".
       " FROM contaplancontable WHERE pucTipo = 'M' AND " . $condicion .
       " ORDER BY pucNombre"; 
    return mysql_query($sql);
     }
     
    
// rubros y subrubros   

    if ($accion=='leeRubros')
    {
        $data = explode('||', $condicion);		
        $clasesIncludes = "../clases/clscontarubros.php";
        include_once ($clasesIncludes);
        $obj = new contarubros();
        $result = $obj->leerubros($data[0], $data[1], $data[2],$data[3], $data[4], $data[5]);
        echo $result;   
    }
     
    if ($accion == 'actualizarubro'){  
        $clasesIncludes = "../clases/clscontarubros.php";
        include_once ($clasesIncludes);
        $obj = new contarubros();
        $data = explode('||', $condicion);
        $registro = Array("rubroid" => $data[0], "rubroempresa" => $data[1], "rubrodetalle" => $data[2], "rubroactiva" => $data[3]);
        $resultado= $obj->actualizarubro($registro);
        echo $resultado;
        }  
        
     if ($accion == 'eliminaRubro'){  
        $clasesIncludes = "../clases/clscontarubros.php";
        include_once ($clasesIncludes);
        $obj = new contarubros();
        $data = explode('||', $condicion);
        $resultado= $obj->borrarubro($data[1]);
        echo $resultado;
        }

     if ($accion == 'ddlrubros'){  
        $clasesIncludes = "../clases/clscontarubros.php";
        include_once ($clasesIncludes);
        $obj = new contarubros();
        $data = explode('||', $condicion);
        $resultado= $obj->ddlrubro($data[0]);
        echo $resultado;
        }
		
    if ($accion=='leesubrubros')
    {
        $data = explode('||', $condicion);		
        $clasesIncludes = "../clases/clscontarubros.php";
        include_once ($clasesIncludes);
        $obj = new contarubros();
        $result = $obj->leesubrubros($data[0], $data[1], $data[2],$data[3], $data[4], $data[5]);
        echo $result;   
    }
    
    if ($accion == 'actualizasubrubro'){  
        $clasesIncludes = "../clases/clscontarubros.php";
        include_once ($clasesIncludes);
        $obj = new contarubros();
        $data = explode('||', $condicion);
        $registro = Array("subrubid" => $data[0], "subrubempresa" => $data[1], "subrubtipo" => $data[2], 
            "subrubrubro" => $data[3], "subrubdetalle" => $data[4], "subrubcuentas" => $data[5], "subrubactiva" => $data[6], "subrubsecuencia"=>$data[7]);
         $resultado= $obj->actualizasubrubro($registro);
        echo $resultado;
        }
        
    if ($accion == 'recuperasubrubro'){  
        $clasesIncludes = "../clases/clscontarubros.php";
        include_once ($clasesIncludes);
        $obj = new contarubros();
        $data = explode('||', $condicion);
        $condi = 'subrubempresa = '. $data[0] . ' AND subrubid = ' . $data[1];
        $resultado= $obj->recuperasubrubro($condi);
    
        echo $resultado;
        }         
 }
///  
     if ($accion=='leesalones')
    {
        $data = explode('||', $condicion);		
        $clasesIncludes = "../clases/clscontasalones.php";
        include_once ($clasesIncludes);
        $obj = new contasalones();
        $result = $obj->leesalones($data[0], $data[1], $data[2],$data[3], $data[4], $data[5], $data[6]);
        echo $result;  
    }
    
    if ($accion == 'actualizasalon'){  
        $clasesIncludes = "../clases/clscontasalones.php";
        include_once ($clasesIncludes);
        $obj = new contasalones();
        $data = explode('||', $condicion);
        $registro = Array("salonid" => $data[0], "salonempresa" => $data[1], "salondetalle" => $data[2], 
        "saloncapacidad" => $data[3], "salonbano" => $data[4], "saloncocina" => $data[5], "salonasonido" => $data[6],
        "salonvisual" => $data[7], "saloninternet" => $data[8], "salonotro" => $data[9], "salonotrocual" => $data[10], "salonactiva" => $data[11]);
         $resultado= $obj->actualizasalones($registro);
        echo $resultado;
        }    
    
     if ($accion=='leecomites')
    {
        $data = explode('||', $condicion);		
        $clasesIncludes = "../clases/clscontasalones.php";
        include_once ($clasesIncludes);
        $obj = new contasalones();
        $result = $obj->leecomites($data[0], $data[1], $data[2],$data[3], $data[4], $data[5], $data[6]);
        echo $result;  
    }
    
    if ($accion == 'actualizacomite'){  
        $clasesIncludes = "../clases/clscontasalones.php";
        include_once ($clasesIncludes);
        $obj = new contasalones();
        $data = explode('||', $condicion);  
        $registro = Array("comiteid" => $data[0], "comiteempresa" => $data[1], "comitenombre" => $data[2], 
        "comitedetalle" => $data[3], "comiteactiva" => $data[4]);
         $resultado= $obj->actualizacomites($registro);
        echo $resultado;
        }

     if ($accion=='listacomites')
    {
        $data = explode('||', $condicion);		
        $clasesIncludes = "../clases/clscontasalones.php";
        include_once ($clasesIncludes);
        $obj = new contasalones();
        $result = $obj->listacomites($data[0]);
        echo $result;  
    }  

    if ($accion=='importaDatos')
    {
        $data = explode('||', $condicion);		
        $clasesIncludes = "opcCargaData.php";
        include_once ($clasesIncludes);
        $obj = new opcCargaData();
        $result = $obj->importaDatos($data);
        echo $result;  
    } 
    // 
     if ($accion=='recupera_comites')
    {
        $data = explode('||', $condicion);		
        $clasesIncludes = "../clases/clscontasalones.php";
        include_once ($clasesIncludes);
        $obj = new contasalones();
        $result = $obj->recupera_comites($data[0]);
        echo $result;  
    }  
    
    if ($accion=='cierreMensualConta')
    {
        $data = explode('||', $condicion);		
        $clasesIncludes = "../clases/clscontacierre.php";
        include_once ($clasesIncludes);
        $obj = new contacierre();
        $result = $obj->cierremensual($data[0],$data[1]);
        echo $result;
       // return $result;
    }

    if ($accion=='numeroFactura')
    {
        $data = explode('||', $condicion);		
        $clasesIncludes = "../clases/clscontafactura.php";
        include_once ($clasesIncludes);
        $obj = new contafactura();
        $result = $obj->numeroFactura($data[0]);
        echo $result;
        return $result;
    }

    if ($accion=='traeTercero')
    {
        $data = explode('||', $condicion);		
        $clasesIncludes = "../clases/clscontafactura.php";
        include_once ($clasesIncludes);
        $obj = new contafactura();
        $result = $obj->traeTercero($data[0],$data[1]);
        echo $result;
       // return $result;  recuperaFactura
    }

    if ($accion=='grabaFactura')
    {
        $data = explode('||', $condicion);		
        $clasesIncludes = "../clases/clscontafactura.php";
        include_once ($clasesIncludes);
        $obj = new contafactura();
        $registro = Array("empresa" => $data[0], "factNro" => $data[1], "facFecha" => $data[2], "facFechaV" => $data[3], "factNit" => $data[4],
            "factDireccion" => $data[5], "factmvtvalor" => $data[6], "factmvtivaporc" => $data[7], "factmvtivavalor"=> $data[8], 
            "factmvtneto" => $data[9], "factmvtdetalle" => $data[10], "tercero" => $data[11], "id" => $data[12]);        
        $result = $obj->grabaFactura($registro);
        echo $result;
    }    
    
    if ($accion=='recuperaFactura')
    {
        $data = explode('||', $condicion);		
        $clasesIncludes = "../clases/clscontafactura.php";
        include_once ($clasesIncludes);
        $obj = new contafactura();
        $result = $obj->recuperaFactura($data[0],$data[1],$data[2]);
        echo $result;
       // return $result;  
    }    
    
    
else
{
//    echo ('No hay accion para ejecutar');
}
 