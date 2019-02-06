<?php 
// session_start();
class DBclases{
        var $mysqli;
        
	function DBclases(){
       
	}

        function leeParametros($id){
            $obj = new DBconexion();
            $con = $obj->conectar();
            if($con==true){ 

                $sql = 'SELECT empresa_id, empresa_nombre, empresa_nit, empresa_web, empresa_direccion, empresa_telefonos, empresa_ciudad, empresa_logo FROM mm_empresa';
                $result = mysqli_query($con, $sql);
                return $result;
           }
           else {
                echo '<br> Error en conexion' ;  
           }
        }
      

function leeLista($tabla, $id, $campo, $condicion){
        $obj = new DBconexion();
        $con = $obj->conectar();
        if($con==true)
            {
            echo 'conetado';
            $sql = 'SELECT ' . $id . ',' . $campo . ' FROM '.$tabla. ' WHERE ' . $condicion . ' ORDER BY ' . $campo ;
            echo $sql;
                     $result = mysqli_query($con, $sql);
                return $result;
            }
        else {
            echo '<br> Error en conexion' ;  
            }
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
            $dia -= $nrDias[$mes - 1];
        }
        if ($mes > 12){
            $mes = 1;
            $ano = $ano + 1 ;
        }
        } while($dia > $nrDias[$mes - 1]);
            $response = $ano . '-';
            if ($mes < 10) {$response = $response . '0';}
            $response = $response.$mes . '-';
            if ($dia < 10) {$response = $response . '0';}
            $response = $response.$dia; 
        return $response;
}
     
        
	function eliminarRegistro($table, $campoId, $id){
            $result="Registro eliminado";
            $ok=true;
            if($this->conectar()==true){
                $sql = 'DELETE FROM ' . $table . ' WHERE ' . $campoId . ' = '.$id;
              
		$ok = mysqli_query($sql);
                if (!$ok) {$result='Erro: No borro el registro';}
            }else{
                $result='Error: No hay conexion a la base de datos';
            }
            return $result;
        }  

        
	function mostrar_varios_registros($tabla,$fields,$condicions,$orden,$pagina,$registros_pagina)
        {
           if($this->conectar()==true){
                $fields = implode(',',$fields);
                $nrRecs = 0;
                $nrRecs = (intval($pagina) - 1)  * (int)$registros_pagina ;
                $sql = 'SELECT '.$fields.' FROM '.$tabla. ' WHERE ' . $condicions . ' ORDER BY '.$orden.
                ' LIMIT ' . $nrRecs . " , " . $registros_pagina;
               //echo $sql;
		$result = mysql_query($sql);
                return $result;
		}
	}
      
        function verInmueblesLista() //DptoAviso, CiudadAviso,
        {
             if($this->conectar()==true){
                $sql="SELECT distinct concat (ucase(DptoAviso), '-', ucase(CiudadAviso),'-',ucase(zona)) As ciudad 
                    FROM paginaventas  ORDER BY ubicacion,zona";
                $result = mysql_query($sql);
                return $result;
             }
        }
        
        
 	function mostrar_un_registro($table, $campoId, $id){
            if($this->conectar()==true){
                $sql = 'SELECT * FROM ' . $table . ' WHERE ' . $campoId . ' = '.$id;
		return mysql_query($sql);
		}
	}
        

	function cuentaRegistros($tabla,$condicions)
	{
            if($this->conectar()==true){
                $sql = 'SELECT *  FROM '.$tabla. ' WHERE ' . $condicions ;
                $nr=0;
            echo $sql;  
		$result = mysql_query($sql);
                $nr = (int)mysql_num_rows($result);
		return (int)$nr; 
            }
	}
        
        function headerGrilla($tabla,$BaseDatos){
            $resulth = mysql_query("SHOW FULL COLUMNS FROM " . $tabla . " FROM " . $BaseDatos);  
            return $resulth;
        }
        
        
function dropdown($table , $id , $field)
{
    $sql = "select * from $table ORDER BY $field";
    $res = mysql_query($sql) or die(mysql_error());
    while ($a = mysql_fetch_assoc($res))
    echo "<option value=\"{$a[$id]}\">$a[$field]</option>";
}
   
        Function compara2fechas($FechaInicio, $FechaFin){
            return true;
        }
        
    function  ceros($valor, $tamano){
        $zero="00000000000000000000";
        $i=strlen($valor);
        $ii = $tamano - $i;
        $j = (int) $tamano - $ii + 1;
        $response = substr($zero,0,$j).$valor;
        return $response;
    }   


        
//          $con = $this->conectar();
//           if($con==true){ 
//            $sql = 'SELECT id,foto,titulo,descripcion FROM primerapag ORDER BY id';
//            $result = mysqli_query($con,$sql);
//            return $result;
//           }
//        }        
       
        function actualizaParametros($campos){
            $response="";
            if($this->conectar()==true){ 
                $sql = "UPDATE parametros SET ".
                " empresa = '".trim($campos['empresa'])."',".
                " nit = '".trim($campos['nit'])."',".
                " direccion = '".trim($campos['direccion'])."',".
                " ciudad = '".trim($campos['ciudad'])."',".
                " telefonos = '".trim($campos['telefonos'])."',".
                " celuar = '".trim($campos['celuar'])."',".
                " ProyectoPpal = '".trim($campos['ProyectoPpal'])."',".
                " email = '".trim($campos['email'])."', logo = '" . $campos['logo'] . "'  WHERE id = " . $campos['id'] ; 
                ///echo $sql;
                if (mysql_query($sql)){
                    $response = 'Actualizacion correcta';
                }else{
                   $response =  'Error: Falla en la actualizacion'; 
                }
            }else{$response =  'Error: No conectado';}
            return $response;
        }
    
        public function leeUsuario($usuario){
            if($this->conectar()==true){ 
                $result='';
                $strSql = "SELECT usuarioEmpresaId, usuarioUsuario, usuarioClave, usuarioNombre, usuarioTipo, ".
                        "usuarioFechaVigencia, usuarioActivo ".
                        "FROM usuarios WHERE usuarioUsuario='".$usuario."' ";                 
                $result =  mysql_query($strSql);
            }
        }
        
    public  function validaUsuario($usuario, $clave){ 
                   $datos=array('Empresa'=>"2",'NomEmpresa'=>"Proinger SAS",'Usuario'=>"",'Tipo'=>"",
                   'Nombre'=>"",'nit'=>"", 'direccion'=>"", 'ciudad'=>"", 'telefonos'=>"", 'celuar'=>"",
                   'email'=>"", 'logo'=>"",'error'=>"");
       if($this->conectar()==true){ 

           $result='Ok';
            $strSql = "SELECT usuarioEmpresaId, usuarioUsuario, usuarioClave, usuarioNombre, usuarioTipo, ".
                      "usuarioFechaVigencia, usuarioActivo, empresa, nit, direccion, ciudad, ".
                      "telefonos, celuar, email, logo, ProyectoPpal FROM usuarios, parametros ".
                      " WHERE parametros.id = usuarioEmpresaId AND usuarioUsuario='".$usuario."' ";                 
            $resultado =  mysql_query($strSql);
            $totRec = mysql_num_rows($resultado);
            if ($totRec > 0) {
                $usuario = mysql_fetch_assoc($resultado);
                $claveOk = md5($clave);
                if($usuario['usuarioActivo']=='A'){
                    date_default_timezone_set('America/New_York');
                    $fecha = date("Y-m-d");
                    if ($this->compara2fechas($usuario['usuarioFechaVigencia'],$fecha)){                                         
                        if($usuario['usuarioClave'] == $claveOk){
                           // session_start(); 
                            $datos['Empresa']=$usuario['usuarioEmpresaId'];
                            $datos['Nombre']=$usuario['usuarioNombre'];
                            $datos['Usuario']=$usuario['usuarioUsuario'];
                            $datos['Tipo']=$usuario['usuarioTipo'];
                            $datos['nit']=$usuario['nit'];
                            $datos['direccion']=$usuario['direccion'];
                            $datos['ciudad']=$usuario['ciudad'];
                            $datos['telefonos']=$usuario['telefonos'];
                            $datos['celuar']=$usuario['celuar'];
                            $datos['email']=$usuario['email'];
                            $datos['logo']=$usuario['logo'];
                            $datos['NomEmpresa']=$usuario['empresa']; 
                            $datos['ProyectoPpal']=$usuario['ProyectoPpal'];
                        }else{
                            $datos['error']= "Error: Clave invalida";
                        }
                      }else{
                        $datos['error']="Error: Usuario con fecha de ingreso expirada";
                      }
                }else{
                     $datos['error']= "Error: Usuario inactivo";
                }
            }else{
              $datos['error']= "Error: Usuario no registrado";
            }

        }
        return $datos;
    }
       
    public function actualizaClave($usuario, $claveOld,  $claveNew){
        $_SESSION['mensaje'] = "";
        $oldClave = md5($claveOld);
        $nuevaClave = md5($claveNew);
        date_default_timezone_set('America/New_York');
        $fecha = date("Y-m-d");
        if($this->conectar()==true){ 
            $strSql = "SELECT usuarioClave FROM contausuarios WHERE usuarioUsuario = '". $usuario .
                  "' AND usuarioClave = '".$oldClave."' ";
            $result=mysql_query($strSql) or die (mysql_error());
            $nrFilas = mysql_num_rows($result);
   
            $strSql = "UPDATE contausuarios SET usuarioClave = '" . $nuevaClave ."', usuarioFechaActualizacion = '" . "$fecha" .
                "' WHERE usuarioUsuario = '" . $usuario ."' ";
            $update=mysql_query($strSql) or die (mysql_error());
            if ($update <> '1'){
                $_SESSION['mensaje'] = "ERROR: ".$update;
            }
        }
        echo($_SESSION['mensaje']);
    }
    
       public function actualizaClaveRapido($usuario, $claveOld,  $claveNew){
        $_SESSION['mensaje'] = "";
        $oldClave = md5($claveOld);
        $nuevaClave = md5($claveNew);
        date_default_timezone_set('America/New_York');
        $fecha = date("Y-m-d");
        if($this->conectar()==true){ 
     
            $strSql = "UPDATE contausuarios SET usuarioClave = '" . $nuevaClave ."', usuarioFechaActualizacion = '" . "$fecha" .
                "' WHERE usuarioUsuario = '" . $usuario ."' ";
            $update=mysql_query($strSql) or die (mysql_error());
            if ($update <> '1'){
                $_SESSION['mensaje'] = "ERROR: ".$update;
            }
        }else{
            echo('error al conectar actualizacion de llave');
        }
        echo($_SESSION['mensaje']);
    }


      public  function leePaginaPincipal(){
          
           if($this->conectar()==true){ 
            $sql = 'SELECT id,foto,titulo,descripcion FROM primerapag ORDER BY id';
            $result = mysql_query($sql);
            return $result;
           }
        }
        
      public function actualizaPaginaPrincipal($registro){
        if($this->conectar()==true){ 
            $sql = "UPDATE primerapag SET foto = '" . $registro['foto'] . "',titulo = '" .
                   $registro['titulo'] . "', descripcion = '" .
                   $registro['descripcion'] . "'  WHERE id = " . $registro['id'];
          //  echo '<br>'.$sql;
            $result = mysql_query($sql);
            return $result;
        }          
      }
      
        public function actualizaPaginaProyectos($registro){
        if($this->conectar()==true){ 
            $sql = "UPDATE proyectospag SET foto = '" . $registro['foto'] . "',titulo = '" .
                   $registro['titulo'] . "', descripcion = '" .
                   $registro['descripcion'] . "'  WHERE id = " . $registro['id'];
           // echo '<br> proyectos'.$sql;
            $result = mysql_query($sql);
            return $result;
        }          
        }  

      
        public function CreaPaginaProyectos($registro){
        if($this->conectar()==true){ 
            $sql = "INSERT INTO proyectospag (foto,titulo,descripcion) VALUES('" . $registro['foto'] . "','" .
                   $registro['titulo'] . "','" . $registro['descripcion'] . "')" ;
            echo '<br> proyectos'.$sql;
            $result = mysql_query($sql);
            return $result;
        }          
        }        
 
        public function borrarPaginaProyectos($id){
        if($this->conectar()==true){ 
            $sql = "DELETE from proyectospag WHERE id = " . $id ;
            echo '<br> proyectos'.$sql;
            $result = mysql_query($sql);
            return $result;
        }          
        }         
        
      public  function leePaginaProyectos(){
          $con = $this->conectar();
           if($con==true){ 
            $sql = 'SELECT id,foto,titulo,descripcion FROM primerapag ORDER BY id';
            $result = mysqli_query($con,$sql);
            return $result;
           }
        }
        
      public  function leePaginaMisProyectos(){
          
           if($this->conectar()==true){ 
            $sql = 'SELECT id,foto,titulo,descripcion FROM proyectospag ORDER BY id';
            $result = mysql_query($sql);
            return $result;
           }
        }
     public function leeRegistroVentas($idEmpresa){
          if($this->conectar()==true){ 
            $sql = 'SELECT id, idEmpresa, codigo, descripcion, detalles, precio, area, cuartos, banos, '.
                    'DptoAviso, CiudadAviso, ubicacion, zona, tipo, foto0, foto1, foto2, foto3, foto4, '.
                    'foto5, foto6, Video, Nombre, direccion, CiudadCliente, BarrioCliente, telefonos, '-
                    'Celular, eMail, fechaActivo, FchPublicacion, FchVencimiento, Asociado, Visitas, Activo ';
            $sql = $sql . ' FROM paginaventas WHERE idEmpresa = ' . $idEmpresa . ' ORDER BY descripcion ';
            $result = mysql_query($sql);
            return $result;
           }
    }
    
     public function leeRegistroVentasXcod($codigo){
          if($this->conectar()==true){ 
            $sql = 'SELECT id, idEmpresa, codigo, descripcion, detalles, precio, area, cuartos, banos, '.
                    'DptoAviso, CiudadAviso, ubicacion, zona, tipo, foto0, foto1, foto2, foto3, foto4, '.
                    'foto5, foto6, Video, Nombre, direccion, CiudadCliente, BarrioCliente, telefonos, ' .
                    'Celular, eMail, fechaActivo, FchPublicacion, FchVencimiento, Asociado, Visitas, Activo ' .
            $sql = " FROM paginaventas WHERE codigo = '" . $codigo . "'";
//            echo $sql;
            $result = mysql_query($sql);
            return $result;
           }
    }    
     public function leeRegistroVentasXid($id){
          if($this->conectar()==true){ 
            $sql = 'SELECT id, codigo, descripcion, detalles, precio, area, cuartos, banos, ubicacion, zona, tipo,
                   fechaActivo, foto0, foto1, foto2, foto3, foto4, foto5, foto6, Video, direccion, telefonos, eMail,
                   FchPublicacion, FchVencimiento, Asociado, Visitas, idEmpresa ';
            $sql = $sql . ' FROM paginaventas WHERE id = ' . $id;
            $result = mysql_query($sql);
            return $result;
           }
    }    
      function actualizaVentas($registro){
        //  print_r($registro);
            $result = $this->mostrar_un_registro('paginaventas', 'id', $registro['id']);
            if (isset($result)){
                $nr = mysql_num_rows($result);               
                if ($nr <> '0') {
                    $resultado=$registro['id']; 
                    $registro['fechaActivo'] = $registro['FchPublicacion'];
                    $sql = 'UPDATE paginaventas SET descripcion = "' . $registro['descripcion'] . '", '.
                    'detalles = "' . htmlentities($registro['detalles']) . '", '.
                    'precio = ' . $registro['precio'] . ', '.
                    'area = ' . $registro['area'] . ', '.
                    'cuartos = ' . $registro['cuartos'] . ', '.
                    'banos = ' . $registro['banos'] . ', '.
                    'Visitas = ' . $registro['Visitas'] . ', '.                          
                    'ubicacion = "' . $registro['ubicacion'] . '", '.
                    'zona = "' . $registro['zona'] . '", '.
                    'tipo = "' . $this->tipoNom($registro['tipo']) . '", '.
                    'fechaActivo = "' . $registro['fechaActivo'] . '", '.                          
                    'foto0 = "' . $registro['foto0'] . '", '.
                    'foto1 = "' . $registro['foto1'] . '", '.
                    'foto2 = "' . $registro['foto2'] . '", '.
                    'foto3 = "' . $registro['foto3'] . '", '.
                    'foto4 = "' . $registro['foto4'] . '", '.
                    'foto5 = "' . $registro['foto5'] . '", '.
                    'foto6 = "' . $registro['foto6'] . '", '.
                    'Video = "' . $registro['Video'] . '", '.
                    'direccion = "' . $registro['direccion'] . '", '.
                    'telefonos = "' . $registro['telefonos'] . '", '.
                    'eMail = "' . $registro['eMail'] . '", '.
                    'FchPublicacion = "' . $registro['FchPublicacion'] . '", '.
                    'FchVencimiento = "' . $registro['FchVencimiento'] . '", '.
                    'Asociado = "' . $registro['Asociado'] . '", '.
                    'DptoAviso = "' . $registro['DptoAviso'] . '", '.
                    'CiudadAviso = "' . $registro['CiudadAviso'] . '", '.
                    'ubicacion = "' . $registro['ubicacion'] . '", '.
                    'Nombre = "' . $registro['Nombre'] . '", '.
                    'CiudadCliente = "' . $registro['CiudadCliente'] . '", '.
                    'BarrioCliente = "' . $registro['BarrioCliente'] . '", '.
                    'Celular = "' . $registro['Celular'] . '", '.
                    'Activo = "' . $registro['Activo'] . '" '.
                    ' WHERE Id = '  . $registro['id'];
                }else{
                    $resultado="Aviso creado "; 
                    $sql = 'INSERT INTO paginaventas (idEmpresa, codigo, descripcion, detalles, precio, area, cuartos, 
                            banos, DptoAviso, CiudadAviso, ubicacion, zona, tipo, foto0, foto1, foto2, foto3, foto4, 
                            foto5, foto6, Video, Nombre, direccion, CiudadCliente, BarrioCliente, telefonos,  Celular,
                            eMail, fechaActivo, FchPublicacion, FchVencimiento, Asociado, Visitas, Activo) 
                            VALUES (' . $registro['idEmpresa'] . ', "' . $registro['codigo'] . '", "'.
                           $registro['descripcion'] . '", "'. $registro['detalles'] . '", '.$registro['precio'] . ', ' .
                           $registro['area'] . ','. $registro['cuartos'] . ','.$registro['banos'] . ',"' . 
                           $registro['DptoAviso'] . '","'. $registro['CiudadAviso'] . '","'.
                           $registro['ubicacion'] . '","'. $registro['zona'] . '","'. $this->tipoNom($registro['tipo']) . '","' . 
                           $registro['foto0'] . '","'.$registro['foto1'] . '","' . 
                           $registro['foto2'] . '","'. $registro['foto3'] . '","'.$registro['foto4'] . '","' . 
                           $registro['foto5'] . '","'. $registro['foto6'] . '","'.$registro['Video'] . '","' . 
                           $registro['Nombre'] . '","'.$registro['direccion'] . '","'. $registro['CiudadCliente'] . '","'. 
                           $registro['BarrioCliente'] . '","'. $registro['telefonos'] . '","'.$registro['Celular'] . '","' . 
                           $registro['eMail'] . '","' . $registro['fechaActivo'] . '","'.
                           $registro['FchPublicacion'] . '","'. $registro['FchVencimiento'] . '","'.
                           $registro['Asociado'] . '",' . $registro['Visitas']  . ',"' . $registro['Activo'] . '");'; 
                 }
   
//echo 'sql op: ' . $sql;
                $result = mysql_query($sql);
                if ($nr == 0) {
                    $id = mysql_insert_id(); 
                    date_default_timezone_set('America/New_York');
                    $fecha = date("Y");
                    $codigo = $this->tipoNom($registro['tipo']) . substr($fecha,2,3) . $this->ceros($id,7);                    
                    $sql = "UPDATE paginaventas SET codigo = '" . $codigo . "' WHERE id =  " . $id;
                
//echo '<br> sql up: ' . $sql;                    
                    $result = mysql_query($sql);
                    $resultado = $id;
                    $file = "fotos/".$codigo;
         //           echo $file;
                    if (!file_exists($file)) {
                        mkdir($file);
                        chmod($file,'0777');
                    }
                }
            }
            return $resultado;
        }
    function primerViddeo(){
        if($this->conectar()==true){ 
             $rs = mysql_query("SELECT MIN(id) FROM Videos ");
            (int) $minID =  mysql_result($rs,0,"MIN(id)");
            return $minID;
        }
    }
    
    function recuperaUnVideo($id){
        if($this->conectar()==true){ 
            $sql='SELECT id, youtubeId, nombre, comentarios, tema FROM Videos WHERE id = ' .$id;
           
            $result = mysql_query($sql);            
            return $result;
        }
    }
    
    function tipoNom($tipo){
        $datos='';
          switch ($tipo){
              case "Casa":
                  $datos = "C";
              break;
              case "Apartamento":
                  $datos = "A";
              break;
              case "Finca":
                  $datos = "F";
              break;
              case "Lote":
                  $datos = "L";
              break;
              case "Bodega":
                  $datos = "B";
              break; 
              case "Oficina":
                 $datos = "O";
              break;        
          }  
              return $datos;
    }
    function aviso($mensaje){
        echo '<script type="text/javascript">';
        echo "alert('" . $mensaje ."');";
        echo '</script>';
    }
}


?>
