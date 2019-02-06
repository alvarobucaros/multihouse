<?php
require_once 'clsConection.php';
$obj = new DBconexion;
$con = $obj->conect();

// $mod = U uno o V varios|pagina|registrops x pagina|Primero,Siguiente,Aanterios,Uultimo modo|cond|nro orden
if( isset($_POST['type']) && !empty( isset($_POST['type']) ) ){
	$type = $_POST['type'];
	
	switch ($type) {
		case "save":
			save($con,$reg);
			break;
		case "delete":
			delete($con, $_POST['id']);
			break;
		case "get":
			get($con, $_POST['mode']);
			break;
		default:
			invalidRequest();
	}
}else{
	invalidRequest();
}

/**
 * This function will handle user add, update functionality
 * @throws Exception
 */
function save($con, $reg){
    try{

        if( $reg[0]==0){
                $query = "INSERT INTO mm_comites (comite_empresa, comite_nombre, comite_descripcion)" .
                        " VALUES ('" . $reg[1] ."','". $reg[2] ."','". $reg[3] . "')";
        }else{
                $query = "UPDATE mm_comites SET comite_empresa = '". $reg[1] . "',".
                         " comite_nombre = '" . $reg[2] . "',".
                         " comite_descripcion = '" . $reg[3] . "' WHERE comite_id = " . $reg[0];
        }

        if( $con->query( $query ) ){
                $data['success'] = true;
                if(!empty($id))$data['message'] = 'Actualización exitosa.';
                else $data['message'] = 'Registro creado exitosamante.';
                if(empty($id))$data['id'] = (int) $mysqli->insert_id;
                else $data['id'] = (int) $id;
        }else{
                throw new Exception( $mysqli->sqlstate.' - '. $mysqli->error );
        }
        $con->close();
        echo json_encode($data);
        exit;
    }catch (Exception $e){
        $data = array();
        $data['success'] = false;
        $data['message'] = $e->getMessage();
        echo json_encode($data);
        exit;
    }
}


	
function get($con,$mode){
    try{
            $dat = explode('|', $mode);       
         
            if (is_int($dat[0]))
            {
                $sql = "SELECT comite_id, comite_empresa, comite_nombre, comite_descripcion FROM mm_comites " .
                       " WHERE comite_id = ".$dat[0];
            }
            else
            {
                $obj=new DBconexion();    
                $nr = $obj->cuentaRegistros('mm_comites','comite_id>0');
                $limite = $obj->limitePagina($nr, $dat[1], $dat[2],$dat[3],$dat[4]);
                // // $mod = # uno o V varios|pagina|registrops x pagina|P,S,A,U modo|cond|nro orden
                $sql =  "SELECT comite_id, comite_empresa, comite_nombre, comite_descripcion FROM mm_comites " .
                        " WHERE " .$dat[4] . 
                        " ORDER BY " . $dat[5] .
                        " LIMIT  ". $nrRecs . ","  . $registros_pagina; 
            }
            if($con($con, $sql)){
            $data = array();
            while ($row = $result->fetch_assoc()) {
                    $row['comite_id'] = (int) $row['comite_id'];
                    $row['comite_empresa'] = (int) $row['comite_empresa'];
                    $row['comite_nombre'] = $row['comite_nombre'];
                    $row['comite_descripcion'] =  $row['comite_descripcion'];
                    $data['data'][] = $row;
            }
            $data['success'] = true;
            echo json_encode($data);exit;
            }else
            {
                throw new Exception( "Registro no encontrado." );
            }
        
    }catch (Exception $e){
            $data = array();
            $data['success'] = false;
            $data['message'] = $e->getMessage();
            echo json_encode($data);
            exit;
    }
}
	
function delete($con, $id = ''){
	try{
		if(empty($id)) throw new Exception( "Llave inválida." );		
                $obj=new DBconexion();                
		if($obj->eliminarRegistro('mm_comites', 'comite_id', $id)){
			$data['success'] = true;
			$data['message'] = 'Comité ha sido borrado.';
			echo json_encode($data);
			exit;
		}else{
			throw new Exception( $mysqli->sqlstate.' - '. $mysqli->error );
		}		
	
	}catch (Exception $e){
		$data = array();
		$data['success'] = false;
		$data['message'] = $e->getMessage();
		echo json_encode($data);
		exit;
	}
}
	


function invalidRequest()
{
	$data = array();
	$data['success'] = false;
	$data['message'] = "Opción inválida";
	echo json_encode($data);
	exit;
}

