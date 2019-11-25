<html>
    <head>
        </head>
<body>
<link rel="stylesheet" href="..css/bootstrap.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" crossorigin="anonymous">

<script src="../js/bootstrap.min.js" crossorigin="anonymous"></script>

<?php
$empresa='1';
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion();
$conn = $objClase->conectar();
if (isset($_POST["import"])) {

$fileName = $_FILES["file"]["tmp_name"];

if ($_FILES["file"]["size"] > 0) {

$file = fopen($fileName, "r");

while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
    
$sqlInsert = "INSERT into mm_inmuebles (inmueble_empresa, inmueble_codigo, inmueble_descripcion, inmueble_area, ".
             " inmueble_coeficiente, inmueble_ubicacion, inmueble_propNombre, inmueble_propCedula,  ".
             " inmueble_propTelefonos, inmueble_propDireccion, inmueble_propCorreo, inmueble_Activo,  ".
             " inmueble_comite, inmueble_prinipal ) values ('" . $empresa . "','".  $column[0] . "','" .
             $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" .
             $column[5] . "','" . $column[6] . "','" . $column[7] . "','" . $column[8] . "','" .
             $column[9] . "')";
$result = mysqli_query($conn, $sqlInsert);


if (! empty($result)) {
$type = "success";
$message = "CSV Data Imported into the Database";
} else {
$type = "error";
$message = "Problem in Importing CSV Data";
}
}
}
}
?>


<div class="container">
<div class="row">
<div class="col-md-12">
    <h2><img src="../img/upload.png" width="20px" height="20"/>Import CSV file into Mysql using PHP</h2>



<div id="response" class="<?php if(!empty($type)) { echo $type . " display-block"; } ?>"><?php if(!empty($message)) { echo $message; } ?></div>
<div class="outer-scontainer">
<div class="row">
<form class="form-horizontal" action="" method="post"
name="frmCSVImport" id="frmCSVImport" enctype="multipart/form-data">
<div class="input-row">
<label class="col-md-4 control-label">Choose CSV
File</label> <input type="file" name="file"
id="file" accept=".csv"> <br>
<button type="submit" id="submit" name="import"
class="btn btn-success">Import</button>
<br />
</div>
</form>
</div>
<?php
include_once("../bin/cls/clsConection.php");
$objClase = new DBconexion();
$conn = $objClase->conectar();
$sqlSelect = "SELECT inmueble_id, inmueble_empresa, inmueble_codigo, inmueble_descripcion, " .
            " inmueble_area, inmueble_coeficiente, inmueble_ubicacion, inmueble_propNombre, " .
            " inmueble_propCedula, inmueble_propTelefonos, inmueble_propDireccion, " .
            " inmueble_propCorreo, inmueble_Activo, inmueble_comite, inmueble_prinipal " .
            " FROM mmeeting2.mm_inmuebles;";
$result = mysqli_query($conn, $sqlSelect);
if (mysqli_num_rows($result) > 0) {
?>
    <table id='userTable'>
    <thead>
    <tr>
    <th>User ID</th>
    <th>User Name</th>
    <th>First Name</th>
    <th>Last Name</th>

    </tr>
    </thead>
    <?php
    while ($row = mysqli_fetch_array($result)) {
    ?>
        <tbody>
        <tr>
        <td><?php echo $row['inmueble_codigo']; ?></td>
        <td><?php echo $row['inmueble_descripcion']; ?></td>
        <td><?php echo $row['inmueble_propNombre']; ?></td>
        <td><?php echo $row['inmueble_propCedula']; ?></td>
        </tr>
        <?php
        }
        ?>
        </tbody>
    </table>
<?php } ?>
</div>
</div>
</div>
</div>
</body>

<script>
$(document).ready(function() {
    $("#frmCSVImport").on("submit", function () {
    $("#response").attr("class", "");
    $("#response").html("");
    var fileType = ".csv";
    var regex = new RegExp("([a-zA-Z0-9\s_\\.\-:])+(" + fileType + ")$");
    if (!regex.test($("#file").val().toLowerCase())) {
        $("#response").addClass("error");
        $("#response").addClass("display-block");
        $("#response").html("Invalid File. Upload : <b>" + fileType + "</b> Files.");
        return false;
    }
        alert('Ok');
        $("#response").html("Listo ppara cargar.  : <b>" + fileType + "</b> Files.");
        return true;
    });
});
</script>


</html>

