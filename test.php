<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$nr=567;
$nr += 1;
$n=strlen($nr);
$val=  substr('00000000000', 0, 10-$n).$nr;
echo $nr.'  '.$val;
