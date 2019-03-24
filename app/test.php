<html>
    <head>
        <title>MultiMeeting</title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <meta name="language" content="es" />
   
    </head>
      
<body style="">
<form action="subeFile.php" method="post" enctype="multipart/form-data"> 
   	<b>Campo de tipo texto:</b> 
   	<br> 
   	<input type="text" name="cadenatexto" size="20" maxlength="100"> 
   	<input type="hidden" name="MAX_FILE_SIZE" value="1000000"> 
   	<br> 
   	<br> 
   	<b>Enviar un nuevo archivo: </b> 
   	<br> 
   	<input name="userfile" type="file"> 
   	<br> 
   	<input type="submit" value="Sube archivo"> 
</form>
<?php


?>
</body>
</html>