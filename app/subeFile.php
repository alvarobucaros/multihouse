<?PHP
//tomo el valor de un elemento de tipo texto del formulario 
$cadenatexto = $_POST["cadenatexto"]; 
echo "Escribió en el campo de texto: " . $cadenatexto . "<br><br>"; 
print_r($_FILES);



//Array ( //[userfile] => Array ( [name] => SERVICIOS.csv [type] => application/vnd.ms-excel [tmp_name] => C:\wamp\tmp\phpA863.tmp [error] => 0 [size] => 1315 ) ) C:\wamp\tmp\phpA863.tmp --- .... application/vnd.ms-excel ---- 1315La extensiÃ³n o el tamaÃ±o de los archivos no es correcta. 
        
//datos del arhivo 
$nombre_archivo = $_FILES['userfile']['tmp_name'];  
$tipo_archivo = $_FILES['userfile']['type']; 
$tamano_archivo = $_FILES['userfile']['size']; 
$fileName = $_FILES["userfile"]["name"];

echo $nombre_archivo . ' --- ' .$fileName. ' .... ' . $tipo_archivo . '  ---- ' . $tamano_archivo;
//compruebo si las características del archivo son las que deseo 
if (!((strpos($tipo_archivo, "gif") || strpos($tipo_archivo, "ms-excel") || strpos($tipo_archivo,"png")))){
    echo 'El tipo de archivo es errado';
}
if($tamano_archivo < 10000000) { 
   	echo " el tamaño de los archivos no es correct"; 
}else{ 
   	if (move_uploaded_file($HTTP_POST_FILES['userfile']['tmp_name'], $nombre_archivo)){ 
      	echo "El archivo ha sido cargado correctamente."; 
   	}else{ 
      	echo "Ocurrió algún error al subir el fichero. No pudo guardarse."; 
   	} 
} 


$linea = 0;
//Abrimos nuestro archivo
$archivo = fopen($nombre_archivo, "r");
//Lo recorremos
while (($datos = fgetcsv($archivo, ",")) == true) 
{
  $num = count($datos);
  $linea++;
  //Recorremos las columnas de esa linea
  for ($columna = 0; $columna < $num; $columna++) 
      {
         echo $datos[$columna] . "\n";
     $arr  =explode(";", $columna) ;
     $data =explode(';',$columna);
      echo $columna;
      echo '<br/>';
      echo $data[0].' '. $data[1];echo '<br/>';
     }
}
//Cerramos el archivo
fclose($archivo);
?>


<style>
    #dropBox{
    border: 3px dashed #0087F7;
    border-radius: 5px;
    background: #F3F4F5;
    cursor: pointer;
}
#dropBox{
    min-height: 150px;
    padding: 54px 54px;
    box-sizing: border-box;
}
#dropBox p{
    text-align: center;
    margin: 2em 0;
    font-size: 16px;
    font-weight: bold;
}
#fileInput{
    display: none;
} 
</style>

<!--<form>      
    <div id="dropBox">
        <p>Select file to upload</p>
    </div>
    <input type="file" name="fileInput" id="fileInput" />
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

https://www.codexworld.com/ajax-file-upload-using-jquery-php/

<script>
 $(function(){
    //file input field trigger when the drop box is clicked
    $("#dropBox").click(function(){
        $("#fileInput").click();
    });
    
    //prevent browsers from opening the file when its dragged and dropped
    $(document).on('drop dragover', function (e) {
        e.preventDefault();
    });

    //call a function to handle file upload on select file
    $('input[type=file]').on('change', fileUpload2);
});

function fileUpload2(){
    
}
function fileUpload(event){
    //notify user about the file upload status
    $("#dropBox").html(event.target.value+" Cargando...");
    
    //get selected file
    files = event.target.files;
    
    //form data check the above bullet for what it is  
    var data = new FormData();                                   

    //file data is presented as an array
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
//alert(file.type);
        if(!file.type.match('application/pdf' )  ){              
            //check file type
            $("#dropBox").html("Please choose an images file.");
        }else if(file.size > 1048576){
            //check file size (in bytes)
            $("#dropBox").html("Sorry, your file is too large (>1 MB)");
        }else{
            //append the uploadable file to FormData object
            data.append('file', file, file.name);
            
            //create a new XMLHttpRequest
            var xhr = new XMLHttpRequest();     
            
            //post file data for upload
            xhr.open('POST', 'uploadFile.php', true);  
            xhr.send(data);
            xhr.onload = function () {
                //get response and show the uploading status
                var response = JSON.parse(xhr.responseText);
                if(xhr.status === 200 && response.status == 'ok'){
                    $("#dropBox").html("File has been uploaded successfully. Click to upload another.");
                }else if(response.status == 'type_err'){
                    $("#dropBox").html("Please choose an images file. Click to upload another.");
                }else{
                    $("#dropBox").html("Some problem occured, please try again.");
                }
            };
        }
    }
}
</script>    -->