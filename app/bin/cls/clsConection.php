<?php 
session_start();

class DBconexion{
	var $conect;  
	var $BaseDatos;
	var $Servidor;
	var $Usuario;
	var $Clave;
        var $mysqli;
        
        var $er;
        
	function DBconexion(){
//		$this->BaseDatos = "atominge_mmeeting";
//		$this->Servidor = "localhost";
//		$this->Usuario = "atominge_mm123";
//		$this->Clave = "mmCien1000";   
            
            ini_set('track_errors', 1);
            $fd = fopen('../bin/cls/mm.ctl', 'r');

            $datos=fread($fd,filesize('../bin/cls/mm.ctl')); 
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
                $strSql = "SELECT usuario_password FROM mm_usuarios where usuario_id = " . $dat[3];
            
                $claveOk = md5($dat[0]);
                $resultado =  mysqli_query($con, $strSql);
                $usuario = mysqli_fetch_array($resultado, MYSQL_ASSOC);
                if($usuario['usuario_password'] ==  $claveOk ){
                    $strSql = "UPDATE mm_usuarios SET usuario_password = '" . md5($dat[1]) . 
                            "' WHERE usuario_id = " . $dat[3];
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
            $fd = fopen('../bin/cls/mm.ctl', 'r');
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
//            echo $mictl;
//           return  localhost||mmeeting||root||123||admin@com.co||123Array
            
            $obj = new DBconexion();
            $con = $obj->conectar();
            $email= TRIM($dat[0]);
            $clave=$dat[1];
          //  $cond=$dat[2];
            if($con==true){
                if (isset($_SESSION['mm'])) {
                    unset($_SESSION['mm']);
                }
                $where = '';
                $where = " usuario_email = '". $email. "' OR usuario_celular = '".
                        $email."' OR usuario_user = '".$email."' ";
                $strSql = "SELECT usuario_id, usuario_nombre , usuario_email, usuario_password, " .
                        " usuario_tipo_acceso,  usuario_fechaActualizado, " .
                        " usuario_estado, usuario_perfil, usuario_avatar, usuario_user, " .
                        " usuario_empresa, empresa_nombre, empresa_nit, empresa_id,  " .
                        " empresa_web, empresa_direccion, empresa_telefonos, empresa_ciudad, " .
                        " empresa_logo, empresa_autentica, empresa_lenguaje, empresa_cresidencial,  " .
                        " empresa_ctrl FROM mm_usuarios " .
                        " INNER JOIN mm_empresa ON empresa_id = usuario_empresa WHERE " . $where;
               $result = ''; 
//echo $strSql;
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
                                if($usuario['empresa_autentica']=='U' && $usuario['usuario_user']==$email ){
                                   $ok=true;
                                }
                                if($usuario['empresa_autentica']=='C' && $usuario['empresa_telefonos']==$email ){
                                   $ok=true;
                                }  
                                if ($ok){
                                    $aa=$usuario['empresa_ctrl'];                              
                                    $a1=substr($aa, 12, 1);
                                    $a2=substr($aa, 24, 1);
                                    $a3=substr($aa, 28, 2);
                                    $ctrl=0;
                                    if((int)$a1+(int)$a2 == (int)$a3){$ctrl=1;}
                                    $mm = $usuario['usuario_nombre'].'||'.$usuario['usuario_tipo_acceso'].'||'.$usuario['usuario_perfil'];
                                    $mm .= '||'.$usuario['usuario_id'].'||'.$usuario['usuario_empresa'];
                                    $mm .= '||'.$usuario['empresa_nombre'].'||'.$usuario['usuario_avatar']; 
                                    $mm .= '||'.$usuario['empresa_cresidencial'].'||'.$usuario['empresa_logo'].'||'.$Ctrl; 
                                    setcookie("mm",$mm);
                                    $_SESSION = array();
                                    $_SESSION['mm']=$mm;
                                    $result .=$mm;
                                }
                                else{
                                    $result .= "Error: Registro incorrecto . " . $autenticaCon;
                                }
                            }else{
                                $result .= "Error: Clave invalida";
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
      
        function cargaEmpresa($empresa){
            $obj = new DBconexion();
            $con = $obj->conectar();
            if($con==true)
            {
                $retorno = '';
                $sql='SELECT empresa_id, empresa_nombre, empresa_nit, empresa_web, empresa_direccion, empresa_telefonos, '.
                     'empresa_ciudad, empresa_logo, empresa_autentica, empresa_lenguaje FROM mm_empresa  WHERE  empresa_id = '. $empresa ;
                $result =  mysqli_query($con, $sql);
                while( $reg = mysqli_fetch_array($result, MYSQL_ASSOC) )
                {
                    $retorno = $reg['empresa_id'].'||'.$reg['empresa_nombre'].'||'.$reg['empresa_nit'].'||'.$reg['empresa_web'].'||'.$reg['empresa_direccion'].'||'.
                            $reg['empresa_telefonos'].'||'.$reg['empresa_ciudad'].'||'.$reg['empresa_logo'].'||'.$reg['empresa_autentica'].'||'.
                            $reg['empresa_lenguaje'];
  
                }
            return $retorno;   
                  
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
            $obj = new DBconexion();
            $con = $obj->conectar();
            if($con==true)
            {
  //             print_r($registro);
                $sql='UPDATE cimaparametros SET  '.
                    ' param_nombre = "'. $registro ['param_nombre'] .'", param_nit = "' .$registro ['param_nit'] .
                    '", param_web = "'. $registro ['param_web'] .'", param_direccion = "' .$registro ['param_direccion'] .
                    '", param_telefonos = "'. $registro ['param_telefonos'] .'", param_ciudad = "' .$registro ['param_ciudad'] .
                    '", param_logo ="'.  $registro ['param_logo'] .'", param_regsGrilla = "' .$registro ['param_regsGrilla'] .
                    '", param_autenticacion ="'.  $registro ['param_autenticacion'] .'", param_representante = "' .$registro ['param_representante'] .
                    '", param_direccioncorreo  ="'.  $registro ['param_direccioncorreo'] .
                    '", param_mensajecorreo  ="'.  $registro ['param_mensajecorreo'] .
                 '", param_cedrepres  ="'.  $registro ['param_cedrepres'] .'"  WHERE param_id = ' .  $registro ['param_id'] ;             
                $result =  mysqli_query($con, $sql);
                $resultado= 'Registro actualizado' ;    
                echo $resultado;
            } 
        }
 
	function cargaMenu($usuario){
            $obj = new DBconexion();
            $con = $obj->conectar();
            if($con==true)
            {
                 $sql = "SELECT menu_descripcion, menu_menu, menu_orden, menu_nivel, menu_modulo, 
                menu_opcion, menu_parametros, menu_detalles 
                FROM cimamenu
                INNER JOIN cimausuariomenu ON usuarioMenu_menu = menu_id
                INNER JOIN cimausuarios ON usuarioMenu_perfil = usuario_perfil_id
                WHERE usuario_id = ".$usuario . " ORDER BY menu_menu, menu_orden, menu_nivel"  ;
		$result =  mysqli_query($con, $sql);
//             echo $sql;
            }
            return $result;
        }        
        
        function menuPorPerfil($perfil,$gral){
            $resultado = '<select name="origen[]" id="origen" multiple="multiple" size="15">';
            if($perfil > 0) { $resultado = '<select name="destino[]" id="destino" multiple="multiple" size="15">';}

            $obj = new DBconexion();
            $con = $obj->conectar();
            if($con==true)
            { 
                if ($perfil==0){
                   $sql = "SELECT menu_id, upper(menu_detalles) AS menu_detalles FROM cimamenu where menu_orden <> 0 and menu_id NOT IN 
                (SELECT usuarioMenu_menu  FROM cimausuariomenu WHERE  usuarioMenu_perfil = " . $gral. ")
                ORDER BY menu_detalles";   
                }else{
                   $sql = "SELECT menu_id, upper(menu_detalles) AS menu_detalles FROM cimamenu where menu_orden <> 0 and menu_id IN 
                (SELECT usuarioMenu_menu  FROM cimausuariomenu WHERE  usuarioMenu_perfil = " . $perfil. ")
                ORDER BY menu_detalles";   
                }
    //            echo $resultado;
                $result =  mysqli_query($con, $sql);
                    while( $reg = mysqli_fetch_array($result, MYSQL_ASSOC) )
                    {
                        $resultado = $resultado . "<option value=". $reg["menu_id"] .">" . $reg["menu_detalles"] . "</option>";
                    }
                    $resultado = $resultado . "</select>";
                     echo $resultado;
                   //  return $resultado;
            }
        }

        function actualizaMenu($data,$perfil){
            $where = '';
            $i=0;
            foreach ($data as $valor) {
                if ($i>0){$where =  $where . ", ";}
                $where =  $where . "'" . $valor. "'";
            }
            $obj = new DBconexion();
            $con = $obj->conectar();
            if($con==true)
            { 
                echo $where.'  ';
//                print_r($data);
            }
            
        }
        
        function actualizaAccesosMenu($perfil, $opciones){
            $obj = new DBconexion();
            $con = $obj->conectar();
            if($con==true)
            {
               $sql = 'SET SQL_SAFE_UPDATES = 0;';
               $result =  mysqli_query($con, $sql);
               $sql = 'DELETE FROM cimausuariomenu WHERE usuarioMenu_perfil = ' . $perfil ;                     
               $result =  mysqli_query($con, $sql);
                if (mysqli_errno($con) != 0){
                    $resultado='Error: No actualiza el perfil';
                }else{
                    $opMenu = explode(',',$opciones);
                    $n = count($opMenu);
                    for($i=0; $i<$n; $i++) {
                        $sql = 'INSERT INTO cimausuariomenu(usuarioMenu_menu,usuarioMenu_perfil,usuarioMenu_actualiza)  VALUES (' . $opMenu[$i]. ',' .  $perfil .',"A")';
                        $result =  mysqli_query($con, $sql);
                        // consultar si existe el registro padre del menu
                         $sql = 'SELECT * FROM cimausuariomenu where usuarioMenu_menu = ( select menu_id from cimamenu where menu_menu = '.
                                '(select menu_menu from cimamenu where  menu_id = ' . $opMenu[$i]. ') and menu_orden = 0) and usuarioMenu_perfil = ' .  $perfil;
                        $result =  mysqli_query($con, $sql);
                        $totRec =  $result->num_rows; 
                        if ($totRec==0){ // crea el registro padre del menu
                           $sql ='select menu_id from cimamenu where menu_orden = 0 and menu_menu = (select menu_menu from cimamenu where  menu_id = ' .  $opMenu[$i] .')';
                           
                           $result =  mysqli_query($con, $sql);
                                               while( $reg = mysqli_fetch_array($result, MYSQL_ASSOC) )
                    {
                        $menu = $reg['menu_id'];
                    }
                           $sql = 'INSERT INTO cimausuariomenu(usuarioMenu_menu,usuarioMenu_perfil,usuarioMenu_actualiza) VALUES (' .$menu .','.  $perfil .',"A")';
                              
                           $menu =  mysqli_query($con, $sql);
                        }
                    }
                     $resultado='Perfil Actualizado';
                }
            }
            echo $resultado;
        }   
        
        function nameUsuario($usuario)
 {
            $obj = new DBconexion();
            $con = $obj->conectar();
            if($con==true)
            {
                 $sql = "SELECT  cliente_contacto  AS nombre, cliente_nombre, CASE usuario_tipo_acceso WHEN 'A' THEN 'Administra' ELSE 'Consulta' END usuario_tipo_acceso ".
                         "FROM cimausuarios  INNER JOIN cimaclientes ON usuario_cliente_id = cliente_id WHERE usuario_id = ".$usuario  ;
		$result =  mysqli_query($con, $sql);
//             echo $sql;
            }
            return $result;
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

