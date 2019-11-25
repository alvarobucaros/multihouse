<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
//session_start();

class DBconexion{
	var $conect;  
	var $BaseDatos;
	var $Servidor;
	var $Usuario;
	var $Clave;
        var $mysqli;
        
        var $er;
        
	function DBconexion(){
          ini_set('track_errors', 1);
            $fd = fopen('../bin/cls/mh.ctl', 'r');
            $datos=fread($fd,filesize('../bin/cls/mh.ctl')); 
            $data =explode('~',$datos);
            fclose($fd);
            $this->Servidor = $this->funde($data[0]);
            $this->BaseDatos = $this->funde($data[1]);
            $this->Usuario = $this->funde($data[2]);
            $this->Clave = $this->funde($data[3]);             
	}

        
        function conectar() {
      
            $mysqli = new mysqli($this->Servidor,$this->Usuario,$this->Clave, $this->BaseDatos);
            if (mysqli_connect_errno()) {
                printf("Conexión fallida: %s\n", mysqli_connect_error());
                return false;
            }  
            else { 
        
               mysqli_set_charset($mysqli,"utf8"); 
               return $mysqli;    
            }
	
	}

	function desConectar(){
             mysqli_close($this->conect);
	}
 
        public function changePwd($dat){
            $obj = new DBconexion();
            $con = $obj->conectar();
            $result = '';
            if($con==true){
                $strSql = "SELECT usuarioClave FROM contausuarios where usuarioId = " . $dat[3];
            
                $claveOk = md5($dat[0]);
                $resultado =  mysqli_query($con, $strSql);
                $usuario = mysqli_fetch_array($resultado, MYSQL_ASSOC);
                if($usuario['usuarioClave'] ==  $claveOk ){
                    $strSql = "UPDATE contausuarios SET usuarioClave = '" . md5($dat[1]) . 
                            "' WHERE usuarioId = " . $dat[3];
                    $resultado =  mysqli_query($con, $strSql);
                }
                else
                {
                  $result .= "Error: La contraseña actual del usuario no es correcta. ";  
                } 
                if ($result != ''){
                     $result .= " Para salir deje el campo Contraseña actual en blanco ";
                }
                 return $result;
             }
             else{
                 $result .= "Error: La conexion no se efectuó";  
             }
               return $result;    
        }
        
        
        public  function autenticaUsuario($dat){ 
            $result='OK';
            $fd = fopen('../bin/cls/mh.ctl', 'r');
            $datos = fread($fd,100);
            fclose($fd);
            $data =explode('~',$datos);
            $this->Servidor = $this->funde($data[0]);
            $this->BaseDatos = $this->funde($data[1]);
            $this->Usuario = $this->funde($data[2]);
            $this->Clave = $this->funde($data[3]); 

            $Servidor = $this->funde($data[0]);
            $BaseDatos = $this->funde($data[1]);
            $Usuario = $this->funde($data[2]);
            $Clave = $this->funde($data[3]); 
            $Ctrl = $this->funde($data[4]); 
            $mictl = $Servidor .'||' . $BaseDatos .'||' . $Usuario  .'||' . $Clave.'||' . $dat[0]   .'||' . $dat[1];
        
            $obj = new DBconexion();
            $con = $obj->conectar();
            $email= TRIM($dat[0]);
            $clave=$dat[1];
  
            if($con==true){
                if (isset($_SESSION['mh'])) {
                    unset($_SESSION['mh']);
                }
                $where = '';
                $where = " usuario_email = '". $email. "' OR usuario_celular = '".
                        $email."' OR usuario_nrodoc = '".$email."' ";

                $strSql = "SELECT usuario_id, usuario_nombre , usuario_email, usuario_password, 
                            usuario_tipo_acceso, usuario_fechaActualizado, 
                            usuario_estado, usuario_perfil, usuario_avatar, usuario_nrodoc,
                            usuario_empresa, empresaNombre AS empresa_nombre, empresaNit AS empresa_nit, empresaid AS empresa_id,  
                            empresaWeb AS empresa_web, empresaDireccion AS empresa_direccion, empresaTelefonos AS 
                            empresa_telefonos, empresaCiudad AS empresa_ciudad,
                            empresaLogo AS empresa_logo, empresaAutentica  AS empresa_autentica, empresaIdioma AS empresa_lenguaje, 'N' As empresa_cresidencial,  
                             '' AS empresa_ctrl, usuario_celular 
                            FROM mm_usuarios 
                            INNER JOIN contaempresas ON empresaid = usuario_empresa 
                            WHERE " . $where; 
 
                $result = ''; 
                $resultado =  mysqli_query($con, $strSql);
                $totRec =   $resultado->num_rows;  ///$número_filas = mysql_num_rows($resultado);  
                if ($totRec > 0) {
                    $usuario = mysqli_fetch_array($resultado, MYSQL_ASSOC);
                    $claveOk = md5($clave);
                    if($usuario['usuario_estado']==='A'){
                        date_default_timezone_set('America/New_York');
                        $fecha = date("Y-m-d");
                        if ($obj->compara2fechas($usuario['usuario_fechaActualizado'],$fecha)){                          
                            if($usuario['usuario_password'] == $claveOk ){
                                $ok=false;
                                $autenticaCon = 'Autentica con codigo de usuario';
                                if($usuario['empresa_autentica']=='M'){
                                    $autenticaCon = 'Autentica con correo electrónico';
                                }
                                if($usuario['empresa_autentica']=='C'){
                                    $autenticaCon = 'Autentica con número de celular';
                                }
                                if($usuario['empresa_autentica']=='M' && $usuario['usuario_email']==$email ){
                                   $ok=true;
                                }
                                if($usuario['empresa_autentica']=='U' && $usuario['usuario_nrodoc']==$email ){
                                   $ok=true;
                                }
                                if($usuario['empresa_autentica']=='C' && $usuario['usuario_celular']==$email ){
                                   $ok=true;
                                }  
                                if ($ok){
                                    $ctrl=1;
                                    $mh = $usuario['usuario_nombre'].'||'.$usuario['usuario_tipo_acceso'].'||'.$usuario['usuario_perfil'];
                                    $mh .= '||'.$usuario['usuario_id'].'||'.$usuario['usuario_empresa'];
                                    $mh .= '||'.$usuario['empresa_nombre'].'||'.$usuario['usuario_avatar']; 
                                    $mh .= '||'.$usuario['empresa_cresidencial'].'||'.$usuario['empresa_logo'].'||'.$ctrl; 
                                    $mh .= '||'.$usuario['empresa_lenguaje'];
                                    setcookie("mh",$mh);
                                  //  $_SESSION = array();
                                    $_SESSION['mh']=$mh;
                                    $result .=$mh;                
                                }
                                else{
                                    $result .= "Error: Registro incorrecto . " . $autenticaCon;
                                }
                            }else{
                                $result .= "Error: Clave invalida " ;
                            }
                          }else{
                            $result .= "Error: Usuario con fecha de ingreso expirada";
                          }
                    }else{
                         $result.="Error: Usuario inactivo";
                    }
                }else{
                    $result.="Error: Usuario no registrado";
                }
            }else{
                    $result.="Error: Base de datos no conecta";
                }   
                
           return $result;
        }
          
        function funde($txt){
            $n= strlen($txt);
            $ret='';
            for ($i=0;$i<=$n;$i++)
            {
                $ret.= substr($txt,$n - $i,1);
            }
            return $ret;
        }
      
        public function cargaEmpresa($empresa){
            $obj = new DBconexion();
            $con = $obj->conectar();
            if($con==true)
            {
                $retorno = '';
                $sql="SELECT empresaId, empresaNombre, empresaNit, empresaDigito, empresaWeb, " .
                     " empresaDireccion ,empresaCiudad ,empresaTelefonos ,empresaLogo ," .
                     " empresaMensaje1, empresaMensaje2, empresaEmail, empresafacturaNota, " .
                     " empresaRecargoPorc, empresaRecargoPesos, empresaRecargoDias, empresaDescPorc,".
                     " empresaDescPesos, empresaFactorRedondeo " .
                     " FROM contaempresas  WHERE  empresaId = ". $empresa ;
                $result =  mysqli_query($con, $sql);
                while($reg = mysqli_fetch_assoc($result)) {
                {
                    $retorno = $reg['empresaId'].'||'.$reg['empresaNombre'].'||'.trim($reg['empresaNit']).'-'.
                    trim($reg['empresaDigito']).'||'.$reg['empresaWeb'].'||'.$reg['empresaDireccion'].'||'.
                    $reg['empresaTelefonos'].'||'.$reg['empresaCiudad'].'||'.$reg['empresaLogo'].
                    '||'.$reg['empresaMensaje1'].'||'. $reg['empresaMensaje2'].'||'. $reg['empresaEmail'] .
                    '||'.$reg['empresafacturaNota'].'||'.$reg['empresaDescPesos'].
                    '||'.$reg['empresaRecargoPesos'].'||'.$reg['empresaRecargoDias'] .
                    '||'.$reg['empresaDescPorc'].'||'.$reg['empresaDescPesos'].
                    '||'.$reg['empresaFactorRedondeo'];
                  }
                  echo $retorno;
            return $retorno;   
                }
           }
        }    
    
	function cuentaRegistros($tabla,$condicions)
	{
            $obj = new DBconexion();
            $con = $obj->conectar();

            if($con==true)
            {
                $nr=0; 
                $sql = 'SELECT COUNT(*) AS nr FROM '.$tabla. ' WHERE ' . $condicions ;   
    //echo $sql;            
		$result =  mysqli_query($con, $sql);
                $nr = $result->fetch_row();
                return (int)$nr[0]; 
            }
	}
        
        function crud($op, $tabla, $campos, $datos){
            $con=$this->conectar();
            if($con){
                switch ($op){
                case 'C':
                     $resultado="INSERT INTO " . $tabla .'(';
                    for ($i=0;$i<=count($campos);$i++){
                        if ($i>0){$resultado .= ', ';}
                        $resultado .= $campos[$i];
                    }
                    $resultado .=" VALUES (";
                    for ($i=0;$i<=count($datos);$i++){
                        if ($i>0){$resultado .= ', ';}
                        $resultado .= "'" . $datos[$i]. "'";
                    }
                    $resultado .=") ";
                    break;
                case "R":
                    $resultado="SELECT ";
                    for ($i=0;$i<=count($campos);$i++){
                        if ($i>0){$resultado .= ', ';}
                        $resultado .= $campos[$i];                       
                    }
                    $resultado .="FROM " . $tabla;
                    break;
                case 'U':
                     $resultado="UPDATE " . $tabla .' SET ';
                    for ($i=0;$i<=count($campos);$i++){
                        if ($i>0){$resultado .= ', ';}
                        $resultado .= $campos[$i]. " = '" . $datos[$i]. "'";
                    }
                    break;
                case "D":
                    $operacion="eliminado";
                    $sql = 'DELETE FROM ' . $tabla . ' WHERE ' . $campos[0] . ' = '.$datos[0]; 
                    break;
                default:
                    echo "Operación errada!";
                }
                $resultado='Registro '.$operacion;
                $result =  mysqli_query($con, $sql);
                if (mysqli_errno($con) != 0){
                    $resultado='Erro: No '.$operacion;
                } 
                
            }else
            {
                $resultado="Error: Conexion de base de datos";
            }
            return $resultado;
        }
        
	function eliminarRegistro($table, $campoId, $id){
            $resultado="OK. Registro eliminado";
            $obj = new DBconexion();
            $con = $obj->conectar();
            if($con==true)
            {
                $sql = 'DELETE FROM ' . $table . ' WHERE ' . $campoId . ' = '.$id;  
		$result =  mysqli_query($con, $sql);
                if (mysqli_errno($con) != 0){
                    $resultado='Erro: No borro el registro';
                } 
            }
            return $resultado;
        }

        function limitePagina($nr, $pag, $regXpag, $modo, $busca)
        {
            $paginas = floor($nr / $regXpag) + 1;
            if($modo=='P'){$pagina = 1;}
            if($modo=='U'){$pagina = $paginas;}
            if($modo=='S'){$pagina = $pag + 1;
                if ($pagina>$paginas){$pagina=$paginas;}
            }
            if($modo=='A'){$pagina = $pag - 1;
               if ($pagina<1){$pagina=1;}
             }
            $nrRecs = (intval($pagina) - 1)  * (int)$regXpag ;
            return $nrRecs;
        }
        
        function actualizaEmpresa($registro){

        }
 
	function cargaMenu($usuario){

        }        
        
        function menuPorPerfil($perfil,$gral){

        }

        function actualizaMenu($data,$perfil){

        }
        
        function actualizaAccesosMenu($perfil, $opciones){
 
        }   
        
 
  
        Function compara2fechas($FechaInicio, $FechaFin){
            return true;
        }        
     
                
Function sumaDias_fecha($fecha, $dias){
        $nrDias = array('31','28','31','30','31','30','31','31','30','31','30','31',);
        $dia = idate("d");
        $mes = idate("m");
        $ano = idate("Y");
        if ($ano % 4 == 0) {$nrDias[1]='29';}
        $dia = $dia + $dias;
        do {
            if ($dia > $nrDias[$mes - 1]){
            $mes = $mes  + 1;
            if ($mes > 12){
            $mes = 1;
            $ano = $ano + 1 ;
        }
            $dia -= $nrDias[$mes - 1];
        }

        } while($dia > $nrDias[$mes - 1]);
            $response = $ano . '-';
            if ($mes < 10) {$response = $response . '0';}
            $response = $response.$mes . '-';
            if ($dia < 10) {$response = $response . '0';}
            $response = $response.$dia; 
        return $response;
}
  
 
    function ListaDesplegable($tabla, $id, $campo, $sel, $where){
        $obj = new DBconexion();
        $con = $obj->conectar();
        $orden = $campo;
        if($con==true)
            {
            $cod='';
            $det='';
            $respuesta='<select name="sel'.$tabla .'" id="sel'.$tabla .'"><option value="-1">Seleccione</option>';
            $sql = 'SELECT ' . $id . ',' . $campo . ' FROM '.$tabla. ' WHERE '. $where . ' ORDER BY ' . $orden ;  
            $result = mysqli_query($con, $sql);
            while( $reg = mysqli_fetch_array($result, MYSQLI_NUM) ){
                $cod=$reg[0]; 
                $des=$reg[1];  
                if ($sel==$cod){
                    $respuesta .= "<option value='".$cod."' selected>$des</option>";
                }else{
                    $respuesta .= "<option value='".$cod."'>$des</option>";
                }                    
            }
            $respuesta .= '</select>';
            echo $respuesta;
            return $respuesta;
            }
    }
    
    function actualizaConsecutivo($parametro, $valor){
        $obj = new DBconexion();
        $con = $obj->conectar();
        if($con==true) {
           $sql=" UPDATE cimaparametros SET " . $parametro . " = '" . $valor ."' ";
           $result = mysqli_query($con, $sql);
        }
    }
    
        
    function  ceros($valor, $tamano){
    $n=5;
    if ($valor>=10){
        $n=4;
    }
    if ($valor>=100){
        $n=3;
    }
    if ($valor>=1000){
        $n=2;
    }
    if ($valor>=10000){
        $n=1;
    } 
    if ($valor>=100000){
        $n=0;
    }    
    $zero="00000000000000000000";
    $response = substr($zero,0,$n).$valor;
    return $response;
    }   
    
    
    function subeArchivo($prefijo){
  
    }
        
}        

