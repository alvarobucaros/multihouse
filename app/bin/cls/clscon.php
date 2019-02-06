<?php          
$result='OK';
            $fd = fopen('mm.ctl', 'r');
            $datos = fread($fd,100);
            fclose($fd);
            $data =explode('~',$datos);
            echo funde($data[0] ). ' ' . funde($data[1]) . ' ' .funde($data[2]) . ' ' .funde($data[3] ). ' '; 
          
function funde($txt){
    $n= strlen($txt);
    $ret='';
    for ($i=0;$i<=$n;$i++)
    {
        $ret.= substr($txt,$n - $i,1);
    }
    return $ret;
}
            
            ?>