
<?php 
$fp=fopen("../mm.ini","rb"); 
$datos=fread($fp,filesize("../mm.ini")); 
$lista= explode  ("\r\n",$datos); 
for($x=0;$x<sizeOf($lista);$x++) 
{ 
echo($lista[$x]."<br>"); 
} 
fclose($fp); 
?> 