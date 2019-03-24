<?php
if( isset($_GET['pas']) ) {
  $pas = $_GET['pas'];
} else {
  $pas='99';
}

$rec=explode('||',$pas);

//print_r($rec);

if ($rec[6]=='C'){
    $anterior= '../actas';
    $carpeta = 'E'.zerofill(trim($rec[0]),5).'/'.trim($rec[3]).'/comite'.trim($rec[1]).'/acta'.trim($rec[2]);
    CreaCarpeta($anterior,$carpeta);
}
else if($rec[6]=='A'){
    $carpeta='../photo';
}   
else{
     $carpeta='../reports/images';
}
print_r($_FILES);
$pas=$carpeta.'/';   //emp+'||'+com+'||'+acta+'||'+anno+'||'+desc;
if(isset($_FILES["file"]["type"]))
{
$validextensions = array("jpeg", "jpg", "png", "pdf");
$temporary = explode(".", $_FILES["file"]["name"]);
$file_extension = end($temporary);
if ((($_FILES["file"]["type"] == "application/pdf") || ($_FILES["file"]["type"] == "image/jpg") || ($_FILES["file"]["type"] == "image/png") 
) && ($_FILES["file"]["size"] < 21000000)//Approx. 100kb files can be uploaded.
&& in_array($file_extension, $validextensions)) 
{
if ($_FILES["file"]["error"] > 0)
    {
    echo "Return Code: " . $_FILES["file"]["error"] . "<br/><br/>";
    }
else
    {
    if (file_exists("upload/"  . $_FILES["file"]["name"])) {
        echo $_FILES["file"]["name"] . " <span id='invalid'><b>already exists.</b></span> ";
        }
    else
        {
            $sourcePath = $_FILES['file']['tmp_name']; // Storing source path of the file in a variable
            $targetPath = "../actas/".$pas.$_FILES['file']['name']; // Target path where file is to be stored
            move_uploaded_file($sourcePath,$targetPath) ; // Moving Uploaded file
            echo "<div class='miDiv'><span id='success'>Carga Exitosa...!!</span><br/>";
            echo "<br/><b>Documento:</b> " . $_FILES["file"]["name"] . "<br>";
            echo "<b>Tipo:</b> " . $_FILES["file"]["type"] . "<br>";
            echo "<b>Tamaño:</b> " . ($_FILES["file"]["size"] / 1024) . " kB;<br>";
            echo "<p calss='textos'>Ahora Ingrese a la aplicación de nuevo para Activar los cambios</p></div>";
            //echo "<b>Temp file:</b> " . $_FILES["file"]["tmp_name"] . "<br>";
            date_default_timezone_set('America/Bogota'); 
            $hoy = date('Y-m-d g:i');

            include_once("../bin/cls/clsConection.php");
            $objClase = new DBconexion();
            $con = $objClase->conectar();
            $query = "INSERT INTO mm_agendaanexos(anexos_empresa, anexos_comiteid, anexos_agendaid, anexos_anexo, anexos_descripcion, " .
                     " anexos_ruta, anexos_usuario,  anexos_fecha, anexos_anno)";
            $query .= "  VALUES ('" .$rec[0] . "', '" . $rec[1]."', '".$rec[2]."', '".$_FILES['file']['name']."', '".$rec[4]."','".  $targetPath. 
                     "', '" . $rec[5]."', '". $hoy . "', '" . $rec[3]. "')"; 
            mysqli_query($con, $query);
            if($rec[6]==='C'){
                 
            }
            if($rec[6]=='A'){
                $query = "UPDATE mm_usuarios SET usuario_avatar = '". $_FILES["file"]["name"] .
                         "' WHERE usuario_id = '" . $rec[5] . "' AND usuario_empresa = '".$rec[0] . "'";
                mysqli_query($con, $query);
            } 
            if($rec[6]=='L')
            {
                $query = "UPDATE mm_empresa SET empresa_logo = '". $_FILES["file"]["name"] .
                         "' WHERE empresa_id = '".$rec[0] . "'";
                mysqli_query($con, $query);
            } 
        }
    }
}

else
{
echo "<span id='invalid'>***Tamaño del documento mayor a 20MB***<span>";
}
}

function zerofill($valor, $longitud){
 $res = str_pad($valor, $longitud, '0', STR_PAD_LEFT);
 return $res;
}
function CreaCarpeta($carpetaAnterior, $carpetaNueva){
    $carpeta = $carpetaAnterior .'/'.$carpetaNueva;
    if (!file_exists($carpeta)) {
        mkdir($carpeta, 0777, true);
    }
}
?>
 
