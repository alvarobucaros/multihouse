<?php
include_once("../clases/conexion.class.php");
$objClase=new DBManager;
if(isset($_POST["accion"])){
    $accion = $_POST["accion"];
    $condicion = $_POST["condicion"]; 
alert($accion);    
    if($accion=='aExcelTerceros'){
alert($condicion);
        $fecha = date("Y-m-d His");  
        $expo='';
        $expo .= "<table border=1 class='table2Excel'> ";
        $expo .=  "<tr> ";
        $expo .=  "<th>NOMBRE</th> ";
        $expo .=  "<th>TIPOID</th> ";
        $expo .=  "<th>NUMEROID</th> ";
        $expo .=  "<th>DIRECCION</th> ";
        $expo .=  "<th>TELEFONO</th> ";
        $expo .=  "<th>CORREO</th> ";
        $expo .=  "<th>TWITER</th> ";
        $expo .=  "<th>FACEBOOK</th> ";
        $expo .=  "<th>COMENTARIOS</th> ";
        $expo .=  "<th>CODIGO</th> ";
        $expo .=  "<th>REGIMEN</th> ";
        $expo .=  "<th>GRAN CONTRIGUYENTE</th> ";
        $expo .=  "<th>ACTIVO</th> ";     
        $expo .=  "</tr> ";         
        include_once("../clases/clscontaterceros.php");
        $objClase = new contaterceros();
        $cond=' terceroEmpresaId = ' . $condicion;
        $result = $objClase->recupera_contaterceros($cond);        

//        while( $reg = mysql_fetch_array($result) )
//        {
//            $expo .=  "<tr> ";
//            $expo .=  	"<td>".$reg["terceroNombre"]."</td> ";
//            $expo .=  	"<td>".$reg["terceroIdenTipo"]."</td> ";
//            $expo .=  	"<td>".$reg["terceroIdenNumero"]."</td> ";
//            $expo .=  	"<td>".$reg["terceroDireccion"]."</td> ";
//            $expo .=  	"<td>".$reg["terceroTelefonos"]."</td> ";
//            $expo .=  	"<td>".$reg["terceroCorreo"]."</td> ";
//            $expo .=  	"<td>".$reg["terceroTwiter"]."</td> ";
//            $expo .=  	"<td>".$reg["terceroFacebook"]."</td> ";
//            $expo .=  	"<td>".$reg["terceroComentario"]."</td> ";
//            $expo .=  	"<td>".$reg["tercero_codigo"]."</td> ";
//            $expo .=  	"<td>".$reg["terceroRegimen"]."</td> ";
//            $expo .=  	"<td>".$reg["terceroContribuyente"]."</td> ";
//            $expo .=  	"<td>".$reg["terceroActivo"]."</td> ";            
//            $expo .=  "</tr> ";             
//        }        
         $expo .=  "</table> "; 
         echo $expo;
    return;
    }        
    

    if ($accion=='aExcelInmuebles'){
        $reg=  explode('||', $condicion);
        $fecha = date("Y-m-d His");  
        $expo='';
        $expo .= "<table border=1 class='table2Excel'> ";
        $expo .=  "<tr> ";
        $expo .=     "<th>ID</th> ";
        $expo .=  	"<th>EMPRESA</th> ";
        $expo .=  	"<th>CODIGO</th> ";
        $expo .=  	"<th>DESCRIPCION</th> ";
        $expo .=  	"<th>AREA</th> ";
        $expo .=  	"<th>COEFICIENTE</th> ";
        $expo .=  	"<th>UBICACION</th> ";
        $expo .=  	"<th>CLASIFICACION</th> ";
        $expo .=  	"<th>PRINCIAL</th> ";
        $expo .=  	"<th>PROPIETARIO</th> ";
        $expo .=  	"<th>NOMBRE</th> ";
        $expo .=  "</tr> ";
        
        include_once("../clases/clscontainmuebles.php");
        $objClase = new containmuebles();
        $result = $objClase->recupera_containmuebles($reg[0],$reg[1]);        

         while( $reg = mysql_fetch_array($result) )
        {
            $expo .=  "<tr> ";
            $expo .=  	"<td>".$reg["inmuebleId"]."</td> ";
            $expo .=  	"<td>".$reg["inmuebleEmpresaId"]."</td> ";
            $expo .=  	"<td>".$reg["inmuebleCodigo"]."</td> ";
            $expo .=  	"<td>".$reg["inmuebleDescripcion"]."</td> ";
            $expo .=  	"<td>".$reg["inmuebleArea"]."</td> ";
            $expo .=  	"<td>".$reg["inmuebleCoeficiente"]."</td> ";
            $expo .=  	"<td>".$reg["inmuebleUbicacion"]."</td> ";
            $expo .=  	"<td>".$reg["clasificacionCodigo"]."</td> ";
            $expo .=  	"<td>".$reg["inmueblePrincipal"]."</td> ";
            $expo .=  	"<td>".$reg["propietarioCedula"]."</td> ";
            $expo .=  	"<td>".$reg["propietarioNombre"]."</td> ";
            $expo .=  "</tr> ";             
        }        
         $expo .=  "</table> "; 
         echo $expo;
    return;
    }
    
    
    if ($accion=='aExcelClasificacion'){
        $fecha = date("Y-m-d His");  
        $expo='';
        $expo .= "<table border=1 class='table2Excel'> ";
        $expo .=  "<tr> ";
        $expo .=     "<th>ID</th> ";
        $expo .=  	"<th>EMPRESA</th> ";
        $expo .=  	"<th>CODIGO</th> ";
        $expo .=  	"<th>DESCRIPCION</th> ";
        $expo .=  "</tr> ";
       
        include_once("../clases/clscontaclasificacion.php");
        $objClase = new contaclasificacion();
        $result = $objClase->recupera_contaclasificacion("clasificacionEmpresaId=".$condicion);

         while( $reg = mysql_fetch_array($result) )
        {
            $expo .=  "<tr> ";
            $expo .=  	"<td>".$reg["clasificacionId"]."</td> ";
            $expo .=  	"<td>".$reg["clasificacionEmpresaId"]."</td> ";
            $expo .=  	"<td>".$reg["clasificacionCodigo"]."</td> ";
            $expo .=  	"<td>".$reg["clasificacionDetalle"]."</td> ";
            $expo .=  "</tr> ";
        }        
         $expo .=  "</table> "; 
         echo $expo;
    return;
    }  
    
    
     if ($accion=='aExcelPropietarios'){
        $fecha = date("Y-m-d His");  
        $expo='';
        $expo .= "<table border=1 class='table2Excel'> ";
        $expo .=  "<tr> ";
        $expo .=  "<th>ID</th> ";
        $expo .=  "<th>EMPRESA</th> ";
        $expo .=  "<th>NOMBRE</th> ";
        $expo .=  "<th>CEDULA</th> ";
        $expo .=  "<th>TELEFONOS</th> ";
        $expo .=  "<th>DIRECCION</th> ";
        $expo .=  "<th>CORREO</th> ";
        $expo .=  "<th>ACTIVO</th> ";
        $expo .=  "</tr> ";
        include_once("../clases/clscontapropietarios.php");
        $objClase = new contapropietarios();
        $result = $objClase->recupera_contapropietarios("propietarioEmpresaId = ".$condicion);

         while( $reg = mysql_fetch_array($result) )
        {
            $expo .=  "<tr> ";
            $expo .=  	"<td>".$reg["propietarioId"]."</td> ";
            $expo .=  	"<td>".$reg["propietarioEmpresaId"]."</td> ";
            $expo .=  	"<td>".$reg["propietarioNombre"]."</td> ";
            $expo .=  	"<td>".$reg["propietarioCedula"]."</td> ";
            $expo .=  	"<td>".$reg["propietarioTelefonos"]."</td> ";            
            $expo .=  	"<td>".$reg["propietarioDireccion"]."</td> ";
            $expo .=  	"<td>".$reg["propietarioCorreo"]."</td> ";
            $expo .=  	"<td>".$reg["propietarioActivo"]."</td> ";
            $expo .=  "</tr> ";
        }        
         $expo .=  "</table> "; 
         echo $expo;
    return;
    }    
   

     if ($accion=='aExcelSevicios'){
        $fecha = date("Y-m-d His");  
        $expo='';
        $expo .= "<table border=1 class='table2Excel'> ";
        $expo .=  "<tr> ";
        $expo .=  "<th>CODIGO</th> ";
        $expo .=  "<th>DETALLE</th> ";
     //   $expo .=  "<th>PERIODO</th> ";
        $expo .=  "<th>DESDE</th> ";
        $expo .=  "<th>HASTA</th> ";
        $expo .=  "<th>VALOR</th> ";
        $expo .=  "<th>PRIORIDAD</th> ";
        $expo .=  "<th>TIPO</th> ";
        $expo .=  "<th>MORA</th> ";
        $expo .=  "<th>% MORA</th> ";
        $expo .=  "<th>Vlr MORA</th> ";
        $expo .=  "<th>CUENTA DB</th> ";
        $expo .=  "<th>CUENTA CR</th> ";
        $expo .=  "<th>% PRONTO PAGO</th> ";
        $expo .=  "<th>PRONTO PAGO VALOR</th> ";
        $expo .=  "<th>ACTIVO</th> ";
        $expo .=  "<th>AMBITO</th> ";
      
        $expo .=  "</tr> ";
        include_once("../clases/clscontaservicios.php");
        $objClase = new contaservicios();
        $result = $objClase->recupera_contaservicios("servicioEmpresaId = ".$condicion);

       
         while( $reg = mysql_fetch_array($result) )
        {
            $expo .=  "<tr> ";
            $expo .=  	"<td>".$reg["ServicioCodigo"]."</td> ";
            $expo .=  	"<td>".$reg["ServicioDetalle"]."</td> ";
//            $expo .=  	"<td>".$reg["ServicioPeriodo"]."</td> ";            
            $expo .=  	"<td>".$reg["ServicioFechaDesde"]."</td> ";
            $expo .=  	"<td>".$reg["ServicioFechaHasta"]."</td> ";
            $expo .=  	"<td>".$reg["ServicioValor"]."</td>" ;            
            $expo .=  	"<td>".$reg["ServicioPrioridad"]."</td> ";
            $expo .=  	"<td>".$reg["ServicioTipo"]."</td> ";
            $expo .=  	"<td>".$reg["ServicioMora"]."</td> ";
            $expo .=  	"<td>".$reg["ServicioMoraPorcentaje"]."</td> ";
            $expo .=  	"<td>".$reg["servicioMoraValor"]."</td> ";
            $expo .=  	"<td>".$reg["ServicioCuentaDB"]."</td> ";
            $expo .=  	"<td>".$reg["ServicioCuentaCR"]."</td> ";
            $expo .=  	"<td>".$reg["ServicioPPporcentaje"]."</td> ";
            $expo .=  	"<td>".$reg["ServicioPPvalor"]."</td> ";
            $expo .=  	"<td>".$reg["ServicioActivo"]."</td> ";
            $expo .=  	"<td>".$reg["servicioClasificacionId"]."</td> ";    
            $expo .=  "</tr> ";
        }     
 
         $expo .=  "</table> "; 
         echo $expo;
    return;
    }
    
    if ($accion == 'RecuperaAbonos')
    {
        $clasesIncludes = "../clases/clscontamovicabeza.php";
        include_once ($clasesIncludes);
        $obj = new contamovicabeza();
        $data = explode('||', $condicion);
        $resultado = $obj->Recuperacontamovicabeza($data[0], $data[1], $data[2],$data[3], $data[4], $data[5]);
        return $resultado;
    }               
   
    if ($accion == 'vaAfacturar')
    {
        $clasesIncludes = "../clases/clscontafactura.php";
        include_once ($clasesIncludes);
        $obj = new contafactura();
        $data = explode('||', $condicion);
        $resultado = $obj->facturar($data[0], $data[1], $data[2],$data[3], $data[4],$data[5], $data[6]);
        return $resultado;
    } 
}