<?php
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion();
$con = $objClase->conectar();
$data = json_decode(file_get_contents("php://input")); 
$op = mysqli_real_escape_string($con, $data->op);
     
$query = "SELECT param_popUp FROM mm_parametros; "; 
$result = mysqli_query($con, $query); 
 
if(mysqli_num_rows($result) != 0)  
{ 
    while($row = mysqli_fetch_assoc($result)) { 
       $popUp=$row['param_popUp'];
   }
       $resultado='';
if($popUp=='S'){
    $query="SELECT popup_titulo, popup_comentario FROM mm_popup where popup_codigo = 'comit'";
    $result = mysqli_query($con, $query); 
    while($row = mysqli_fetch_assoc($result)) { 
       $resultado="<div id='dialog' title='".$row['param_popUp']."'><p>".$row['popup_comentario']."</p></div>";
   }
  

}
}
return $resultado;


